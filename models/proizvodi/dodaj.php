<?php
if (isset($_POST['dodavanjePorizvoda'])) {
    try{
        include "../../config/connection.php";
        include "funkcije.php";
        $greske = 0;
        $greskeSlika = [];
        $fileName = $_FILES['slikafajl']['name'];
        $tmpName = $_FILES['slikafajl']['tmp_name'];
        $fileSize = $_FILES['slikafajl']['size'];
        $fileType = $_FILES['slikafajl']['type'];
        $fileError = $_FILES['slikafajl']['error'];
        switch ($fileType){
            case "image/jpg":
                $fileName = $_POST['imeSlike'].'.jpg';
                break;
            case "image/jpeg":
                $fileName = $_POST['imeSlike'].'.jpeg';
                break;
            case "image/png":
                $fileName = $_POST['imeSlike'].'.png';
        }
        $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];
        if(!in_array($fileType, $dozvoljeni_tipovi)){
            array_push($greskeSlika, "Pogresan tip fajla.");
        }
        if($fileSize > 3000000){
            array_push($greskeSlika, "Maksimalna velicina fajla je 3MB.");
        }
        $novaPutanja = '../../assets/images/original-'.time().$fileName;
        if(count($greskeSlika) == 0){
            $dodataSlikaFizicki = move_uploaded_file($tmpName, $novaPutanja);
        }
        else{
            var_dump($greskeSlika);
            var_dump($novaPutanja);
        }
        $dimenzije = getimagesize($novaPutanja);
        $sirina = $dimenzije[0];
        $visina = $dimenzije[1];
        $novaSirina = 300;
        $novaVisina = $visina / ($sirina / $novaSirina);
        $ekstezija = pathinfo($novaPutanja, PATHINFO_EXTENSION);
        if($ekstezija == "png"){
            $malaPutanja = "mala-".time().".png";
            $uploadedSlika = imagecreatefrompng($novaPutanja);
            $platno = imagecreatetruecolor($novaSirina, $novaVisina);
            imagecopyresampled($platno, $uploadedSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
            imagepng($platno, "../../assets/img/".$malaPutanja);
        }
        else{
            $malaPutanja = "mala-".time().".jpg";
            $uploadedSlika = imagecreatefromjpeg($novaPutanja);
            $platno = imagecreatetruecolor($novaSirina, $novaVisina);
            imagecopyresampled($platno, $uploadedSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
            imagejpeg($platno, "../../assets/img/".$malaPutanja);
        }

        $imePorizovda = $_POST['imeProizvoda'];
        $opisProizvoda = $_POST['opis'];
        $cena = $_POST['cena'];
        if(!isset($cena) || empty($cena)){
            $greske++;
        }
        if(!isset($opisProizvoda) || empty($opisProizvoda)){
            $greske++;
        }
        if(!isset($imePorizovda) || empty($imePorizovda)){
            $greske++;
        }
        if(!$dodataSlikaFizicki){
            $greske++;
        }
        if($greske == 0){
            $kon->beginTransaction();
            $ubaciSliku = ubaciSliku(substr($novaPutanja,20), $malaPutanja, $imePorizovda);
            if($ubaciSliku){
                $idSlike = $kon->lastInsertId();
                $dodajProizvod = ubaciProizvod($imePorizovda, $opisProizvoda, $idSlike);
                if($dodajProizvod){
                    $idProizvoda = $kon->lastInsertId();
                    $ubaciCenu = ubaciCenu($cena, $idProizvoda);
                    if($ubaciCenu){
                        $kon->commit();
                        $odgovor = ["poruka" => "Upešno ste dodali proizvod!"];
                        header('Location:../../index.php?page=admin/proizvodi&admin=admin');
                    }
                }
            }
        }
        else{
            var_dump($greske);
            //header('Location:../../index.php?page=admin/proizvodi&admin=admin');
        }
    }
    catch(PDOException $e){
        $kon->rollback();
        echo json_encode(['poruka'=> $e->getMessage()]);
        http_response_code(500);
    }
}
else {
    http_response_code(404);
}