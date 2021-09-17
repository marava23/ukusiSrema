<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../config/connection.php";
        include "funkcije.php";
        $brojGresaka = 0;
        try{
            $ime = $_POST['korisnickoIme'];
            $lozinka = $_POST['lozinka'];
            if(!isset($ime) || empty($ime)){
                $brojGresaka++;
                $odgovor = ["poruka" => "Nije dobro korisnicko ime!"];
            }
            if(!isset($lozinka) || empty($lozinka)){
                $brojGresaka++;
                $odgovor = ["poruka" => "Nije dobro korisnicko ime!"];
            }
            $sifrovanaLozinka = md5($lozinka);
            $korisnik = proveraLogovanje($ime, $sifrovanaLozinka);
            //var_dump($korisnik);
            if($korisnik){
                $_SESSION['korisnik'] = $korisnik;
                $date = date('d-m-Y H:i:s');
                $file = fopen(USPEH_LOG, "a");
                fwrite($file, "{$korisnik->korisnickoIme}".SEPARATOR."{$date}\n");
                fclose($file);
                $odgovor = ["poruka"=>"Uspešno ste se ulogovali!"];
                echo json_encode($odgovor);
                http_response_code(200);
            }
            else {
                $odgovor = ["poruka" => "Nije pronadjen korisnik!"];
                echo json_encode($odgovor);
            }
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>