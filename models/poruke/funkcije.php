<?php
function posaljiPoruku($ime, $prezime, $mejl, $poruka){
    global $kon;
    $procitano = 0;
    $upit = "INSERT INTO poruka (ime, prezime, email, poruka, procitano) VALUES (:ime, :prezime, :email, :poruka, :procitano)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':prezime', $prezime);
    $priprema->bindParam(':email', $mejl);
    $priprema->bindParam(':poruka', $poruka);
    $priprema->bindParam(':procitano', $procitano);
    $priprema->execute();
    return true;
}
function procitaj($id){
    global $kon;
    $upit = "UPDATE poruka SET procitano=1 WHERE porukaId  = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}