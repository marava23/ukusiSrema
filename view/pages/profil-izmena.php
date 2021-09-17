<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include "models/korisnici/funkcije.php";
    try{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //var_dump($id);
            $gradovi = executeQuery("SELECT * from grad");
            //var_dump($gradovi);
            $korisnik = vratiKorisnika($id);
            //var_dump($korisnik);
            echo "
                            <form action='' id='Izmena' class='logovanje'>
                                Ime: <br/><input type='text' id='imeIzm' value=$korisnik->Ime /><br/>
                                <span id='imeErrIzm' class='error'></span><br/>
                                Prezime: <br/><input type='text' id='prezimeIzm' value=$korisnik->Prezime /><br/>
                                <span id='prezimeErrIzm' class='error'></span><br/>
                                Korisnicko ime: <br/><input type='text' id='usernameIzm' value=$korisnik->korisnickoIme /><br/>
                                <span id='usernameErrIzm' class='error'></span><br/>
                                Lozinka: <br/><input type='text' id='lozinkaIzm' value='Upiši novu lozinku' /><br/>
                                <span id='passwordErrIzm' class='error'></span><br/>
                                email: <br/><input type='email' id='emailIzm' value=$korisnik->email /><br/>
                                <span id='emailErrIzm' class='error'></span><br/>
                                Grad: <br/><select name='grad' id='grad'>";
            foreach ($gradovi as $grad){
                echo "
                                    <option value='$grad->id'> $grad->ImeGrada </option>";
            };
            echo"
                                    </select>
                                   <br/>
                                Adresa: <br/>
                                <input type='text' id='adresaIzm' value='$korisnik->adresa'/><br/>
                                <span id='adresaErrorIzm' class='error'></span><br/>
                                Broj telefona: <br/><input type='text' id='brTelIzm' value=$korisnik->telefon /><br/><br/>
                                <span id='brTelErrIzm' class='error'></span><br/>
                                <input type='button' id='izmPotvrdi' data-id=$id value='Izmeni podatke'  /><br/>  
                                <span id='izmenaPoruka'></span>
                            </form>";
        }
        else {
            header("Location: index.php");
        }
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}