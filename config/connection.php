<?php

require_once "config.php";


try {
    $kon = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $kon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $kon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
function executeQuery($query){
    global $kon;
    return $kon->query($query)->fetchAll();
}
function executeQueryOneRow($query){
    global $kon;
    return $kon->query($query)->fetch();
}
function vratiSve($nazivTabele){
    global $kon;
    $upit = "SELECT * FROM $nazivTabele";
    return $kon->query($upit)->fetchAll();
}
if( $_SERVER['REQUEST_URI'] != "/ukusisremaphp/index.php"){
    zabeleziPristupStranici();
}
function zabeleziPristupStranici(){
    $open = fopen(LOG_FAJL, "a");
    if($open){
        $adresa = $_SERVER['REQUEST_URI'];
        if(isset($_SESSION['korisnik']->korisnickoIme)){
            $korisnik = $_SESSION['korisnik']->korisnickoIme;
        }
        else{
            $korisnik = "Neautorizovani korisnik";
        }
        $date = date('d-m-Y H:i:s');
        fwrite($open, "{$adresa}". SEPARATOR ." {$date}" . SEPARATOR . "{$_SERVER['REMOTE_ADDR']}" . SEPARATOR .
            "{$korisnik}".SEPARATOR. "\n");
        fclose($open);
    }
}
