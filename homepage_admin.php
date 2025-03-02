<?php
// Avvio della sessione per gestire i dati dell'utente
session_start();
?>

<main class="admin-body d-flex flex-column min-vh-100">

    <!-- Titolo in cima con saluto personalizzato -->
    <div class="text-center admin-header">
        <h3 class="mt-5">Benvenuto,
            <?php
            // Visualizza il nome dell'utente dalla sessione, se disponibile
            echo htmlspecialchars($_SESSION['name'] ?? 'Admin');
            ?>
        </h3>
    </div>

    <!-- Sezione bottoni principali -->
    <div class="admin-main d-flex flex-wrap justify-content-center gap-3 p-4">
        <!-- Bottone per aggiungere un nuovo prodotto -->
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAggiuntaProdotti">
            Aggiungi prodotto
        </button>

        <!-- Modal per l'aggiunta di un prodotto -->
        <div class="modal fade" id="modalAggiuntaProdotti" tabindex="-1" aria-labelledby="modalAggiuntaProdottiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAggiuntaProdottiLabel">Aggiungi prodotto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form per aggiungere un prodotto -->
                    <form action="controller_prodotti.php?action=create" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- Visualizzazione di eventuali errori o successi -->
                            <?php if (isset($_SESSION['errore']) && $_SESSION['errore'] != null) : ?>
                                <span><?php echo "Errore" . $_SESSION['errore'] ?></span>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['successo']) && $_SESSION['successo'] != null) : ?>
                                <span><?php echo "Caricamento avvenuto. <br>" . $_SESSION['successo'] ?></span>
                            <?php endif; ?>

                            <!-- Campo per inserire il nome del prodotto -->
                            <div class="mb-3">
                                <label for="" class="form-label">Nome</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nome_prodotto"
                                    id="nome_prodotto"
                                    placeholder="Nome prodotto" />
                            </div>

                            <!-- Campo per inserire il prezzo del prodotto -->
                            <div class="input-group mb-3">
                                <label for="" class="form-label">Prezzo</label>
                                <span class="input-group-text">€</span>
                                <input type="number" id="prezzo" name="prezzo" class="form-control">
                            </div>

                            <!-- Campo per selezionare il tipo di prodotto -->
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo</label>
                                <select
                                    class="form-select form-select-lg"
                                    name="tipo"
                                    id="tipo">
                                    <option selected>Seleziona uno</option>
                                    <option value="piante">Piante</option>
                                    <option value="borse">Borse</option>
                                    <option value="gioielli">Gioielli</option>
                                </select>
                            </div>

                            <!-- Campo per caricare l'immagine del prodotto -->
                            <div class="mb-3">
                                <label for="" class="form-label">Seleziona l'immagine del prodotto</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="immagine"
                                    id="immagine"
                                    required />
                            </div>

                            <!-- Campo per inserire la disponibilità del prodotto in magazzino -->
                            <div class="mb-3">
                                <label for="" class="form-label">Disponibilità magazzino</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="disp_magazzino"
                                    id="disp_magazzino"
                                    placeholder="" />
                            </div>
                        </div>

                        <!-- Bottoni per inviare o chiudere il modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary">Aggiungi prodotto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bottone per visualizzare la lista dei prodotti -->
        <?php if ((!isset($_SESSION['piante']) && (!isset($_SESSION['borse']) && (!isset($_SESSION['gioielli']))))) : ?>
            <form action="controller_prodotti.php?action=showAll" method="post">
                <button
                    type="submit"
                    class="btn btn-primary pt-3 pb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modal_lista_prodotti_id">
                    Lista prodotti
                </button>
            </form>
        <?php else : ?>
            <button
                type="submit"
                class="btn btn-primary pt-3 pb-3"
                data-bs-toggle="modal"
                data-bs-target="#modal_lista_prodotti_id">
                Lista prodotti
            </button>
        <?php endif; ?>

        <!-- Modal per visualizzare la lista dei prodotti -->
        <div class="modal fade" id="modal_lista_prodotti_id" tabindex="-1" role="dialog" aria-labelledby="modale_lista_prodotti_title_id" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modale_lista_prodotti_title_id">Lista prodotti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Container per la visualizzazione dei prodotti -->
                        <div class="container">
                            <div class="row align-items-start g-2">
                                <!-- Visualizzazione delle piante -->
                                <div class="col">
                                    <?php for ($i = 0; $i < count($_SESSION['piante']); $i++) : ?>
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img
                                                        src="./imgs/<?php echo $_SESSION['piante'][$i]['immagine'] ?>"
                                                        class="img-fluid rounded-start"
                                                        alt="<?php echo $_SESSION['piante'][$i]['nome'] ?>" />
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $_SESSION['piante'][$i]['nome'] ?></h5>
                                                        <p class="card-text">
                                                            Prezzo: <?php echo $_SESSION['piante'][$i]['prezzo'] ?>€<br>
                                                            Disponibilità in magazzino: <?php echo $_SESSION['piante'][$i]['disp_magazzino'] ?><br>
                                                        </p>
                                                        <!-- Modifica e Elimina per ogni prodotto -->
                                                        <form action="modifica_prodotto.php?id=<?php echo $i ?>&tipo=<?php echo $_SESSION['piante'][$i]['tipo'] ?>" method="post">
                                                            <button type="submit" class="btn btn-primary">Modifica</button>
                                                        </form>
                                                        <form action="controller_prodotti.php?action=delete&id=<?php echo $_SESSION['piante'][$i]['id'] ?>" method="post">
                                                            <button type="submit" class="btn btn-primary mt-3">Elimina</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <!-- Ripetere la stessa struttura per borse e gioielli -->
                                <!-- Codice per borse -->
                                <div class="col">
                                    <?php for ($i = 0; $i < count($_SESSION['borse']); $i++) : ?>
                                        <!-- Codice simile a quello per le piante -->
                                    <?php endfor; ?>
                                </div>

                                <!-- Codice per gioielli -->
                                <div class="col">
                                    <?php for ($i = 0; $i < count($_SESSION['gioielli']); $i++) : ?>
                                        <!-- Codice simile a quello per le piante -->
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Spazio flessibile per riempire lo spazio vuoto -->
    <div class="flex-grow-1"></div>

    <!-- Script per personalizzare la visualizzazione del modal -->
    <script>
        var modal_lista_prodotti_id = document.getElementById('modal_lista_prodotti_id');
        modal_lista_prodotti_id.addEventListener('show.bs.modal', function(event) {
            // Codice per personalizzare il comportamento del modal, se necessario
        });
    </script>

    <!-- Bottone per il logout -->
    <div class="text-center pb-2">
        <form action="login_controller.php?action=logout" method="post">
            <button type="submit" class="btn btn-danger px-5 py-2 mt-5">Effettua il logout</button>
        </form>
    </div>

</main>
