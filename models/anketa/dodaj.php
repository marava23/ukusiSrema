<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            include "../../config/connection.php";
            include "funkcije.php";
            $anketa = $_POST['anketa'];
            if($anketa != null){
                $dodajAnketu = dodajAnketu($anketa);
                if ($dodajAnketu){
                    header('Location:../../index.php?page=anketa&admin=admin');
                }
            }
            else {
                header('Location:../../index.php?page=anketa&admin=admin');
            }
        }
        catch(PDOException $e){
            var_dump($e);
        }
    }
    else {
        http_response_code(404);
    }