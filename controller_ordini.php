<?php

session_start(); // Avvia la sessione per poter usare le variabili di sessione
$azione = $_GET['action']; // Recupera l'azione passata tramite GET

// In base all'azione richiesta, chiama la funzione corrispondente
if ($azione == 'create') {
  create_ordine(); // Crea un nuovo ordine

  
} elseif($azione == 'showAll') {
  showAll(); // Mostra tutti gli ordini
}


/**
 * Funzione per creare un nuovo ordine
 */
function create_ordine()
{
  
  $id_user = $_SESSION['id_user']; // Recupera l'ID dell'utente dalla sessione
  $carrello = $_SESSION['carrello']; // Recupera il carrello dalla sessione
  $totale = 0; // Inizializza il totale dell'ordine
  $id_prodotti = []; // Array per memorizzare i prodotti dell'ordine
  $id_ordine = ""; // Variabile per l'ID dell'ordine

  // Ottiene la data corrente nel formato corretto per il database (YYYY-MM-DD)
  $dataCorrente = (new DateTime())->format('Y-m-d');
   
  // Calcola il totale dell'ordine e prepara i dati dei prodotti
  foreach ($carrello as $prodotto) {
    $totale += $prodotto['prezzo'] * $prodotto['quantita']; // Somma il costo totale
    // crea l'array associativo $mappa_prodotto e lo aggiunge alla fine dell'array $id_prodotti
    array_push($id_prodotti, $mappa_prodotto = ['id' => $prodotto['id'], 'quantita' => $prodotto['quantita'], 'disp_magazzino' => $prodotto['disp_magazzino']]);
  }

  // Connessione al database
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  // Inserimento dell'ordine nella tabella ordini
  $sql_insert = "INSERT INTO ordini (utente, prezzo, data) VALUES (?, ?, ?)";
  $stmt_insert = $connessione->prepare($sql_insert);
  $stmt_insert->bind_param("sss", $id_user, $totale, $dataCorrente);

  if ($stmt_insert->execute()) {
    
    // Recupero dell'ID dell'ordine appena creato
    $sql = "SELECT id FROM ordini WHERE utente = ? AND data = ? ORDER BY id DESC LIMIT 1";

    $stmt_ordine = $connessione->prepare($sql);
    $stmt_ordine->bind_param("ss", $id_user, $dataCorrente);

    if ($stmt_ordine->execute()) {
      $result = $stmt_ordine->get_result();
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_ordine = $row['id']; // Recupera l'ID dell'ordine
        
       // Query per inserire i prodotti associati all'ordine
      $sql = "INSERT INTO prodotti_ordini (id_ordine, id_prodotto, quantita) VALUES (?, ?, ?)";
      $stmt = $connessione->prepare($sql);

      // Controllo se la preparazione della query è andata a buon fine
      if (!$stmt) {
        die("Errore nella preparazione della query: " . $connessione->error);
      }
     
     // Inserisce ogni prodotto dell'ordine nella tabella `prodotti_ordini`
      foreach ($id_prodotti as $id_prodotto) {
        
        $stmt->bind_param("iii", $id_ordine, $id_prodotto['id'], $id_prodotto['quantita']);
        $stmt->execute();
      }
      }
    // Svuota il carrello dell'utente
     $_SESSION['carrello'] = [];

     // Query per aggiornare la disponibilità in magazzino dei prodotti acquistati
     $query = "UPDATE prodotti SET disp_magazzino = ? WHERE id = ?";
     $stmt_update = $connessione->prepare($query);
      // Controllo se la preparazione della query è andata a buon fine
      if (!$stmt_update) {
        die("Errore nella preparazione della query: " . $connessione->error);
      }
          // Aggiorna la disponibilità per ogni prodotto acquistato
         foreach ($id_prodotti as $id_prodotto) {
        $nuova_disp = $id_prodotto['disp_magazzino'] - $id_prodotto['quantita'];
          $stmt_update->bind_param("ii",   $nuova_disp, $id_prodotto['id']);
          $stmt_update->execute();
        }

        // Reindirizza l'utente a una pagina di conferma dell'ordine
    header('Location: messaggio_ordine.php');
    exit();
    
    }

    // Se c'è un errore nell'inserimento dell'ordine, salva l'errore nella sessione e reindirizza l'utente
  } else {
    $_SESSION['errore'] = "Errore nell'inserimento dei dati: " . $connessione->error;
    header("Location: checkout.php");
    exit();
  }

  // Chiudere la connessione al database
  $stmt_insert->close();
  $stmt_ordine->close();
  $connessione->close();

  
}


/**
 * Funzione per mostrare tutti gli ordini
 */
function showAll(){
  // Connessione al DB
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  // Query per selezionare tutti gli ordini, ordinati per data decrescente
  $query = "SELECT id, utente,  prezzo, data FROM ordini ORDER BY data DESC";
  if ($result = $connessione->query($query)) {

    // Controlla se ci sono ordini nel database
    if ($result->num_rows > 0) {
      $ordini = [];
      while ($row = $result->fetch_assoc()){
        $ordine = [
          "id" => $row['id'],
          "utente" => $row['utente'],
          "prezzo" => $row['prezzo'],
          "data" => $row['data']

        ];
        array_push($ordini, $ordine); //aggiunge un elemento alla fine dell'array
      }
      // Salva gli ordini nella sessione e reindirizza l'utente alla pagina `utente.php`
      $_SESSION['ordini'] = $ordini;
      header('Location: utente.php');
      exit();
    } // Se non ci sono prodotti, salva un messaggio di errore nella sessione e reindirizza
  } else {
    
      $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
      header('Location: utente.php');
      exit();
    
  }
}
