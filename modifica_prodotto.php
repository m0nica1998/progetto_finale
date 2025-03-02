<?php
// Inizia la sessione per poter accedere alle variabili di sessione
session_start();

// Includi l'header del sito che contiene il codice HTML per l'intestazione della pagina
include('header.php');

// Recupera gli ID e il tipo di prodotto dalla query string (parametri passati nell'URL)
$id = $_GET['id'];  // ID del prodotto
$tipo = $_GET['tipo'];  // Tipo di prodotto (piante, borse, gioielli)

// Definisce una variabile $prodotti per accedere ai prodotti in base al tipo selezionato
if ($tipo == 'piante') {
  $prodotti = $_SESSION['piante'];  // Carica i prodotti di tipo piante dalla sessione
} elseif ($tipo == 'borse') {
  $prodotti = $_SESSION['borse'];  // Carica i prodotti di tipo borse dalla sessione
} else {
  $prodotti = $_SESSION['gioielli'];  // Carica i prodotti di tipo gioielli dalla sessione
}

// Recupera i dettagli del prodotto con l'ID specificato
$prodotto = $prodotti[$id];  // Accede al prodotto specifico usando l'ID
?>

<main class="modifica-prodotto">
  <!-- Form per modificare il prodotto, invia i dati al controller con l'azione 'edit' -->
  <form action="controller_prodotti.php?action=edit&id=<?php echo  $prodotto['id'] ?>" method="post" enctype="multipart/form-data">
    
    <!-- Campo per modificare il nome del prodotto -->
    <div class="mb-3">
      <label for="nome_prodotto" class="form-label">Nome</label>
      <input
        type="text"
        class="form-control"
        name="nome_prodotto"
        id="nome_prodotto"
        aria-describedby="helpId"
        placeholder="Nome prodotto"
        value="<?php echo $prodotto['nome'] ?>"  <!-- Valore precompilato con il nome attuale del prodotto -->
      />
    </div>

    <!-- Campo per modificare il prezzo del prodotto -->
    <div class="input-group mb-3">
      <label for="prezzo" class="form-label">Prezzo</label>
      <span class="input-group-text">€</span>
      <input
        type="number"
        id="prezzo"
        name="prezzo"
        class="form-control"
        aria-label="Amount (to the nearest euro)"
        value="<?php echo $prodotto['prezzo'] ?>"  <!-- Valore precompilato con il prezzo attuale -->
      >
    </div>

    <!-- Campo per selezionare il tipo di prodotto (piante, borse, gioielli) -->
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select
        class="form-select form-select-lg"
        name="tipo"
        id="tipo"
      >
        <!-- Opzioni per selezionare il tipo, la selezione è precompilata in base al tipo attuale -->
        <option value="piante" <?php if($tipo == 'piante'){ echo "selected"; }?>>Piante</option>
        <option value="borse" <?php if($tipo == 'borse'){ echo "selected"; }?>>Borse</option>
        <option value="gioielli" <?php if($tipo == 'gioielli'){ echo "selected"; }?>>Gioielli</option>
      </select>
    </div>

    <!-- Campo per caricare una nuova immagine del prodotto -->
    <div class="mb-3">
      <label for="immagine" class="form-label">Seleziona l'immagine del prodotto</label>
      <input
        type="file"
        class="form-control"
        name="immagine"
        id="immagine"
        placeholder="Immagine prodotto"
        aria-describedby="fileHelpId" 
        required  <!-- Il campo immagine è obbligatorio -->
      />
    </div>

    <!-- Campo per modificare la disponibilità in magazzino -->
    <div class="mb-3">
      <label for="disp_magazzino" class="form-label">Disponibilità magazzino</label>
      <input
        type="number"
        class="form-control"
        name="disp_magazzino"
        id="disp_magazzino"
        aria-describedby="helpId"
        placeholder=""
        value="<?php echo $prodotto['disp_magazzino'] ?>"  <!-- Valore precompilato con la disponibilità attuale -->
      />
    </div>

    <!-- Bottone per inviare il form e salvare le modifiche -->
    <button type="submit" class="btn btn-primary">
      Salva modifiche
    </button>
   
  </form>
</main>

<?php
// Includi il footer della pagina, che contiene il codice HTML per il piè di pagina
include('footer.php');
?>
