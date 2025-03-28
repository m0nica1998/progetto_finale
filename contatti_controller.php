


<?php 
// Avvia la sessione per memorizzare dati tra le richieste HTTP
session_start();
// Inizializza la variabile di sessione per gli errori
$_SESSION['errore'] = "";

// Recupero dati form, faccio in modo che i dati rimangano inseiti quando si compila parzialmente il form e si preme registrati
$nome = $_POST['nome_completo'] ?? '';
$_SESSION['nome_completo'] = isset($_POST['nome_completo']) ? $_POST['nome_completo'] : "";
$eta = $_POST['eta'] ?? '';
$_SESSION['eta'] = isset($_POST['eta']) ? $_POST['eta'] : "";
$data = $_POST['data_nascita'] ?? '';
$_SESSION['data_nascita'] = isset($_POST['data_nascita']) ? $_POST['data_nascita'] : "";
$telefono = $_POST['telefono'] ?? '';
$_SESSION['telefono'] = isset($_POST['telefono']) ? $_POST['telefono'] : "";
$genere = $_POST['genere'] ?? '';
$_SESSION['genere'] = isset($_POST['genere']) ? $_POST['genere'] : "";
$regione = $_POST['regione'] ?? '';
$_SESSION['regione'] = isset($_POST['regione']) ? $_POST['regione'] : "";
$email = $_POST['email'] ?? '';
$_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : "";
$pass = $_POST['password'] ?? '';
$_SESSION['password'] = isset($_POST['password']) ? $_POST['password'] : "";

// Controllo dati form (regex)
$pattern_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$pattern_eta = "/^(?:1[0-4][0-9]|[1-9]?[0-9]|150)$/";
$pattern_data = "#^(19[0-9]{2}|20[01][0-9]|202[0-4])-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$#";
$pattern_telefono = "/^(?:\+39\s?|0039\s?)?(3[1-9]\d{8}|0\d{1,3}\s?\d{5,10})$/";
$pattern_password = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/";

// Validazione dei dati inviati dal form, preg_match() è una funzione che controlla se una stringa corrisponde a un'espressione regolare.
if (empty($nome)) {
    $_SESSION['errore'] = "Il campo 'Nome e Cognome' è obbligatorio.";
} elseif (empty($eta) || !preg_match($pattern_eta, $eta)) {
    $_SESSION['errore'] = "L'età non è valida.";
} elseif (empty($data) || !preg_match($pattern_data, $data)) {
    $_SESSION['errore'] = "La data di nascita non è valida.";
} elseif (empty($telefono) || !preg_match($pattern_telefono, $telefono)) {
    $_SESSION['errore'] = "Il numero di telefono non è valido.";
} elseif (empty($email) || !preg_match($pattern_email, $email)) {
    $_SESSION['errore'] = "L'email non è valida.";
} elseif (empty($pass) || !preg_match($pattern_password, $pass)) {
    $_SESSION['errore'] = "La password non è valida.";
} elseif (!in_array($genere, ["maschio", "femmina"])) {
    $_SESSION['errore'] = "Seleziona un genere valido.";
} elseif (!in_array($regione, ["Abruzzo", "Basilicata", "Calabria", "Campania", "Emilia-Romagna", "Friuli-Venezia Giulia", "Lazio", "Liguria", "Lombardia", "Marche", "Molise", "Piemonte", "Puglia", "Sardegna", "Sicilia", "Toscana", "Trentino-Alto Adige", "Umbria", "Valle d'Aosta", "Veneto"])) {
    $_SESSION['errore'] = "La regione selezionata non è valida.";
}

// Se ci sono errori, reindirizza alla pagina di contatto
if (!empty($_SESSION['errore'])) {
  header("Location: contatti.php");
   exit();
}

// Converte il genere in valore numerico per il database
$genere = ($genere == "maschio") ? 0 : 1;

// Connessione al DB
$connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
if ($connessione->connect_error) {
    die("Errore di connessione: " . $connessione->connect_error);
}

// Controllo se l'email esiste già
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $connessione->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['errore'] = "Esiste già un account con questa email!";
    $connessione->close();
   header("Location: contatti.php"); // Reindirizzamento alla pagina contatti
   exit();
}

// Query per l'inserimento dei dati
$sql_insert = "INSERT INTO users (name, age, date, number, gender, region, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $connessione->prepare($sql_insert);
$stmt_insert->bind_param("ssssssss", $nome, $eta, $data, $telefono, $genere, $regione, $email, $pass);

// Esegui l'inserimento dei dati nel database
if ($stmt_insert->execute()) {
    $connessione->close();
 
    
    $_SESSION['name'] = $nome;
    $_SESSION['is_admin'] = 0;
    header("Location: utente.php"); // Reindirizzamento alla pagina utente
    exit();
} else {
    $_SESSION['errore'] = "Errore nell'inserimento dei dati: " . $connessione->error;
   header("Location: contatti.php"); // Reindirizzamento alla pagina contatti
  exit();
}
