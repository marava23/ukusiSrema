<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        include "../../config/connection.php";
        include "funkcije.php";
        $statusId = $_GET['id'];
        $porudzbinaId = $_GET['idPorudzbine'];
        $obradi = obradiPorudzbinu($statusId, $porudzbinaId);
        if($obradi){
            header("Location: ../../index.php?page=porudzbine/prikaz&admin=admin");
        }
        else{
            echo "Desila se greska!";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo $e->getMessage();
    }
} else {
    http_response_code(404);
}