<?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        try{
            include "funkcije.php";
            include "../../config/connection.php";
        $id = $_GET['id'];
        $aktiviraj = aktivirajRucno($id);
        if($aktiviraj) {
            header('Location:../../index.php?page=korisnici&admin=admin');
        }
        else{
            echo "usao je u gresku";
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