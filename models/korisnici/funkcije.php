<?php
function registruj($ime,$prezime,$korisnickoIme,$mejl,$telefon,$lozinka, $kod, $aktivan, $adresa, $grad){
    global $kon;
    $uloga = 1;
    $upit = "INSERT INTO korisnik (Ime, Prezime, korisnickoIme, email, lozinka, kod, telefon, idUloga, aktivan, adresa, idGrada ) VALUES (:ime, :prezime, :korisnickoIme, :email, :lozinka, :kod, :telefon, :idUloga, :aktivan, :adresa, :grad)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':prezime', $prezime);
    $priprema->bindParam(':korisnickoIme', $korisnickoIme);
    $priprema->bindParam(':email', $mejl);
    $priprema->bindParam(':lozinka',$lozinka);
    $priprema->bindParam(':kod', $kod);
    $priprema->bindParam(':telefon', $telefon);
    $priprema->bindParam(':idUloga', $uloga);
    $priprema->bindParam(':aktivan', $aktivan);
    $priprema->bindParam(':adresa', $adresa);
    $priprema->bindParam(':grad', $grad);
    $rezultat = $priprema->execute();
    if($rezultat){
        $poslednjiId = $kon->lastInsertId();
        $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.idUloga = u.idUloga WHERE idKorisnika=$poslednjiId";
        $priprema = $kon->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetch();
        return $rezultat;
    }
}
function izmeni($id,$ime,$prezime,$korisnickoIme,$mejl,$telefon,$lozinka, $adresa, $gradId){
    global $kon;
    $upit = "UPDATE korisnik SET Ime = :ime, Prezime = :prezime, korisnickoIme = :korisnickoIme, email = :email, lozinka = :lozinka, telefon = :telefon, adresa = :adresa, idGrada = :idGrada WHERE idKorisnika = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':prezime', $prezime);
    $priprema->bindParam(':korisnickoIme', $korisnickoIme);
    $priprema->bindParam(':email', $mejl);
    $priprema->bindParam(':lozinka',$lozinka);
    $priprema->bindParam(':telefon', $telefon);
    $priprema->bindParam(':adresa', $adresa);
    $priprema->bindParam(':idGrada', $gradId);
    $rezultat = $priprema->execute();
    return $rezultat;
}
function izmeniBezSifre($id,$ime,$prezime,$korisnickoIme,$mejl,$telefon, $adresa, $gradId){
    global $kon;
    $upit = "UPDATE korisnik SET Ime = :ime, Prezime = :prezime, korisnickoIme = :korisnickoIme,
                    email = :email, telefon = :telefon,	adresa = :adresa, idGrada = :idGrada WHERE idKorisnika = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':prezime', $prezime);
    $priprema->bindParam(':korisnickoIme', $korisnickoIme);
    $priprema->bindParam(':email', $mejl);
    $priprema->bindParam(':telefon', $telefon);
    $priprema->bindParam(':adresa', $adresa);
    $priprema->bindParam(':idGrada', $gradId);
    $rezultat = $priprema->execute();
    return $rezultat;
}
function proveraLogovanje($ime, $sifrovanaLozinka){
    global $kon;
    $upit = "SELECT email FROM korisnik WHERE korisnickoIme = :ime";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':ime', $ime);
    $priprema->execute();
    $email = $priprema->fetch();
    $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.idUloga = u.idUloga WHERE k.korisnickoIme = :ime AND k.lozinka = :lozinka";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':ime', $ime);
    $priprema->bindParam(':lozinka', $sifrovanaLozinka);
    $priprema->execute();
    try{
        $korisnik = $priprema->fetch();
        if(!$korisnik){
            require_once "../../config/connection.php";
            $file = fopen(NEUSPEH_LOG, "a");
            if($email->email){
                $korMejl = $email->email;
            }
            else{
                $korMejl = "Nije pronadjen mejl";
            }
            $date = date('d-m-Y H:i:s');
            fwrite($file, "$ime".SEPARATOR."$korMejl".SEPARATOR."$date\n");
            fclose($file);
        }
        return $korisnik;
    }
    catch (PDOException $e){
        $e->getMessage();
    }

}
function vratiKorisnike(){
    global $kon;
    $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.idUloga = u.idUloga JOIN grad g ON g.id = k.idGrada ORDER BY k.idKorisnika";
    return $kon->query($upit)->fetchAll();
}
function vratiKorisnika($id){
    global $kon;
    $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.idUloga = u.idUloga JOIN grad g ON g.id = k.idGrada WHERE idKorisnika = :id ";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return $priprema->fetch();
}
function aktivirajKorisnika($mejl){
    global $kon;
    $upit = "UPDATE korisnik SET aktivan=1 WHERE email  = :mejl";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':mejl', $mejl);
    $priprema->execute();
}
function aktivirajRucno($id){
    global $kon;
    $upit = "UPDATE korisnik SET aktivan=1 WHERE idKorisnika  = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}
function zakljucajNalog($email){
    global $kon;
    $upit = "UPDATE korisnik SET zakljucan=1 WHERE email = :email";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam('email', $email);
    $priprema->execute();
    return true;
}
function otkljucaj($id){
    global $kon;
    $upit = "UPDATE korisnik SET zakljucan=0 WHERE idKorisnika  = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}
function izbrisiKorisnika($id){
    global $kon;
    $upit = "DELETE FROM korisnik WHERE idKorisnika  = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}