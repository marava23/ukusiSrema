<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header('content-type: aplication/json');
    try{
        include "../../config/connection.php";
        include "funkcije.php";
        $proizvodi = vratiProizvode();
        echo json_encode($proizvodi);
    }
    catch(PDOException $e){
        http_response_code(500);
        var_dump($e);
    }
}
else {
    http_response_code(404);
}