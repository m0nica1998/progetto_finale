  <footer>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <h3 class="mt-5 mb-3"><strong><a class="my-1" href="index.php">Tabacchi Cesario</a></strong></h3>
          <strong>Indirizzo:</strong>
          <p class="my-1">Via XX Settembre 104</p>
          <strong>Contatti:</strong>
          <p class="my-1"><strong>tel:</strong> +39 0984 180 3006</p>
          <p class="my-1"><strong>email:</strong> <a class="my-1" href="mailto:monica.cesario98@icloud.com">monica.cesario98@icloud.com</a></p>
          <div class="social-media pb-4">

            <!--link Facebook-->
            <a class="my-1"  href="https://www.facebook.com/profile.php?id=100075942254236" target="_blank">
              <img src="imgs/facebook.png" alt="Facebook" class="facebook-logo">
            </a>

            <!-- Link a WhatsApp -->
            <a class="my-1" href="https://wa.me/393515914071" target="_blank">
              <img src="imgs/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6">
            <!-- Mappa dinamica per San Fili, Cosenza -->
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3086.778849259464!2d16.1738593!3d39.3179248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133f9f887eaaaaab%3A0x881ab9b33d9f9a2e!2sSan%20Fili%2C%20CS!5e0!3m2!1sit!2sit!4v1635800211445!5m2!1sit!2sit"
              width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>

            <!-- Link che apre San Fili su Google Maps -->
            <a href="https://www.google.com/maps/place/San+Fili,+CS/@39.3179248,16.1738593,14z" target="_blank"
              class="map-link">Visualizza su Google Maps</a>
        </div>
      </div>
    </div>
  </footer>
  
    <script>
           function toggleSearchOverlay() {
        let overlay = document.getElementById('searchOverlay');
        overlay.style.display = (overlay.style.display === 'flex') ? 'none' : 'flex';
    }
        var triggerEl = document.querySelector("#navId a");
        bootstrap.Tab.getInstance(triggerEl).show(); // Select tab by name
    </script>

    <?php if($title ==  "Area personale" ) :?>
    <script>
        var modal_lista_prodotti_id = document.getElementById('modal_lista_prodotti_id');

        modal_lista_prodotti_id.addEventListener('show.bs.modal', function(event) {
           
            let button = event.relatedTarget;
            
            let recipient = button.getAttribute('data-bs-whatever');

           
        });
    </script>
    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modaleOrdiniId"),
            options,
        );
    </script>
    <?php endif; ?>
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>