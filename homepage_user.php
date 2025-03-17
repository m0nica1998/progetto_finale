<main class="main-utente d-flex align-items-center flex-column">
<h3 class="text-center pt-3">Benvenuto, <?php echo $_SESSION['name']?></h3>

<div class="col-6 d-flex align-items-center flex-column" >
  <!-- Modale ordini bottone -->
<button
  type="button"
  class="btn btn-primary btn-lg mt-3"
  data-bs-toggle="modal"
  data-bs-target="#modalOrdiniUtenteId"
>
  I miei ordini
</button>
<!-- form -->
<form class="mt-3" action="login_controller.php?action=logout" method="post">

 <!-- bottone di logout -->
  <button type="submit" class="btn btn-danger">Effettura il logout</button>
</form>
</div>



 <!-- Modale per visualizzare gli ordini -->
<div
  class="modal fade"
  id="modalOrdiniUtenteId"
  tabindex="-1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  
  role="dialog"
  aria-labelledby="modalOrdiniUtenteTitleId"
  aria-hidden="true"
>
  <div
    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
    role="document"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalOrdiniUtenteTitleId">
          I miei ordini
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <?php if(isset($_SESSION['ordini_utente']) && count($_SESSION['ordini_utente']) > 0 ) :?>
          <div
            class="table-responsive"
          >
            <table
              class="table table-primary"
            >
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Prezzo</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach($_SESSION['ordini_utente'] as $key => $value) : ?>
                <tr class="">
                  <td scope="row"><?php echo $value['id']?></td>
                  <td><?php echo $value['prezzo']?> €</td>
                  <td><?php echo $value['data']?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          
         <?php else : ?>
          
          <p>Non ci sono ordini</p>
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




</main>
