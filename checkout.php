<?php 
// Avvia la sessione per mantenere i dati dell'utente
session_start();
// Inizializzazione delle variabili per il checkout
$tot_quantita = 0; // Totale quantità prodotti nel carrello
$totale_carrello = 0; // Totale costo del carrello
$tot_prodotto = 0; // Totale costo di un singolo prodotto
$title = 'Checkout';  // Titolo della pagina

// Calcola il totale degli articoli nel carrello
for($i = 0; $i< count($_SESSION['carrello']); $i++) {
    $tot_quantita += $_SESSION['carrello'][$i]['quantita'];
}

// Include l'header della pagina
include 'header.php' ?> 

<main class="main-checkout container ">
        <div class="text-center mb-4">
            <h1><a href="index.html" target="_blank" class="text-decoration-none">Tabacchi Cesario</a></h1>
            <h2>CHECKOUT</h2>
        </div>
        <div class="row">
            <!-- Sezione per il modulo di fatturazione e pagamento -->
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="controller_ordini.php?action=create" method="post">
                        <h3>Indirizzo fatturazione</h3>
                        <!-- Campi per l'inserimento dei dati di fatturazione -->
                        <div class="mb-3">
                            <label for="fname" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="fname" name="firstname" placeholder="Mario Rossi">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="mario@esempio.com">
                        </div>
                        <div class="mb-3">
                            <label for="adr" class="form-label">Indirizzo</label>
                            <input type="text" class="form-control" id="adr" name="address" placeholder="128 Via Roma">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Città</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Milano">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="state" class="form-label">Stato</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="IT">
                            </div>
                            <div class="col-md-6">
                                <label for="zip" class="form-label">CAP</label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="10001">
                            </div>
                        </div>
                        <h3 class="mt-4">Pagamento</h3>
                       <!-- Campi per il pagamento -->
                        <div class="mb-3">
                            <label for="cname" class="form-label">Nome sulla carta</label>
                            <input type="text" class="form-control" id="cname" name="cardname" placeholder="Mario Rossi">
                        </div>
                        <div class="mb-3">
                            <label for="ccnum" class="form-label">Numero carta</label>
                            <input type="text" class="form-control" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="expmonth" class="form-label">Mese scadenza</label>
                                <input type="text" class="form-control" id="expmonth" name="expmonth" placeholder="Settembre">
                            </div>
                            <div class="col-md-6">
                                <label for="expyear" class="form-label">Anno scadenza</label>
                                <input type="text" class="form-control" id="expyear" name="expyear" placeholder="2028">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="352">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sameadr" checked>
                            <label class="form-check-label" for="sameadr">Indirizzo di spedizione uguale all'indirizzo di fatturazione</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Continua al checkout</button>
                    </form>
                </div>
            </div>
            <!-- Sezione riepilogo carrello -->
            <div class="col-md-4">
                <div class="card p-4">
                    <h4>Carrello <span class="float-end"><i class="fa fa-shopping-cart"></i> <b><?php echo $tot_quantita?></b></span></h4>
                    <?php for($i = 0; $i< count($_SESSION['carrello']); $i++): ?> 
                    <?php
                     // Calcola il totale per ogni prodotto nel carrello
                     $tot_prodotto = $_SESSION['carrello'][$i]['prezzo']* $_SESSION['carrello'][$i]['quantita'];
                    $totale_carrello += $tot_prodotto;
                     ?>
                    
                    <p><a href="#" class="text-decoration-none"><?php echo $_SESSION['carrello'][$i]['nome']?></a> <span class="float-end"> <?php echo $_SESSION['carrello'][$i]['prezzo']* $_SESSION['carrello'][$i]['quantita'] ?> €</span></p>
                    
                    <?php endfor; ?>
                    <hr>
                    <p>Totale <span class="float-end"><b><?php echo $totale_carrello?></b> €</span></p>
                </div>
            </div>
        </div>
</main>

 <?php include 'footer.php' //include il footer della pagina ?>
