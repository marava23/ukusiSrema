<?php
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../../config/connection.php";
        include "funkcije.php";
    try{
        $limit = $_POST['limit'];
        $proizvodi = proizvodiPaginacija($limit);

        echo json_encode($proizvodi);
        http_response_code(200);


    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}
?>