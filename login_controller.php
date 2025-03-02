<?php
// Avvia la sessione, permettendo di utilizzare variabili di sessione globali.
session_start();

// Verifica se è stata passata una variabile 'action' tramite la query string (GET)
if (isset($_GET['action'])) {
    // Se l'azione è 'login'
    if ($_GET['action'] == 'login') {
        // Salva l'email e la password inserite dall'utente nella sessione per eventuali riempimenti futuri.
        $_SESSION['old_mail'] = $_POST['mail'] ?? "";
        $_SESSION['old_password'] = $_POST['password'] ?? "";

        // Controlla che l'email sia stata inserita. Se manca, setta un messaggio di errore e rimanda alla pagina di login.
        if (empty($_POST['mail']) && !empty($_POST['password'])) {
            $_SESSION['errore-login'] = "È richiesta la mail.";
            header("Location: login.php");
            exit();
        }

        // Controlla che la password sia stata inserita. Se manca, setta un messaggio di errore e rimanda alla pagina di login.
        if (empty($_POST['password']) && !empty($_POST['mail'])) {
            $_SESSION['errore-login'] = "È richiesta la password.";
            header("Location: login.php");
            exit();
        }

        // Controlla che sia stata inserita sia l'email che la password. Se entrambe mancano, setta un messaggio di errore.
        if (empty($_POST['mail']) && empty($_POST['password'])) {
            $_SESSION['errore-login'] = "Sono richiesti sia email che password.";
            header("Location: login.php");
            exit();
        }

        // Se tutti i controlli sono passati, esegue la funzione login()
        login();
    } 
    // Se l'azione è 'logout'
    elseif ($_GET['action'] == 'logout') {
        // Esegue la funzione logout() per disconnettere l'utente
        logout();
    }
}

// Funzione che gestisce il login dell'utente
function login() {
    // Ottiene i dati di email e password dal form di login
    $email = $_POST['mail'] ?? "";
    $pass = $_POST['password'] ?? "";

    // Connessione al database
    $host = 'localhost';  // Indirizzo del database
    $user = 'root';       // Username per il database
    $password = 'root';   // Password per il database
    $dbname = 'db_tabacchi'; // Nome del database

    // Crea la connessione al database
    $connessione = new mysqli($host, $user, $password, $dbname);

    // Verifica se la connessione al database è riuscita, altrimenti termina l'esecuzione con un errore
    if ($connessione->connect_error) {
        die("Errore di connessione: " . $connessione->connect_error);
    }

    // Query per selezionare l'utente in base alla email
    $sql = "SELECT name, is_admin, password FROM users WHERE email = ?";
    // Prepara la query con un parametro (l'email)
    $stmt = $connessione->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    // Ottiene il risultato della query
    $result = $stmt->get_result();

    // Se la query restituisce un risultato (utente trovato)
    if ($row = $result->fetch_assoc()) {
        // Controlla se la password inserita corrisponde a quella memorizzata nel database
        if ($pass == $row["password"]) {
            // Se la password è corretta, imposta le variabili di sessione per il nome e i permessi dell'utente
            $_SESSION['name'] = $row["name"];
            $_SESSION['is_admin'] = $row["is_admin"];
            
            // Rimuove i dati precedenti di email e password salvati nella sessione
            unset($_SESSION['old_mail']);
            unset($_SESSION['old_password']);
            
            // Reindirizza l'utente alla pagina 'utente.php' dopo il login corretto
            header("Location: utente.php");
            exit();
        } else {
            // Se la password non è corretta, imposta un messaggio di errore
            $_SESSION['errore-login'] = "Credenziali non valide.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Se l'utente non esiste nel database, imposta un messaggio di errore
        $_SESSION['errore-login'] = "Utente non trovato! Registrati.";
        header("Location: login.php");
        exit();
    }
}

// Funzione che gestisce il logout dell'utente
function logout() {
    // Rimuove tutte le variabili di sessione
    session_unset();
    // Distrugge la sessione
    session_destroy();

    // Se le sessioni usano i cookie, elimina il cookie di sessione
    if (ini_get("session.use_cookies")) {   
        $params = session_get_cookie_params();  
        setcookie(session_name(), '', time() - 42000,          
        $params["path"], $params["domain"],           
        $params["secure"], $params["httponly"]);
    }
    
    // Reindirizza l'utente alla pagina principale dopo il logout
    header("Location: index.php");
    exit();
}
?>
