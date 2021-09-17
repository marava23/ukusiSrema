<div class="cart-btn">
                <span class="nav-icon">
                    <i class="fas fa-cart-plus"></i>
                </span>
    <div class="cart-items">0</div>
</div>
<section id="prodavnica">
    <div id="prodaflex">
        <h1>Naši proizvodi</h1>
        <input class='pretraga' type="text" placeholder="Pretraži...">
    </div>
    <div id="proizvodi">
    </div>
    <div class='cart-overlay'>
        <div class='cart'>
            <span class="close-cart">
                <i class='fas fa-window-close'></i>
            </span>
            <h2> Vaša korpa</h2>
            <div class="cart-content">
                <div class="cart-item">
<!--                    <img src="./assets/images/product-1.jpeg" alt="product">-->
<!--                    <div>-->
<!--                        <h4> queen bed</h4>-->
<!--                        <h5>$9.00</h5>-->
<!--                        <span class="remove-item">remove</span>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                    <i class="fas fa-chevron-up"></i>-->
<!--                    <p class="item-amount">1</p>-->
<!--                    <i class="fas fa-chevron-down"></i>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="cart-footer">
                <h3>Ukupno :  <span class="cart-total">0 rsd</span></h3>
                <button class="clear-cart banner-btn" id='dohvati'>Izbriši sve</button>
                <button class="banner-btn" id="kupi">Kupi</button>
                <br/>
                <span id="kupovinaGreska" class="error"></span>
                <?php
                if(isset($_SESSION['korisnik'])){
                    $korisnik = $_SESSION['korisnik'];
                    echo "<input type='hidden' id='kupacId' name='kupacId' value='$korisnik->idKorisnika'>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="pagination">
<!--        --><?php
//        $brojStranica = brojStranica();
//        for($i=0; $i< $brojStranica; $i++){
//            echo "<a class='proizvodiPaginacija' href='#'  data-id='$i' > " . ($i + 1) ."</a>";
//        }
//        ?>
    </div>
    <script src="assets/js/kupovina.js"></script>