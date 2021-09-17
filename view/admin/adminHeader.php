<header>
    <?php
    if(isset($_SESSION)){
        $korisnik = $_SESSION['korisnik'];
        if($korisnik->nazivUloge != 'admin'){
            header('Location: index.php');
        }
    }
    ?>
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
                <li class="dropdown meni"><a href='index.php?page=statistika/prikaz&admin=admin'>Statistika</a>
                    <ul class="dropdown-content">
                        <li><a href='index.php?page=statistika/prikaz&admin=admin'>Oduvek</a></li>
                        <li><a href='index.php?page=statistika/danas&admin=admin'>Danas</a></li>
                        <li><a href='index.php?page=logovanje/danas&admin=admin'>Logovanje</a></li>
                    </ul>
                </li>
                <li class="meni"><a href='index.php?page=porudzbine/prikaz&admin=admin'>Porudzbine</a></li>
                <li class="meni"><a href='index.php?page=korisnici&admin=admin'>Korisnici</a></li>
                <li class="meni"><a href='index.php?page=admin/proizvodi&admin=admin'>Proizvodi</a></li>
                <li class="meni"><a href='index.php?page=poruke&admin=admin'>Poruke</a></li>
                <li class="meni"><a href='index.php?page=anketa&admin=admin'>Anketa</a></li>
                <li class="meni" id="logOut"><a href="models/korisnici/logout.php">Izlogujte se</a></li>
            </ul>
        </nav>
    </div>
</header>