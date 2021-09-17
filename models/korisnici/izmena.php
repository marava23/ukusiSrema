<?php
    header("Content-type: aplication/json");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            include "../../config/connection.php";
            include "funkcije.php";
            $id = $_POST['id'];
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $korisnickoIme = $_POST['korisnik'];
            $mejl = $_POST['mejl'];
            $telefon = $_POST['telefon'];
            $lozinka = $_POST['lozinka'];
            $adresa = $_POST['adresa'];
            $gradId = $_POST['gradId'];
        if($lozinka == "Upiši novu lozinku"){
            $izmenaKorisnika = izmeniBezSifre($id,$ime, $prezime, $korisnickoIme, $mejl, $telefon, $adresa, $gradId);
            if($izmenaKorisnika){
                $odgovor = ["poruka"=>"Uspešno ste izmenili podatke"];
                echo json_encode($odgovor);
            }
        }
            else{
            $sifrovanaLozinka = md5($lozinka);
            $izmenaKorisnika = izmeni($id,$ime, $prezime, $korisnickoIme, $mejl, $telefon,$sifrovanaLozinka, $adresa, $gradId);
            if($izmenaKorisnika){
            $odgovor = ["poruka"=>"Uspešno ste izmenili podatke"];
            echo json_encode($odgovor);
            }
        }
    }
    catch(PDOException $e){
        http_response_code(500);
        var_dump($e);
    }
}
else {
    http_response_code(404);
}