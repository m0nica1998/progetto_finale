<?php
session_start();
function showBorse()
{

    // Connessione al DB
    $connessione = new mysqli('localhost', 'root', 'root', 'db_tabacchi');
    if ($connessione->connect_error) {
        die("Errore di connessione: " . $connessione->connect_error);
    }

    $query = "SELECT id, nome, tipo, prezzo, immagine, fileData, disp_magazzino FROM prodotti";
    if ($result = $connessione->query($query)) {

        //verifica se sono presenti dati nella tabella
        if ($result->num_rows > 0) {
            $piante = [];
            $borse = [];
            $gioielli = [];
            while ($row = $result->fetch_assoc()) {
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
           
            $_SESSION['piante'] = $piante;
            $_SESSION['borse'] = $borse;
            $_SESSION['gioielli'] = $gioielli;
           // header('Location: shop_borse.php');
          //  exit();
        } else {
            $_SESSION['errore'] = "Non ci sono prodotti nel sistema";
          //  header('Location: shop_borse.php');
          //  exit();
        }
    }
}


showBorse();



$title = 'Shop Borse';

include 'header.php'; ?>
<main class="main-shop-borse">
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($_SESSION['borse']); $i++): ?>
                <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
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
                                <?php if (in_array($i, [1])): ?>
                                    <div class="ribbon bg-green">HOT</div>
                                <?php endif; ?>
                                <?php if (in_array($i, [0])): ?>
                                    <div class="ribbon bg-orange">NEW</div>
                                <?php endif; ?>
                                <img src="imgs/<?php echo $_SESSION['borse'][$i]['immagine'] ?>" alt="<?php echo $_SESSION['borse'][$i]['nome'] ?>" class="img <?php if ($_SESSION['borse'][$i]['disp_magazzino'] == 0) {
                                                                                                                                                                    echo "opaca";
                                                                                                                                                                } ?>">
                            </div>
                            <div class="col text-center mt-2">
                                <p class="fw-bold">Prezzo <?php echo $_SESSION['borse'][$i]['prezzo'] ?> €</p>
                                <div class="footer-card d-flex justify-content-center">
                                    <?php if ($_SESSION['borse'][$i]['disp_magazzino'] == 0): ?>
                                        <button type="button" class="btn btn-shop" disabled
                                            style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                            Esaurito
                                        </button>
                                    <?php else: ?>
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
<?php include 'footer.php'; ?>