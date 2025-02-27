<?php 
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
  $immagine = $_POST['immagine'];
  $disp_magazzino = $_POST['disp_magazzino'];
//echo  $prezzo . "<br>";
//echo $nome_prodotto . "<br>";
//echo   $tipo . "<br>";
//echo $immagine . "<br>";
//echo $disp_magazzino . "<br>";

  
}
?>