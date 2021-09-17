<?php
try{
    include "models/kupovina/funkcije.php";
    $porudzbine = dohvatiObradjene();
    //var_dump($porudzbine);
    ?>
    <div style="overflow-x:auto;">
        <table class="table">
            <tr>
                <th>Korisnik</th>
                <th>Grad/adresa</th>
                <th>Datum</th>
                <th>Ukupna cena</th>
                <th>Status</th>
                <th>Detalji porudzbine</th>
            </tr>
            <?php
            if($porudzbine)
                foreach($porudzbine as $p){
                    echo"<tr>
                                    <td>$p->korisnickoIme</td>
                                    <td>$p->ImeGrada/$p->adresa</td>
                                    <td>$p->vremePromene</td>
                                    <td>$p->ukupnaCena</td>
                                    <td>$p->naziv</td>
                                    <td>";
                    $detalji = detaljiZaPorudzbinu($p->idPorudzbina);
                    foreach ($detalji as $d):
                        ?>
                        <p><?= "Aritakl: ".$d->NazivProizvoda." količina: ".$d->kolicina." Cena: ".$d->cena?></p>
                    <?php
                    endforeach;
                    echo"            </td>
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
