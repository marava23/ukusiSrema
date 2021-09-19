<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try{
        require_once "../../config/connection.php";
        include "funkcije.php";
        $id = $_POST['id'];
        require_once "../../vendor/autoload.php";
                    $mail = new PHPMailer(true);
                    $mail->SMTPDebug = 3;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "";
                    $mail->Password = "";
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
                        
                    } catch (Exception $e) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        header('Location:../../index.php?page=profil');
                    }
                }
                catch(PDOException $e){
                    var_dump($e);
                }
            }
else {
    http_response_code(404);
}
