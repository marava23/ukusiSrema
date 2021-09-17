<?php

session_start();

header("Content-type: aplication/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_SESSION['korisnik'])){
        $korisnik = $_SESSION['korisnik'];
        if($korisnik->aktivan == 1){
            try {
                require_once "../../config/connection.php";
                include "funkcije.php";
                $korisnikId = $_POST['idKorisnika'];
                $ukupnaCena = $_POST['ukupnaCena'];
                $proizvodi = $_POST['proizvodi'];
                $kolicine = $_POST['kolicine'];
                $cene = $_POST['cene'];
                $kon->beginTransaction();
                $porudzbina = dodajPorudzbinu($korisnikId,$ukupnaCena);
                if($porudzbina){
                    $porudzbinaId = $kon->lastInsertId();
                    $queryParams = [];
                    $values = [];

                    for($i=0; $i<count($proizvodi); $i++){
//                        id	idPorudzbine	idProizvoda	kolicina	cena
                        $queryParams[] = "(NULL,?,?,?,?)";
                        $values[] = $porudzbinaId;
                        $values[] = $proizvodi[$i];
                        $values[] = $kolicine[$i];
                        $values[] = $cene[$i];
                    }

                    $detaljiPorudzbine = dodajDetaljePorudzbine($queryParams, $values);
                    if($detaljiPorudzbine){
                        $dodeliStatus = dodeliStatus($porudzbinaId);
                        if($dodeliStatus){
                            http_response_code(201);
                            $odgvor = ["poruka" => "Porudzbina je uspesno poslata!"];
                            echo json_encode($odgvor);
                        }
                    }
                }
                $kon->commit();

            } catch (PDOException $e) {
                $kon->rollBack();
                http_response_code(500);
                var_dump($e);
            }
        }
        else{
            $odgvor = ["poruka" => "Registracija"];
            echo json_encode($odgvor);
        }
    }
    else{
        $odgvor = ["poruka" => "Registracija"];
        echo json_encode($odgvor);
    }
}
else {
    http_response_code(404);
}