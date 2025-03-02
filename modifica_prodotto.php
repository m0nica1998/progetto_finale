<?php
session_start();
include('header.php');
$id = $_GET['id'];
$tipo = $_GET['tipo'];
//echo $id;
//echo $tipo;
$prodotti;
if($tipo == 'piante'){
  $prodotti = $_SESSION['piante'];
} elseif($tipo == 'borse'){
  $prodotti = $_SESSION['borse'];
} else {
  $prodotti = $_SESSION['gioielli'];
}
$prodotti[$id];

?>

<main class="modifica-prodotto">
  <form action="controller_prodotti.php?action=edit&id=<?php echo  $prodotti[$id]['id'] ?>" method="post" enctype="multipart/form-data"
  >
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
    <div class="input-group mb-3">
    <label for="" class="form-label">Prezzo</label>
      <span class="input-group-text">€</span>
      <input type="number" id="prezzo" name="prezzo" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $prodotti[$id]['prezzo'] ?>">

    </div>
    <div class="mb-3">
      <label for="" class="form-label">Tipo</label>
      <select
        class="form-select form-select-lg"
        name="tipo"
        id="tipo">
        <option value="piante" <?php if($tipo == 'piante'){
          echo "selected"; }?>>Piante</option>
        <option value="borse" <?php if($tipo == 'borse'){
          echo "selected"; }?>>Borse</option>
        <option value="gioielli" <?php if($tipo == 'gioielli'){
          echo "selected"; }?>>Gioielli</option>
      </select>
    </div>
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
   <button
    type="submit"
    class="btn btn-primary"
   >
    Salva modifiche
   </button>
   
  </form>
</main>
<?php include('footer.php'); ?>