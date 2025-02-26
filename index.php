<?php 
session_start();
if(empty($_SESSION['name'])){
    $_SESSION['name'] = "";
}

$title = 'Tabacchi Cesario Home';
include 'header.php' ?>

<main class="position-relative text-center text-white py-5 main-homepage">
    <div class="opacizzata"></div>
    <div class="container position-relative z-3">
        <h1 class="fw-bold">Tabacchi Cesario</h1>
        <h4>Tabacchi, fiori, piante ed articoli da regalo.</h4>
        <h4>Si effettuano consegne floreali a domicilio!</h4>
        <p>Vienici a trovare! Siamo a San Fili in <mark>Via XX Settembre 104</mark>.</p>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imgs/carousel1.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/carousel2.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/carousel4.jpg" class="d-block w-100 carousel-image rounded-4" alt="fiori">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div id="carousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
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
<?php include 'footer.php' ?>