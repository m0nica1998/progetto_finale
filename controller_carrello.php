<?php
session_start(); // Avvia la sessione per poter usare le variabili di sessione
$azione = $_GET['action'];  // Recupera l'azione richiesta tramite il parametro GET

// Esegue la funzione corrispondente in base all'azione ricevuta
if ($azione == 'create') {
  create_carrello();
} elseif ($azione == 'delete') {
  delete_carrello();
} elseif ($azione == 'edit') {
  edit_carrello();
}

/**
 * Funzione per aggiungere un prodotto al carrello
 */
function create_carrello()
{
  if ($_SESSION['name'] != "") { // Controlla se l'utente è loggato
   // Recupero dati del prodotto dai parametri GET
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $prezzo = $_GET['prezzo'];
    $tipo = $_GET['tipo'];
    $immagine = $_GET['immagine'];
    $fileData = $_GET['fileData'];
    $disp_magazzino = $_GET['disp_magazzino'];

    // Creazione della variabile di sessione per il carrello (se non esiste)
    if (!isset($_SESSION['carrello'])) {
      $_SESSION['carrello'] = [];
    }

    // Controllo se il prodotto è già presente nel carrello
    $trovato = false;
    for ($i = 0; $i < count($_SESSION['carrello']); $i++) {
      if ($_SESSION['carrello'][$i]['id'] == $id && $_SESSION['carrello'][$i]['tipo'] == $tipo) {
        // Se il prodotto è già presente, aumento la quantità se disponibile in magazzino
        if (($_SESSION['carrello'][$i]['quantita'] += 1) <=  $_SESSION['carrello'][$i]['disp_magazzino']) {
          $_SESSION['carrello'][$i]['quantita'] + 1;
          $trovato = true;
          break;
        } else {
          $_SESSION['errore'] = "Non ci sono abbastanza prodotti diaponibili";
          break;
        }
      }
    }

    // Se il prodotto non è stato trovato, lo aggiungo al carrello
    if (!$trovato) {
     
      $prodotto = [
        "id" => $id,
        "nome" => $nome,
        "tipo" => $tipo,
        "prezzo" => $prezzo,
        "immagine" => $immagine,
        "fileData" => $fileData,
        "disp_magazzino" => $disp_magazzino,
        "quantita" => 1
      ];
      
      array_push($_SESSION["carrello"], $prodotto);
     
    }

    // Ritorno alla pagina del prodotto in base al tipo
    if ($tipo == "piante") {
      header("Location: shop_piante.php");
      exit();
    } elseif ($tipo == "borse") {
     header("Location: shop_borse.php");
      exit();
    } elseif ($tipo == "gioielli") {
      header("Location: shop_gioielli.php");
      exit();
    }
  } else {
    $_SESSION['errore'] = "Effettua il login";
    header("Location: login.php");
    exit();
  }
}

/**
 * Funzione per rimuovere un prodotto dal carrello
 */
function delete_carrello()
{
  if ($_SESSION['name'] != "") { // Controlla se l'utente è loggato

    //recupero id prodotto da eliminare
    $id = $_GET['id'];
    echo $id;
     // Scorre il carrello alla ricerca del prodotto
    for ($i = 0; $i < count($_SESSION['carrello']); $i++) {
      if ($_SESSION['carrello'][$i]['id'] == $id) {
        array_splice($_SESSION['carrello'], $i, 1); // Rimuove l'elemento e riordina gli indici, (i è l'indice da cui iniziare la modifica e 1 è il numero di elementi da rimuovere)
        break; // Esce dal ciclo per evitare problemi di indice
      }
    }

    // ritorno alla pagina del carrello
    header("Location: carrello.php");
    exit();
  } else {
    header("Location: login.php"); //ritorno alla pagina di login
    exit();
  }
}

/**
 * Funzione per modificare la quantità di un prodotto nel carrello
 */
function edit_carrello()
{
  if ($_SESSION['name'] != "") { // Controlla se l'utente è loggato
    // Recupera l'id del prodotto da modificare
    $id = $_GET["id"];
    // Recupera il metodo (incremento o decremento)
    $method = $_GET["method"];
    
    // Scorre il carrello per trovare il prodotto
    for ($i = 0; $i < count($_SESSION['carrello']); $i++) {
      if ($_SESSION['carrello'][$i]['id'] == $id) {
        if ($method == "up") { // Incremento della quantità
          if (($_SESSION['carrello'][$i]['quantita'] += 1) <=  $_SESSION['carrello'][$i]['disp_magazzino']) {
            $_SESSION['carrello'][$i]['quantita'] + 1;
          }
        } else { // Decremento della quantità
          if (($_SESSION['carrello'][$i]['quantita'] -= 1) > 0) {
            $_SESSION['carrello'][$i]['quantita'] - 1;
          } else {
            array_splice($_SESSION['carrello'], $i, 1); // Rimuove l'elemento se la quantità diventa zero e riordina gli indici
        break; // Esce dal ciclo per evitare problemi di indice
          }
        }
      }
    }
    // ritorno al carrello
    header("Location: carrello.php");

  } else { // ritorno al login
    header("Location: login.php");
    exit();
  }
}
