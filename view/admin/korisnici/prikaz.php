<?php
    include "models/korisnici/funkcije.php";
    $korisnici = vratiKorisnike();
    //var_dump($korisnici);
    if(count($korisnici) != 0){
?>
        <div style="overflow-x:auto;">
            <table class="table">
                <tr>
                    <th>RB</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Korisnicko ime </th>
                    <th>Email</th>
                    <th>Uloga</th>
                    <th>Telefon</th>
                    <th>Datum registracije</th>
                    <th>Grad</th>
                    <th>Adresa</th>
                    <th>Aktivan </th>
                    <th>Aktiviraj ručno </th>
                    <th>Zaključan</th>
                    <th><a href='index.php?page=korisnici/dodaj&admin=admin'><input type="button" class="dugme" value="Dodaj korisnika"/></a></th>
                    <th></th>
                </tr>
                <?php
                $rb = 1;
                foreach($korisnici as $korisnik){
                    echo "<tr>
                                                        <td>$rb</td>
                                                        <td>$korisnik->Ime</td>
                                                        <td>$korisnik->Prezime</td>
                                                        <td>$korisnik->korisnickoIme</td>
                                                        <td>$korisnik->email</td>
                                                        <td>$korisnik->nazivUloge</td>
                                                        <td>$korisnik->telefon</td>
                                                        <td>$korisnik->datum</td>
                                                        <td>$korisnik->ImeGrada</td>
                                                        <td>$korisnik->adresa</td>";
                    if($korisnik->aktivan==1){
                        echo "<td>Aktivan</td>";
                    }
                    else {
                        echo "<td>Kod je poslat</td>";
                    }
                    if($korisnik->aktivan==1) {
                        echo "<td></td>";
                    }
                    else {
                        echo "<td> <a href='models/korisnici/aktivirajRucno.php?id=$korisnik->idKorisnika'> Aktiviraj </a> </td>";
                    }
                    if($korisnik->zakljucan==0){
                        echo "<td></td>";
                    }
                    else{
                        echo "<td><a href='models/korisnici/otkljucaj.php?id=$korisnik->idKorisnika'>Otključaj</a></td>";
                    }
                    echo "
                                                        <td><a href='index.php?page=korisnici/izmeni&admin=admin&id=$korisnik->idKorisnika.'>Izmeni</a></td>";
                    echo "<td><a class='error' href='models/korisnici/obrisi.php?id=$korisnik->idKorisnika'> Izbriši</a></td>";
                    $rb++;
                }

            ?>
            </table>
        </div>
        <?php
    }
    else{
        echo "<p class='alert alert-danger my-3'>Trenutno nema podataka</p>";
    }
    ?>