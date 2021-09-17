<div style="overflow-x:auto;">
    <table class="table">
        <tr>
            <th>Pitanje</th>
            <th>Odgovor</th>
            <th>Korisnik</th>
            <th>Vreme </th>
        </tr>

        <?php
        try{
            include "models/anketa/funkcije.php";
            $id = $_GET['id'];
            //var_dump($id);
            $podaci = podaciJedneAnkete($id);
            //var_dump($podaci);
            foreach($podaci as $p){
                echo "<tr>";
                echo "<td>$p->pitanje</td>";
                echo "<td>$p->odgovor</td>";
                echo "<td>$p->korisnickoIme</td>";
                echo "<td>$p->vremeOdgovora</td>";
                echo "</tr>";
            }
        }
        catch(PDOException $e){
            var_dump($e);
        }
        ?>
    </table>
</div>