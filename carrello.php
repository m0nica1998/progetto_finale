<?php 
// Avvia la sessione per mantenere i dati dell'utente durante la navigazione
session_start();

// Inizializza le variabili per il totale del carrello
$totale_carrello = 0;
$totale_prezzo_prodotto = 0;

// Titolo della pagina
$title = 'Carello';

// Include l'header della pagina
include 'header.php' ?>

<main class="d-flex justify-content-center align-items-center vh-100 main-carello">
    <div class="container text-center">
        
        <?php 
        // Controlla se l'utente è loggato (verifica se la variabile di sessione 'name' non è vuota)
        if($_SESSION['name'] != "") :   ?>
        
         <!-- Se il carrello non è vuoto, mostra la tabella -->
          <?php if(isset($_SESSION['carrello']) && $_SESSION['carrello'] != []) : ?>

          <div
            class="table-responsive">
            <table
                class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Immagine</th>
                        <th scope="col">Nome</th>
                        <th scope="col" class="text-start">Quantità</th>
                        <th scope="col">Prezzo</th>

                    </tr>
                </thead>
               
                
                <?php 
                // Ciclo for per iterare su tutti gli elementi presenti nel carrello
                for($i = 0; $i < count($_SESSION["carrello"]); $i++): ?>
                    <?php
                    // Calcola il prezzo totale del prodotto (quantità * prezzo unitario)
                     $totale_prezzo_prodotto = $_SESSION["carrello"][$i]['prezzo'] * $_SESSION["carrello"][$i]['quantita']; 
                    $totale_carrello += $totale_prezzo_prodotto; // Aggiorna il totale complessivo del carrello
                    ?>
                    
                <tbody>
                    <tr class="">
                        <td scope="row">
                            <!-- Pulsante per rimuovere un prodotto dal carrello -->
                            <form action="controller_carrello.php?action=delete&id=<?php echo $_SESSION["carrello"][$i]['id'] ?>" method="post">
                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                <i class="fa fa-trash"></i>

                                </button>
                                
                            </form>
                        </td>
                        <!-- Mostra l'immagine del prodotto -->
                        <td><img src="imgs/<?php echo $_SESSION["carrello"][$i]['immagine'] ?>" alt="<?php echo $_SESSION["carrello"][$i]['nome'] ?>" width="50" height="50"></td>
                        <td><?php echo $_SESSION["carrello"][$i]['nome'] ?></td>
                        <!-- Sezione quantità con pulsanti per aumentare o diminuire -->
                        <td class="d-flex min-h-100 pb-4"><?php echo $_SESSION["carrello"][$i]['quantita'] ?>
                        <!-- Pulsante per incrementare la quantità -->
                        <form class="ps-2 pe-2" action="controller_carrello.php?action=edit&method=up&id=<?php echo $_SESSION["carrello"][$i]['id']?>" method="post">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                            <i class="fas fa-caret-up"></i>  <!-- Triangolo su -->


                            </button>
                            
                        </form>
                        <!-- Pulsante per decrementare la quantità -->
                        <form action="controller_carrello.php?action=edit&method=down&id=<?php echo $_SESSION["carrello"][$i]['id']?>" method="post">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                            <i class="fas fa-caret-down"></i>  <!-- Triangolo giù -->
                            </button>
                            
                        </form>
                    
                    </td>
                        <td><?php echo $_SESSION["carrello"][$i]['prezzo'] ?> €</td> <!-- Prezzo unitario -->
                    </tr>
                </tbody>
                
                <?php endfor; ?> <!-- Fine del ciclo for -->
                
                <!-- Riga del totale carrello -->
                <tfoot><tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tot: <?php echo $totale_carrello ?> €</td> <!-- Totale del carrello -->
                </tr></tfoot>
            </table>
          </div>
          <?php else : ?>
            <h3>Il carrello è vuoto</h3> <!-- Messaggio se il carrello è vuoto -->
          <?php endif; ?>
          <!-- Mostra il pulsante di checkout solo se il carrello contiene prodotti -->
        <?php if(isset($_SESSION['carrello']) && !$_SESSION['carrello'] == [] ) : ?>
        <a href="checkout.php" target="_blank" class="btn btn-danger btn-custom">Procedi al checkout</a>
        <?php endif; ?>
        <?php else : ?> 
             <!-- Se l'utente non è loggato, mostra il pulsante per accedere -->
             <a href="login.php" target="_blank" class="btn btn-danger btn-custom">Effettua il login </a>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php' ?> <!-- Include il footer della pagina -->