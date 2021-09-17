<?php
try{
    include "models/statistika/funkcije.php";
    popuniStatistiku("danas");
    $file = fopen(STATISTIKA, "r");
    $podaci = file(STATISTIKA);
    fclose($file);
    $ukupnoPoseta = brojPodatakaDanas(LOG_FAJL);
    //var_dump($podaci);
    ?>
    <div style="overflow-x:auto;">
        <table class="table">
            <tr>
                <th>Stranica</th>
                <th>Procenat posećenosti</th>
            </tr>
            <?php
            foreach ($podaci as $red):
                list($stranica, $broj) = explode(SEPARATOR,$red);
                if(strpos($stranica, "admin") == false):
                    ?>
                    <tr>
                        <td><?= $stranica ?> </td>
                        <td><?= @round($broj/$ukupnoPoseta * 100, 2) . "%" ?></td>
                    </tr>
                <?php
                endif;
            endforeach;
            ?>
        </table>
    </div>
    <?php
}
catch(PDOException $e){
    var_dump($e);
    http_response_code(500);
}
