<div style="overflow-x:auto;">
    <table class="table">
        <tr>
            <th>Broj ankete</th>
            <th>Pitanje</th>
            <th>Aktivna</th>
            <th><a href='index.php?page=anketa/dodaj&admin=admin'><input type="button" class="dugme" value="Dodaj anketu"/></a></th>
            <th> </th>
        </tr>
        <?php
        try{
            include "models/anketa/funkcije.php";
            $anketa = podaciAnkete();
            //var_dump($anketa);
            $rb=1;
            foreach($anketa as $a){
                echo "
                                <tr>
                                    <td>$rb</td>
                                    <td>$a->pitanje</td>";
                if($a->aktivna==1){
                    echo "<td> Aktivna </td>";
                }
                else {
                    echo "<td> Nije aktivna </td>";
                }
                if($a->aktivna==1){
                    echo "<td><a href='models/anketa/stopiraj.php?id=$a->anketaId'>Zaustavi</a></td>";
                }
                else {
                    echo "<td></td>";
                }
                echo "
                                    <td><a href='index.php?page=anketa/arhiva&admin=admin&id=$a->anketaId'> Arhiva </a></td>
                                </tr>
                            ";
                $rb++;
            }
        }
        catch(PDOException $e){
            var_dump($e);
        }
        ?>
    </table>
</div>