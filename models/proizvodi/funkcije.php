<?php
function vratiProizvode(){
    global $kon;
    $upit = "SELECT * FROM proizvodi p JOIN slike s ON p.idSlike = s.idSlike JOIN cena c ON c.idProizvod = p.id WHERE p.softDelete=0 AND c.aktivan=1";
    return $kon->query($upit)->fetchAll();
}
function vratiProizvod($id){
    global $kon;
    $upit = "SELECT * FROM proizvodi p JOIN slike s ON p.idSlike = s.idSlike JOIN cena c ON c.idProizvod = p.id WHERE p.id = :id AND c.aktivan=1";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(":id", $id, PDO::PARAM_INT);
    $priprema->execute();
    $rezultat = $priprema->fetch();
    return $rezultat;
}
function proizvodiSoftDel($id){
    global $kon;
    $upit = "UPDATE proizvodi SET softDelete = 1 WHERE id = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}
function izmeniProizvod($idProizvoda, $idSlike , $imeProizvoda, $opisProizvoda){
    global $kon;
    $upit = "UPDATE proizvodi SET NazivProizvoda = :imeProizvoda, OpisProizvoda = :opisProizvoda, idSlike = :idSlike WHERE id = :id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':imeProizvoda', $imeProizvoda);
    $priprema->bindParam(':opisProizvoda', $opisProizvoda);
    $priprema->bindParam(':idSlike', $idSlike);
    $priprema->bindParam(':id', $idProizvoda);
    $priprema->execute();
    return true;
}
function ubaciSliku($velikaPutanja, $malaPutanja, $alt){
    global $kon;
    $upit = "INSERT INTO `slike` (`velikaputanja`, `malaputanja`, `alt`) VALUES (:velikaPutanja, :malaPutanja, :alt)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':velikaPutanja', $velikaPutanja);
    $priprema->bindParam(':malaPutanja', $malaPutanja);
    $priprema->bindParam(':alt', $alt);
    $priprema->execute();
    return true;
}
function ubaciProizvod($naziv, $opis, $idSlike){
    global $kon;
    $softDelete = 0;
    $upit = "INSERT INTO proizvodi (NazivProizvoda,OpisProizvoda, idSlike, softDelete ) VALUES (:naziv, :opis, :id, :del)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':naziv', $naziv);
    $priprema->bindParam(':opis', $opis);
    $priprema->bindParam(':id', $idSlike);
    $priprema->bindParam(':del', $softDelete);
    $priprema->execute();
    return true;
}
function ubaciCenu($iznos, $id){
    global $kon;
    $aktivan = 1;
    $upit = "INSERT INTO cena (	Iznos,aktivan, idProizvod) VALUES (:iznos,:aktivan, :idProizvod)";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':iznos', $iznos);
    $priprema->bindParam(':idProizvod', $id);
    $priprema->bindParam(':aktivan', $aktivan);
    $priprema->execute();
    return true;
}
function obrisiCenu($id){
    global $kon;
    $upit = "UPDATE cena SET aktivan=0 WHERE idCena=:id";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':id', $id);
    $priprema->execute();
    return true;
}
function pretraziProizvod($unos){
    global $kon;
    $upit = "SELECT * FROM proizvodi p JOIN slike s ON p.idSlike = s.idSlike JOIN cena c ON c.idProizvod = p.id WHERE p.NazivProizvoda LIKE :unos";
    $priprema = $kon->prepare($upit);
    $priprema->bindParam(':unos', $unos);
    $priprema->execute();
    return $priprema->fetchAll();
}
define("PROIZVOD_OFFSET", 3);
function proizvodiPaginacija($limit = 0){
    global $kon;
    $upit = "SELECT * FROM proizvodi p JOIN slike s ON p.idSlike = s.idSlike JOIN cena c ON c.idProizvod = p.id ORDER BY NazivProizvoda LIMIT :limit, :offset";
    $priprema = $kon->prepare($upit);
    $limit = ((int) $limit) * PROIZVOD_OFFSET;
    $priprema->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = PROIZVOD_OFFSET;
    $priprema->bindParam(":offset", $offset, PDO::PARAM_INT);
    $priprema->execute();
    $proizvodi = $priprema->fetchAll();
    return $proizvodi;
}
function brojProizvoda(){
    global $kon;
    $upit= "SELECT COUNT(*) AS broj FROM proizvodi";
    return $kon->query($upit)->fetch();
}
function brojStranica(){
    $brojProizvoda = brojProizvoda();
    $brojStranica = ceil($brojProizvoda->broj / PROIZVOD_OFFSET);
    return $brojStranica;
}