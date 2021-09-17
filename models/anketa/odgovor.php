<?php
    header("Content-type: aplication/json");
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            include "../../config/connection.php";
            include "funkcije.php";
            $greske = 0;
            $idKorisnika = $_POST['id'];
            $odgovor = $_POST['odgovor'];
            $anketaId = $_POST['anketaId'];
            $provera = podaciJedneAnkete($anketaId);
        foreach($provera as $p){
            if($p->idKorisnika == $idKorisnika){
                $greske++;
            }
        }
        if($greske == 0){
        $dodajOdgovor = dodajOdgovor($odgovor, $anketaId, $idKorisnika);
        }
        else {
            $dodajOdgovor = false;
            $odgovor = ["poruka"=>"Već ste učestvovali u ovoj anketi!"];
            json_encode($odgovor);
        }
        if($dodajOdgovor){
            $odgovor = ["poruka"=>"Uspešno ste odgovorili!"];
            json_encode($odgovor);
        }
        else{
            $odgovor = ["poruka"=>"Već ste učestvovali u ovoj anketi!"];
            json_encode($odgovor);
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