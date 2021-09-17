
$(document).ready(function(){
    let imeReg = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})*$/;
    let korImeReg = /^[A-zčćžšđ0-9]{3,50}$/;
    let lozinkaReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    let emailReg= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    var regTelefon=/^06\d{1}\d{6,7}$/;
    var regAdresa =/^[A-zČĆŽŠĐčćžšđ]+(\s[A-zČĆŽŠĐčćžšđ]+)*\s\d{1,}$/;
    var greske = 0;
    let navBarButton =  $('.fa-bars');
    navBarButton.click(function() {
        $('#meni').fadeToggle( "slow", "linear" );
    });
    $('.pretraga').keyup(pretraga);
    $(".anketaOdgovor").click(posaljiOdgovore);
    $('#logbutton').click(function (e) {
        e.preventDefault();
        $('#log').toggle('slow');
    });
    $('.zatvori').click(function(e){
        $('#log').hide('slow');
    })
    $('#registracija').click(function(e){
        $('#log').hide();
    })
    $("#regPotvrdi").click(function(){
        proveraRegistracije();
    })
    $("#logPotvrdi").click(function (e) {
        logovanje();
    });
    $("#porukaPotvrdi").click(posaljiPoruku);
    $('#izmPotvrdi').click(izmeniPodatke);
    $('#dodaj').click(dodajKorisnika);
    $(".proizvodiPaginacija").click(paginacija);
    $(".dropdown").hover(function(){
        $(".dropdown-content").css("display","flex");
        $(".dropdown-content").css("flex-direction", "column");
    },
        function (){
            $(".dropdown-content").css("display","none");
        });
    function ispisProizvoda(proizvodi){
        let html="";
        for(p of proizvodi){
            html+=`<div class='proizvodi'>
                    <article class='proizvod'>
                        <div class='img-container'>
                            <img src='assets/img/${p.malaputanja}' alt='${p.alt}'>
                            <div class='infromacije'>
                                <h3>${p.NazivProizvoda} - ${p.Iznos}rsd/kg</h3>
                                <a href='index.php?page=proizvod&id=${p.id}'><button>Prikaži više</button></a>
                                <button class='bag-btn' data-id='${p.id}'>Dodaj u korpu </button>
                            </div>
                        </div>
                    </article>
                </div>`;
        }
        if(html.length==0){
            $("#proizvodi").html("Nema proizvoda za prikaz!");
        }
        else{
            $("#proizvodi").html(html);
        }
    }
    function proveraRegistracije(){
        greske = 0;
        let ime = $("#ime");
        let prezime = $("#prezime");
        let korIme = $("#username");
        let lozinka = $("#password");
        let email = $("#email");
        let brTel = $("#brTel");
        let gradId = $("#grad");
        let adresa = $("#adresa");
        provera(imeReg, ime.val(), "#imeErr", "Ime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(imeReg, prezime.val(), "#prezimeErr", "Prezime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(korImeReg, korIme.val(), "#usernameErr", "Korisničko ime može da sadrži slova i brojeve, mora biti duže od 3 karaktera!");
        provera(lozinkaReg, lozinka.val(), "#passwordErr", "Lozinka mora imati veliko slovo, broj i mora biti duža od 8 karaktera!");
        provera(emailReg, email.val(), "#emailErr", "Morate uneti email!");
        provera(regTelefon, brTel.val(), "#brTelErr", "Unesite broj telefona u formatu 06********");
        provera(regAdresa, (adresa.val()).trim(), "#adresaError" , "Unesite adresu u formatu ulica broj");
        //console.log(greske);
        if(greske==0){
            data = {
                ime : ime.val(),
                prezime : prezime.val(),
                korisnik : korIme.val(),
                lozinka : lozinka.val(),
                mejl: email.val(),
                telefon : brTel.val(),
                grad : gradId.val(),
                adresa: (adresa.val()).trim()
            }
            ajax("post", "models/korisnici/registracija.php", data, "json", function(uspeh){
                location.reload();
                set
            }, function(error){
                location.reload();
            })
        }
    }

    function provera (regex, vrednost, id, poruka) {
        if (!regex.test(vrednost)) {
            $(id).html(poruka);
            greske++;
        }
        else {
            $(id).html("");
        }
    }

    function logovanje(){
        greske = 0;
        var korIme = $("#logUsername");
        var korLozinka = $("#logPassword");
        provera(korImeReg, korIme.val(), "#usernameLogErr", "Korisničko ime može da sadrži slova i brojeve, mora biti duže od 3 karaktera!");
        provera(lozinkaReg, korLozinka.val(), "#passwordLogErr", "Lozinka mora imati veliko slovo, broj i mora biti duža od 8 karaktera!");
        if(greske==0){
            data = {
                korisnickoIme : korIme.val(),
                lozinka : korLozinka.val()
            }
            ajax("post", "models/korisnici/logovanje.php", data, "json", function(uspeh){
                if(uspeh.poruka == "Nije pronađen ni jedan korisnik!"){
                    $("#logovanjeOdg").html(uspeh.poruka);
                }
                else if(uspeh.poruka == "Uspešno ste se ulogovali!"){
                    location.reload();
                }
            }, function(neuspeh){
                $("#logovanjeOdg").html(neuspeh.poruka);
            })
        }
    }

    function posaljiPoruku(){
        greske = 0;
        var ime = $("#kontaktIme");
        var prezime = $("#kontaktPrezime");
        var mejl = $("#kontaktMail");
        var poruka = $("#poruka");
        provera(imeReg, ime.val(), "#imegreska", "Ime mora početi velikim početnim slovom i biti duže od 3 slova!" );
        provera(imeReg, prezime.val(), "#prezimegreska", "Prezime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(emailReg, mejl.val(), "#mejlgreskaPor", "Morate uneti email!");
        if(poruka.val().length < 10){
            greske++;
            $("#porukagreska").html("Poruka mora imati najmanje 10 slova!");
        }
        else {
            $("#porukagreska").html("")
        }
        if(greske == 0){
            data = {
                ime : ime.val(),
                prezime : prezime.val(),
                email : mejl.val(),
                poruka : poruka.val()
            }
            ajax("post", "models/poruke/posaljiPoruku.php", data, "json", function(uspeh){
                $("#porukaOdogovor").html(uspeh.poruka);
            }, function(neuspeh){
                $("#porukaOdogovor").html(neuspeh.poruka);
            })
        }
    }

    function izmeniPodatke(){
        greske=0;
        let id = parseInt(izmPotvrdi.dataset.id);
        let ime = $("#imeIzm");
        let prezime = $("#prezimeIzm");
        let korIme = $("#usernameIzm");
        let lozinka = $("#lozinkaIzm");
        let email = $("#emailIzm");
        let brTel = $("#brTelIzm");
        let gradId = $("#grad");
        let adresa = $("#adresaIzm");
        provera(imeReg, ime.val(), "#imeErrIzm", "Ime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(imeReg, prezime.val(), "#prezimeErrIzm", "Prezime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(korImeReg, korIme.val(), "#usernameErrIzm", "Korisničko ime može da sadrži slova i brojeve, mora biti duže od 3 karaktera!");
        if(lozinka.val() != 'Upiši novu lozinku'){
            provera(lozinkaReg, lozinka.val(), "#passwordErrIzm", "Lozinka mora imati veliko slovo, broj i mora biti duža od 8 karaktera!");
        }
        else {
            $("#passwordErrIzm").html("")
        }
        provera(emailReg, email.val(), "#emailErrIzm", "Morate uneti email!");
        provera(regTelefon, brTel.val(), "#brTelErrIzm", "Unesite broj telefona u formatu 06********");
        provera(regAdresa, (adresa.val()).trim(), "#adresaErrorIzm" , "Unesite adresu u formatu ulica broj");
        console.log(greske);
        console.log(id);
        if(greske==0){
            data = {
                id : id,
                ime : ime.val(),
                prezime : prezime.val(),
                korisnik : korIme.val(),
                lozinka : lozinka.val(),
                mejl: email.val(),
                telefon : brTel.val(),
                adresa : adresa.val(),
                gradId : gradId.val()
            }
            ajax("post", "models/korisnici/izmena.php", data, "json", function(uspeh){
                $("#izmenaPoruka").html(uspeh.poruka);
            }, function(neuspeh){
                $("#izmenaPoruka").html(neuspeh.poruka);
            })
        }
    }

    function dodajKorisnika(){
        greske = 0;
        let ime = $("#imeDod");
        let prezime = $("#prezimeDod");
        let korIme = $("#usernameDod");
        let lozinka = $("#passwordDod");
        let email = $("#emailDod");
        let brTel = $("#brTelDod");
        provera(imeReg, ime.val(), "#imeErrDod", "Ime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(imeReg, prezime.val(), "#prezimeErrDod", "Prezime mora početi velikim početnim slovom i biti duže od 3 slova!");
        provera(korImeReg, korIme.val(), "#usernameErrDod", "Korisničko ime može da sadrži slova i brojeve, mora biti duže od 3 karaktera!");
        provera(lozinkaReg, lozinka.val(), "#passwordErrDod", "Lozinka mora imati veliko slovo, broj i mora biti duža od 8 karaktera!");
        provera(emailReg, email.val(), "#emailErrDod", "Morate uneti email!");
        provera(regTelefon, brTel.val(), "#brTelErrDod", "Unesite broj telefona u formatu 06********");
        console.log(greske);
        if(greske==0){
            data = {
                ime : ime.val(),
                prezime : prezime.val(),
                korisnik : korIme.val(),
                lozinka : lozinka.val(),
                mejl : email.val(),
                telefon : brTel.val()
            }
            ajax("post", "models/korisnici/dodaj.php", data, "json", function(uspeh){
                $("#dodavanjeOdgovor").html(uspeh.poruka);
            }, function(neuspeh){
                $("#dodavanjeOdgovor").html(neuspeh.poruka);
            })
        }
    }

    function posaljiOdgovore(){
        var anketa = $(this).data("anketa");
        var vrednostOdgovora;
        var id = $(this).data("id");
        var odgovor = document.getElementsByName('odgovor');
        for (var i = 0; i < odgovor.length; i++) {
            if (odgovor[i].checked) {
                vrednostOdgovora = odgovor[i].value;
                break;
            }
        }
        if(vrednostOdgovora == null){
            $("#anketaUspeh").html('Morate uneti odgovor!');
        }
        else {
            let data = {
                id : id,
                anketaId :anketa,
                odgovor : vrednostOdgovora
            }
            ajax("post", "models/anketa/odgovor.php", data, "json", function(uspeh){
                $("#anketaUspeh").html(uspeh.poruka);
            }, function(error){
                $("#anketaUspeh").html("Već ste učestvovali u ovoj anketi!");
            } )
        }
    }
    function pretraga(){
        const unosKorisnika = this.value;
        var podaci = {
            unos : unosKorisnika
        }
        ajax("get", "models/proizvodi/pretraga.php", podaci, "json", function(uspeh){
            ispisProizvoda(uspeh);
        } , function (error){ console.log(error)});
    }

    function paginacija(){
        let limit = $(this).data("id");
        let podaci = {
            limit : limit
        }
        ajax("post", "models/proizvodi/paginacija.php", podaci, "json", function(proizvodi){
            ispisProizvoda(proizvodi);
        }, function(error){console.log(error)});
    }
    function ajax(metod, url, data, dataType, success, error){
        $.ajax({
            method: metod,
            url: url,
            data: data,
            dataType: dataType,
            success: success,
            error: error
        });
    }
})