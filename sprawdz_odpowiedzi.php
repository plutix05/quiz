<?php

session_start();

if (!isset($_SESSION['zalogowany_user'])) {
    header("Location: login_user.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamin INF.03 - odpowiedzi</title>
</head>

<body>
    <nav>
        <a href="user.php">Konto</a>
        <a href="egzamin.php">Egzamin</a>
        <a href="wyniki.php">Wyniki</a>
        <a href="logout_user.php">Wyloguj się</a>
    </nav>
    <p>
        Oto twój wynik <?php echo $_SESSION['user'] ?>. Wynik został wysłany do bazy danych
    </p>
    <?php
    // Połączenie z bazą danych
    require_once "connect.php";

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    // Sprawdź połączenie
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Zmienna przechowująca liczbę poprawnych odpowiedzi
    $liczbaPoprawnych = 0;

    // Tablica do przechowywania odpowiedzi użytkownika
    $odpowiedziUzytkownika = [];

    // Sprawdzenie odpowiedzi użytkownika
    foreach ($_POST as $key => $value) {
        // Sprawdź czy klucz zaczyna się od 'q' (oznacza to pytanie)
        if (substr($key, 0, 1) === 'q') {
            // Pobierz numer pytania
            $numerPytania = intval(substr($key, 1));

            // Pobierz poprawną odpowiedź z bazy danych
            $sql = "SELECT pop_odp, tresc, a, b, c, d FROM pytania WHERE nr_pyt = $numerPytania";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $poprawnaOdpowiedz = $row['pop_odp'];

                // Dodaj odpowiedź użytkownika i poprawną odpowiedź do tablicy
                $odpowiedziUzytkownika[$numerPytania] = [
                    'numer_porządkowy' => $numerPytania, // Dodaj numer porządkowy
                    'tresc' => $row['tresc'],
                    'odp_uzytkownika' => $value,
                    'poprawna_odp' => $poprawnaOdpowiedz,
                    'a' => $row['a'],
                    'b' => $row['b'],
                    'c' => $row['c'],
                    'd' => $row['d']
                ];

                // Sprawdź czy odpowiedź użytkownika jest poprawna
                if ($value === $poprawnaOdpowiedz) {
                    $liczbaPoprawnych++;
                }
            }
        }
    }

    // Wyświetl wyniki
    echo "<p>Liczba poprawnych odpowiedzi: $liczbaPoprawnych</p>";

    // Oblicz procent poprawnych odpowiedzi
    $procentPoprawnych = ($liczbaPoprawnych / 40) * 100;
    $procentPoprawnych = round($procentPoprawnych);
    $_SESSION['pop'] = $procentPoprawnych;
    // Wyświetl wynik procentowy
    echo "<p>Wynik procentowy: $procentPoprawnych%</p>";

    // Wyświetl komunikat w zależności od wyniku procentowego
    if ($procentPoprawnych >= 50) {
        echo "<p>Brawo, zdałeś!</p>";
    } else {
        echo "<p>Przykro mi, nie zdałeś.</p>";
    }

    // Wyświetl odpowiedzi użytkownika i poprawne odpowiedzi w tabelce
    echo "<table border='1'>
        <tr>
            <th>Nr pytania</th>
            <th>Treść pytania</th>
            <th>Odpowiedź użytkownika</th>
            <th>Poprawna odpowiedź</th>
        </tr>";

    foreach ($odpowiedziUzytkownika as $numerPytania => $odpowiedz) {
        echo "<tr>
            <td>{$odpowiedz['numer_porządkowy']}</td>
            <td>{$odpowiedz['tresc']}</td>
            <td>{$odpowiedz['odp_uzytkownika']}</td>
            <td>{$odpowiedz['poprawna_odp']}</td>
        </tr>";
    }

    echo "</table>";

    $sql2 = "INSERT INTO wyniki VALUES(null, '{$_SESSION['user']}', now(),'{$_SESSION['pop']}')";
    $q1 = $conn->query($sql2);
    // Zamknij połączenie
    $conn->close();
    ?>


</body>

</html>