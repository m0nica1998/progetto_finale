<?php
// Avvio della sessione per gestire le variabili di sessione
session_start();
// Selettore di metodi CRUD in base all'azione ricevuta tramite GET
$action = $_GET['action'];
if ($action == 'create') {
  create();
} elseif($action == 'showAll'){
  showAll();
} elseif($action == 'delete'){
  delete();
} elseif($action == 'edit'){
  edit();
}


// Funzione per creare un nuovo prodotto nel database
function create()
{
  $_SESSION['errore'] = "";
  $_SESSION['successo'] = "";
  
  // Recupero dati dal form
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  $disp_magazzino = $_POST['disp_magazzino'];

  // Recupero immagine
  $filename = $_FILES['immagine']['name'];
  $filedata = $_FILES['immagine']['name'] != null ? ($_FILES['immagine']['tmp_name']) : "";

 // Controllo della validità dei dati
  if (!(strlen($nome_prodotto) > 0)) {
    $_SESSION['errore'] = "Non hai inserito nessun nome ";
  }
  if (!($prezzo > 0)) {
    $_SESSION['errore'] = "Il prezzo non è valido ";
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

 // Query per inserire i dati
  $sql_insert = "INSERT INTO prodotti (nome, tipo, prezzo, immagine, fileData, disp_magazzino) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt_insert = $connessione->prepare($sql_insert);
  $stmt_insert->bind_param("ssssss", $nome_prodotto, $tipo, $prezzo, $filename, $filedata, $disp_magazzino);

  // Esecuzione query e gestione della risposta
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

// Funzione per mostrare tutti i prodotti
function showAll (){

    // Connessione al DB
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
    if ($connessione->connect_error) {
      die("Errore di connessione: " . $connessione->connect_error);
    }

    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";
    if ($result = $connessione -> query($query)) {
    
      //verifica se sono presenti dati nella tabella
      if($result -> num_rows > 0) { 
        $piante = [];
        $borse = [];
        $gioielli = [];
        while ($row = $result->fetch_assoc()){
          if($row['tipo'] == "piante"){
            $pianta = [
              "id" => $row['id'],
              "nome" => $row['nome'],
              "tipo" => "piante",
              "prezzo" => $row['prezzo'],
              "immagine" => $row['immagine'],
              "fileData" => $row['fileData'],
              "disp_magazzino" => $row['disp_magazzino']

            ];
            array_push($piante, $pianta);
          } elseif($row['tipo'] == "borse"){
            $borsa = [
              "id" => $row['id'],
              "nome" => $row['nome'],
              "tipo" => "borse",
              "prezzo" => $row['prezzo'],
              "immagine" => $row['immagine'],
              "fileData" => $row['fileData'],
              "disp_magazzino" => $row['disp_magazzino']

            ];
            array_push($borse, $borsa);
          } else { 
            $gioiello = [
              "id" => $row['id'],
              "nome" => $row['nome'],
              "tipo" => "gioielli",
              "prezzo" => $row['prezzo'],
              "immagine" => $row['immagine'],
              "fileData" => $row['fileData'],
              "disp_magazzino" => $row['disp_magazzino']

            ];
            array_push($gioielli, $gioiello);

          }
        }
        
       $_SESSION['piante'] = $piante;
       $_SESSION['borse'] = $borse;
       $_SESSION['gioielli'] = $gioielli;
       header('Location: utente.php');
       exit();
      } else {
         $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
         header('Location: utente.php');
         exit();
      }}
      
}




// Funzione per eliminare un prodotto
function delete(){
  $id = $_GET['id'];
  echo $id;
  // Connessione al DB
  $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
  if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
  }
  $sql = "DELETE FROM prodotti WHERE id = ?"; //operazione irreversibile
  $stmt_insert = $connessione->prepare($sql);
  $stmt_insert->bind_param("s", $id);

  if ($stmt_insert->execute()) {
    showAll();
    $connessione->close();
    $_SESSION['successo'] = " Il prodotto è stato eliminato correttamente dal db <br>";
    header("Location: utente.php"); // Reindirizzamento alla pagina utente
    exit();
  } else {
    $_SESSION['id_errore'] = $id;
    $_SESSION['errore_eliminazione'] = "Errore nell'eliminare il prodotto: " . $connessione->error;
    header("Location: utente.php");
    exit();
  }

}


function edit(){
  $_SESSION['error'] = "";
  $_SESSION['successo'] = "";
  $id = $_GET['id'];
  

 
   //recupero input form
   $nome_prodotto = $_POST['nome_prodotto'];
   $prezzo = $_POST['prezzo'];
   $tipo = $_POST['tipo'];
   $disp_magazzino = $_POST['disp_magazzino'];
  
  // recupero immagine
   $filename = $_FILES['immagine']['name'];
   $filedata = $_FILES['immagine']['name'] != null ? ($_FILES['immagine']['tmp_name']) : "";

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
   $sql_update = "UPDATE prodotti 
               SET nome = ?, 
                   tipo = ?, 
                   prezzo = ?, 
                   immagine = ?, 
                   fileData = ?,  
                   disp_magazzino = ? 
               WHERE id = ?";

   $stmt_update = $connessione->prepare($sql_update);
   $stmt_update->bind_param("sssssss", $nome_prodotto, $tipo, $prezzo, $filename, $filedata, $disp_magazzino, $id);
 
   if ($stmt_update->execute()) {
     $connessione->close();
     $_SESSION['successo'] = " Il prodotto è stato aggiornato correttamente sul db";
     showAll();
     header("Location: utente.php"); // Reindirizzamento alla pagina utente
     exit();
   } else {
     $_SESSION['errore'] = "Errore nell'aggiornamento dei dati: " . $connessione->error;
     header("Location: utente.php");
     exit();
   }


}

