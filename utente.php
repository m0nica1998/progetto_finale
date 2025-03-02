<?php
// Inizia la sessione per gestire le variabili di sessione
session_start();

// Imposta il titolo della pagina
$title = "Area personale";

// Include il file 'header.php' che contiene la parte dell'intestazione del sito
include('header.php');


// Verifica se l'utente è un amministratore (is_admin == 1) o un normale utente (is_admin == 0)
if ($_SESSION['is_admin'] == 0) {
  // Se l'utente è un normale utente (is_admin == 0), stampa un messaggio "pagina user" e include la pagina utente
  echo "pagina user";
  include('homepage_user.php');  // Include il file 'homepage_user.php' per l'utente normale
} else {
  // Se l'utente è un amministratore (is_admin == 1), stampa un messaggio "pagina admin" e include la pagina amministratore
  echo "pagina admin";
  include('homepage_admin.php');  // Include il file 'homepage_admin.php' per l'amministratore
}

// Include il file 'footer.php' che contiene il piè di pagina del sito
include('footer.php');
