<?php
function podaciAnkete(){
    global $kon;
    $upit ="SELECT * FROM anketa";
    $priprema = $kon->prepare($upit);
    $priprema->execute();
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}
function dodajOdgovor($odogovr, $anketaId, $korisnikId){
    global $kon;
    $upit ="INSERT INTO anketaodgovori (odgovor, anektaId, korisnikId) VALUES (:odgovor, :anketaId, :korisnikId)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':korisnikId', $korisnikId);
    $priprema->bindParam(':odgovor', $odogovr);
    $priprema->bindParam(':anketaId', $anketaId);
    $priprema->execute();
    return true;
}
function podaciJedneAnkete($id){
    global $kon;
    $upit ="SELECT * FROM anketa a JOIN anketaodgovori ao ON a.anketaId = ao.anektaId  JOIN korisnik k ON k.idKorisnika = ao.korisnikId WHERE ao.anektaId = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    $rezultat = $priprema->fetchAll();
    return $rezultat;
}
function zaustaviAnketu($id){
    global $kon;
    $upit = "UPDATE anketa SET aktivna=0 WHERE anketaId = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}
function dodajAnketu($anketa){
    global $kon;
    $aktivan = 1;
    $upit = "INSERT INTO anketa (pitanje, aktivna) VALUES (:pitanje, :aktivan)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':pitanje', $anketa);
    $priprema->bindParam(':aktivan', $aktivan);
    $priprema->execute();
    return true;
}