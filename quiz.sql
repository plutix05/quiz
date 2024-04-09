-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Mar 2024, 12:40
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `quiz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `confirm` enum('confirmed','unconfirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id_admin`, `user`, `pass`, `confirm`) VALUES
(1, 'admin', '$2y$10$UVO4rrAvgZlB50.E8D6FVuod0Tj26D/uTmjAG/vHq4Z8NjTTZXyh6', 'confirmed');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id_pyt` int(2) NOT NULL,
  `nr_pyt` int(11) NOT NULL,
  `tresc` varchar(230) DEFAULT NULL,
  `obraz` varchar(64) DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `pop_odp` varchar(5) DEFAULT NULL,
  `kategoria` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pytania`
--

INSERT INTO `pytania` (`id_pyt`, `nr_pyt`, `tresc`, `obraz`, `a`, `b`, `c`, `d`, `pop_odp`, `kategoria`) VALUES
(1, 1, 'Język JavaScript ma obsługę', NULL, 'obiektów DOM', 'klas abstrakcyjnych', 'wysyłania ciastek z tą samą informacją do wielu klientów strony', 'funkcji wirtualnych', 'a', 'JS'),
(2, 2, 'W języku HTML, aby zdefiniować hiperłącze otwierające się w osobnej karcie przeglądarki, należy zastosować atrybut', NULL, 'target = \"_blank\"', 'rel = \"external\"', 'target = \"_new\"', 'rel = \"prev\"', 'a', 'HTML'),
(3, 3, 'Kod języka CSS można umieścić wewnątrz kodu HTML, posługując się znacznikiem', NULL, '<style>', '<meta>', '<body>', '<head>', 'a', 'HTML'),
(4, 4, 'Selektor CSS a:link {color:red} zawarty w kaskadowych arkuszach stylów definiuje', NULL, 'identyfikator', 'pseudoelement', 'klasę', 'pseudoklasę', 'd', 'CSS'),
(5, 5, 'Wskaż komentarz wieloliniowy w języku PHP', NULL, '//', '<!-- -->', '/* */', '#', 'c', 'PHP'),
(6, 6, 'W języku JavaScript, aby sprawdzić warunek czy liczba znajduje się w przedziale (100;200>, należy zapisać:', NULL, 'if (liczba < 100 && liczba <= 200)', 'if (liczba > 100 || liczba <= 200)', 'if (liczba > 100 && liczba <= 200)', 'if (liczba < 100 || liczba >= 200)', 'c', 'JS'),
(7, 7, 'Która z przedstawionych grup znaczników HTML zawiera znaczniki służące do grupowania elementów i tworzenia struktury dokumentu?', NULL, 'table, tr, td', 'div, article, header', 'span, strong, em', 'br, img, hr', 'b', 'HTML'),
(8, 8, 'W instrukcji warunkowej języka JavaScript należy sprawdzić przypadek, gdy wartość zmiennej a jest z przedziału (0, 100), natomiast wartość zmiennej b jest większa od zera. Warunek taki jest prawidłowo zapisany w nastepujący sposób', NULL, 'if ((a>0 && a<100) || b<0)', 'if ((a>0 && a<100) || b>0)', 'if (a>0 || a<100 || b<0)', 'if ((a>0 || a<100) && b>0)', 'b', 'JS'),
(9, 9, 'W języku HTML 5 atrybut action stosowany jest w znaczniku', NULL, '<body>', '<form>', '<code>', '<head>', 'b', 'HTML'),
(10, 10, 'W języku CSS zdefiniowano formatowanie dla stopki. Aby użyć tego formatowania dla bloku opisanego znacznikiem div, należy zapisać', NULL, '<div id=\"stopka\">', '<div class=\"stopka\">', '<div title=\"stopka\">', '<div \"stopka\">', 'a', 'CSS'),
(11, 11, 'Aby użyć zewnętrznego skryptu JavaScript o nazwie skrypt.js, należy zapisać w kodzie HTML', NULL, '<link rel=\"script\" href=\"skrypt.js\" />', '<script src=\"skrypt.js\"></script>', '<link rel=\"JavaScript\" type=\"js\" href=\"skrypt.js\" />', '<script> skrypt.js </script>', 'b', 'HTML'),
(12, 12, 'Strona HTML definiuje akapit oraz rysunek. Aby rysunek został umieszczony przez przeglądarkę w tej samej linii co akapit po jego lewej stronie, należy w stylu CSS rysunku zawrzeć własność', NULL, 'align:left;', 'float:left;', 'alt:left;', 'style:left;', 'b', 'CSS'),
(13, 13, 'Który z wymienionych znaczników języka HTML nie jest stosowany w celu formatowania tekstu?', NULL, '<em>', '<strong>', '<div>', '<sub>', 'c', 'HTML'),
(14, 14, 'W języku PHP zmienna $_SERVER przechowuje między innymi informacje o', NULL, 'nazwie ciasteczek zapisanych na serwerze i danych z nimi związanych.', 'adresie IP serwera, nazwie protokołu.', 'danych dotyczących sesji.', 'danych formularza przetwarzanego na serwerze.', 'b', 'PHP'),
(15, 15, 'Poprzez deklarację var x=\"true\"; w języku JavieScript tworzy się zmienną typu', NULL, 'Logicznego', 'String (ciąg znaków)', 'Nieokreślonego (undefined)', 'Liczbowego', 'b', 'JS'),
(16, 16, 'W języku HTML informacje dotyczące autora, streszczenia i słów kluczowych strony należy umieścić', NULL, 'pomiędzy znacznikami <body> i </body>, w znaczniku <html>', 'pomiędzy znacznikami <head> i </head>, w znaczniku <style>', 'pomiędzy znacznikami <head> i </head>, w znaczniku <meta>', 'pomiędzy znacznikami <body> i </body>, w znaczniku <meta>', 'c', 'HTML'),
(17, 17, 'Kolor zapisany w notacji heksadecymalnej #0000FF to', NULL, 'czerwony', 'niebieski', 'zielony', 'czarny', 'b', 'CSS'),
(18, 18, 'Wskaż prawidłową kolejność stylów CSS mając na uwadze ich pierwszeństwo w formatowaniu elementów strony WWW.', NULL, 'Lokalny, Wewnętrzny, Zewnętrzny', 'Wewnętrzny, Zewnętrzny, Rozciąganie stylu', 'Rozciąganie stylu, Zewnętrzny, Lokalny', 'Zewnętrzny, Wydzielone bloki, Lokalny', 'a', 'CSS'),
(19, 19, 'W języku JavaScript metoda document.getElementById(id) ma za zadanie', NULL, 'zwrócić odniesienie do pierwszego elementu HTML o podanym id', 'sprawdzić poprawność formularza o identyfikatorze id', 'pobrać dane z pola formularza i wstawić je do zmiennej id', 'wstawić tekst o treści ’id’ na stronie WWW', 'a', 'JS'),
(20, 20, 'Wskaż poprawny zapis instrukcji zapisanej w języku JavaScript.', NULL, 'document.write(\"Liczba π z dokładnością do 2 miejsc po przecinku ≈ \" + 3.14 );', 'document.write(\"Liczba π z dokładnością do 2 miejsc po przecinku ≈ \" ; 3.14 );', 'document.write(\"Liczba π z dokładnością do 2 miejsc po przecinku ≈ \" . 3.14 );', 'document.write(\"Liczba π z dokładnością do 2 miejsc po przecinku ≈ \" 3.14 );', 'a', 'JS'),
(21, 21, 'Kolorem o barwie niebieskiej jest kolor', NULL, '#0000EE', '#EE0000', '#EE00EE', '#00EE00', 'a', 'CSS'),
(22, 22, 'Wykonanie kodu JavaScript w przeglądarce wymaga', NULL, 'interpretowania', 'debugowania', 'zamiany na kod maszynowy', 'kompilowania', 'a', 'JS'),
(23, 23, 'Tworzenie i przypisanie do zmiennej tablicy asocjacyjnej zrealizuje się w PHP zapisem', NULL, '$tab = array (array (1, 2), array (3, 4));', '$tab = array (); $tab[] = array (1, 2, 3, 4);', '$tab = array (1, 2, 3, 4);', '$tab = array (\"a\" => 1, \"b\" => 2, \"c\" => 3);', 'd', 'PHP'),
(24, 24, 'Komentarz w języku JavaScript rozpoczyna się od znaku lub znaków', NULL, '<!--', '#', '//', '<?', 'c', 'JS'),
(25, 25, 'W języku JavaScript zadeklarowana zmienna i, która ma przechowywać wynik dzielenia wynoszący 1, to', NULL, 'var i = parseFloat(3/2);', 'var i = Number(3/2);', 'var i = 3/2;', 'var i = parseInt(3/2);', 'd', 'JS'),
(26, 26, 'W języku JavaScript zdefiniowano obiekt Samochod. Aby wywołać jedną z metod tego obiektu, należy zapisać', NULL, 'Samochod.()', 'Samochod.spalanie()', 'Samochod.kolor', 'Samochod.spalanie_na100', 'b', 'JS'),
(27, 27, 'Które polecenie w CSS służy do załączenia zewnętrznego arkusza stylów?', NULL, 'require', 'include', 'import', 'open', 'c', 'CSS'),
(28, 28, 'Który fragment kodu JavaScript zwróci wartość true?', NULL, '\"a\" > \"b\"', '\"abc\" > \"def\"', '\"def\" > \"abc\"', '\"ab\" > \"c\"', 'c', 'JS'),
(29, 29, 'Którego znacznika NIE NALEŻY umieszczać w nagłówku dokumentu HTML?', NULL, '<title>', '<h2>', '<meta>', '<link>', 'b', 'HTML'),
(30, 30, 'Która z przedstawionych funkcji języka PHP zamieni słowo \"kota\" na słowo \"mysz\" w napisie \"ala ma kota\"?', NULL, 'str_replace(\"ala ma kota\", \"kota\", \"mysz\");', 'str_replace( \"kota\", \"mysz\", \"ala ma kota\");', 'replace(\"ala ma kota\", \"kota\", \"mysz\");', 'replace(\"kota\", \"mysz\", \"ala ma kota\");', 'b', 'PHP'),
(31, 31, 'Aby zdefiniować krój czcionki w stylu CSS, należy użyć właściwości', NULL, 'text-style', 'text-family', 'font-style', 'font-family', 'd', 'CSS'),
(32, 32, 'Kolor zapisany w postaci szesnastkowej o wartości #11FE07 w kodzie RGB ma postać', NULL, 'rgb(17,254,7)', 'rgb(11,127,7)', 'rgb(17,255,7)', 'rgb(17,FE,7)', 'a', 'CSS'),
(33, 33, 'Na rysunku przedstawiono strukturę bloków strony internetowej. Który z fragmentów formatowania strony pasuje do takiego układu? (Dla uproszczenia pominięto właściwości koloru tła, wysokości i czcionki)', 'photo1.png', '#pierwszy{float:left; width:30%;} #drugi {clear:both; width:70%;} #trzeci {cle', '#pierwszy { width: 30%; } #drugi { width: 70%; } #trzeci { width: 70%; } #czwa', '#pierwszy {float:left; width:30%;} #drugi {float:left; width:70%;} #trzeci {fl', '#pierwszy {float:left; width:30%; } #drugi {clear:both; width:70%; } #trzeci', 'c', 'CSS'),
(34, 34, 'W języku PHP funkcja trim ma za zadanie', NULL, 'Podawać długość napisu', 'Usuwać białe znaki lub inne znaki podane w parametrze, z obu końców napisu', 'Zmniejszać napis o wskazaną w parametrze liczbę znaków', 'Porównywać dwa napisy i wypisać część wspólną', 'b', 'PHP'),
(35, 35, 'W języku PHP funkcja, która może służyć do sprawdzenia, czy dany ciąg jest fragmentem innego ciągu, to', NULL, 'trim();', 'strstr();', 'strtok();', 'strtik();', 'b', 'PHP'),
(36, 36, 'Wskaż poprawny składniowo warunek zapisany w języku PHP i sprawdzający brak połączenia z bazą MySQL.', NULL, 'if (mysql_connect_error())()', 'if {mysql_connect_errno()}{}', 'if (mysqli_connect_errno()){}', 'if {mysqli_connect_error()}{}', 'c', 'PHP'),
(37, 37, 'Funkcją języka PHP tworzącą ciasteczko jest', NULL, 'setcookie()', 'createcookie()', 'addcookie()', 'echocookie()', 'a', 'PHP'),
(38, 38, 'Wskaż wszystkie znaki umożliwiające komentowanie kodu języku PHP.', NULL, '/* */ oraz // oraz #', '/* */ oraz <!-- -->', '<?php ?> oraz //', 'jedynie /* */', 'a', 'PHP'),
(39, 39, 'Język PHP posiada obsługę', NULL, 'sesji i ciastek.', 'zdarzeń klawiatury.', 'obiektów przeglądarki.', 'zdarzeń myszy.', 'a', 'PHP'),
(40, 40, 'Która ze zdefiniowanych funkcji w języku PHP jako wynik zwraca połowę kwadratu wartości przekazanej?', NULL, 'function licz($a) { return $a*$a/2; }', 'function licz($a) { echo $a/2; }', 'function licz($a) { return $a/2; }', 'function licz($a) { echo $a*$a/2; }', 'a', 'PHP');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`) VALUES
(1, 'user', '$2y$10$UVO4rrAvgZlB50.E8D6FVuod0Tj26D/uTmjAG/vHq4Z8NjTTZXyh6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki`
--

CREATE TABLE `wyniki` (
  `id_wynik` int(11) NOT NULL,
  `user` text NOT NULL,
  `data` date NOT NULL,
  `wynik` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id_pyt`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeksy dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  ADD PRIMARY KEY (`id_wynik`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id_pyt` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  MODIFY `id_wynik` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
