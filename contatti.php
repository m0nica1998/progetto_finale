<?php 
session_start();
$title = 'Contatti';
$error = (isset($_SESSION['errore']) ) ? $_SESSION['errore'] : "";

 

echo "errore: ". $error;
include 'header.php';




$success = '';


?>

<main class="container  d-flex  flex-column align-items-center">
   
    <div class="container main-contatti card p-4 form-contatti  bg-light-gray shadow-lg rounded">
         <!-- Titolo e logo -->
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

        <form id="registration-form" method="POST" class="" action="contatti_controller.php">
            <div class="mb-3">
                <label for="nome_completo" class="form-label">Nome e Cognome</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Inserisci qui il tuo nome completo" value="<?php echo isset($nome_completo) ? htmlspecialchars($nome_completo) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="eta" class="form-label">Età</label>
                <input type="number" class="form-control" id="eta" name="eta" min="0" placeholder="Inserisci la tua età" value="<?php echo isset($eta) ? htmlspecialchars($eta) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="data_nascita" class="form-label">Data di Nascita</label>
                <input type="date" class="form-control" id="data_nascita" name="data_nascita" value="<?php echo isset($data_nascita) ? htmlspecialchars($data_nascita) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Inserisci il tuo numero di telefono" value="<?php echo isset($telefono) ? htmlspecialchars($telefono) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci la tua email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la password">
                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">👁️</button>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Genere:</label>
                <div class="radio-group">
                    <input class="form-check-input" type="radio" name="genere" id="maschio" value="maschio" checked>
                    <label class="form-check-label" for="maschio">Maschio</label>
                    <input class="form-check-input" type="radio" name="genere" id="femmina" value="femmina">
                    <label class="form-check-label" for="femmina">Femmina</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="regione" class="form-label">Regione</label>
                <select class="form-select" id="regione" name="regione">
                    <option value="">Seleziona la tua regione</option>
                   
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
          
            <div class="submit-container">
                <button type="submit" class="btn btn-danger w-100">Registrati</button>
            </div>
        </form>
    </div>
</main>

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

<?php include 'footer.php' ?>

