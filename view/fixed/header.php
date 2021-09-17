<header>
    <div class="header-width">
        <div id="logo">
            <figure>
                <a href="index.php"><img src="assets/img/ukusisremalogo.jpg" alt="'ukusi srema' company logo"></a>
            </figure>
            <div class="nav-button">
                <i class="fa fa-bars"></i>
            </div>
        </div>
        <nav id="meni">
            <ul>
                <?php
                if ($_SESSION){
                $korisnik = $_SESSION['korisnik'] ;
                if($korisnik->nazivUloge == "admin"){
                        echo "<li class='meni'><a href='index.php?page=admin&admin=admin'>Admin panel</a></li>";
                }}
                if(isset($_GET['page']) && $_GET['page'] == "pocetna" || !isset($_GET['page'])){
                    echo "<li class='meni' ><a class='active' href='index.php?page=pocetna'>Početna</a></li>";
                }
                else {
                    echo "<li class='meni'><a href='index.php?page=pocetna'>Početna</a></li>";
                }
                if(isset($_GET['page']) &&  $_GET['page'] == "proizvodi"){
                echo "<li class='meni'><a class='active' href='index.php?page=proizvodi'>Proizvodi</a></li>";
                }
                else {
                echo "<li class='meni'><a href='index.php?page=proizvodi'>Proizvodi</a></li>";
                }
                if(isset($_GET['page']) && $_GET['page'] == "kontakt"){
                    echo "<li class='meni'><a class='active' href='index.php?page=kontakt'>Kontakt</a></li>";
                }
                else {
                    echo "<li class='meni'><a href='index.php?page=kontakt'>Kontakt</a></li>";
                }
                if ($_SESSION){
                    $korisnik = $_SESSION['korisnik'] ;
                    echo "
                <li class='dropdown meni'><a href='#'><i class='fas fa-user'></i></a>
                    <ul class='dropdown-content'>
                        <li><a href='index.php?page=profil&id=$korisnik->idKorisnika'>Profil</a></li>
                        <li><a href='models/korisnici/logout.php'>Izlogujte se</a></li>
                    </ul>
                </li>";
                }
                else {
                    echo '<li class="meni" id="logbutton"><a href="#"><i class="fas fa-user"></i></a></li>';
                }
                ?>
            </ul>
        </nav>
        <div class="forma">
            <form action="" id="log" class="logovanje">
                <i class="fas fa-window-close zatvori"></i><br/>
                Korisnicko ime: <br/><input type="text" id="logUsername"/><br/>
                <span id="usernameLogErr" class="error"></span><br/>
                Lozinka: <br/><input type="password" id="logPassword"/><br/>
                <span id="passwordLogErr" class="error"></span><br/>
                <input type="button" id="logPotvrdi" value="Ulogujte se"/><br/>
                <span id="passwordOdgovor" class="error"></span><br/>
                <p class="reg">Nemate nalog? <a id="registracija" href="index.php?page=registracija"> Registrujte se</a></p><br/>
                <span id="logovanjeOdg" class="error"></span>
            </form>
        </div>
    </div>
</header>