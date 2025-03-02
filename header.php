<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Impostazioni di carattere e viewport per la responsività -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link al file CSS personalizzato -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Link al file CSS di Bootstrap per lo stile e la responsività -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Link a FontAwesome per l'uso delle icone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Titolo della pagina dinamico tramite PHP -->
    <title><?php echo $title ?></title>
</head>

<body>
    <!-- Barra di navigazione (Navbar) -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-gray py-1 fixed-top">
            <div class="container-fluid pt-1 pb-1">
                
                <!-- Logo che porta alla homepage -->
                <a class="navbar-brand container-logo border rounded-circle" href="index.php"></a>
                
                <!-- Barra di ricerca visibile solo su dispositivi con larghezza media e superiore -->
                <form class="d-none d-md-flex mx-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search" type="submit">Cerca</button>
                </form>
                
                <!-- Pulsante di ricerca mobile visibile solo su schermi piccoli -->
                <div class="d-flex ms-auto pe-3">
                    <button class="d-md-none btn btn-outline-secondary" onclick="toggleSearchOverlay()">
                        🔍
                    </button>
                </div>
                
                <!-- Toggler per la visualizzazione del menu mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Menu di navigazione espandibile (per schermi grandi) -->
                <div class="collapse navbar-collapse justify-content-end fs-5" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        
                        <!-- Link alla homepage (non visibile se il titolo è "Tabacchi Cesario Home") -->
                        <?php if($title != 'Tabacchi Cesario Home') : ?>
                        <li class="nav-item p-1 ">
                            <a class="color-lgray hoverRed fw-bold td-none" aria-current="page"
                                href="index.php">Homepage</a>
                        </li>
                        <?php endif; ?>
                        
                        <!-- Link al login (visibile solo se l'utente non è loggato) -->
                        <?php if($title != 'Login' && (isset($_SESSION['name']) &&  $_SESSION['name'] == "")) : ?>
                        <li class="nav-item p-1 ">
                            <a class="color-lgray hoverRed fw-bold td-none" href="login.php">Login</a>
                        </li>
                        <?php endif; ?>
                        
                        <!-- Link all'area personale (visibile solo se l'utente è loggato) -->
                        <?php if($title != "Area personale" && (isset($_SESSION['name']) &&  $_SESSION['name'] != "")) : ?>
                            <li class="nav-item p-1 ">
                            <a class="color-lgray hoverRed fw-bold td-none" href="utente.php">Benvenuto, <?php echo $_SESSION['name'] ?> </a>
                        </li> 
                        <?php endif; ?>
                         
                        <!-- Link alla registrazione (visibile solo se l'utente non è loggato) -->
                        <?php if($title != 'Contatti' && (isset($_SESSION['name']) &&  $_SESSION['name'] == "")) : ?>
                        <li class="nav-item p-1">
                            <a class="color-lgray hoverRed fw-bold td-none" href="contatti.php">Registrati</a>
                        </li>
                        <?php endif; ?>
                       
                        <!-- Menu a discesa per lo shop -->
                        <li class="nav-item p-1 dropdown">
                            <a class="td-none fw-bold color-lgray hoverRed" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Shop
                            </a>
                            <ul class="dropdown-menu bg-gray border-0 text-lg-center shadow-lg" aria-labelledby="navbarDropdownMenuLink">
                                <!-- Link per le categorie di shop, visibili solo se non si è già sulla pagina corrente -->
                                <?php if($title != 'Shop Piante') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none" href="shop_piante.php">Piante</a></li>
                                <?php endif; ?>
                                
                                <?php if($title != 'Shop Borse') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none" href="shop_borse.php">Borse</a></li>
                                <?php endif; ?>
                                
                                <?php if($title != 'Shop Gioielli') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none" href="shop_gioielli.php">Gioielli</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <!-- Link al carrello -->
                        <li class="nav-item p-1 ">
                            <a class="hoverRed color-lgray fw-bold td-none" href="carrello.php">Carrello</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Overlay di ricerca (visibile su dispositivi mobili quando cliccato il pulsante 🔍) -->
        <div id="searchOverlay" class="search-overlay">
            <div class="search-box">
                <!-- Campo di ricerca nell'overlay -->
                <input class="form-control" type="search" placeholder="Cerca..." aria-label="Search">
                <!-- Pulsante per chiudere l'overlay di ricerca -->
                <button class="btn btn-outline-danger mt-2" onclick="toggleSearchOverlay()">Chiudi</button>
            </div>
        </div>
    </header>
</body>

</html>
