<?php
// Avvia una sessione per gestire variabili globali tra le pagine
session_start();

$prodotti_ricerca = [];
if(isset($_SESSION['prodotti_ricerca'])) { 
    echo count($prodotti_ricerca);
    echo  count($_SESSION['prodotti_ricerca']);
    $prodotti_ricerca = $_SESSION['prodotti_ricerca'];
    $_SESSION['prodotti_ricerca'] = [];
   
} else { 
    $_SESSION['prodotti_ricerca']= []; 
    
} 
// Funzione che recupera i dati dei prodotti dal database e li divide in categorie
function showPiante()
{

     // Connessione al database MySQL utilizzando le credenziali
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
    // Verifica se la connessione è riuscita
    if ($connessione->connect_error) {
        // Se la connessione fallisce, termina lo script e mostra il messaggio di errore
        die("Errore di connessione: " . $connessione->connect_error);
    }
// Query SQL per selezionare i dati di tutti i prodotti dalla tabella 'prodotti'
    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";
     // Esegui la query e memorizza il risultato
    if ($result = $connessione->query($query)) {

        //verifica se sono presenti dati nella tabella
        if ($result->num_rows > 0) {
                // Inizializza gli array per ogni tipo di prodotto
            $piante = [];
            $borse = [];
            $gioielli = [];
             // Ciclo attraverso ogni prodotto nel risultato della query
            while ($row = $result->fetch_assoc()) {
                // Se il prodotto è di tipo "piante", lo aggiunge all'array delle piante
                if ($row['tipo'] == "piante") {
                    $pianta = [
                        "id" => $row['id'],
                        "nome" => $row['nome'],
                        "tipo" => "piante",
                        "prezzo" => $row['prezzo'],
                        "immagine" => $row['immagine'],
                        "fileData" => $row['fileData'],
                        "disp_magazzino" => $row['disp_magazzino']

                    ];
                    array_push($piante, $pianta);
                    // Se il prodotto è di tipo "borse", lo aggiunge all'array delle borse
                } elseif ($row['tipo'] == "borse") {
                    $borsa = [
                        "id" => $row['id'],
                        "nome" => $row['nome'],
                        "tipo" => "borse",
                        "prezzo" => $row['prezzo'],
                        "immagine" => $row['immagine'],
                        "fileData" => $row['fileData'],
                        "disp_magazzino" => $row['disp_magazzino']

                    ];
                    array_push($borse, $borsa);
                } else {
                    // Se il prodotto è di tipo "gioielli", lo aggiunge all'array dei gioielli
                    $gioiello = [
                        "id" => $row['id'],
                        "nome" => $row['nome'],
                        "tipo" => "gioielli",
                        "prezzo" => $row['prezzo'],
                        "immagine" => $row['immagine'],
                        "fileData" => $row['fileData'],
                        "disp_magazzino" => $row['disp_magazzino']

                    ];
                    array_push($gioielli, $gioiello);
                }
            }
           // Salva i dati delle piante, borse e gioielli in sessione per l'accesso successivo
            $_SESSION['piante'] = $piante;
            $_SESSION['borse'] = $borse;
            $_SESSION['gioielli'] = $gioielli;
           
        } else {
            // Se non ci sono prodotti nel sistema, salva il messaggio di errore in sessione
            $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
          
        }
    }
}

// Chiamata alla funzione per recuperare i dati delle piante
showPiante();


// Impostazione del titolo della pagina
$title = 'Shop Piante';

// Includi l'header del sito
include 'header.php'; ?>
<main class="main-shop-piante">
    <div class="container">
        <div class="row">
            <?php if(count($prodotti_ricerca) >0) : ?>
            <?php 
            // Ciclo su tutti i prodotti di tipo "piante" salvati in sessione
            for ($i = 0; $i < count($prodotti_ricerca); $i++): ?>
            
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                      <!-- Header della card del prodotto -->
                    <div class="header-card d-flex ">
                        <div class="pianta col-4 ms-1 me-1 ">

                        </div>
                        <div class="text col-8">
                            <!-- Nome del prodotto -->
                            <p class="fw-bold testo-titolo"><?php echo $prodotti_ricerca[$i]['nome'] ?></p>
                        </div>
                    </div>
                    <div class="main-card card-equal-height">
                        <div class="row justify-content-center align-items-center flex-column">
                            <div class="col d-flex justify-content-center position-relative">
                                <!-- Se il prodotto è nelle posizioni specifiche, aggiungi l'etichetta "HOT" o "NEW" -->
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                 <!-- Immagine del prodotto, con classe per l'opacità se il prodotto è esaurito -->
                                <img src="imgs/<?php echo $prodotti_ricerca[$i]['immagine'] ?>" alt="<?php echo $prodotti_ricerca[$i]['nome'] ?>" class="img <?php if ($prodotti_ricerca[$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                <!-- Prezzo del prodotto -->
                                <p class="fw-bold">Prezzo <?php echo $prodotti_ricerca[$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                    <!-- Se il prodotto è esaurito, il bottone "Acquista" è disabilitato -->
                                    <?php if ($prodotti_ricerca[$i]['disp_magazzino'] == 0): ?>
                                        <button type="button" class="btn btn-shop" disabled
                                            style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                            Esaurito
                                        </button>
                                    <?php else: ?>
                                        <!-- Altrimenti, il bottone "Acquista" apre la pagina del carrello -->
                                        <button type="button" class="btn btn-shop" onclick="window.open('carrello.php', '_blank');">
                                            Acquista
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
            
            <?php else : ?>
                <?php 
            // Ciclo su tutti i prodotti di tipo "piante" salvati in sessione
            for ($i = 0; $i < count($_SESSION['piante']); $i++): ?>
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                      <!-- Header della card del prodotto -->
                    <div class="header-card d-flex ">
                        <div class="pianta col-4 ms-1 me-1 ">

                        </div>
                        <div class="text col-8">
                            <!-- Nome del prodotto -->
                            <p class="fw-bold testo-titolo"><?php echo $_SESSION['piante'][$i]['nome'] ?></p>
                        </div>
                    </div>
                    <div class="main-card card-equal-height">
                        <div class="row justify-content-center align-items-center flex-column">
                            <div class="col d-flex justify-content-center position-relative">
                                <!-- Se il prodotto è nelle posizioni specifiche, aggiungi l'etichetta "HOT" o "NEW" -->
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                 <!-- Immagine del prodotto, con classe per l'opacità se il prodotto è esaurito -->
                                <img src="imgs/<?php echo $_SESSION['piante'][$i]['immagine'] ?>" alt="<?php echo $_SESSION['piante'][$i]['nome'] ?>" class="img <?php if ($_SESSION['piante'][$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                <!-- Prezzo del prodotto -->
                                <p class="fw-bold">Prezzo <?php echo $_SESSION['piante'][$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                    <!-- Se il prodotto è esaurito, il bottone "Acquista" è disabilitato -->
                                    <?php if ($_SESSION['piante'][$i]['disp_magazzino'] == 0): ?>
                                        <button type="button" class="btn btn-shop" disabled
                                            style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                            Esaurito
                                        </button>
                                    <?php else: ?>
                                        <!-- Altrimenti, il bottone "Acquista" apre la pagina del carrello -->
                                        <button type="button" class="btn btn-shop" onclick="window.open('carrello.php', '_blank');">
                                            Acquista
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
                <?php endif; ?>
        </div>
    </div>
</main>
<!-- Includi il footer della pagina -->
<?php include 'footer.php'; ?>