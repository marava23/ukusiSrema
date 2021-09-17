<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        include "../../config/connection.php";
        include "funkcije.php";
        return $proizvodi = vratiProizvode();
    } catch (PDOException $e) {
        http_response_code(500);
        $e->getMessage();
    }
} else {
    http_response_code(404);
}