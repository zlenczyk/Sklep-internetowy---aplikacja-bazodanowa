-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Lip 2021, 22:55
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostawa`
--

CREATE TABLE `dostawa` (
  `id_dostawy` int(11) NOT NULL,
  `sposob_dostawy` varchar(60) NOT NULL,
  `koszt_dostawy` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dostawa`
--

INSERT INTO `dostawa` (`id_dostawy`, `sposob_dostawy`, `koszt_dostawy`) VALUES
(1, 'odbior osobisty', '0.00'),
(2, 'kurier DPD', '18.00'),
(3, 'kurier DPD za pobraniem', '21.00'),
(4, 'paczkomat', '17.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `telefon` int(11) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `haslo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `imie`, `nazwisko`, `telefon`, `email`, `haslo`) VALUES
(2, 'Monika', 'Kawa', 123456789, 'huhuhuh@g.pl', '25d55ad283aa400af464c76d713c07ad'),
(3, 'Brak', 'Brak', 0, '3', 'Brak'),
(4, 'Zuzanna', 'Lenczyk', 6567556, 'moj_email@mail.com', '25d55ad283aa400af464c76d713c07ad'),
(5, 'Marcin', 'Domagala', 666666666, 'pieklo@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycje_zamowien`
--

CREATE TABLE `pozycje_zamowien` (
  `id_pozycji` int(11) NOT NULL,
  `zamowienia_id` int(11) NOT NULL,
  `produkty_id` int(11) NOT NULL,
  `sztuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pozycje_zamowien`
--

INSERT INTO `pozycje_zamowien` (`id_pozycji`, `zamowienia_id`, `produkty_id`, `sztuk`) VALUES
(27, 10, 5, 2),
(28, 10, 3, 5),
(29, 10, 1, 1),
(30, 11, 7, 1),
(31, 11, 3, 3),
(35, 12, 7, 1),
(36, 12, 5, 4),
(37, 12, 2, 1),
(43, 15, 5, 3),
(44, 15, 3, 4),
(45, 16, 3, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produktu` int(11) NOT NULL,
  `nazwa` varchar(60) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `opis` varchar(200) NOT NULL,
  `gatunek` enum('aglaonema','alokazja','anturium','begonia','epipremnum i scindapsus','filodendron','kaktusy i sukulenty','marantowate','syngonium','inne') DEFAULT NULL,
  `trudnosc` enum('dla amatorów','dla zaawansowanych') DEFAULT NULL,
  `bezpieczna` enum('bezpieczna','szkodliwa') DEFAULT NULL,
  `oczyszczanie` enum('tak','nie') DEFAULT NULL,
  `wysokosc` int(11) NOT NULL,
  `material` enum('plastikowa','ceramiczna','szklana','metalowa','betonowa','gliniana','inna') DEFAULT NULL,
  `srednica` float NOT NULL,
  `typ` enum('roslina','oslonka') NOT NULL,
  `na_stanie` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produktu`, `nazwa`, `cena`, `opis`, `gatunek`, `trudnosc`, `bezpieczna`, `oczyszczanie`, `wysokosc`, `material`, `srednica`, `typ`, `na_stanie`) VALUES
(1, 'Monstera Deliciosa S', '39.00', 'Rosnie szybko, wymaga minimalnej pielegnacji i dostosuje sie do większości warunków.Lubi umiarkowanie wilgotno, dlatego podlewaj gdy ziemia bedzie sucha.', 'inne', 'dla amatorów', 'szkodliwa', 'nie', 30, NULL, 12, 'roslina', 6),
(2, 'Monstera Deliciosa M', '69.00', 'Rosnie szybko, wymaga minimalnej pielegnacji i dostosuje sie do większości warunków.Lubi umiarkowanie wilgotno, dlatego podlewaj gdy ziemia bedzie sucha.', 'inne', 'dla amatorów', 'szkodliwa', 'nie', 45, NULL, 14, 'roslina', 4),
(3, 'Oslonka w ciapki', '19.00', 'Piekna oslonka przypominajaca ciapki leoparda, to idelne polaczenie z kazda roslina!', NULL, NULL, NULL, NULL, 7, 'ceramiczna', 6.5, 'oslonka', 10),
(4, 'Philodendron scandens brasil', '79.00', 'W niewielkim czasie moze osiagnac naprawde imponujace rozmiary, dlatego kupujac go, warto zadbac o odpowiednia ilosc przestrzeni.', 'filodendron', 'dla amatorów', 'szkodliwa', 'tak', 40, NULL, 15, 'roslina', 3),
(5, 'Alokazja silver dragon XS', '39.00', 'Ma piekne, szaro – zielone liscie, ktore hipnotyzuja swoim wdziekiem. Jak kazda alokazja ma swoje kaprysy, ale jesli spelnisz jej podstawowe potrzeby to stanie sie prawdziwa krolowa Twojego mieszkania', 'alokazja', 'dla zaawansowanych', 'szkodliwa', 'nie', 12, NULL, 6, 'roslina', 2),
(7, 'Maranta Lemon Lime S', '140.00', 'Maranta Lemon Lime ma ladne limonkowe liscie', 'marantowate', 'dla zaawansowanych', 'szkodliwa', 'nie', 15, '', 10, 'roslina', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `data` timestamp(2) NOT NULL DEFAULT current_timestamp(2),
  `status` enum('w_trakcie','oczekujace','zaplacono','zwrocono') NOT NULL DEFAULT 'w_trakcie',
  `ulica` varchar(45) DEFAULT NULL,
  `numer_domu` varchar(45) DEFAULT NULL,
  `miasto` varchar(45) DEFAULT NULL,
  `kod_pocztowy` varchar(10) DEFAULT NULL,
  `wojewodztwo` enum('dolnoslaskie','kujawsko-pomorskie','lubelskie','lubuskie','lodzkie','malopolskie','mazowieckie','opolskie','podkarpackie','podlaskie','pomorskie','slaskie','swietokrzyskie','warminsko-mazurskie','wielkopolskie','zachodniopomorskie') DEFAULT NULL,
  `koszt_zamowienia` decimal(6,2) NOT NULL DEFAULT 0.00,
  `klienci_id` int(11) NOT NULL,
  `dostawa_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `data`, `status`, `ulica`, `numer_domu`, `miasto`, `kod_pocztowy`, `wojewodztwo`, `koszt_zamowienia`, `klienci_id`, `dostawa_id`) VALUES
(10, '2021-07-01 07:11:10.57', 'oczekujace', 'ul. Graniczna 30', '15', 'Wrocław', '12-345', 'dolnoslaskie', '229.00', 2, 4),
(11, '2021-07-01 07:16:19.90', 'oczekujace', 'ul. Krótka 23', '15', 'Warszawa', '54-321', 'mazowieckie', '215.00', 3, 2),
(12, '2021-07-01 07:32:16.98', 'oczekujace', 'ul. Długa', '10', 'Swidnica', '56-789', 'swietokrzyskie', '386.00', 4, 3),
(15, '2021-07-01 08:35:43.61', 'oczekujace', 'ul. Graniczna 30', '15', 'Swidnica', '12-345', 'opolskie', '210.00', 4, 4),
(16, '2021-07-01 09:10:16.97', 'oczekujace', 'ul. Graniczna 30', '15', 'Wrocław', '12-345', 'swietokrzyskie', '57.00', 4, 1),
(17, '2021-07-01 09:32:53.68', 'w_trakcie', NULL, NULL, NULL, NULL, NULL, '0.00', 4, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostawa`
--
ALTER TABLE `dostawa`
  ADD PRIMARY KEY (`id_dostawy`),
  ADD UNIQUE KEY `sposob_dostawy` (`sposob_dostawy`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `pozycje_zamowien`
--
ALTER TABLE `pozycje_zamowien`
  ADD PRIMARY KEY (`id_pozycji`),
  ADD KEY `zamowienia` (`zamowienia_id`),
  ADD KEY `produkty` (`produkty_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produktu`),
  ADD UNIQUE KEY `nazwa` (`nazwa`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `klienci` (`klienci_id`),
  ADD KEY `dostawa` (`dostawa_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dostawa`
--
ALTER TABLE `dostawa`
  MODIFY `id_dostawy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pozycje_zamowien`
--
ALTER TABLE `pozycje_zamowien`
  MODIFY `id_pozycji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `pozycje_zamowien`
--
ALTER TABLE `pozycje_zamowien`
  ADD CONSTRAINT `produkty` FOREIGN KEY (`produkty_id`) REFERENCES `produkty` (`id_produktu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `zamowienia` FOREIGN KEY (`zamowienia_id`) REFERENCES `zamowienia` (`id_zamowienia`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `dostawa` FOREIGN KEY (`dostawa_id`) REFERENCES `dostawa` (`id_dostawy`) ON UPDATE CASCADE,
  ADD CONSTRAINT `klienci` FOREIGN KEY (`klienci_id`) REFERENCES `klienci` (`id_klienta`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
