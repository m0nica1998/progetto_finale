<?php 
session_start();
$title = 'Recupera Password';

// Inizializza le variabili per evitare warning
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ottieni il valore dell'email dal form e rimuovi eventuali spazi
  $email = trim($_POST['email']);

  // Controlla se l'email è vuota
  if (empty($email)) {
      $error = "L'email è obbligatoria.";
  } 
  // Controlla se l'email è valida
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "L'email inserita non è valida.";
  } else {
      // Se l'email è valida, supponiamo di inviare una mail di recupero
      $success = "Un'email di recupero è stata inviata alla tua email.";
  }
}

include 'header.php'; 
?>

<div class="wrapper ">
    <main class="custom-container main-reset-pass ">
        <!-- titolo e logo -->
        <h1><a href="index.php" target="_blank" class="text-decoration-none titolo">Tabacchi Cesario</a></h1>

        <!-- Linea orizzontale -->
        <div class="divider"></div>

        <h2>Recupera la password!</h2>

        <?php if (!empty($error)) : ?>
            <div class='alert alert-warning' role='alert'>
                <?php echo $error; ?>
            </div>
        <?php elseif (!empty($success)) : ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3 w-100">
                <label for="email" class="form-label">EMAIL</label>
                <div class="input-container position-relative">
                    <img src="imgs/email.png" alt="User Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <input type="email" name="email" id="email" class="form-control ps-5" required placeholder="Inserisci l'email">
                </div>
            </div>

            <div class="submit-container mb-3">
                <input type="submit" value="Invia" class="btn btn-danger w-100">
            </div>
        </form>

        <!-- Linea orizzontale -->
        <div class="divider"></div>

        <!-- Social Media Links -->
        <div class="social-media social-media-reset-pass">
            <a href="https://www.facebook.com/profile.php?id=100075942254236" target="_blank">
                <img src="imgs/facebook.png" alt="Facebook" class="facebook-logo">
            </a>
            <a href="https://wa.me/393515914071" target="_blank">
                <img src="imgs/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
            </a>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>
