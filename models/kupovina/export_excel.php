<?php

require_once "../../config/connection.php";
include "funkcije.php";
$id = $_GET['id'];
$porudzbine = dohvatiSveZaKorisnika($id);

// Pokretanje Excel aplikacije
$excel = new COM("Excel.Application");

// Da bi se fizički videlo otvaranje fajla
$excel->Visible = 1;

// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
$excel->DisplayAlerts = 1;

// Otvaranje Excel fajla
$workbook = $excel->Workbooks->Open("http://localhost/ukusisremaphp/models/kupovina/porudzbine.xlsx") or die('Did not open filename');
// Otvaranje Sheet
$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach($porudzbine as $p){
    // U A kolonu upisujemo ID
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value =$p->vremeZahteva;

    // U B kolonu upisujemo TITLE
    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $p->ukupnaCena;
    $detalji = detaljiZaPorudzbinu($p->idPorudzbina);
    foreach ($detalji as $d){
        $polje = $sheet->Range("C{$br}");
        $polje->activate;
        $polje->value = $d->NazivProizvoda;
        $polje = $sheet->Range("D{$br}");
        $polje->activate;
        $polje->value = $d->kolicina;
        $polje = $sheet->Range("E{$br}");
        $polje->activate;
        $polje->value = $d->cena;
    }
    $polje = $sheet->Range("F{$br}");
    $polje->activate;
    $polje->value = $p->ukupnaCena;
    $detalji = detaljiZaPorudzbinu($p->naziv);
    $br++;
}

// U E kolonu upisujemo BROJ UNETIH REDOVA
$polje = $sheet->Range("G{$br}");
$polje->activate;
$polje->value = count($porudzbine);

// Cuvanje promena u fajla
$workbook->_SaveAs("http://localhost/praktikum_php/lab/termin9/resenje/models/movies/Filmovi.xlsx", -4143);
$workbook->Save();

// Zatvaranje Excel fajla
$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);