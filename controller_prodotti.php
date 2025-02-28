<?php 
session_start();
// selettore di metodi CRUD
$action = $_GET['action'];
if($action == 'create'){
  create();
}


function create(){
  //recupero input form
  $nome_prodotto = $_POST['nome_prodotto'];
  $prezzo = $_POST['prezzo'];
  $tipo = $_POST['tipo'];
  //$immagine = $_POST['immagine'];
 // $fileData = $_POST['file_data'];
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
echo $filedata ;

//controllo dei dati
if(!(strlen($nome_prodotto) > 0)){
  $_SESSION['errore'] = "non hai inserito nessun nome";

}
if(!($prezzo > 0)){
  $_SESSION['errore'] = "il prezzo non è valido";
}

$tipi = ["piante", "borse", "gioielli"];
if(!(in_array($tipo, $tipi))){
  $_SESSION['errore'] = "seleziona un tipo corretto";
}
if(!($disp_magazzino >= 0)){
  $_SESSION['errore'] = "la disponibilità non è corretta";
}
if(!empty($filename) && !empty($filedata)){
  $_SESSION['errore'] = "seleziona una immagine";
}

header('Location: utente.php');
exit();




  
}
?>