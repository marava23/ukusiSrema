-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 01:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28109172_ukusisrema`
--
CREATE DATABASE IF NOT EXISTS `epiz_28109172_ukusisrema` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `epiz_28109172_ukusisrema`;

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `anketaId` int(11) NOT NULL,
  `pitanje` text COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `anketa`:
--

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`anketaId`, `pitanje`, `aktivna`) VALUES
(1, 'Da li ste zadovoljni količinom proizvoda?', 0),
(2, 'Da li biste probali livadski med?', 0),
(3, 'Da li si zadovoljan cenom kulena?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketaodgovori`
--

CREATE TABLE `anketaodgovori` (
  `anketaOdgovoriId` int(11) NOT NULL,
  `odgovor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anektaId` int(11) NOT NULL,
  `korisnikId` int(11) NOT NULL,
  `vremeOdgovora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `anketaodgovori`:
--   `anektaId`
--       `anketa` -> `anketaId`
--   `korisnikId`
--       `korisnik` -> `idKorisnika`
--

--
-- Dumping data for table `anketaodgovori`
--

INSERT INTO `anketaodgovori` (`anketaOdgovoriId`, `odgovor`, `anektaId`, `korisnikId`, `vremeOdgovora`) VALUES
(1, 'Da', 1, 1, '2021-03-18 03:28:52'),
(4, 'Da', 1, 2, '2021-03-18 03:33:38'),
(5, 'Da', 1, 13, '2021-03-18 03:35:03'),
(6, 'Da', 2, 1, '2021-03-18 04:46:35'),
(7, 'Ne', 3, 1, '2021-03-18 11:44:44'),
(8, 'Da', 3, 2, '2021-03-18 11:47:27'),
(9, 'Da', 3, 13, '2021-03-18 11:48:38'),
(10, 'Da', 3, 27, '2021-04-27 08:09:37'),
(11, 'Ne', 3, 31, '2021-04-27 08:44:49'),
(12, 'Da', 5, 1, '2021-04-27 12:30:07'),
(13, 'Da', 6, 1, '2021-04-27 12:37:43'),
(14, 'Da', 3, 39, '2021-05-29 13:31:06'),
(15, 'Da', 3, 41, '2021-06-09 22:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `cena`
--

CREATE TABLE `cena` (
  `idCena` int(100) NOT NULL,
  `Iznos` double NOT NULL,
  `vaziOd` timestamp NOT NULL DEFAULT current_timestamp(),
  `vaziDo` date DEFAULT NULL,
  `idProizvod` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `cena`:
--   `idProizvod`
--       `proizvodi` -> `id`
--

--
-- Dumping data for table `cena`
--

INSERT INTO `cena` (`idCena`, `Iznos`, `vaziOd`, `vaziDo`, `idProizvod`) VALUES
(22, 750, '2021-06-12 18:05:56', NULL, 6),
(21, 1500, '2021-06-12 18:05:24', NULL, 5),
(20, 1250, '2021-06-12 16:27:12', NULL, 4),
(19, 1100, '2021-06-12 16:26:42', NULL, 3),
(18, 1600, '2021-06-12 16:26:14', NULL, 2),
(17, 1350, '2021-06-12 15:45:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id` int(11) NOT NULL,
  `ImeGrada` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `grad`:
--

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id`, `ImeGrada`) VALUES
(1, 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnika` int(255) NOT NULL,
  `Ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `korisnickoIme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kod` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUloga` int(10) NOT NULL,
  `aktivan` tinyint(1) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `zakljucan` tinyint(4) NOT NULL,
  `adresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idGrada` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `korisnik`:
--   `idGrada`
--       `grad` -> `id`
--   `idUloga`
--       `uloga` -> `idUloga`
--

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnika`, `Ime`, `Prezime`, `korisnickoIme`, `email`, `lozinka`, `kod`, `telefon`, `idUloga`, `aktivan`, `datum`, `zakljucan`, `adresa`, `idGrada`) VALUES
(1, 'Miloš', 'Maravić', 'marava', 'milos.maravic.269.19@ict.edu.rs', '9f79967d562d2f7b394a700ff23c3419', 'd9ad28109d5dbb44b73328d26abf212e', '062423730', 2, 1, '2021-03-11 02:53:56', 0, 'Toplicka 25', 1),
(2, 'Cimra', 'Cimric', 'cimra', 'cimra@gmail.com', 'dfa7fc51eeb57371b31c00abaf1b6631', '38f1c30382c20465644b965f30c90d97', '0641489563', 1, 1, '2021-03-11 02:57:03', 0, 'Zahumska 23', 1),
(13, 'Vukasin', 'Pekovic', 'vukasinsk', 'vukasinsk@gmail.com', 'ccdc1bdbd51296d890affabab03a0578', 'acb935a39abbaeb8bdba379426655763', '0642589417', 1, 1, '2021-03-17 17:33:59', 0, 'Bulevar Kralja Aleksandra 123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obrada`
--

CREATE TABLE `obrada` (
  `idObrada` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `idPorudzbine` int(11) NOT NULL,
  `vremePromene` datetime NOT NULL,
  `aktivan` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `obrada`:
--   `idStatus`
--       `status` -> `idStatus`
--   `idPorudzbine`
--       `porudzbina` -> `idPorudzbina`
--

--
-- Dumping data for table `obrada`
--

INSERT INTO `obrada` (`idObrada`, `idStatus`, `idPorudzbine`, `vremePromene`, `aktivan`) VALUES
(1, 1, 3, '2021-06-15 02:50:57', 0),
(2, 1, 4, '2021-06-15 02:53:19', 0),
(3, 1, 5, '2021-06-15 02:54:03', 0),
(4, 1, 6, '2021-06-15 02:55:04', 0),
(5, 1, 7, '2021-06-15 02:55:20', 0),
(6, 1, 8, '2021-06-15 02:56:58', 0),
(7, 1, 9, '2021-06-15 02:57:37', 0),
(8, 1, 10, '2021-06-15 16:12:33', 0),
(9, 2, 3, '2021-06-16 00:25:49', 1),
(10, 2, 4, '2021-06-16 00:25:49', 1),
(11, 2, 5, '2021-06-16 00:27:18', 1),
(12, 2, 6, '2021-06-16 00:27:27', 1),
(13, 2, 7, '2021-06-16 00:27:28', 1),
(14, 2, 10, '2021-06-16 00:27:29', 1),
(15, 2, 9, '2021-06-16 00:54:35', 1),
(16, 3, 8, '2021-06-16 00:55:10', 1),
(17, 1, 15, '2021-06-16 02:10:02', 0),
(18, 3, 15, '2021-06-16 02:26:54', 1),
(19, 1, 16, '2021-06-16 02:27:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `porudzbina`
--

CREATE TABLE `porudzbina` (
  `idPorudzbina` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `vremeZahteva` datetime NOT NULL,
  `ukupnaCena` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `porudzbina`:
--   `idKorisnik`
--       `korisnik` -> `idKorisnika`
--

--
-- Dumping data for table `porudzbina`
--

INSERT INTO `porudzbina` (`idPorudzbina`, `idKorisnik`, `vremeZahteva`, `ukupnaCena`) VALUES
(3, 1, '2021-06-15 02:50:57', '3750'),
(4, 1, '2021-06-15 02:53:19', '5000'),
(5, 1, '2021-06-15 02:54:03', '5000'),
(6, 1, '2021-06-15 02:55:04', '5000'),
(7, 1, '2021-06-15 02:55:20', '5000'),
(8, 1, '2021-06-15 02:56:58', '5000'),
(9, 1, '2021-06-15 02:57:37', '1250'),
(10, 1, '2021-06-15 16:12:33', '1350'),
(15, 1, '2021-06-16 02:10:02', '2750'),
(16, 2, '2021-06-16 02:27:44', '2250');

-- --------------------------------------------------------

--
-- Table structure for table `porudzbinadetalji`
--

CREATE TABLE `porudzbinadetalji` (
  `id` int(11) NOT NULL,
  `idPorudzbine` int(11) NOT NULL,
  `idProizvoda` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cena` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `porudzbinadetalji`:
--   `idPorudzbine`
--       `porudzbina` -> `idPorudzbina`
--   `idProizvoda`
--       `proizvodi` -> `id`
--

--
-- Dumping data for table `porudzbinadetalji`
--

INSERT INTO `porudzbinadetalji` (`id`, `idPorudzbine`, `idProizvoda`, `kolicina`, `cena`) VALUES
(1, 3, 5, 1, '1500'),
(2, 3, 6, 3, '750'),
(3, 4, 5, 1, '1500'),
(4, 4, 6, 3, '750'),
(5, 4, 4, 1, '1250'),
(6, 5, 5, 1, '1500'),
(7, 5, 6, 3, '750'),
(8, 5, 4, 1, '1250'),
(9, 6, 5, 1, '1500'),
(10, 6, 6, 3, '750'),
(11, 6, 4, 1, '1250'),
(12, 7, 5, 1, '1500'),
(13, 7, 6, 3, '750'),
(14, 7, 4, 1, '1250'),
(15, 8, 5, 1, '1500'),
(16, 8, 6, 3, '750'),
(17, 8, 4, 1, '1250'),
(18, 9, 4, 1, '1250'),
(19, 10, 1, 1, '1350'),
(28, 15, 4, 1, '1250'),
(29, 15, 5, 1, '1500'),
(30, 16, 6, 3, '750');

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

CREATE TABLE `poruka` (
  `porukaid` int(11) NOT NULL,
  `ime` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `poruka` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vreme` datetime NOT NULL DEFAULT current_timestamp(),
  `procitano` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `poruka`:
--

--
-- Dumping data for table `poruka`
--

INSERT INTO `poruka` (`porukaid`, `ime`, `prezime`, `email`, `poruka`, `vreme`, `procitano`) VALUES
(1, 'Miloš', 'Maravić', 'milos.maravic.269.19@ict.edu.r', 'poruka od admina', '2021-03-18 02:38:20', 1),
(2, 'Cimra', 'Cimric', 'cimra125@gmail.com', 'Poruka od neautorizovanog korisnika', '2021-03-18 02:38:57', 1),
(3, 'Test', 'Test', 'luka.lukic@ict.edu.rs', 'Poruka od 10 slova', '2021-05-29 13:31:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `NazivProizvoda` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `OpisProizvoda` text COLLATE utf8_unicode_ci NOT NULL,
  `idSlike` int(11) NOT NULL,
  `softDelete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `proizvodi`:
--   `idSlike`
--       `slike` -> `idSlike`
--

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `NazivProizvoda`, `OpisProizvoda`, `idSlike`, `softDelete`) VALUES
(1, 'Pečenica', '    Jedan od najjednostavnijih proizvoda po načinu proizvodnje, ali svakako proizvod vrhunskog kvaliteta koji sa razlogom zaslužuje da se nađe u našoj ponudi, jeste pečenica. Pečenica je čist komad krmenadle, odvojen od kosti i pažljivo usoljen. Ključni faktor u proizvodnji pečenice je hladan dim, gde se u kombinaciji bukove, šljivine i kruškine piljevine dobija svetlocrvena boja i aroma koja naprosto mami svakog da je proba.', 20, 0),
(2, 'Kulen', 'Najstariji proizvod porodice, koji se proizvodi od pamtiveka, svakako je sremski kulen.Tajna dobrog kulena je, prvenstveno, u začinima i ljubavi, sa kojom se proizvodi. Pored čistog svinjskog mesa, u sremski kulen se još dodaju so i ljuta paprika ali svakako da veliku ulogu igra i proces sušenja i dimljenja, koji se odvija na tradicionalan način, na hladnom dimu bez bilo kakvih dodataka. Ono što Sremski kulen čini drugačijim od ostalih proizvoda jeste to sto on ima zaštićeno geografsko poreklo, što znači da može da se pravi samo od svinjetine uzgojene na teritoriji Srema.\r\n', 21, 0),
(3, 'Kobasica ', 'Nema kuće u Sremu, a da u njoj nema sremske kobasice. Naprosto, u Sremu ne može da se zamisli obrok, a da uz njega ne ide bar ‘lakat’ sremske kobasice. Sremska kobasica se pravi od čistog svinjskog mesa uz dodatak domaćeg belog luka, crnog bibera, ljute paprike i soli. Upravo je taj beli luk ono što sremsku kobasicu čini jedinstvenom. Beli luk je brižljivo uzgajan, sa namerom da upotpuni ukus sremske kobasice. Sremska kobasica je autentičan proizvod iz Srema koji naša porodica već vekovima proizvodi na isti način, sa namerom da svakom gostu ponudi ono najbolje iz Srema i da nikoga ne ostavi ravnodušnim.\r\n\r\n', 22, 0),
(4, 'Slanina ', 'Hrana na kojoj su odrasle generacije, melem iz Srema o kome se pričalo od Fruške Gore pa do Bečkog dvora. Naša porodica slaninu proizvodi od posebne vrste svinja uzgojenih samo za te potrebe. Bez obzira da li se jede leti uz glavicu crnog luka i paradajz ili zimi uz koju čašicu rakijice, slanina je tu da upotpuni svaki Vaš trenutak sa željom da ispuni očekivanja svakog gosta i da na najbolji način reprezentuje duh Srema.', 23, 0),
(5, 'Suvi vrat', 'Svakako najzastupljeniji komad mesa, a ujedno i jedan od najboljih, jeste suvi vrat. Suvi vrat se proizvodi tako što se sa pažnjom bira komad koji zadovoljava sve kriterijume da postane finalni proizvod. Pored soli, hladnog dima i blagog vetra, kod suvog vrata najveću ulogu u ukusu i kvalitetu proizvoda igra sam komad mesa. Blago prošaran komad mesa detaljnom selekcijom i stručnom obradom postaje suvi vrat, proizvod koji će svakog gurmana naterati da mu se uvek vrati.', 24, 0),
(6, 'Med ', 'Med je slatka, aromatična, gusta tečnost koju proizvode medonosne pčele iz cvetnog nektara, medne rose sa lišća četinara i listopadnog drveća, slatkih materija koje izlučuju sitni insekti ili od slatkog soka plodova nekih biljaka. Tako dobijen med pčele skladište u saću.Boja meda može da varira od skoro bezbojne do tamnosmeđe, dok mu konzistencija može biti tečno gusta, ili ukristalisana. Ukus i miris variraju, i zavise od dominantne biljne vrste u medu.', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idSlike` int(100) NOT NULL,
  `velikaputanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `malaputanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `slike`:
--

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlike`, `velikaputanja`, `malaputanja`, `alt`) VALUES
(25, 'original-1623521156med.jpeg', 'mala-1623521156.jpg', 'Med '),
(24, 'original-1623521124suvivrat.jpeg', 'mala-1623521124.jpg', 'Suvi vrat'),
(23, 'original-1623515232slanina.jpeg', 'mala-1623515232.jpg', 'Slanina '),
(22, 'original-1623515202kobasica.jpeg', 'mala-1623515202.jpg', 'Kobasica '),
(21, 'original-1623515174kulen.jpeg', 'mala-1623515174.jpg', 'Kulen'),
(20, 'original-1623512707pecenica.jpeg', 'mala-mala-1623512707.jpg', 'Pečenica');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `status`:
--

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`idStatus`, `naziv`) VALUES
(1, 'poslato'),
(2, 'prihvaceno'),
(3, 'odbijeno'),
(4, 'isporuceno');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(11) NOT NULL,
  `nazivUloge` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `uloga`:
--

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `nazivUloge`) VALUES
(1, 'korisnik'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`anketaId`);

--
-- Indexes for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  ADD PRIMARY KEY (`anketaOdgovoriId`),
  ADD KEY `anektaId` (`anektaId`),
  ADD KEY `korisnikId` (`korisnikId`);

--
-- Indexes for table `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`idCena`),
  ADD KEY `idProizvod` (`idProizvod`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnika`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kod` (`kod`),
  ADD UNIQUE KEY `korisnickoIme` (`korisnickoIme`),
  ADD KEY `idUloga` (`idUloga`),
  ADD KEY `idGrada` (`idGrada`);

--
-- Indexes for table `obrada`
--
ALTER TABLE `obrada`
  ADD PRIMARY KEY (`idObrada`),
  ADD KEY `idPorudzbine` (`idPorudzbine`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Indexes for table `porudzbina`
--
ALTER TABLE `porudzbina`
  ADD PRIMARY KEY (`idPorudzbina`),
  ADD KEY `idKorisnik` (`idKorisnik`);

--
-- Indexes for table `porudzbinadetalji`
--
ALTER TABLE `porudzbinadetalji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProizvoda` (`idProizvoda`),
  ADD KEY `idPorudzbine` (`idPorudzbine`);

--
-- Indexes for table `poruka`
--
ALTER TABLE `poruka`
  ADD PRIMARY KEY (`porukaid`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSlike` (`idSlike`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idSlike`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `anketaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  MODIFY `anketaOdgovoriId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cena`
--
ALTER TABLE `cena`
  MODIFY `idCena` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnika` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `obrada`
--
ALTER TABLE `obrada`
  MODIFY `idObrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `porudzbina`
--
ALTER TABLE `porudzbina`
  MODIFY `idPorudzbina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `porudzbinadetalji`
--
ALTER TABLE `porudzbinadetalji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `poruka`
--
ALTER TABLE `poruka`
  MODIFY `porukaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idSlike` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `obrada`
--
ALTER TABLE `obrada`
  ADD CONSTRAINT `obrada_ibfk_1` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `obrada_ibfk_2` FOREIGN KEY (`idPorudzbine`) REFERENCES `porudzbina` (`idPorudzbina`);

--
-- Constraints for table `porudzbinadetalji`
--
ALTER TABLE `porudzbinadetalji`
  ADD CONSTRAINT `porudzbinadetalji_ibfk_1` FOREIGN KEY (`idPorudzbine`) REFERENCES `porudzbina` (`idPorudzbina`),
  ADD CONSTRAINT `porudzbinadetalji_ibfk_2` FOREIGN KEY (`idProizvoda`) REFERENCES `proizvodi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
