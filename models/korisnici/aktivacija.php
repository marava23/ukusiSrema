<?php
    session_start();
    header("Content-type: application/json");
    if(isset($_SESSION['korisnik'])){
            include "../../config/connection.php";
            include "funkcije.php";
        try{
            $id = $_GET['id'];
            $korisnik = $_SESSION['korisnik'];
            $kod = $korisnik->kod;
            $mejl = $korisnik->email;
            if($kod == $id){
                $probaj = aktivirajKorisnika($mejl);
                if($probaj) {
                    echo "Uspešno ste aktivirali nalog!";
                }
                else {
                    header('Location:../../index.php');
                    echo "Niste uspeli";
                }
            }
            else {
                echo "Nije dobar kod!";
            }
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        echo "Morate biti ulogovani kako biste potvrdili mejl!";
    }
?>