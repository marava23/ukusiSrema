<?php
    session_start();
    require_once "config/connection.php";
?>
<!DOCTYPE html>
<html lang="sr-Latn-RS">
<head>
        <?php
        include "view/fixed/head.php";
        ?>
</head>
    <body>
        <div id="wraper">
            <?php
                if(isset($_GET['admin']) && $_GET['admin']=='admin'){
                    include "view/admin/adminHeader.php";
                }
                else{
                    include "view/fixed/header.php";
                }
                if(isset($_GET['page']) && @$_GET['admin']=='admin'){
                    switch ($_GET['page']){
                        case "admin":
                            include "view/admin/statistika/prikaz.php";
                            break;
                        case "anketa":
                            include "view/admin/anketa/prikaz.php";
                            break;
                        case "anketa/dodaj":
                            include "view/admin/anketa/dodaj.php";
                            break;
                        case "anketa/arhiva":
                            include "view/admin/anketa/arhiva.php";
                            break;
                        case "admin/proizvodi":
                            include "view/admin/proizvodi/prikaz.php";
                            break;
                        case "poruke":
                            include "view/admin/poruke/prikaz.php";
                            break;
                        case "poruke/arhiva":
                            include "view/admin/poruke/arhiva.php";
                            break;
                        case "proizvodi/dodaj":
                            include "view/admin/proizvodi/dodaj.php";
                            break;
                        case "proizvodi/izmeni":
                            include "view/admin/proizvodi/izmeni.php";
                            break;
                        case "korisnici":
                            include "view/admin/korisnici/prikaz.php";
                            break;
                        case "korisnici/dodaj":
                            include "view/admin/korisnici/dodaj.php";
                            break;
                        case "korisnici/izmeni":
                            include "view/admin/korisnici/izmeni.php";
                            break;
                        case "statistika/prikaz":
                            include "view/admin/statistika/prikaz.php";
                            break;
                        case "statistika/danas":
                            include "view/admin/statistika/prikaz-danas.php";
                            break;
                        case "logovanje/danas":
                            include "view/admin/statistika/logovanje-danas.php";
                            break;
                        case "porudzbine/prikaz":
                            include "view/admin/porudzbine/prikaz.php";
                            break;
                        case "porudzbine/arhiva":
                            include "view/admin/porudzbine/arhiva.php";
                            break;
                        default:
                            include "view/pages/pocetna.php";
                            break;
                    }
                }
                else if(!isset($_GET['page'])){
                    include "view/pages/pocetna.php";
                }
                else{
                    switch ($_GET['page']){
                        case "pocetna" :
                            include "view/pages/pocetna.php";
                            break;
                        case "proizvodi":
                            include "view/pages/proizvodi.php";
                            break;
                        case "kontakt":
                            include "view/pages/kontakt.php";
                            break;
                        case "proizvod":
                            include  "view/pages/proizvod.php";
                            break;
                        case "registracija":
                            include  "view/pages/registracija.php";
                            break;
                        case "autor":
                            include "view/pages/autor.php";
                            break;
                        case "profil":
                            include "view/pages/profil.php";
                            break;
                        case "profil/izmena":
                            include "view/pages/profil-izmena.php";
                            break;
                        default:
                            include "view/pages/pocetna.php";
                            break;
                    }
                }
            ?>
        </div>
        <?php
            include "view/fixed/footer.php";
        ?>
    </body>
</html>