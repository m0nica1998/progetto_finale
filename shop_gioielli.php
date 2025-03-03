<?php
// Avvia la sessione per gestire variabili globali tra le pagine
session_start();

// Funzione per recuperare i prodotti di tipo "gioielli" dal database
function showGioielli()
{

   // Connessione al database MySQL utilizzando le credenziali
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
    // Verifica se la connessione al database è riuscita
    if ($connessione->connect_error) {
        // Se la connessione fallisce, termina lo script e mostra il messaggio di errore
        die("Errore di connessione: " . $connessione->connect_error);
    }

        // Query SQL per selezionare i dati di tutti i prodotti dalla tabella 'prodotti'
    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";
    // Esegui la query e memorizza il risultato
    if ($result = $connessione->query($query)) {

        // Verifica se ci sono risultati nella tabella
        if ($result->num_rows > 0) {
            // Crea gli array per i diversi tipi di prodotti
            $piante = [];
            $borse = [];
            $gioielli = [];
            // Ciclo attraverso i risultati della query
            while ($row = $result->fetch_assoc()) {
                // Se il prodotto è di tipo "piante", lo aggiungi all'array delle piante
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
                  // Se il prodotto è di tipo "borse", lo aggiungi all'array delle borse
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
                } // Se il prodotto è di tipo "gioielli", lo aggiungi all'array dei gioielli
                else {
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
           // Salva i dati dei prodotti nelle sessioni, così possono essere usati in altre pagine
            $_SESSION['piante'] = $piante;
            $_SESSION['borse'] = $borse;
            $_SESSION['gioielli'] = $gioielli;
           
        } else {
            // Se non ci sono dati, salva il messaggio di errore nella sessione
            $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
          
        }
    }
}

// Chiamata alla funzione per recuperare i prodotti di tipo "gioielli"

showGioielli();


// Imposta il titolo della pagina
$title = 'Shop Gioielli';

// Includi l'header del sito
include 'header.php'; ?>

<main class="main-shop-gioielli">
    <div class="container">
        <div class="row">
            <!-- Ciclo su tutti i prodotti di tipo "gioielli" salvati in sessione -->
            <?php for ($i = 0; $i < count($_SESSION['gioielli']); $i++): ?>
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                     <!-- Header della card del prodotto -->
                    <div class="header-card d-flex ">
                        <div class="gioiello col-4 ms-1 me-1 ">

                        </div>
                        <div class="text col-8">
                            <!-- Nome del prodotto -->
                            <p class="fw-bold testo-titolo"><?php echo $_SESSION['gioielli'][$i]['nome'] ?></p>
                        </div>
                    </div>
                    <div class="main-card card-equal-height">
                        <div class="row justify-content-center align-items-center flex-column">
                            <div class="col d-flex justify-content-center position-relative">
                                 <!-- Se il prodotto si trova nelle posizioni specifiche, aggiungi l'etichetta "HOT" o "NEW" -->
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                <!-- Mostra l'immagine del prodotto, applicando una classe 'opaca' se il prodotto è esaurito -->
                                <img src="imgs/<?php echo $_SESSION['gioielli'][$i]['immagine'] ?>" alt="<?php echo $_SESSION['gioielli'][$i]['nome'] ?>" class="img <?php if ($_SESSION['gioielli'][$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                 <!-- Visualizza il prezzo del prodotto -->
                                <p class="fw-bold">Prezzo <?php echo $_SESSION['gioielli'][$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                     <!-- Se il prodotto è esaurito, disabilita il bottone "Acquista" -->
                                    <?php if ($_SESSION['gioielli'][$i]['disp_magazzino'] == 0): ?>
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
        </div>
    </div>
</main>
<!-- Includi il footer del sito -->
<?php include 'footer.php'; ?>