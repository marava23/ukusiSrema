<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
header("Content-type: aplication/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try{
        require_once "../../config/connection.php";
        include "funkcije.php";
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnickoIme = $_POST['korisnik'];
        $mejl = $_POST['mejl'];
        $telefon = $_POST['telefon'];
        $lozinka = $_POST['lozinka'];
        $adresa = $_POST['adresa'];
        $gradId =$_POST['grad'];
        $imeReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})*$/";
        $korImeReg = "/^[A-zčćžšđ0-9]{3,50}$/";
        $lozinkaReg = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
        $emailReg = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";
        $regTelefon = "/^06\d{1}\d{6,7}$/";
        $regAdresa = "/^[A-zČĆŽŠĐčćžšđ]+(\s[A-zČĆŽŠĐčćžšđ]+)*\s\d{1,}$/";
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
        if(!isset($mejl) && !empty($mejl)){
            $brojGresaka++;
            $odgovor = ["poruka" => "Ne valja email!"];
        }
        if(!preg_match($regTelefon, $telefon)){
            $brojGresaka++;
        }
        if(!preg_match($regAdresa, $adresa)){
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
            $aktivan = 0;
            $registrujKorisnika = registruj($ime, $prezime, $korisnickoIme, $mejl, $telefon,$sifrovanaLozinka, $kod, $aktivan,$adresa, $gradId);
            if($registrujKorisnika){
                $_SESSION['korisnik'] = $registrujKorisnika;
                $odgovor = ["poruka" =>"Uspesno ste se registrovali!"];
                try{
                    require_once "../../vendor/autoload.php";
                    $mail = new PHPMailer(true);
                    $mail->SMTPDebug = 3;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "milos.maravic.269.19@ict.edu.rs";
                    $mail->Password = "uK7q5i7L";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;
                    $mail->From = "milos.maravic.269.19@ict.edu.rs";
                    $mail->FromName = "Milos Maravic";
                    $mail->addAddress("$mejl", "$ime");
                    $mail->isHTML(true);
                    $mailSubject = "Registracija na sajt Ukusi Srema";
                    $mail->Body = "<i>Da biste verifikovali Vaš nalog kliknite na sledeci <a href='http://ukusisrema.epizy.com/models/korisnici/aktivacija.php?id=$kod'>link </a></i>";
                    try {
                        $poslato = $mail->send();
                        $odgovor = ["poruka" => "Uspešno ste se registrovali! Poslat je mejl za aktivaciju!"];
                        echo json_encode($odgovor);
                        echo "Message has been sent successfully";
                    } catch (Exception $e) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    }
                }
                catch(PDOException $e){
                    var_dump($e);
                }
            }
            else {
                $odgovor = ["poruka" =>"Nismo uspeli da Vas registrujemo!"];
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