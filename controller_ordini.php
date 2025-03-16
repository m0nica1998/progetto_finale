<?php

session_start();
$azione = $_GET['action'];

if ($azione == 'create') {
  create_ordine();
} elseif ($azione == 'delete') {
  // Implementa la funzione delete_ordine()
} elseif ($azione == 'edit') {
  // Implementa la funzione edit_ordine()
} elseif($azione == 'showAll') {
  showAll();
}

function create_ordine()
{
  
  $id_user = $_SESSION['id_user'];
  $carrello = $_SESSION['carrello'];
  $totale = 0;
  $id_prodotti = [];
  $id_ordine = "";

  // Formattazione corretta della data
  $dataCorrente = (new DateTime())->format('Y-m-d');
   var_dump($carrello);
  // Calcolo del totale dell'ordine
  foreach ($carrello as $prodotto) {
    $totale += $prodotto['prezzo'] * $prodotto['quantita'];
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
    echo "ok 0";
    // Recupero dell'ID dell'ordine appena creato
    $sql = "SELECT id FROM ordini WHERE utente = ? AND data = ? ORDER BY id DESC LIMIT 1";

    $stmt_ordine = $connessione->prepare($sql);
    $stmt_ordine->bind_param("ss", $id_user, $dataCorrente);

    if ($stmt_ordine->execute()) {
      $result = $stmt_ordine->get_result();
      echo "ok 1";
      if ($result->num_rows > 0) {
        echo "ok 2";
        $row = $result->fetch_assoc();
        $id_ordine = $row['id'];
        echo $id_ordine;
         // Query preparata per inserire ogni prodotto nell'ordine
      $sql = "INSERT INTO prodotti_ordini (id_ordine, id_prodotto, quantita) VALUES (?, ?, ?)";
      $stmt = $connessione->prepare($sql);

      // Controllo se la preparazione della query è andata a buon fine
      if (!$stmt) {
        die("Errore nella preparazione della query: " . $connessione->error);
      }
      var_dump($id_prodotti);
      // Itero su ogni prodotto e lo inserisco nel database
      foreach ($id_prodotti as $id_prodotto) {
        
        $stmt->bind_param("iii", $id_ordine, $id_prodotto['id'], $id_prodotto['quantita']);
        $stmt->execute();
      }
      }
     //svuoto il carrello
     $_SESSION['carrello'] = [];
     $query = "UPDATE prodotti SET disp_magazzino = ? WHERE id = ?";
     $stmt_update = $connessione->prepare($query);
      // Controllo se la preparazione della query è andata a buon fine
      if (!$stmt_update) {
        die("Errore nella preparazione della query: " . $connessione->error);
      }
         // Itero su ogni prodotto e lo inserisco nel database
         var_dump($id_prodotti);
         foreach ($id_prodotti as $id_prodotto) {
        var_dump($id_prodotto);
        echo $id_prodotto['id'];
        echo $id_prodotto['quantita'];
        $nuova_disp = $id_prodotto['disp_magazzino'] - $id_prodotto['quantita'];
          $stmt_update->bind_param("ii",   $nuova_disp, $id_prodotto['id']);
          $stmt_update->execute();
        }
    header('Location: messaggio_ordine.php');
    exit();
    
    }

    // Aggiungere qui eventuali altre operazioni (es. inserire dettagli ordine)
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

function showAll(){
  // Connessione al DB
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  $query = "SELECT id, utente,  prezzo, data FROM ordini ORDER BY data DESC";
  if ($result = $connessione->query($query)) {

    //verifica se sono presenti dati nella tabella
    if ($result->num_rows > 0) {
      $ordini = [];
      while ($row = $result->fetch_assoc()){
        $ordine = [
          "id" => $row['id'],
          "utente" => $row['utente'],
          "prezzo" => $row['prezzo'],
          "data" => $row['data']

        ];
        array_push($ordini, $ordine);
      }
      $_SESSION['ordini'] = $ordini;
      header('Location: utente.php');
      exit();
    } 
  } else {
    
      $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
      header('Location: utente.php');
      exit();
    
  }
}
