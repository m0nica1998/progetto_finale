<?php 
session_start();
$title = 'Carello';
include 'header.php' ?>
<main class="d-flex justify-content-center align-items-center vh-100 main-carello">
    <div class="container text-center">
        <?php if($_SESSION['name'] != "") : ?>
        <a href="checkout.php" target="_blank" class="btn btn-danger btn-custom">Procedi al checkout</a>
        <?php else : ?> 
             <a href="login.php" target="_blank" class="btn btn-danger btn-custom">Effettua il login </a>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php' ?>