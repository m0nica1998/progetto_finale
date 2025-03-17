<?php 
session_start(); // Avvia la sessione per accedere alle variabili di sessione
$title = "Messaggio ordine"; // Definisce il titolo della pagina
include("header.php") // Include il file "header.php" per caricare l'intestazione della pagina
?>

<!-- Contenuto principale della pagina -->
<main class="main-mess-ordine">
  <!-- Messaggio di conferma ordine, centrato -->
<h3 class="text-center">Complimenti! Hai completato con successo un ordine</h3>
</main>

<?php 
// Include il file "footer.php" per caricare il piè di pagina
include("footer.php") ?>