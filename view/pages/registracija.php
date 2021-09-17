<?php
$gradovi = executeQuery("SELECT * from grad");
//var_dump($gradovi);
?>
<div class="forma">
    <form action="" id="reg" class="logovanje">
        Ime: <br/><input type="text" id="ime"/><br/>
        <span id="imeErr" class="error"></span><br/>
        Prezime: <br/><input type="text" id="prezime"/><br/>
        <span id="prezimeErr" class="error"></span><br/>
        Korisnicko ime: <br/><input type="text" id="username"/><br/>
        <span id="usernameErr" class="error"></span><br/>
        Lozinka: <br/><input type="password" id="password"/><br/>
        <span id="passwordErr" class="error"></span><br/>
        email: <br/><input type="email" id="email"/><br/>
        <span id="emailErr" class="error"></span><br/>
        Grad: <br/><select name="grad" id="grad">
            <?php
                    foreach ($gradovi as $grad):
            ?>
                        <option value="<?=$grad->id ?>"> <?=$grad->ImeGrada ?> </option>
            <?php
                    endforeach;
            ?>
                    </select>
        <br/>
        Adresa: <br/>
        <input type="text" id="adresa"/><br/>
        <span id="adresaError" class="error"></span><br/>
        Broj telefona: <br/><input type="text" id="brTel"/><br/>
        <span id="brTelErr" class="error"></span><br/>
        <input type="button" id="regPotvrdi" value="Registrujte se"/><br/>
        <span id="registracijaOdgovor" class="error"></span>
    </form>
</div>