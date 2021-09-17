<?php
try{
                            include "models/poruke/funkcije.php";
                            $poruke = vratiSve('poruka');
                            //var_dump($poruke);
                            ?>
    <div style="overflow-x:auto;">
                                <table class="table">
                                    <tr>
                                        <th>Ime</th>
                                        <th>Prezime</th>
                                        <th>Email</th>
                                        <th>Poruka</th>
                                        <th>Datum</th>
                                        <th><a href='index.php?page=poruke&admin=admin'><input type="button" class="dugme" value="Poruke"/></a></th>
                                    </tr>
                            <?php
                                foreach($poruke as $p){
                                    if($p->procitano==1){
                                    echo"<tr>
                                    <td>$p->ime</td>
                                    <td>$p->prezime</td>
                                    <td>$p->email</td>
                                    <td>$p->poruka</td>
                                    <td>$p->vreme</td>
                                    <td></td>
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
