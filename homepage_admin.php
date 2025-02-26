<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
</head>
<body>

    <!-- Titolo in cima -->
    <div class="text-center admin-header">
        <h3 class="mt-5">Benvenuto, 
            <?php 
            echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); 
            ?>
        </h3>
    </div>

    <main class="admin-body d-flex flex-column min-vh-100">
        
        <!-- Sezione bottoni -->
        <div class="admin-main d-flex flex-wrap justify-content-center gap-3 p-4">
            <!-- Piante -->
            <button class="btn btn-danger admin-btn"><i class="fa-solid fa-plus"></i> Aggiungi Pianta</button>
            <button class="btn btn-warning admin-btn text-white"><i class="fa-solid fa-pen"></i> Modifica Pianta</button>
            <button class="btn btn-dark admin-btn"><i class="fa-solid fa-xmark"></i> Elimina Pianta</button>

            <!-- Borse -->
            <button class="btn btn-danger admin-btn"><i class="fa-solid fa-plus"></i> Aggiungi Borsa</button>
            <button class="btn btn-warning admin-btn text-white"><i class="fa-solid fa-pen"></i> Modifica Borsa</button>
            <button class="btn btn-dark admin-btn"><i class="fa-solid fa-xmark"></i> Elimina Borsa</button>

            <!-- Gioielli -->
            <button class="btn btn-danger admin-btn"><i class="fa-solid fa-plus"></i> Aggiungi Gioiello</button>
            <button class="btn btn-warning admin-btn text-white"><i class="fa-solid fa-pen"></i> Modifica Gioiello</button>
            <button class="btn btn-dark admin-btn"><i class="fa-solid fa-xmark"></i> Elimina Gioiello</button>
        </div>

        <!-- Bottone Logout -->
        <div class="text-center pb-2">
            <form action="login_controller.php?action=logout" method="post">
                <button type="submit" class="btn btn-danger px-5 py-2 mt-5">Effettua il logout</button>
            </form>
        </div>

        <!-- Spazio flessibile -->
        <div class="flex-grow-1"></div>
        
    </main>

</body>
</html>
