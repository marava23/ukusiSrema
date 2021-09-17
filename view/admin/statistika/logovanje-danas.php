<?php
try{
    include "models/statistika/funkcije.php";
    $podaci = danasnjiPodaci(USPEH_LOG);
    //var_dump($podaci);
    ?>
    <div style="overflow-x:auto;">
        <table class="table">
            <tr>
                <th>Redni broj</th>
                <th>Korisnik</th>
                <th>Vreme logovanja</th>
            </tr>
            <?php
            $rb=1;
            foreach ($podaci as $red):
                list($korisnik, $vreme) = explode(SEPARATOR,$red);
                    ?>
                    <tr>
                        <td><?= $rb?></td>
                        <td><?= $korisnik ?> </td>
                        <td><?= $vreme ?></td>
                    </tr>
                <?php
            $rb++;
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
