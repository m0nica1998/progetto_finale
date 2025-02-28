<?php
//fare controllo immmagine e limite peso file imm.
session_start();
// selettore di metodi CRUD
$action = $_GET['action'];
if ($action == 'create') {
  create();
}


function create()
{
  $_SESSION['errore'] = "";
  $_SESSION['successo'] = "";
  //recupero input form
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  
  $disp_magazzino = $_POST['disp_magazzino'];

  // Nome del file
  $filename = $_FILES['immagine']['name'];
  // Dati del file
  $filedata = $_FILES['immagine']['name'] != null ? ($_FILES['immagine']['tmp_name']) : "";

  echo  $prezzo . "<br>";
  echo $nome_prodotto . "<br>";
  echo   $tipo . "<br>";
  echo $filename . "<br>";
  echo $disp_magazzino . "<br>";
  echo $filedata;

  //controllo dei dati
  if (!(strlen($nome_prodotto) > 0)) {
    $_SESSION['errore'] = "non hai inserito nessun nome ";
  }
  if (!($prezzo > 0)) {
    $_SESSION['errore'] = "il prezzo non è valido ";
  }

  $tipi = ["piante", "borse", "gioielli"];
  if (!(in_array($tipo, $tipi))) {
    $_SESSION['errore'] = "seleziona un tipo corretto ";
  }
  if (!($disp_magazzino >= 0)) {
    $_SESSION['errore'] = "la disponibilità non è corretta ";
  }
 
  if (isset($_SESSION['errore']) && ($_SESSION['errore'] != "")) {
    header('Location: utente.php');
    exit();
  }


  // Connessione al DB
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  // Inserimento dati
  $sql_insert = "INSERT INTO prodotti (nome, tipo, prezzo, immagine, fileData, disp_magazzino) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt_insert = $connessione->prepare($sql_insert);
  $stmt_insert->bind_param("ssssss", $nome_prodotto, $tipo, $prezzo, $filename, $filedata, $disp_magazzino);

  if ($stmt_insert->execute()) {
    $connessione->close();
    $_SESSION['successo'] = " Il prodotto è stato caricato correttamente sul db";
    header("Location: utente.php"); // Reindirizzamento alla pagina utente
    exit();
  } else {
    $_SESSION['errore'] = "Errore nell'inserimento dei dati: " . $connessione->error;
    header("Location: utente.php");
    exit();
  }
}
