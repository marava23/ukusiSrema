<?php
try{
    include "models/kupovina/funkcije.php";
    $porudzbine = dohvatiSve();
    //var_dump($porudzbine);
    ?>
    <div style="overflow-x:auto;">
        <table class="table">
            <tr>
                <th>Korisnik</th>
                <th>Grad/adresa</th>
                <th>Datum</th>
                <th>Ukupna cena</th>
                <th>Detalji porudzbine</th>
                <th><a href='index.php?page=porudzbine/arhiva&admin=admin'><input type="button" class="dugme" value="Obrađene porudžbine"/></a></th>
            </tr>
            <?php
            if($porudzbine)
            foreach($porudzbine as $p){
                    echo"<tr>
                                    <td>$p->korisnickoIme</td>
                                    <td>$p->ImeGrada/$p->adresa</td>
                                    <td>$p->vremeZahteva</td>
                                    <td>$p->ukupnaCena</td>
                                    <td>";
                    $detalji = detaljiZaPorudzbinu($p->idPorudzbina);
                    foreach ($detalji as $d):
                        ?>
                                        <p><?= "Aritakl: ".$d->NazivProizvoda." količina: ".$d->kolicina." Cena: ".$d->cena?></p>
                    <?php
                    endforeach;
                    echo"            </td>
                                     <td>
                                         <a href='models/kupovina/promenistatus.php?id=2&idPorudzbine=$p->idPorudzbina'><i class='fa fa-check prihvati btn-porudzbine' aria-hidden='true'></i></a>
                                         <a href='models/kupovina/promenistatus.php?id=3&idPorudzbine=$p->idPorudzbina'><i class='fa fa-window-close odbij btn-porudzbine' aria-hidden='true'></i></a
                                     </td>
                                </tr>";
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
