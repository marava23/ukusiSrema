<?php
$id = $_GET['id'];
require_once "models/korisnici/funkcije.php";
$korisnik = vratiKorisnika($id);
//var_dump($korisnik);
?>
            <div class='detaljnije'>
                <div class='inf-content'>
                    <div class='inf-text'>
                        <h3> <?=$korisnik->Ime." ".$korisnik->Prezime ?></h3>
                        <h4> <?= $korisnik->korisnickoIme ?></h4><br/>
                        <p><b>Adresa</b> : <?=$korisnik->ImeGrada." ".$korisnik->adresa?></p><br/>
                        <p><b>Email adresa</b> : <?=$korisnik->email?></p>
                        <?php
                        if($korisnik->aktivan == 0):
                        ?>
                        <p class="error"><b>Molim Vas, verifikujte Vašu email adresu!</b></p>
                        <a href="models/korisnici/verifikacioniMejl?id=<?=$korisnik->idKorisnika?>">Ponovo pošalji mejl za verifikaciju</a><br/>
                        <?php
                        endif;
                        ?>
                        <br/><p><b>Broj telefona</b> : <?=$korisnik->telefon ?></p><br/>
                        <p><b>Vreme registracije</b> : <?=  $korisnik->datum ?></p><br/>
                        <p><b>Uloga</b> : <?=  $korisnik->nazivUloge ?></p><br/>
                        <p><a href="index.php?page=profil/izmena&id=<?=$korisnik->idKorisnika?>">Izmeni svoje podatke</a></p><br/>
                        <h2>Moje porudžbine</h2>
                        <?php
                        include "models/kupovina/funkcije.php";
                        $porudzbine = dohvatiSveZaKorisnika($korisnik->idKorisnika);
                        //var_dump($porudzbine);
                        ?>
                        <div style="overflow-x:auto;">
                            <table class="table">
                                <tr>
                                    <th>Datum</th>
                                    <th>Ukupna cena</th>
                                    <th>Detalji porudzbine</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                if($porudzbine)
                                    foreach($porudzbine as $p){
                                        echo"<tr>
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
                                                    $p->naziv
                                                 </td>
                                            </tr>";
                                    }
                                ?>
                            </table>
                        </div>
                        <?php
                         if(count($porudzbine)>0):
                        ?>
                            <a href="models/kupovina/export_excel.php?id=<?=$korisnik->idKorisnika?>">
                                Preuzmi u formi eksela
                            </a> 
                        <?php
                         endif;
                        ?>
                        
                    </div>
                </div>
            </div>