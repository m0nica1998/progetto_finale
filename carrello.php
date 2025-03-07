<?php 
session_start();
$title = 'Carello';
include 'header.php' ?>
<main class="d-flex justify-content-center align-items-center vh-100 main-carello">
    <div class="container text-center">
        
        <?php 
        if($_SESSION['name'] != "") : ?>
        <?php for($i = 0; $i < count($_SESSION["carrello"]); $i++): ?>
          <div class="card">
            <img class="card-img-top" src="./imgs/<?php echo $_SESSION['carrello'][$i]['immagine']?>" alt="Title" />
            <div class="card-body">
                <h4 class="card-title"><?php echo $_SESSION['carrello'][$i]['nome']?></h4>
                <p class="card-text"><?php echo $_SESSION['carrello'][$i]['prezzo']?></p>
                <p class="card-text"><?php echo $_SESSION['carrello'][$i]['disp_magazzino']?></p>
                <p>Quantità: <?php echo $_SESSION['carrello'][$i]['quantita']?> </p>
            </div>
          </div>
          
        <?php endfor; ?>
        <a href="checkout.php" target="_blank" class="btn btn-danger btn-custom">Procedi al checkout</a>
        <?php else : ?> 
             <a href="login.php" target="_blank" class="btn btn-danger btn-custom">Effettua il login </a>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php' ?>