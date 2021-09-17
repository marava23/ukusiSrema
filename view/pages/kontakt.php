<section id="kontakt">
    <div class="kontakt-border">
        <div class="kontakt-levo">
            <h2>Ostavite poruku!</h2>
            <?php
            if($_SESSION){
                $korisnik = $_SESSION['korisnik'];
                echo " <div class='forma'>
                            <form method='GET' action='obrada.php'>
                                <label for='ime'>Ime:</label><br/>
                                <input type='text' id='kontaktIme' name='ime' value='$korisnik->Ime' /><br/>
                                <span id='imegreska' class='error'></span><br/>
                                <label for='prezime'>Prezime:</label><br/>
                                <input type='text' id='kontaktPrezime' name='prezime' value='$korisnik->Prezime' /><br/>
                                <span id='prezimegreska' class='error'></span><br/>
                                <label for='mail'>email:</label><br/>
                                <input type='email' id='kontaktMail' name='mail' value='$korisnik->email' /><br/>
                                <span id'mejlgreskaPor' class='error'></span><br/>
                                <label for='poruka'>Vaša poruka:</label><br/>
                                <textarea id='poruka' name='poruka' placeholder='Vaša poruka...'></textarea><br/>
                                <span id='porukagreska' class='error'></span><br/>
                                <input type='button' name='potvrdi' id='porukaPotvrdi' value='Pošalji'/><br/>
                                <span id='porukaOdogovor'></span>
                                </form>
                                </div>
                                </div>";


            }
            else {
                echo " <div class='forma'>
                            <form method='GET' action='obrada.php'>
                                <label for='ime'>Ime:</label><br/>
                                <input type='text' id='kontaktIme' name='ime' placeholder='Vaše ime...' /><br/>
                                <span id='imegreska' class='error'></span><br/>
                                <label for='prezime'>Prezime:</label><br/>
                                <input type='text' id='kontaktPrezime' name='prezime' placeholder='Vaše prezime...' /><br/>
                                <span id='prezimegreska' class='error'></span><br/>
                                <label for='mail'>email:</label><br/>
                                <input type='email' id='kontaktMail' name='mail' placeholder='Vaš mejl...' /><br/>
                                <span id='mejlgreskaPor' class='error'></span><br/>
                                <label for='poruka'>Vaša poruka:</label><br/>
                                <textarea id='poruka' name='poruka' placeholder='Vaša poruka...'></textarea><br/>
                                <span id='porukagreska' class='error'></span><br/>
                                <input type='button' name='potvrdi' id='porukaPotvrdi' value='Pošalji'/><br/>
                                <span id='porukaOdogovor'></span>
                            </form>
                        </div>
                    </div>";
            }
            ?>
            <?php
            if($_SESSION){
                $korisnik = $_SESSION['korisnik'];
                //var_dump($korisnik);
                $anketa = vratiSve('anketa');
                //var_dump($anketa);
                foreach($anketa as $a){
                    if($a->aktivna == 1){
                        echo " <br/> <br/>
                                <div class='anketa'>
                                    <p> $a->pitanje</p><br/>
                                    <form class='forma'>
                                        <input type='radio' id='yes' name='odgovor' value='Da'>
                                        <label for='male'>Da</label>
                                        <input type='radio' id='no' name='odgovor' value='Ne'>
                                        <label for='female'>Ne</label><br/>
                                        <span><input type='button' class='anketaOdgovor' value='Odgovori' data-id=$korisnik->idKorisnika data-anketa=$a->anketaId /></span>
                                        <br/>
                                    </form>
                                </div>";
                    }
                }
                echo "<span id='anketaUspeh' class='error'></span>";
            }

            ?>
        </div>
    </div>
</section>