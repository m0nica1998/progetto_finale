
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title><?php echo $title ?></title>
</head>

<body>
    <!-- Nav tabs -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-gray py-1 fixed-top">
            <div class="container-fluid pt-1 pb-1" >
                <a class="navbar-brand  container-logo border rounded-circle" href="index.php" ></a>
                <form class="d-none d-md-flex mx-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn search" type="submit">Cerca</button>
                </form>
                <div class="d-flex ms-auto pe-3">
                    <button class="d-md-none btn btn-outline-secondary" onclick="toggleSearchOverlay()">
                        🔍
                    </button>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end fs-5" id="navbarNavDropdown" >
                    <ul class="navbar-nav">
                        <?php if($title != 'Tabacchi Cesario Home') : ?>
                        <li class="nav-item p-1 ">
                            <a class=" color-lgray hoverRed fw-bold td-none" aria-current="page"
                                href="index.php">Homepage</a>
                        </li>
                        <?php endif; ?>
                        <?php if($title != 'Login' && (isset($_SESSION['name']) &&  $_SESSION['name'] == "")) : ?>
                        <li class="nav-item p-1 ">
                            <a class="color-lgray hoverRed fw-bold td-none" href="login.php">Login</a>
                        </li>
                        <?php endif; ?>
                        <?php if($title != "Area personale" && (isset($_SESSION['name']) &&  $_SESSION['name'] != "")) : ?>
                            <li class="nav-item p-1 ">
                            <a class="color-lgray hoverRed fw-bold td-none" href="utente.php">Benvenuto, <?php echo $_SESSION['name'] ?> </a>
                        </li> 
                        <?php endif; ?>
                         <?php if($title != 'Contatti' && (isset($_SESSION['name']) &&  $_SESSION['name'] == "")) : ?>
                        <li class="nav-item p-1">
                            <a class="color-lgray hoverRed fw-bold td-none" href="contatti.php">Registrati</a>
                        </li>
                        <?php endif; ?>
                       
                        <li class="nav-item p-1 dropdown  ">
                            <a class="td-none fw-bold color-lgray hoverRed " href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Shop
                            </a>
                            <ul class="dropdown-menu bg-gray border-0 text-lg-center shadow-lg" aria-labelledby="navbarDropdownMenuLink">
                            <?php if($title != 'Shop Piante') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none" href="shop_piante.php">Piante</a>
                                </li>
                                <?php endif; ?>
                                <?php if($title != 'Shop Borse') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none" href="shop_borse.php">Borse</a>
                                </li>
                                <?php endif; ?>
                                <?php if($title != 'Shop Gioielli') : ?>
                                <li><a class="fw-bold color-lgray hoverRed td-none"
                                        href="shop_gioielli.php">Gioielli</a></li>
                                        <?php endif; ?>  
                            </ul>
                        </li>
                        <li class="nav-item p-1 ">
                            <a class="hoverRed color-lgray fw-bold td-none" href="carrello.php">Carrello</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="searchOverlay" class="search-overlay">
        <div class="search-box">
            <input class="form-control" type="search" placeholder="Cerca..." aria-label="Search">
            <button class="btn btn-outline-danger mt-2" onclick="toggleSearchOverlay()">Chiudi</button>
        </div>
    </div>
    </header>