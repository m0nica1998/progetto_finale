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

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAggiuntaProdotti">
                Aggiungi prodotto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalAggiuntaProdotti" tabindex="-1" aria-labelledby="modalAggiuntaProdottiLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalAggiuntaProdottiLabel">Aggiungi prodotto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="controller_prodotti.php?action=create" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nome</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nome_prodotto"
                                        id="nome_prodotto"
                                        aria-describedby="helpId"
                                        placeholder="Nome prodotto" />
                                    
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">€</span>
                                    <input type="number" id="prezzo" name="prezzo" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Tipo</label>
                                    <select
                                        class="form-select form-select-lg"
                                        name="tipo"
                                        id="tipo"
                                    >
                                        <option selected>Seleziona uno</option>
                                        <option value="piante">Piante</option>
                                        <option value="borse">Borse</option>
                                        <option value="gioielli">Gioielli</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Seleziona l'immagine del prodotto</label>
                                    <input
                                        type="file"
                                        class="form-control"
                                        name="immagine"
                                        id="immagine"
                                        placeholder="Immagine prodotto"
                                        aria-describedby="fileHelpId"
                                    />
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Disponibilità magazzino</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="disp_magazzino"
                                        id="disp_magazzino"
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-primary">Aggiungi prodotto</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Borse -->

            <button class="btn btn-warning admin-btn text-white"><i class="fa-solid fa-pen"></i> Modifica Borsa</button>
            <button class="btn btn-dark admin-btn"><i class="fa-solid fa-xmark"></i> Elimina Borsa</button>

            <!-- Gioielli -->

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