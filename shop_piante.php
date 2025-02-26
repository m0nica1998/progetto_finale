<?php 
session_start();
$title = 'Shop Borse';

include 'header.php';?>
<main class="main-shop-borse">
    <div class="container">
        <div class="row">
            <?php for ($i = 1; $i <= 17; $i++): ?>
            <div class="col-sm col-md-3 col-lg-3 d-flex flex-column mt-4">
                <div class="header-card d-flex ">
                    <div class="pianta col-4 ms-1 me-1 ">
                        
                    </div>
                    <div class="text col-8">
                        <p class="fw-bold testo-titolo">Pianta <?php echo $i; ?></p>
                    </div>
                </div>
                <div class="main-card card-equal-height">
                    <div class="row justify-content-center align-items-center flex-column">
                        <div class="col d-flex justify-content-center position-relative">
                            <?php if (in_array($i, [1, 6, 15])): ?>
                                <div class="ribbon bg-green">HOT</div>
                            <?php endif; ?>
                            <?php if (in_array($i, [3, 9, 17])): ?>
                                <div class="ribbon bg-orange">NEW</div>
                            <?php endif; ?>
                            <img src="imgs/pianta<?php echo $i; ?>.JPG" alt="Pianta <?php echo $i; ?>" class="img <?php echo in_array($i, [1, 42]) ? 'opaca' : ''; ?>">
                        </div>
                        <div class="col text-center mt-2">
                            <p class="fw-bold">Prezzo: <?php echo rand(15, 30); ?>€</p>
                            <div class="footer-card d-flex justify-content-center">
                                <?php if (in_array($i, [1, 42])): ?>
                                    <button type="button" class="btn btn-shop" disabled
                                        style="cursor: not-allowed; background-color: #ccc; color: #666;">
                                        Esaurito
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-shop" onclick="window.open('carrello.php', '_blank');">
                                        Acquista
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</main>
<?php include 'footer.php';?>
