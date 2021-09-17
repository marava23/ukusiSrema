<?php
    header("Content-type: aplication/json");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            include "../../config/connection.php";
            include "funkcije.php";
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $mejl = $_POST['email'];
            $poruka = $_POST['poruka'];
            $imeReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})*$/";
            $brojGresaka = 0;
        if(!preg_match($imeReg, $ime)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja ime!"];
        }
        if(!preg_match($imeReg,  $prezime)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja prezime"];
        }
        if(!isset($mejl) && !empty($mejl)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja email!"];
        }
        if(!isset($poruka) && !empty($poruka)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja poruka!"];
        }
        if($brojGresaka != 0){
            $statusniKod = 422;
            $odgovor = ["poruka" => "Greska prilikom obrade podataka."];
        }
        else{
            $posalji = posaljiPoruku($ime, $prezime, $mejl, $poruka);
            if($posalji){
                $odgovor = ["poruka" =>" Poruka je poslata administratoru!"];
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