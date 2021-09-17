<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
        include "models/proizvodi/funkcije.php";
        try {
            $id = $_GET['id'];
            $proizvod = vratiProizvod($id);
            //var_dump($proizvod);
            echo "
        <div class='forma'>
            <form action='models/proizvodi/izmeniProizvod.php' method='post' enctype='multipart/form-data' class='logovanje'>
                Naziv proizvoda: <br/><input type='text' name='ime' value=$proizvod->NazivProizvoda /><br/>
                <span id='proizvodGreska' class='error'></span><br/>
                Opis Proizvoda: <br/><textarea name='opisProizvoda'> $proizvod->OpisProizvoda</textarea><<br/>
                <span id='opisGreska' class='error'></span><br/>";
                ?>
                Cena proizvoda: <br/>
                <input type="number" name="cenaProizvoda" value="<?=$proizvod->Iznos?>"/><br/><br/>
                <input type="hidden" name="id" value="<?=$proizvod->id?>"/>
                <input type="hidden" name="stariIdSlike" value="<?=$proizvod->idSlike?>"/>
                Trenutna slika:<br/> <img src="assets/img/<?=$proizvod->malaputanja?>" alt="$proizvod->NazivProizvoda"/> <br/>
                Kreiraj novu sliku: <br/>Ime slike: <input type="text" name="imeSlike" id="manjaSirina"/><br/>
                Ubaci sliku: <input type="file" name="slikafajl"/><br/>
                <?php
            echo "
                <span id='passwordErrIzm' class='error'></span><br/>
                <input type='submit' id='izmeniProizvod' data-id=$id value='Izmeni podatke'  /><br/>
            </form>
        </div>";
        } catch (PDOException $exception) {
            http_response_code(500);
        }
    }
else{
    http_response_code(404);
}