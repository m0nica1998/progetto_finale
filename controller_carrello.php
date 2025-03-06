<?php 
session_start();
$azione = $_GET['action'];
if ($azione == 'create') {
  create_carrello();
}  elseif ($azione == 'delete') {
    delete_carrello();
  } elseif($azione == 'edit'){
    edit_carrello();
  }
function create_carrello(){
if($_SESSION['name'] != ""){
// recupero id, tipo, prezzo, nome immagine e disponibilità prodotto
// creare variabile sessione per il carrello (se non esiste)
// aggiungo il prodotto al carrello
//ritorno alla pagina del prodotto in base al tipo
} else {
  $_SESSION['errore'] = "Effettua il login";
  header("Location: login.php");
  exit();
}
};

function delete_carrello(){
  if($_SESSION['name'] != ""){
//recupero id prodotto
// ciclo nel carrello 
// quando l'id del prodotto nel carrello coincide con quello recuperato, rimuovo il prodotto dal carrello
// ritorno alla pagina del carrello
  } else {
    header("Location: login.php");
    exit();
  }
}

function edit_carrello(){
  if($_SESSION['name'] != ""){
// recupero id e disponibilità in magazzino 
// ciclo nel carrello 
// quando l'id del prodotto nel carrello coincide con quello recuperato, verifico che ci sia il prodotto in magazzino, modifico la quantità
// ritorno al carrello

  } else {
    header("Location: login.php");
    exit();
  }
}
?>