<main class="admin-body d-flex flex-column min-vh-100">

   <!-- Titolo in cima con il nome dell'utente amministratore -->
    <div class="text-center admin-header">
        <h3 class="mt-5">Benvenuto,
            <?php
            echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); // Stampa il nome dell'utente dalla sessione
            ?>
        </h3>
    </div>
   <!-- Sezione con i bottoni di gestione -->
    <div class="admin-main d-flex flex-wrap justify-content-center gap-3 p-4">
      
    <!-- Bottone per aggiungere un nuovo prodotto -->
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAggiuntaProdotti">
            Aggiungi prodotto
        </button>

        <!-- Modale per l'aggiunta di un prodotto -->
        <div class="modal fade" id="modalAggiuntaProdotti" tabindex="-1" aria-labelledby="modalAggiuntaProdottiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAggiuntaProdottiLabel">Aggiungi prodotto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                     <!-- Form per l'inserimento dei dati del prodotto -->
                    <form action="controller_prodotti.php?action=create" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- Messaggi di errore o successo -->
                            <?php if (isset($_SESSION['errore']) && $_SESSION['errore'] != null) : ?>
                                <span><?php echo "Errore" . $_SESSION['errore'] ?></span>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['successo']) && $_SESSION['successo'] != null) : ?>
                                <span><?php echo "Caricamento avvenuto. <br>" . $_SESSION['successo'] ?></span>
                            <?php endif; ?>

                            <!-- Campo per il nome del prodotto -->
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
                            <!-- Campo per il prezzo -->
                            <div class="input-group mb-3">
                            <label for="" class="form-label">Prezzo</label>
                                <span class="input-group-text">€</span>
                                <input type="number" id="prezzo" name="prezzo" class="form-control" aria-label="Amount (to the nearest dollar)">

                            </div>
                                   <!-- Selezione del tipo di prodotto -->
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
                            <!-- Campo per il caricamento dell'immagine -->
                            <div class="mb-3">
                                <label for="" class="form-label">Seleziona l'immagine del prodotto</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="immagine"
                                    id="immagine"
                                    placeholder="Immagine prodotto"
                                    aria-describedby="fileHelpId" required />

                            </div>
                            <!-- Campo per la disponibilità in magazzino -->
                            <div class="mb-3">
                                <label for="" class="form-label">Disponibilità magazzino</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="disp_magazzino"
                                    id="disp_magazzino"
                                    aria-describedby="helpId"
                                    placeholder="" />

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
             <!-- Modale per visualizzare i prodotti -->
        <div
            class="modal fade"
            id="modal_lista_prodotti_id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modale_lista_prodotti_title_id"
            aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modale_lista_prodotti_title_id">
                            Lista prodotti
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div
                            class="container">
                            <div
                                class="row align-items-start g-2">
                                <div class="col"> <?php for ($i = 0; $i < count($_SESSION['piante']); $i++): ?>
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
                                                        <p class="card-text">
                                                         <form action="modifica_prodotto.php?id=<?php echo $i ?>&tipo=<?php echo $_SESSION['piante'][$i]['tipo'] ?>" method="post">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary"
                                                            >
                                                                Modifica
                                                            </button>
                                                            
                                                         </form>

                                                        <form action="controller_prodotti.php?action=delete&id=<?php echo $_SESSION['piante'][$i]['id'] ?>" method="post">
                                                           
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary mt-3">
                                                                Elimina
                                                            </button>
                                                        </form>


                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="col"> <?php for ($i = 0; $i < count($_SESSION['borse']); $i++): ?>
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img
                                                        src="./imgs/<?php echo $_SESSION['borse'][$i]['immagine'] ?>"
                                                        class="img-fluid rounded-start"
                                                        alt="<?php echo $_SESSION['borse'][$i]['nome'] ?>" />
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $_SESSION['borse'][$i]['nome'] ?></h5>
                                                        <p class="card-text">
                                                            Prezzo: <?php echo $_SESSION['borse'][$i]['prezzo'] ?>€<br>
                                                            Disponibilità in magazzino: <?php echo $_SESSION['borse'][$i]['disp_magazzino'] ?><br>
                                                        </p>
                                                        <p class="card-text">
                                                         <form action="modifica_prodotto.php?id=<?php echo $i ?>&tipo=<?php echo $_SESSION['borse'][$i]['tipo'] ?>" method="post">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary"
                                                            >
                                                                Modifica
                                                            </button>
                                                            
                                                         </form>

                                                        <form action="controller_prodotti.php?action=delete&id=<?php echo $_SESSION['borse'][$i]['id'] ?>" method="post">
                                                           
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary mt-3">
                                                                Elimina
                                                            </button>
                                                        </form>


                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="col"> <?php for ($i = 0; $i < count($_SESSION['gioielli']); $i++): ?>
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img
                                                        src="./imgs/<?php echo $_SESSION['gioielli'][$i]['immagine'] ?>"
                                                        class="img-fluid rounded-start"
                                                        alt="<?php echo $_SESSION['gioielli'][$i]['nome'] ?>" />
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $_SESSION['gioielli'][$i]['nome'] ?></h5>
                                                        <p class="card-text">
                                                            Prezzo: <?php echo $_SESSION['gioielli'][$i]['prezzo'] ?>€<br>
                                                            Disponibilità in magazzino: <?php echo $_SESSION['gioielli'][$i]['disp_magazzino'] ?><br>
                                                        </p>
                                                        <p class="card-text">
                                                         <form action="modifica_prodotto.php?id=<?php echo $i ?>&tipo=<?php echo $_SESSION['gioielli'][$i]['tipo'] ?>" method="post">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary"
                                                            >
                                                                Modifica
                                                            </button>
                                                            
                                                         </form>

                                                        <form action="controller_prodotti.php?action=delete&id=<?php echo $_SESSION['gioielli'][$i]['id'] ?>" method="post">
                                                          
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary mt-3">
                                                                Elimina
                                                            </button>
                                                        </form>


                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                               
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Chiudi
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

       




    </div>
    <!-- Modale per visualizzare gli ordini -->
    <button
        type="button"
        class="btn btn-primary pb-3 pt-3"
        data-bs-toggle="modal"
        data-bs-target="#modaleOrdiniId"
    >
        Ordini
    </button>
    
    <div
        class="modal fade"
        id="modaleOrdiniId"
        tabindex="-1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        
        role="dialog"
        aria-labelledby="modaleOrdiniTitoloId"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleOrdiniTitoloId">
                        Lista ordini
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <?php if(isset($_SESSION['ordini']) && count($_SESSION['ordini']) > 0) : ?>
                        <div
                            class="table-responsive"
                        >
                            <table
                                class="table table-primary"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Utente</th>
                                        <th scope="col">Prezzo</th>
                                        <th scope="col">data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php for($i= 0; $i<count($_SESSION['ordini']); $i++) : ?>
                                    <tr class="">
                                        <td scope="row"><?php echo $_SESSION['ordini'][$i]['id']?></td>
                                        <td><?php echo $_SESSION['ordini'][$i]['utente']?></td>
                                        <td><?php echo $_SESSION['ordini'][$i]['prezzo']?></td>
                                        <td><?php echo $_SESSION['ordini'][$i]['data']?></td>
                                    </tr>
                                <?php endfor; ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        
                    <?php else : ?>
                        <h2>Non ci sono ordini evasi</h2>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Chiudi
                    </button>
                        
                </div>
            </div>
        </div>
    </div>
    
    
    
     

   
    <!-- Bottone Logout -->
    <div class="text-center pb-2">
        <form action="login_controller.php?action=logout" method="post">
            <button type="submit" class="btn btn-danger px-5 py-2 mt-5">Effettua il logout</button>
        </form>
    </div>

   
</main>