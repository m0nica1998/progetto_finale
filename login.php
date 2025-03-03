<?php
// Avvia una sessione per gestire le variabili di sessione
session_start();

// Imposta il titolo della pagina
$title = 'Login';

// Inizializza le variabili per l'errore e l'email
$errore = "";
$mail = "";

// Recupera eventuali errori di login dalla sessione
// Se c'è un errore di login memorizzato, viene mostrato
if (isset($_SESSION['errore-login'])) {
    $errore = $_SESSION['errore-login']; // Assegna l'errore alla variabile
    $_SESSION['errore-login'] = "";  // Resetta l'errore dalla sessione
}

// Mantieni la mail inserita precedentemente per precompilare il campo email
if (isset($_SESSION['old_mail'])) {
    $mail = $_SESSION['old_mail']; // Recupera l'email salvata nella sessione
}

// Includi il file dell'header 
include 'header.php'; 
?>

<main class="main-login">
    <div class="container card container-login d-flex flex-column justify-content-center align-items-center vh-100 bg-light-gray shadow-lg rounded">
        <!-- Titolo della pagina e link al sito principale -->
        <h1><a href="index.php" target="_blank" class="text-decoration-none titolo">Tabacchi Cesario</a></h1>
        <hr class="divider">
        <!-- Titolo del form di login -->
        <h2>Accedi!</h2>
        <!-- Se c'è un errore di login, viene visualizzato un messaggio di avviso -->
        <?php if ($errore != "") : ?>
            <div class='alert alert-warning' role='alert'><?php echo $errore; ?></div>
        <?php endif; ?>
         <!-- Form di login -->
        <form id="login-form" class="w-100" method="POST" action="login_controller.php?action=login">

            <!-- Campo per l'email -->
            <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <div class="input-container position-relative">
                    <!-- Icona email all'interno del campo -->
                    <img src="imgs/email.png" alt="User Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <!-- Campo di input per l'email precompilato con il valore della variabile $mail se presente -->
                    <input type="text" id="email" class="form-control ps-5" placeholder="Inserisci l'email" name="mail" value="<?php echo htmlspecialchars($mail); ?>">
                </div>
            </div>

            <!-- Campo per la password -->
            <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <div class="input-container position-relative">
                    <!-- Icona password all'interno del campo -->
                    <img src="imgs/password-icon.png" alt="Lock Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <!-- Campo di input per la password -->
                    <input type="password" id="password" class="form-control ps-5" name="password" placeholder="Inserisci la password">
                </div>
            </div>
            
           <!-- Checkbox per ricordare l'utente -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>
          
             <!-- Pulsante di login -->
            <div class="mb-3">
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </div>
        </form>

        <hr class="divider">
        <!-- Link per recupero password e registrazione -->
        <div class="paragrafi">
            <p>Hai dimenticato la password? <a href="recupera_password.php" class="text-danger">Recupera la password</a></p>
            <p>Non sei ancora registrato? <a href="contatti.php" class="text-danger">Registrati</a></p>
        </div>

        <!-- Sezione per i link ai social media -->
        <div class="social-media social-media-reset-pass">
            <a href="https://www.facebook.com/profile.php?id=100075942254236" target="_blank">
                <img src="imgs/facebook.png" alt="Facebook" class="facebook-logo">
            </a>
            <!-- Link al numero WhatsApp -->
            <a href="https://wa.me/393515914071" target="_blank">
                <img src="imgs/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
            </a>
        </div>
    </div>
</main>

<?php 
// Includi il file del footer
include 'footer.php'; 
?>
