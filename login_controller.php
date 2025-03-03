<?php
// Avvio della sessione per poter utilizzare le variabili di sessione
session_start();

// Controllo se è stata passata un'azione tramite il parametro GET
if (isset($_GET['action'])) {
    // Se l'azione è 'login'
    if ($_GET['action'] == 'login') {
        // Salvataggio temporaneo dell'email e della password inserite dall'utente
        $_SESSION['old_mail'] = $_POST['mail'] ?? "";
        $_SESSION['old_password'] = $_POST['password'] ?? "";
        
         // Controllo se l'email è vuota ma la password è stata inserita
        if (empty($_POST['mail']) && !empty($_POST['password'])) {
            $_SESSION['errore-login'] = "È richiesta la mail.";
            header("Location: login.php");
            exit(); // Interrompe l'esecuzione dello script
        }
        
         // Controllo se la password è vuota ma l'email è stata inserita
        if (empty($_POST['password']) && !empty($_POST['mail'])) {
            $_SESSION['errore-login'] = "È richiesta la password.";
            header("Location: login.php");
            exit();
        }

          // Controllo se sia email che password sono vuoti
        if (empty($_POST['mail']) && empty($_POST['password'])) {
            $_SESSION['errore-login'] = "Sono richiesti sia email che password.";
            header("Location: login.php");
            exit();
        }
        
        // Se i controlli sono superati, viene chiamata la funzione di login
        login();
        // Se l'azione è 'logout'
    } elseif ($_GET['action'] == 'logout') {
        logout();
    }
}

/**
 * Funzione per gestire il login dell'utente.
 */
function login() {
    // Recupera i dati inviati dal form
    $email = $_POST['mail'] ?? "";
    $pass = $_POST['password'] ?? "";

     // Credenziali per la connessione al database
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $dbname = 'db_tabacchi';

     // Creazione della connessione al database
    $connessione = new mysqli($host, $user, $password, $dbname);

     // Controllo se la connessione ha avuto successo
    if ($connessione->connect_error) {
        die("Errore di connessione: " . $connessione->connect_error);
    }

    // Query per selezionare l'utente con email corrispondente
    $sql = "SELECT name, is_admin, password FROM users WHERE email = ?";
    $stmt = $connessione->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se l'utente esiste nel database
    if ($row = $result->fetch_assoc()) {
        // Controllo se la password inserita corrisponde a quella memorizzata
        if ($pass == $row["password"]) {
            // Salva i dati dell'utente nella sessione
            $_SESSION['name'] = $row["name"];
            $_SESSION['is_admin'] = $row["is_admin"];
            
            // Rimuove la mail e la password salvate dopo un login corretto
            unset($_SESSION['old_mail']);
            unset($_SESSION['old_password']);
            
             // Reindirizza l'utente alla pagina utente
            header("Location: utente.php");
            exit();
        } else {
             // Se la password è errata, mostra un messaggio di errore
            $_SESSION['errore-login'] = "Credenziali non valide.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Se l'utente non esiste, mostra un messaggio di errore
        $_SESSION['errore-login'] = "Utente non trovato! Registrati.";
        header("Location: login.php");
        exit();
    }
}

/**
 * Funzione per gestire il logout dell'utente.
 */
function logout() {
     // Elimina tutte le variabili di sessione
    session_unset();
    session_destroy();

     // Cancella il cookie di sessione, se presente
    if (ini_get("session.use_cookies")) {   
        $params = session_get_cookie_params();  
        setcookie(session_name(), '', time() - 42000,          
        $params["path"], $params["domain"],           
        $params["secure"], $params["httponly"]);
    }
        // Reindirizza alla homepage
    header("Location: index.php");
    exit();
}
