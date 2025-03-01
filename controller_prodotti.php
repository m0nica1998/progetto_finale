<?php
//fare controllo immmagine e limite peso file imm.
session_start();
// selettore di metodi CRUD
$action = $_GET['action'];
if ($action == 'create') {
  create();
} elseif($action == 'showAll'){
  showAll();
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
        var_dump($borse);
        var_dump($piante);
        var_dump($gioielli);
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



