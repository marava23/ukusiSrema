<?php
//require_once "../../config/connection.php";
function proveriVreme($datum){
    $vreme1 = mktime(0,0,0,1,1,2021);
    $vreme2 = mktime(0,0,0,1,2,2021);
    $jedanDan = $vreme2 - $vreme1;
    $datum = strtotime($datum);
    $sad = new DateTime();
    $sad = $sad->getTimestamp();
    if(($sad - $datum) < $jedanDan){
        return true;
    }
    else{
        return false;
    }

}
function danasnjiPodaci($nazivFajla){
    $file = fopen($nazivFajla, "r");
    $podaci = file($nazivFajla);
    fclose($file);
    $podaciDanas = [];
    foreach ($podaci as $red){
        @list($stranica, $vreme) = explode(SEPARATOR,$red);
        if(proveriVreme($vreme)){
            array_push($podaciDanas, $red);
        }
    }
    return $podaciDanas;
}
function brojPodatakaDanas($nazivFajla){
    $file = fopen($nazivFajla, "r");
    $podaci = file($nazivFajla);
    fclose($file);
    $brojac = 0;
    foreach ($podaci as $red){
        list($strana, $vreme, $ip, $korisnik) = explode(SEPARATOR,$red);
        if(proveriVreme($vreme) && (strpos($strana, "admin") == false) && (strpos($strana, "models") == false)){
            $brojac++;
        }
    }
    return $brojac;
}
function brojPodataka($nazivFajla){
    $file = fopen($nazivFajla, "r");
    $podaci = file($nazivFajla);
    fclose($file);
    $brojac = 0;
    foreach ($podaci as $red){
        list($strana) = explode(SEPARATOR, $red);
        if((strpos($strana, "admin") == false) && (strpos($strana, "models") == false)){
            $brojac++;
        }
    }
    return $brojac;
}
function popuniStatistiku($vreme){
    if($vreme == "danas"){
        $log = danasnjiPodaci(LOG_FAJL);
    }
    else{
        $file = fopen(LOG_FAJL, "r");
        $log = file(LOG_FAJL);
        fclose($file);
    }
    $stranice = [];
    foreach ($log as $l){
        list($strana) = explode(SEPARATOR, $l);
        if((!in_array($strana, $stranice)) && (strpos($strana, "admin") == false) && (strpos($strana, "models") == false)){
            array_push($stranice, $strana);
        }
    }
    $file = fopen(STATISTIKA, 'w');
    foreach ($stranice as $strana){
        fwrite($file, "$strana".SEPARATOR."0".SEPARATOR."\n");
    }
    fclose($file);
    $file = fopen(STATISTIKA, "r");
    $statistika = file(STATISTIKA);
    fclose($file);
    //var_dump($statistika);
    $noviPodaci = "";
    foreach ($statistika as $s){
        list($adresa, $broj) = explode(SEPARATOR, $s);
        foreach ($log as $l){
            list($adresaLog) = explode(SEPARATOR, $l);
            if($adresaLog == $adresa){
                ++$broj;
                $noviPodatak = "{$adresa}".SEPARATOR."{$broj}"."\n";
            }
        }
        @$noviPodaci .= $noviPodatak;
    }
    //var_dump($noviPodaci);
    $file = fopen(STATISTIKA, "w");
    fwrite($file, $noviPodaci);
    fclose($file);
}
