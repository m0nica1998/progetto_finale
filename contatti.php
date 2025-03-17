<?php 
// Avvia la sessione per poter accedere e memorizzare variabili di sessione
session_start();

// Imposta il titolo della pagina
$title = 'Contatti';

// Recupera eventuali messaggi di errore memorizzati nella sessione
$error = (isset($_SESSION['errore']) ) ? $_SESSION['errore'] : "";
 
// Includi l'header della pagina
include 'header.php';

// Variabile per il messaggio di successo (se necessario)
$success = '';


?>

<main class="container  d-flex  flex-column align-items-center">
   
    <div class="container main-contatti card p-4 form-contatti  bg-light-gray shadow-lg rounded">
         <!-- Titolo  -->
    <h1 class="text-center"><a href="index.php" target="_blank" class="text-decoration-none titolo">Tabacchi Cesario</a></h1>

        <h2 class="text-center">Registrati compilando il nostro form!</h2>
        <!-- Mostra il messaggio di errore o successo -->
        <?php if ($error != ""): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php elseif ($success): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
         <!-- Form di registrazione -->
        <form id="registration-form" method="POST" class="" action="contatti_controller.php">
             <!-- Campo Nome e Cognome -->
            <div class="mb-3">
                <label for="nome_completo" class="form-label">Nome e Cognome</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Inserisci qui il tuo nome completo" value="<?php 
                // Controlla se nella sessione esiste già un valore associato alla chiave nome_completo
                if(isset($_SESSION['nome_completo'])){
                    echo $_SESSION['nome_completo'];
                } ?>">
            </div>
            <!-- Campo Età -->
            <div class="mb-3">
                <label for="eta" class="form-label">Età</label>
                <input type="number" class="form-control" id="eta" name="eta" min="0" placeholder="Inserisci la tua età" value="<?php 
                // Controlla se nella sessione esiste già un valore associato alla chiave età
                if(isset($_SESSION['eta'])){
                    echo $_SESSION['eta'];
                } ?>">
            </div>
             <!-- Campo Data di Nascita -->
            <div class="mb-3">
                <label for="data_nascita" class="form-label">Data di Nascita</label>
                <input type="date" class="form-control" id="data_nascita" name="data_nascita" value="<?php 
                // Controlla se nella sessione esiste già un valore associato alla chiave data_nascita
                if(isset($_SESSION['data_nascita'])){
                    echo $_SESSION['data_nascita'];
                } ?>">
            </div>
             <!-- Campo Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Inserisci il tuo numero di telefono" value="<?php 
                // Controlla se nella sessione esiste già un valore associato alla chiave telefono
                if(isset($_SESSION['telefono'])){
                    echo $_SESSION['telefono'];
                } ?>">
            </div>
             <!-- Campo Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci la tua email" value="<?php 
                // Controlla se nella sessione esiste già un valore associato alla chiave email
                if(isset($_SESSION['email'])){
                    echo $_SESSION['email'];
                } ?>">
            </div>
              <!-- Campo Password con bottone per mostrare/nascondere -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la password" value="<?php 
                    // Controlla se nella sessione esiste già un valore associato alla chiave password
                    if(isset($_SESSION['password'])){
                    echo $_SESSION['password'];
                } ?>">
                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">👁️</button>
                </div>
            </div>
             <!-- Campo Genere -->
            <div class="mb-3">
                <label class="form-label">Genere:</label>
                <div class="radio-group">
                    <input class="form-check-input" type="radio" name="genere" id="maschio" value="maschio" checked>
                    <label class="form-check-label" for="maschio">Maschio</label>
                    <input class="form-check-input" type="radio" name="genere" id="femmina" value="femmina">
                    <label class="form-check-label" for="femmina">Femmina</label>
                </div>
            </div>
            <!-- Campo Regione -->
            <div class="mb-3">
                <label for="regione" class="form-label">Regione</label>
                <select class="form-select" id="regione" name="regione">
                    <option value="<?php if(isset($_SESSION['regione'])){
                    echo $_SESSION['regione'];
                } ?>">Seleziona la tua regione</option>
                   
                    <option value="Abruzzo" >Abruzzo</option>
    <option value="Basilicata" >Basilicata</option>
    <option value="Calabria" >Calabria</option>
    <option value="Campania" >Campania</option>
    <option value="Emilia-Romagna" >Emilia-Romagna</option>
    <option value="Friuli-Venezia Giulia" >Friuli Venezia Giulia</option>
    <option value="Lazio" >Lazio</option>
    <option value="Liguria" >Liguria</option>
    <option value="Lombardia" >Lombardia</option>
    <option value="Marche" >Marche</option>
    <option value="Molise" >Molise</option>
    <option value="Piemonte" >Piemonte</option>
    <option value="Puglia" >Puglia</option>
    <option value="Sardegna" >Sardegna</option>
    <option value="Sicilia" >Sicilia</option>
    <option value="Toscana" >Toscana</option>
    <option value="Trentino-Alto Adige" >Trentino-Alto Adige</option>
    <option value="Umbria" >Umbria</option>
    <option value="Valle d'Aosta" >Valle d'Aosta</option>
    <option value="Veneto" >Veneto</option>

                </select>
            </div>
            <!-- Bottone di invio -->
            <div class="submit-container">
                <button type="submit" class="btn btn-danger w-100">Registrati</button>
            </div>
        </form>
    </div>
</main>
<!-- Script per mostrare/nascondere la password -->
<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerText = '🙈';
        } else {
            passwordInput.type = 'password';
            this.innerText = '👁️';
        }
    });
</script>

<?php include 'footer.php' //include il footer della pagina ?> 

