<?php
try{
    include "models/proizvodi/funkcije.php";
    $proizvodi = vratiProizvode();
    //var_dump($proizvodi[0]);
    ?>
    <div style="overflow-x:auto;">
        <table class="table">
            <tr>
                <th>Naziv Proizvoda</th>
                <th>Opis Proizvoda</th>
                <th>Cena</th>
                <th><a href='index.php?page=proizvodi/dodaj&admin=admin'><input type="button" class="dugme" value="Dodaj proizvod"/></a></th>
                <th></th>
            </tr>
            <?php
            foreach($proizvodi as $p){
                if($p->softDelete==0){
                    echo"<tr>
                                    <td>$p->NazivProizvoda</td>
                                    <td>$p->OpisProizvoda</td>
                                    <td>$p->Iznos rsd</td>
                                    <td><a href='index.php?page=proizvodi/izmeni&admin=admin&id=$p->idProizvod'>Izmeni</a></td>
                                    <td><a class='error' href='models/proizvodi/obrisiProizvod.php?id=$p->idProizvod'> Izbriši</a></td>
                                </tr>";
                }
            }
            ?>
        </table>
    </div>
    <?php
}
catch(PDOException $e){
    var_dump($e);
    http_response_code(500);
}