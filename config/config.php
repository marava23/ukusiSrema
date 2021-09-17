<?php


define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/ukusisremaphp");
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("NEUSPEH_LOG", ABSOLUTE_PATH. "/data/neuspeh.txt");
define("STATISTIKA", ABSOLUTE_PATH . "/data/statistika.txt");
define("USPEH_LOG", ABSOLUTE_PATH."/data/uspeh.txt");
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));
define("SEPARATOR", "\t");

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]);
        }
    }
    return $vrednost;
}
