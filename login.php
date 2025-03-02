<?php
// Inizia la sessione per poter utilizzare variabili di sessione.
session_start();

// Imposta il titolo della pagina per l'HTML
$title = 'Login';

// Variabili per gestire gli errori e il recupero della mail
$errore = "";
$mail = "";

// Recupera eventuali messaggi di errore salvati nella sessione
if (isset($_SESSION['errore-login'])) {
    // Se c'è un errore, lo assegna alla variabile $errore
    $errore = $_SESSION['errore-login'];
    // Poi cancella il messaggio di errore dalla sessione
    $_SESSION['errore-login'] = "";
}

// Recupera la mail precedentemente inserita nella sessione (se presente)
if (isset($_SESSION['old_mail'])) {
    $mail = $_SESSION['old_mail'];
}

// Includi l'header della pagina, che contiene il codice HTML per l'intestazione
include 'header.php'; 
?>

<main class="main-login">
    <!-- Contenitore principale per la login con classe di stile e layout flex -->
    <div class="container card container-login d-flex flex-column justify-content-center align-items-center vh-100 bg-light-gray shadow-lg rounded">
        <!-- Titolo con link alla home -->
        <h1><a href="index.php" target="_blank" class="text-decoration-none titolo">Tabacchi Cesario</a></h1>
        <hr class="divider"> <!-- Divider orizzontale -->
        <h2>Accedi!</h2>

        <!-- Se c'è un errore di login, viene visualizzato un messaggio di avviso -->
        <?php if ($errore != "") : ?>
            <div class='alert alert-warning' role='alert'><?php echo $errore; ?></div>
        <?php endif; ?>
        
        <!-- Form per il login, invia i dati tramite metodo POST al controller -->
        <form id="login-form" class="w-100" method="POST" action="login_controller.php?action=login">

            <!-- Campo per l'email -->
            <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <div class="input-container position-relative">
                    <!-- Icona di email accanto al campo di input -->
                    <img src="imgs/email.png" alt="User Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <!-- Campo di input per l'email con valore precompilato se presente nella sessione -->
                    <input type="text" id="email" class="form-control ps-5" placeholder="Inserisci l'email" name="mail" value="<?php echo htmlspecialchars($mail); ?>">
                </div>
            </div>

            <!-- Campo per la password -->
            <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <div class="input-container position-relative">
                    <!-- Icona di lucchetto accanto al campo password -->
                    <img src="imgs/password-icon.png" alt="Lock Icon" class="icon position-absolute top-50 start-0 translate-middle-y ms-3" width="20" height="20">
                    <!-- Campo di input per la password -->
                    <input type="password" id="password" class="form-control ps-5" name="password" placeholder="Inserisci la password">
                </div>
            </div>
            
            <!-- Checkbox "Ricordami" per ricordare l'utente -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>
          
            <!-- Bottone di submit per inviare i dati -->
            <div class="mb-3">
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </div>
        </form>

        <hr class="divider"> <!-- Divider orizzontale -->

        <!-- Paragrafi con link per recupero password e registrazione -->
        <div class="paragrafi">
            <p>Hai dimenticato la password? <a href="recupera_password.php" class="text-danger">Recupera la password</a></p>
            <p>Non sei ancora registrato? <a href="contatti.php" class="text-danger">Registrati</a></p>
        </div>

        <!-- Link ai social media (Facebook e WhatsApp) -->
        <div class="social-media social-media-reset-pass">
            <!-- Icona di Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100075942254236" target="_blank">
                <img src="imgs/facebook.png" alt="Facebook" class="facebook-logo">
            </a>
            <!-- Icona di WhatsApp -->
            <a href="https://wa.me/393515914071" target="_blank">
                <img src="imgs/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
            </a>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
