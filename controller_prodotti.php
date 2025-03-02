<?php
// Avvia la sessione per gestire i messaggi di errore e successo
session_start();

// Selettore di metodi CRUD in base al parametro 'action' passato via GET
$action = $_GET['action'];
if ($action == 'create') {
  create();
} elseif ($action == 'showAll') {
  showAll();
} elseif ($action == 'delete') {
  delete();
} elseif ($action == 'edit') {
  edit();
}

// Funzione per creare un nuovo prodotto nel database
function create() {
  $_SESSION['errore'] = "";
  $_SESSION['successo'] = "";

  // Recupero input dal form
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  $disp_magazzino = $_POST['disp_magazzino'];
  
  // Gestione immagine caricata
  $filename = $_FILES['immagine']['name'];
  $filedata = $_FILES['immagine']['tmp_name'] ?? "";

  // Controllo dei dati inseriti
  if (strlen($nome_prodotto) == 0) {
    $_SESSION['errore'] = "Non hai inserito nessun nome";
  }
  if ($prezzo <= 0) {
    $_SESSION['errore'] = "Il prezzo non è valido";
  }
  $tipi = ["piante", "borse", "gioielli"];
  if (!in_array($tipo, $tipi)) {
    $_SESSION['errore'] = "Seleziona un tipo corretto";
  }
  if ($disp_magazzino < 0) {
    $_SESSION['errore'] = "La disponibilità non è corretta";
  }
  
  if (!empty($_SESSION['errore'])) {
    header('Location: utente.php');
    exit();
  }

  // Connessione al database
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  // Inserimento dati nel database
  $sql_insert = "INSERT INTO prodotti (nome, tipo, prezzo, immagine, fileData, disp_magazzino) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt_insert = $connessione->prepare($sql_insert);
  $stmt_insert->bind_param("ssssss", $nome_prodotto, $tipo, $prezzo, $filename, $filedata, $disp_magazzino);

  if ($stmt_insert->execute()) {
    $_SESSION['successo'] = "Il prodotto è stato caricato correttamente";
  } else {
    $_SESSION['errore'] = "Errore nell'inserimento: " . $connessione->error;
  }
  
  $connessione->close();
  header("Location: utente.php");
  exit();
}

// Funzione per visualizzare tutti i prodotti
function showAll() {
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  $query = "SELECT * FROM prodotti";
  $result = $connessione->query($query);
  
  if ($result->num_rows > 0) {
    $_SESSION['prodotti'] = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $_SESSION['errore'] = "Nessun prodotto trovato";
  }
  
  $connessione->close();
  header("Location: utente.php");
  exit();
}

// Funzione per eliminare un prodotto
function delete() {
  $id = $_GET['id'];
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  $sql = "DELETE FROM prodotti WHERE id = ?";
  $stmt = $connessione->prepare($sql);
  $stmt->bind_param("s", $id);
  
  if ($stmt->execute()) {
    $_SESSION['successo'] = "Prodotto eliminato con successo";
  } else {
    $_SESSION['errore'] = "Errore nell'eliminazione: " . $connessione->error;
  }
  
  $connessione->close();
  header("Location: utente.php");
  exit();
}

// Funzione per modificare un prodotto
function edit() {
  $id = $_GET['id'];
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  $disp_magazzino = $_POST['disp_magazzino'];
  $filename = $_FILES['immagine']['name'];
  $filedata = $_FILES['immagine']['tmp_name'] ?? "";
  
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }

  $sql_update = "UPDATE prodotti SET nome = ?, tipo = ?, prezzo = ?, immagine = ?, fileData = ?, disp_magazzino = ? WHERE id = ?";
  $stmt_update = $connessione->prepare($sql_update);
  $stmt_update->bind_param("sssssss", $nome_prodotto, $tipo, $prezzo, $filename, $filedata, $disp_magazzino, $id);

  if ($stmt_update->execute()) {
    $_SESSION['successo'] = "Prodotto aggiornato correttamente";
  } else {
    $_SESSION['errore'] = "Errore nell'aggiornamento: " . $connessione->error;
  }
  
  $connessione->close();
  header("Location: utente.php");
  exit();
}
