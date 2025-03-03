<main class="main-utente">
<h3 class="text-center pt-3">Benvenuto, <?php echo $_SESSION['name']?></h3>
<!-- form -->
<form class="d-flex justify-content-center form-utente align-items-center" action="login_controller.php?action=logout" method="post">

 <!-- bottone di logout -->
  <button type="submit" class="btn btn-danger w-50 h-10">Effettura il logout</button>
</form>
</main>
