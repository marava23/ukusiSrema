<?php
session_start();
header("Content-type: aplication/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try{
        include "../../config/connection.php";
        include "funkcije.php";
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnickoIme = $_POST['korisnik'];
        $mejl = $_POST['mejl'];
        $telefon = $_POST['telefon'];
        $lozinka = $_POST['lozinka'];
        $imeReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})*$/";
        $korImeReg = "/^[A-zčćžšđ0-9]{3,50}$/";
        $lozinkaReg = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
        $emailReg= "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        $regTelefon="/^06\d{1}\d{6,7}$/";
        $brojGresaka = 0;
        if(!preg_match($imeReg, $ime)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja ime!"];
        }
        if(!preg_match($imeReg,  $prezime)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja prezime"];
        }
        if(!preg_match($korImeReg, $korisnickoIme)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja korisnicko"];
        }
        if(!preg_match($lozinkaReg , $lozinka)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja lozinka"];
        }
        if(!preg_match($emailReg, $mejl)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja email!"];
        }
        if(!preg_match($regTelefon, $telefon)){
            $brojGresaka++;
        }
        if($brojGresaka != 0){
            $statusniKod = 422;
            $odgovor = ["poruka" => "Greska prilikom obrade podataka."];
        }
        else {
            $upit = true;
            $statusniKod = 201;
            $sifrovanaLozinka = md5($lozinka);
            $kod=md5(time().md5($mejl));
            $aktivan = 1;
            $registrujKorisnika = registruj($ime, $prezime, $korisnickoIme, $mejl, $telefon,$sifrovanaLozinka,$kod, $aktivan);
            if($registrujKorisnika){
                $odgovor = ["poruka" =>"Uspesno ste dodali korisnika!"];
                http_response_code(200);
            }
            else {
                $odgovor = ["poruka" =>"Nismo uspeli da Vas registrujemo!"];
            }
        }

        echo json_encode($odgovor);
        http_response_code($statusniKod);
    }
    catch(PDOException $e){
        http_response_code(500);
        var_dump($e);
    }
}
else {
    http_response_code(404);
}