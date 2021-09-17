<?php
$id = $_GET['id'];
require_once "models/proizvodi/funkcije.php";
$proizvod = vratiProizvod($id);
//var_dump($proizvod);
echo "<div class='detaljnije'>
                <div class='zaglavlje'>
                    <h1> $proizvod->NazivProizvoda - $proizvod->Iznos rsd/kg </h1>
                </div>
                <div class='inf-content'>
                    <div class='inf-img'>
                        <img src='assets/images/$proizvod->velikaputanja' alt='$proizvod->alt'/>
                    </div>
                    <div class='inf-text'>
                        <p>$proizvod->OpisProizvoda</p>
                    </div>
                </div>
                </div>
                </div>";
?>