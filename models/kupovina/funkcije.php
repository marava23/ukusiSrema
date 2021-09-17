<?php

function dodajPorudzbinu($id,$ukCena){
    global $kon;
    $now = new DateTime();
    $vreme = $now->format('Y-m-d H:i:s');
    $upit = "INSERT INTO porudzbina (idKorisnik,vremeZahteva,ukupnaCena) VALUES (:id, :vreme,:uk)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(":id", $id);
    $priprema->bindParam(':vreme', $vreme);
    $priprema->bindParam('uk', $ukCena);
    $priprema->execute();
    return true;
}
function dodajDetaljePorudzbine($parametri, $vrednosti){
    global $kon;
    $priprema = $kon->prepare("INSERT INTO porudzbinadetalji VALUES " . implode(",", $parametri));
    $priprema->execute($vrednosti);
    return true;
}
function dodeliStatus($idPorudzbine){
//    idStatus	idPorudzbine	vremePromene	napomena	aktivan
    global $kon;
    $idStatus = 1;
    $now = new DateTime();
    $vreme = $now->format('Y-m-d H:i:s');
    $napomena = "";
    $aktivan = 1;
    $pripema = $kon->prepare("INSERT INTO obrada (idStatus, IdPorudzbine, vremePromene, aktivan) 
                                    VALUES (:idStatus, :idPorudzbina, :vreme, :aktivan)");
    $pripema->bindParam(":idStatus", $idStatus);
    $pripema->bindParam(":idPorudzbina", $idPorudzbine);
    $pripema->bindParam(":vreme", $vreme);
    $pripema->bindParam(":aktivan", $aktivan);
    $pripema->execute();
    return true;
}
function dohvatiSve(){
    global $kon;
    $priprema =$kon->prepare("SELECT * FROM porudzbina p
                                    JOIN obrada o ON p.idPorudzbina=o.idPorudzbine
                                    JOIN status s ON s.idStatus = o.idStatus
                                    JOIN korisnik k ON k.idKorisnika= p.idKorisnik
                                    JOIN grad g ON g.id = k.idGrada
                                    WHERE o.aktivan=1 AND o.idStatus=1");
    $priprema->execute();
    return $priprema->fetchAll();
}
function dohvatiSveZaKorisnika($idKorisnika){
    global $kon;
    $priprema =$kon->prepare("SELECT * FROM porudzbina p
                                    JOIN obrada o ON p.idPorudzbina=o.idPorudzbine
                                    JOIN status s ON s.idStatus = o.idStatus
                                    JOIN korisnik k ON k.idKorisnika= p.idKorisnik
                                    JOIN grad g ON g.id = k.idGrada
                                    WHERE k.idKorisnika = $idKorisnika AND o.aktivan=1
                                    ORDER BY p.vremeZahteva DESC");
    $priprema->execute();
    return $priprema->fetchAll();
}
function dohvatiObradjene(){
    global $kon;
    $priprema =$kon->prepare("SELECT * FROM porudzbina p
                                    JOIN obrada o ON p.idPorudzbina=o.idPorudzbine
                                    JOIN status s ON s.idStatus = o.idStatus
                                    JOIN korisnik k ON k.idKorisnika= p.idKorisnik
                                    JOIN grad g ON g.id = k.idGrada
                                    WHERE o.idStatus!=1");
    $priprema->execute();
    return $priprema->fetchAll();
}
function detaljiZaPorudzbinu($id){
    global $kon;
    $pripema = $kon->prepare("SELECT * FROM porudzbina p
                                    JOIN porudzbinadetalji pd ON pd.idPorudzbine=p.idPorudzbina
                                    JOIN proizvodi pr ON pr.id = pd.idProizvoda
                                    WHERE p.idPorudzbina = :id");
    $pripema->bindParam(':id', $id);
    $pripema->execute();
    return $pripema->fetchAll();
}
function obradiPorudzbinu($idStatus, $idPorudzbine){
    $now = new DateTime();
    $vreme = $now->format('Y-m-d H:i:s');
    $aktivan = 1;
    global $kon;
    $priprema = $kon->prepare("UPDATE obrada SET aktivan = 0 WHERE idPorudzbine = :id");
    $priprema->bindParam(':id', $idPorudzbine);
    $priprema->execute();
    $priprema = $kon->prepare("INSERT INTO obrada (idStatus,idPorudzbine,vremePromene,aktivan) VALUES (:idstatus,:idpor, :vreme, :aktivan)");
    $priprema->bindParam(':idstatus', $idStatus);
    $priprema->bindParam(':idpor', $idPorudzbine);
    $priprema->bindParam(':vreme',$vreme);
    $priprema->bindParam('aktivan', $aktivan);
    $priprema->execute();
    return true;
}
//                                      SELECT * FROM porudzbina p
//                                      JOIN obrada o ON p.idPorudzbina=o.idPorudzbine
//                                      JOIN status s ON s.idStatus = o.idStatus
//                                      JOIN porudzbinadetalji pd ON pd.idPorudzbine=p.idPorudzbina
//                                      JOIN proizvodi pr ON pr.id = pd.idProizvoda
//                                      JOIN korisnik k ON k.idKorisnika= p.idKorisnik
//                                      JOIN grad g ON g.id = k.idGrada
