<?php
// Avvia una sessione per gestire variabili globali durante la navigazione
session_start();

// Funzione che recupera i dati dei prodotti dal database e li divide in categorie
function showBorse()
{

    // Connessione al database MySQL utilizzando i parametri host, username, password, e nome del database
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
    // Verifica se la connessione al database ha avuto successo
    if ($connessione->connect_error) {
        // Se c'è un errore di connessione, il codice si interrompe e mostra il messaggio di errore
        die("Errore di connessione: " . $connessione->connect_error);
    }

    // Query SQL per selezionare i dati di tutti i prodotti dalla tabella 'prodotti'
    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";
    // Esegui la query
    if ($result = $connessione->query($query)) {

       // Verifica se ci sono righe di dati nel risultato della query
        if ($result->num_rows > 0) {
             // Inizializza array per le categorie di prodotti
            $piante = [];
            $borse = [];
            $gioielli = [];
             // Ciclo attraverso ogni riga del risultato per separare i prodotti nelle categorie
            while ($row = $result->fetch_assoc()) {
                // Se il prodotto è una pianta, aggiungilo all'array $piante
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
                    // Se il prodotto è una borsa, aggiungilo all'array $borse
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
                     // Altrimenti, se è un gioiello, aggiungilo all'array $gioielli
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
             // Salva gli array delle categorie in sessione per l'accesso successivo
            $_SESSION['piante'] = $piante;
            $_SESSION['borse'] = $borse;
            $_SESSION['gioielli'] = $gioielli;
           
        } else {
            // Se non ci sono prodotti nel database, salva un messaggio di errore in sessione
            $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
          
        }
    }
}

// Chiama la funzione per mostrare le borse
showBorse();


// Imposta il titolo della pagina
$title = 'Shop Borse';

// Includi l'header della pagina
include 'header.php'; ?>

<main class="main-shop-borse">
    <div class="container">
        <div class="row">
            <?php 
            // Ciclo attraverso tutte le borse salvate in sessione e mostro ciascuna
            for ($i = 0; $i < count($_SESSION['borse']); $i++): ?>
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                    <!-- Header della card del prodotto -->
                    <div class="header-card d-flex ">
                        <div class="borsa col-4 ms-1 me-1 ">

                        </div>
                        <div class="text col-8">
                            <p class="fw-bold testo-titolo"><?php echo $_SESSION['borse'][$i]['nome'] ?></p>
                        </div>
                    </div>
                    <div class="main-card card-equal-height">
                        <div class="row justify-content-center align-items-center flex-column">
                            <div class="col d-flex justify-content-center position-relative">
                                 <!-- Se il prodotto è nelle posizioni specifiche, aggiungi un'etichetta "HOT" o "NEW" -->
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                <!-- Immagine del prodotto con uno stile che cambia se il prodotto è esaurito -->
                                <img src="imgs/<?php echo $_SESSION['borse'][$i]['immagine'] ?>" alt="<?php echo $_SESSION['borse'][$i]['nome'] ?>" class="img <?php if ($_SESSION['borse'][$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                 <!-- Prezzo della borsa -->
                                <p class="fw-bold">Prezzo <?php echo $_SESSION['borse'][$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                     <!-- Se il prodotto è esaurito, il bottone "Acquista" è disabilitato -->
                                    <?php if ($_SESSION['borse'][$i]['disp_magazzino'] == 0): ?>
                                        <button type="button" class="btn btn-shop" disabled
                                            style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                            Esaurito
                                        </button>
                                    <?php else: ?>
                                        <!-- Altrimenti, il bottone permette di andare alla pagina del carrello -->
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
<!-- Includi il footer della pagina -->
<?php include 'footer.php'; ?>