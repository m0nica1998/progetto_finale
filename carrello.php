<?php 
session_start();
$totale_carrello = 0;
$totale_prezzo_prodotto = 0;
$title = 'Carello';
include 'header.php' ?>
<main class="d-flex justify-content-center align-items-center vh-100 main-carello">
    <div class="container text-center">
        
        <?php 
        if($_SESSION['name'] != "") : ?>
        
         <!--  <div class="card">
            <img class="card-img-top" src="./imgs/<?php echo $_SESSION['carrello'][$i]['immagine']?>" alt="Title" />
            <div class="card-body">
                <h4 class="card-title"><?php echo $_SESSION['carrello'][$i]['nome']?></h4>
                <p class="card-text"><?php echo $_SESSION['carrello'][$i]['prezzo']?></p>
                <p class="card-text"><?php echo $_SESSION['carrello'][$i]['disp_magazzino']?></p>
                <p>Quantità: <?php echo $_SESSION['carrello'][$i]['quantita']?> </p>
            </div>
          </div>  -->
          <div
            class="table-responsive"
          >
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Immagine</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Quantità</th>
                        <th scope="col">Prezzo</th>

                    </tr>
                </thead>
                <?php for($i = 0; $i < count($_SESSION["carrello"]); $i++): ?>
                    <?php $totale_prezzo_prodotto = $_SESSION["carrello"][$i]['prezzo'] * $_SESSION["carrello"][$i]['quantita']; 
                    $totale_carrello += $totale_prezzo_prodotto;
                    ?>
                <tbody>
                    <tr class="">
                        <td scope="row">
                            <form action="controller_carrello.php?action=delete&id=<?php echo $_SESSION["carrello"][$i]['id'] ?>" method="post">
                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                <i class="fa fa-trash"></i>

                                </button>
                                
                            </form>
                        </td>
                        <td><img src="imgs/<?php echo $_SESSION["carrello"][$i]['immagine'] ?>" alt="<?php echo $_SESSION["carrello"][$i]['nome'] ?>" width="50" height="50"></td>
                        <td><?php echo $_SESSION["carrello"][$i]['nome'] ?></td>
                        <td><?php echo $_SESSION["carrello"][$i]['quantita'] ?>
                        <form action="controller_carrello.php?action=edit&method=up&id=<?php echo $_SESSION["carrello"][$i]['id']?>" method="post">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                up
                            </button>
                            
                        </form>
                        <form action="controller_carrello.php?action=edit&method=down&id=<?php echo $_SESSION["carrello"][$i]['id']?>" method="post">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                down
                            </button>
                            
                        </form>
                    
                    </td>
                        <td><?php echo $_SESSION["carrello"][$i]['prezzo'] ?> €</td>
                    </tr>
                </tbody>
                
                <?php endfor; ?>
                <tfoot><tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tot: <?php echo $totale_carrello ?> €</td>
                </tr></tfoot>
            </table>
          </div>
          
       
        <a href="checkout.php" target="_blank" class="btn btn-danger btn-custom">Procedi al checkout</a>
        <?php else : ?> 
             <a href="login.php" target="_blank" class="btn btn-danger btn-custom">Effettua il login </a>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php' ?>