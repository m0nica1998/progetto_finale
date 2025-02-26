<?php
session_start();
$title = 'Login';
$errore = "";
$mail = "";

// Recupera eventuali errori di login
if (isset($_SESSION['errore-login'])) {
    $errore = $_SESSION['errore-login'];
    $_SESSION['errore-login'] = "";
}

// Mantieni la mail inserita precedentemente
if (isset($_SESSION['old_mail'])) {
    $mail = $_SESSION['old_mail'];
}

include 'header.php'; 
?>

<main class="main-login">
    <div class="container card container-login d-flex flex-column justify-content-center align-items-center vh-100 bg-light-gray shadow-lg rounded">
        <h1><a href="index.php" target="_blank" class="text-decoration-none titolo">Tabacchi Cesario</a></h1>
        <hr class="divider">
        <h2>Accedi!</h2>
        <?php if ($errore != "") : ?>
            <div class='alert alert-warning' role='alert'><?php echo $errore; ?></div>
        <?php endif; ?>
        
        <form id="login-form" class="w-100" method="POST" action="login_controller.php?action=login">

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <div class="input-container position-relative">
                    <img src="imgs/email.png" alt="User Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <input type="text" id="email" class="form-control ps-5" placeholder="Inserisci l'email" name="mail" value="<?php echo htmlspecialchars($mail); ?>">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <div class="input-container position-relative">
                    <img src="imgs/password-icon.png" alt="Lock Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <input type="password" id="password" class="form-control ps-5" name="password" placeholder="Inserisci la password">
                </div>
            </div>
            
            <!-- Checkbox Ricordami -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>
          
            <div class="mb-3">
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </div>
        </form>

        <hr class="divider">
        <div class="paragrafi">
            <p>Hai dimenticato la password? <a href="recupera_password.php" class="text-danger">Recupera la password</a></p>
            <p>Non sei ancora registrato? <a href="contatti.php" class="text-danger">Registrati</a></p>
        </div>

        <!-- Social Media Links -->
        <div class="social-media social-media-reset-pass">
            <a href="https://www.facebook.com/profile.php?id=100075942254236" target="_blank">
                <img src="imgs/facebook.png" alt="Facebook" class="facebook-logo">
            </a>
            <a href="https://wa.me/393515914071" target="_blank">
                <img src="imgs/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
            </a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
