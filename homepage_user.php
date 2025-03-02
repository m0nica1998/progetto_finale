<!-- Inizio del corpo principale per l'utente -->
<main class="main-utente">
  <!-- Titolo di benvenuto centrato con il nome dell'utente -->
  <h3 class="text-center pt-3">Benvenuto, <?php echo $_SESSION['name']?></h3>

  <!-- Form per il logout -->
  <form class="d-flex justify-content-center form-utente align-items-center" action="login_controller.php?action=logout" method="post">
    <!-- Bottone per il logout con una larghezza e altezza definite -->
    <button type="submit" class="btn btn-danger w-50 h-10">Effettua il logout</button>
  </form>
</main>
