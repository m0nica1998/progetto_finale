<?php
// Avvia una sessione per gestire le variabili di sessione
session_start();
$title = "Modifica Prodotto";
// Includi il file dell'header 
include('header.php');

// Recupera l'ID e il tipo del prodotto dalla query string nell'URL
$id = $_GET['id']; // ID del prodotto da modificare
$tipo = $_GET['tipo']; // Tipo del prodotto (piante, borse, gioielli)

// Variabile per memorizzare l'array dei prodotti in base al tipo
$prodotti;
if($tipo == 'piante'){
  // Se il tipo è 'piante', recupera il relativo array di prodotti dalla sessione
  $prodotti = $_SESSION['piante'];
} elseif($tipo == 'borse'){
  // Se il tipo è 'borse', recupera il relativo array di prodotti dalla sessione
  $prodotti = $_SESSION['borse'];
} else {
  // Altrimenti, recupera l'array di 'gioielli'
  $prodotti = $_SESSION['gioielli'];
}

// Recupera il prodotto specifico in base all'ID
$prodotti[$id];

?>

<main class="modifica-prodotto">
   <!-- Inizio del form di modifica prodotto -->
  <form action="controller_prodotti.php?action=edit&id=<?php echo  $prodotti[$id]['id'] ?>" method="post" enctype="multipart/form-data"
  >
    <!-- Campo per il nome del prodotto -->
    <div class="mb-3">
      <label for="" class="form-label">Nome</label>
      <input
        type="text"
        class="form-control"
        name="nome_prodotto"
        id="nome_prodotto"
        aria-describedby="helpId"
        placeholder="Nome prodotto"
        value = "<?php echo $prodotti[$id]['nome'] ?>" />

    </div>
     <!-- Campo per il prezzo del prodotto -->
    <div class="input-group mb-3">
    <label for="" class="form-label">Prezzo</label>
      <span class="input-group-text">€</span>
      <input type="number" id="prezzo" name="prezzo" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $prodotti[$id]['prezzo'] ?>">

    </div>
     <!-- Campo per il tipo di prodotto (piante, borse, gioielli) -->
    <div class="mb-3">
      <label for="" class="form-label">Tipo</label>
      <select
        class="form-select form-select-lg"
        name="tipo"
        id="tipo">
        <!-- Opzioni del tipo di prodotto, con il valore selezionato preimpostato in base al tipo corrente -->
        <option value="piante" <?php if($tipo == 'piante'){
          echo "selected"; }?>>Piante</option>
        <option value="borse" <?php if($tipo == 'borse'){
          echo "selected"; }?>>Borse</option>
        <option value="gioielli" <?php if($tipo == 'gioielli'){
          echo "selected"; }?>>Gioielli</option>
      </select>
    </div>
     <!-- Campo per la selezione dell'immagine del prodotto -->
    <div class="mb-3">
      <label for="" class="form-label">Seleziona l'immagine del prodotto</label>
      <input
        type="file"
        class="form-control"
        name="immagine"
        id="immagine"
        placeholder="Immagine prodotto"
        aria-describedby="fileHelpId" required />

    </div>
      <!-- Campo per la disponibilità in magazzino -->
    <div class="mb-3">
      <label for="" class="form-label">Disponibilità magazzino</label>
      <input
        type="number"
        class="form-control"
        name="disp_magazzino"
        id="disp_magazzino"
        aria-describedby="helpId"
        placeholder=""
        value = "<?php echo $prodotti[$id]['disp_magazzino'] ?>" />

    </div>
    <!-- Bottone per inviare il form -->
   <button
    type="submit"
    class="btn btn-primary"
   >
    Salva modifiche
   </button>
   
  </form>
</main>
<?php 
// Includi il file del footer
include('footer.php'); 
?>