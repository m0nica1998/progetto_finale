<?php 
// Avvio della sessione per gestire le variabili di sessione
session_start();

// Controllo se la variabile di sessione 'name' è vuota; se sì, la inizializza con una stringa vuota
if(empty($_SESSION['name'])){
    $_SESSION['name'] = "";
}

// Definizione del titolo della pagina
$title = 'Tabacchi Cesario Home';

// Inclusione del file 'header.php'
include 'header.php' ?>

<main class="position-relative text-center text-white py-5 main-homepage">
     <!-- Div per lo sfondo opacizzato -->
    <div class="opacizzata"></div>
    <div class="container position-relative z-3">
        <!-- Titolo principale -->
        <h1 class="fw-bold">Tabacchi Cesario</h1>
            <!-- Descrizione dell'attività -->
        <h4>Tabacchi, fiori, piante ed articoli da regalo.</h4>
        <h4>Si effettuano consegne floreali a domicilio!</h4>
        <!-- Indirizzo del negozio evidenziato -->
        <p>Vienici a trovare! Siamo a San Fili in <mark>Via XX Settembre 104</mark>.</p>
         <!-- Sezione contenente due caroselli di immagini -->
        <div class="row justify-content-center">
             <!-- Primo carosello -->
            <div class="col-md-5">
                <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                         <!-- Prima immagine del carosello (attiva di default) -->
                        <div class="carousel-item active">
                            <img src="imgs/carousel1.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <!-- Seconda immagine del carosello -->
                        <div class="carousel-item">
                            <img src="imgs/carousel2.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                          <!-- Terza immagine del carosello -->
                        <div class="carousel-item">
                            <img src="imgs/carousel4.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                    </div>
                </div>
            </div>
             <!-- Secondo carosello -->
            <div class="col-md-5">
                <div id="carousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                         <!-- Prima immagine del carosello (attiva di default) -->
                        <div class="carousel-item active">
                            <img src="imgs/carousel5.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                         <!-- Seconda immagine del carosello -->
                        <div class="carousel-item">
                            <img src="imgs/carousel6.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                         <!-- Terza immagine del carosello -->
                        <div class="carousel-item">
                            <img src="imgs/carousel7.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Inclusione del file 'footer.php' -->
<?php include 'footer.php' ?>