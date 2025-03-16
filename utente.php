<?php

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
     
    } 
  } else {
    
      $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
     
    
  }
}

// Avvia la sessione per gestire variabili globali tra le pagine
session_start();
// Imposta il titolo della pagina
$title = "Area personale";
// Includi l'header del sito
include('header.php');
// Stampa il valore della variabile di sessione 'is_admin', che indica se l'utente è un amministratore
echo $_SESSION['is_admin'];

// Verifica il valore di 'is_admin' per determinare quale pagina mostrare
if ($_SESSION['is_admin'] == 0) {
  // Se l'utente non è amministratore (is_admin == 0), mostra "pagina user" e include la pagina dell'utente
  echo "pagina user";
  include('homepage_user.php');
} else {
  // Se l'utente è amministratore (is_admin != 0), mostra "pagina admin" e include la pagina dell'amministratore
  showAll();
  echo "pagina admin";
  include('homepage_admin.php');
}



// Includi il footer del sito
include('footer.php');
