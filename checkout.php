<?php 
session_start();
$title = 'CheckOut';
include 'header.php' ?>

<main class="main-checkout container ">
        <div class="text-center mb-4">
            <h1><a href="index.html" target="_blank" class="text-decoration-none">Tabacchi Cesario</a></h1>
            <h2>CHECKOUT</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="/action_page.php">
                        <h3>Indirizzo fatturazione</h3>
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
            <div class="col-md-4">
                <div class="card p-4">
                    <h4>Carrello <span class="float-end"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
                    <p><a href="#" class="text-decoration-none">Prodotto 1</a> <span class="float-end">€15</span></p>
                    <p><a href="#" class="text-decoration-none">Prodotto 2</a> <span class="float-end">€5</span></p>
                    <p><a href="#" class="text-decoration-none">Prodotto 3</a> <span class="float-end">€8</span></p>
                    <p><a href="#" class="text-decoration-none">Prodotto 4</a> <span class="float-end">€2</span></p>
                    <hr>
                    <p>Totale <span class="float-end"><b>€30</b></span></p>
                </div>
            </div>
        </div>
</main>

 <?php include 'footer.php' ?>
