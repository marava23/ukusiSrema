<div class="forma">
    <form  method="POST" action="models/proizvodi/dodaj.php" class="logovanje" enctype="multipart/form-data">
        Ime Proizvoda: <br/><input type="text" name='imeProizvoda'/><br/>
        <span id="imeErrDod" class="error"></span><br/>
        Opis Proizvoda: <br/><textarea name='opis'></textarea><br/>
        <span id="prezimeErrDod" class="error"></span><br/>
        Cena:<br/><input type="number" name='cena'/><br/>
        <span id="prezimeErrDod" class="error"></span><br/>
        Kreiraj Sliku: <br/>Ime slike: <input type="text" name="imeSlike" id="manjaSirina"/><br/>
        Ubaci sliku: <input type="file" name="slikafajl"/><br/>
        <input type="submit" name="dodavanjePorizvoda" value="Dodaj proizvod"/><br/>
        <span id ="dodavanjeOdgovor" class="error"></span>
    </form>
</div>