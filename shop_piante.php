<?php
// Inizia la sessione per gestire le variabili di sessione, che memorizzano i dati dei prodotti
session_start();

// Funzione per mostrare le piante
function showPiante()
{
    // Connessione al database 'db_tabacchi' con le credenziali fornite
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');

    // Verifica se la connessione al database è avvenuta correttamente
    if ($connessione->connect_error) {
        die("Errore di connessione: " . $connessione->connect_error);  // Se c'è un errore, fermiamo l'esecuzione e mostriamo il messaggio d'errore
    }

    // Query per selezionare i dati dei prodotti (ID, nome, tipo, prezzo, immagine, fileData, disponibilità)
    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";

    // Esecuzione della query e salvataggio del risultato
    if ($result = $connessione->query($query)) {

        // Verifica se ci sono righe nel risultato (prodotti)
        if ($result->num_rows > 0) {
            // Crea array per memorizzare i prodotti separati per tipo (piante, borse, gioielli)
            $piante = [];
            $borse = [];
            $gioielli = [];

            // Ciclo per elaborare ogni prodotto
            while ($row = $result->fetch_assoc()) {
                // A seconda del tipo di prodotto (piante, borse, gioielli), lo aggiunge all'array corrispondente
                if ($row['tipo'] == "piante") {
                    // Aggiunge le piante all'array piante
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
                } elseif ($row['tipo'] == "borse") {
                    // Aggiunge le borse all'array borse
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
                    // Aggiunge i gioielli all'array gioielli
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
            // Memorizza gli array dei prodotti nelle variabili di sessione
            $_SESSION['piante'] = $piante;
            $_SESSION['borse'] = $borse;
            $_SESSION['gioielli'] = $gioielli;

        } else {
            // Se non ci sono prodotti, memorizza un errore nella sessione
            $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
        }
    }
}

// Chiama la funzione per mostrare le piante
showPiante();

// Imposta il titolo della pagina
$title = 'Shop Piante';

// Include il file 'header.php' per caricare l'intestazione del sito
include 'header.php'; ?>
<main class="main-shop-piante">
    <div class="container">
        <div class="row">
            <!-- Ciclo per visualizzare ogni prodotto di tipo 'pianta' -->
            <?php for ($i = 0; $i < count($_SESSION['piante']); $i++): ?>
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                    <div class="header-card d-flex ">
                        <div class="borsa col-4 ms-1 me-1 ">
                            <!-- Qui potrebbe essere aggiunto un contenuto relativo alla pianta (ad esempio l'immagine) -->
                        </div>
                        <div class="text col-8">
                            <!-- Mostra il nome della pianta -->
                            <p class="fw-bold testo-titolo"><?php echo $_SESSION['piante'][$i]['nome'] ?></p>
                        </div>
                    </div>
                    <div class="main-card card-equal-height">
                        <div class="row justify-content-center align-items-center flex-column">
                            <div class="col d-flex justify-content-center position-relative">
                                <!-- Mostra un'etichetta "HOT" per la seconda pianta (indice 1) -->
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <!-- Mostra un'etichetta "NEW" per la prima pianta (indice 0) -->
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                <!-- Mostra l'immagine della pianta -->
                                <img src="imgs/<?php echo $_SESSION['piante'][$i]['immagine'] ?>" alt="<?php echo $_SESSION['piante'][$i]['nome'] ?>" class="img <?php if ($_SESSION['piante'][$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                <!-- Mostra il prezzo della pianta -->
                                <p class="fw-bold">Prezzo <?php echo $_SESSION['piante'][$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                    <!-- Se la disponibilità è zero, disabilita il pulsante "Acquista" -->
                                    <?php if ($_SESSION['piante'][$i]['disp_magazzino'] == 0): ?>
                                        <button type="button" class="btn btn-shop" disabled
                                            style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                            Esaurito
                                        </button>
                                    <?php else: ?>
                                        <!-- Altrimenti, permette di aprire la pagina del carrello -->
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
<?php
// Include il file 'footer.php' per caricare il piè di pagina del sito
include 'footer.php';
?>
