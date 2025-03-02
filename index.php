<?php 
// Avvia la sessione. Viene utilizzato per gestire variabili globali di sessione.
session_start();

// Controlla se la variabile di sessione 'name' è vuota, e se lo è la inizializza come stringa vuota.
if(empty($_SESSION['name'])){
    $_SESSION['name'] = "";
}

// Imposta il titolo della pagina.
$title = 'Tabacchi Cesario Home';

// Include il file 'header.php' che contiene la parte superiore del sito (header).
include 'header.php' 
?>

<!-- Inizio del corpo principale della homepage -->
<main class="position-relative text-center text-white py-5 main-homepage">
    <!-- Questo div applica un effetto di opacità al fondo, dando un effetto di sfocatura o oscuramento dietro il contenuto -->
    <div class="opacizzata"></div>
    
    <!-- Contenitore principale con posizione relativa per sovrapporre elementi sopra -->
    <div class="container position-relative z-3">
        <!-- Titolo principale della pagina -->
        <h1 class="fw-bold">Tabacchi Cesario</h1>
        
        <!-- Descrizione sotto il titolo -->
        <h4>Tabacchi, fiori, piante ed articoli da regalo.</h4>
        
        <!-- Sottotitolo che menziona la disponibilità di consegne floreali -->
        <h4>Si effettuano consegne floreali a domicilio!</h4>
        
        <!-- Testo che fornisce l'indirizzo fisico del negozio -->
        <p>Vienici a trovare! Siamo a San Fili in <mark>Via XX Settembre 104</mark>.</p>
        
        <!-- Griglia (row) centrata per le immagini del carosello -->
        <div class="row justify-content-center">
            <!-- Colonna con la larghezza di 5 unità su schermi medi e più grandi -->
            <div class="col-md-5">
                <!-- Primo carosello di immagini -->
                <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                    <!-- Contenuto del carosello -->
                    <div class="carousel-inner">
                        <!-- Prima immagine del carosello, attiva al caricamento -->
                        <div class="carousel-item active">
                            <img src="imgs/carousel1.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <!-- Altre immagini del carosello -->
                        <div class="carousel-item">
                            <img src="imgs/carousel2.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/carousel4.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Colonna per il secondo carosello di immagini -->
            <div class="col-md-5">
                <!-- Secondo carosello di immagini -->
                <div id="carousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Immagini del secondo carosello -->
                        <div class="carousel-item active">
                            <img src="imgs/carousel5.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/carousel6.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/carousel7.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
// Include il file 'footer.php' che contiene la parte inferiore del sito (footer).
include 'footer.php' 
?>
