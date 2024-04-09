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
    <title>Egzamin </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="user.php">Konto</a>
        <a href="egzamin.php">Egzamin</a>
        <a href="wyniki.php">Wyniki</a>
        <a href="logout_user.php">Wyloguj się</a>
    </nav>
    <h3>Użytkownik <?php echo $_SESSION['user'] ?></h3>
    <?php
    require_once "connect.php";

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Zapytanie SQL do pobrania wszystkich pytań z bazy danych
    $sql = "SELECT * FROM pytania ORDER BY RAND() LIMIT 40";
    $result = $conn->query($sql);

    // Sprawdź, czy zapytanie zwróciło wyniki
    if ($result->num_rows > 0) {
        // Wyświetl pytania w formie formularza
        echo '<form method="post" action="sprawdz_odpowiedzi.php">';
        echo '<ol>'; // Otwarcie listy numerowanej

        while ($row = $result->fetch_assoc()) {
            echo '<li>'; // Otwarcie elementu listy
            echo '<p><b>' . htmlspecialchars($row['tresc']) . '</b></p>';

            // Wyświetl zdjęcie, jeśli istnieje
            if (!empty($row['obraz'])) {
                echo '<img src="photos/' . $row['obraz'] . '">';
            }

            echo '<p><input type="radio" name="q' . $row['nr_pyt'] . '" value="a">A ' . htmlspecialchars($row['a']) . '</p>';
            echo '<p><input type="radio" name="q' . $row['nr_pyt'] . '" value="b">B ' . htmlspecialchars($row['b']) . '</p>';
            echo '<p><input type="radio" name="q' . $row['nr_pyt'] . '" value="c">C ' . htmlspecialchars($row['c']) . '</p>';
            echo '<p><input type="radio" name="q' . $row['nr_pyt'] . '" value="d">D ' . htmlspecialchars($row['d']) . '</p>';
            echo '</li><hr />'; // Zamknięcie elementu listy
        }

        echo '</ol>'; // Zamknięcie listy numerowanej
        echo '<input type="submit" value="Sprawdź odpowiedzi">';
        echo '</form>';
    } else {
        echo "Brak pytań w bazie danych.";
    }

    // Zamknij połączenie
    $conn->close();
    ?>
</body>

</html>