<?php
// Avvia la sessione per mantenere variabili di sessione tra le richieste
session_start();

// Inizializza la variabile di sessione per memorizzare eventuali errori
$_SESSION['errore'] = "";

// Recupera l'azione richiesta dalla query string, utile per distinguere operazioni CRUD
$action = $_GET['action'];

// Se l'azione richiesta è 'create', chiama la funzione per creare un nuovo prodotto
if ($action == 'create') {
  create();
}

function create()
{
  $_SESSION['errore'] = "";
  $_SESSION['successo'] = "";
  
  // Recupero input form
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  $disp_magazzino = $_POST['disp_magazzino'];

  // Controllo dati base
  if (empty($nome_prodotto)) {
    $_SESSION['errore'] = "Non hai inserito nessun nome";
  }
  if (!($prezzo > 0)) {
    $_SESSION['errore'] = "Il prezzo non è valido";
  }
  
  $tipi = ["piante", "borse", "gioielli"];
  if (!(in_array($tipo, $tipi))) {
    $_SESSION['errore'] = "Seleziona un tipo corretto";
  }
  if (!($disp_magazzino >= 0)) {
    $_SESSION['errore'] = "La disponibilità non è corretta";
  }

  // Controllo immagine
  if (!isset($_FILES['immagine']) || $_FILES['immagine']['error'] != 0) {
    $_SESSION['errore'] = "Errore nel caricamento dell'immagine";
  } else {
    $filename = $_FILES['immagine']['name'];
    $filedata = $_FILES['immagine']['tmp_name'];
    $filesize = $_FILES['immagine']['size'];
    $filetype = $_FILES['immagine']['type'];
    $allowed_types = ["image/jpeg", "image/png", "image/gif"];
    
    if (!in_array($filetype, $allowed_types)) {
      $_SESSION['errore'] = "Formato immagine non valido. Sono ammessi solo JPEG, PNG e GIF";
    }
    if ($filesize > 819200) { // 800 KB
      $_SESSION['errore'] = "L'immagine supera il limite di 800 KB";
    }
  }

  if (!empty($_SESSION['errore'])) {
    header('Location: utente.php');
    exit();
  }

  // Connessione al DB
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  // Modifica del database per permettere un valore predefinito per fileData
  $connessione->query("ALTER TABLE prodotti MODIFY fileData TEXT DEFAULT ''");

  // Salvataggio immagine nel server
  $upload_dir = "uploads/";
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
  }
  $file_path = $upload_dir . basename($filename);
  move_uploaded_file($filedata, $file_path);

  // Inserimento dati nel database
  $sql_insert = "INSERT INTO prodotti (nome, tipo, prezzo, immagine, disp_magazzino) VALUES (?, ?, ?, ?, ?)";
  $stmt_insert = $connessione->prepare($sql_insert);
  $stmt_insert->bind_param("ssdsi", $nome_prodotto, $tipo, $prezzo, $file_path, $disp_magazzino);

  if ($stmt_insert->execute()) {
    $_SESSION['successo'] = "Il prodotto è stato caricato correttamente sul database";
  } else {
    $_SESSION['errore'] = "Errore nell'inserimento dei dati: " . $connessione->error;
  }

  $connessione->close();
  header("Location: utente.php");
  exit();
}
