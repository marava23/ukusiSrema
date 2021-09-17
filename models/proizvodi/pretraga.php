<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header('content-type: aplication/json');
    try{
        include "../../config/connection.php";
        include "funkcije.php";
        $stiglo = trim($_GET['unos']);
        $unos = "%$stiglo%";
        if($unos == "%%"){
            $pretraga = vratiProizvode();
        }
        else{
            $pretraga = pretraziProizvod($unos);
        }
        echo json_encode($pretraga);
    }
    catch(PDOException $e){
        http_response_code(500);
        var_dump($e);
    }
}
else {
    http_response_code(404);
}