<?php 
session_start();
$azione = $_GET['action'];
if ($azione == 'create') {
  create_carrello();
}  elseif ($azione == 'delete') {
    delete_carrello();
  } elseif($azione == 'edit'){
    edit_carrello();
  }
  function create_carrello(){
    if($_SESSION['name'] != ""){
        // Recupero dati del prodotto
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $prezzo = $_GET['prezzo'];
        $tipo = $_GET['tipo'];
        $immagine = $_GET['immagine'];
        $fileData = $_GET['fileData'];
        $disp_magazzino = $_GET['disp_magazzino'];

        // Creazione della variabile di sessione per il carrello (se non esiste)
        if(!isset($_SESSION['carrello'])){
            $_SESSION['carrello'] = [];
        }

        // Controllo se il prodotto è già presente nel carrello
        $trovato = false;
        for ($i = 0; $i < count($_SESSION['carrello']); $i++) {
            if ($_SESSION['carrello'][$i]['id'] == $id) {
                // Se il prodotto è già presente, aumento la quantità
                if(( $_SESSION['carrello'][$i]['quantita'] += 1) <=  $_SESSION['carrello'][$i]['disp_magazzino'] ){
                  $_SESSION['carrello'][$i]['quantita'] += 1;
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
        if($tipo == "piante"){
            header("Location: shop_piante.php");
            exit();
        } elseif($tipo == "borse"){
            header("Location: shop_borse.php");
            exit();
        } elseif($tipo == "gioielli"){
            header("Location: shop_gioielli.php");
            exit();
        }
    } else {
        $_SESSION['errore'] = "Effettua il login";
        header("Location: login.php");
        exit();
    }
}

function delete_carrello(){
  if($_SESSION['name'] != ""){

//recupero id prodotto
$id = $_GET['id'];
echo $id;
// ciclo nel carrello 
// quando l'id del prodotto nel carrello coincide con quello recuperato, rimuovo il prodotto dal carrello
for ($i = 0; $i < count($_SESSION['carrello']); $i++) {
  if ($_SESSION['carrello'][$i]['id'] == $id) {
      array_splice($_SESSION['carrello'], $i, 1); // Rimuove l'elemento e riordina gli indici
      break; // Esce dal ciclo per evitare problemi di indice
  }
}

// ritorno alla pagina del carrello
header("Location: carrello.php");
exit();

  } else {
    header("Location: login.php");
    exit();
  }
}

function edit_carrello(){
  if($_SESSION['name'] != ""){
// recupero id e disponibilità in magazzino 
$id = $_GET["id"];
echo $id;
$method = $_GET["method"];
echo $method;
// ciclo nel carrello 
// quando l'id del prodotto nel carrello coincide con quello recuperato, verifico che ci sia il prodotto in magazzino, modifico la quantità
// ritorno al carrello

  } else {
    header("Location: login.php");
    exit();
  }
}
?>