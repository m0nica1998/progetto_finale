<?php
session_start();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'login') {
        $_SESSION['old_mail'] = $_POST['mail'] ?? "";
        $_SESSION['old_password'] = $_POST['password'] ?? "";
        
        if (empty($_POST['mail']) && !empty($_POST['password'])) {
            $_SESSION['errore-login'] = "È richiesta la mail.";
            header("Location: login.php");
            exit();
        }

        if (empty($_POST['password']) && !empty($_POST['mail'])) {
            $_SESSION['errore-login'] = "È richiesta la password.";
            header("Location: login.php");
            exit();
        }

        if (empty($_POST['mail']) && empty($_POST['password'])) {
            $_SESSION['errore-login'] = "Sono richiesti sia email che password.";
            header("Location: login.php");
            exit();
        }
        
        login();
    } elseif ($_GET['action'] == 'logout') {
        logout();
    }
}

function login() {
    $email = $_POST['mail'] ?? "";
    $pass = $_POST['password'] ?? "";

    // Connessione al database
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $dbname = 'db_tabacchi';

    $connessione = new mysqli($host, $user, $password, $dbname);

    if ($connessione->connect_error) {
        die("Errore di connessione: " . $connessione->connect_error);
    }

    // Query per selezionare l'utente con email corrispondente
    $sql = "SELECT name, is_admin, password FROM users WHERE email = ?";
    $stmt = $connessione->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($pass == $row["password"]) {
            $_SESSION['name'] = $row["name"];
            $_SESSION['is_admin'] = $row["is_admin"];
            
            // Rimuove la mail e la password salvate dopo un login corretto
            unset($_SESSION['old_mail']);
            unset($_SESSION['old_password']);
            
            header("Location: utente.php");
            exit();
        } else {
            $_SESSION['errore-login'] = "Credenziali non valide.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['errore-login'] = "Utente non trovato! Registrati.";
        header("Location: login.php");
        exit();
    }
}

function logout() {
    session_unset();
    session_destroy();

    if (ini_get("session.use_cookies")) {   
        $params = session_get_cookie_params();  
        setcookie(session_name(), '', time() - 42000,          
        $params["path"], $params["domain"],           
        $params["secure"], $params["httponly"]);
    }
    header("Location: index.php");
    exit();
}
