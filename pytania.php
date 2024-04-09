<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista pytań</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="admin.php">Konto</a>
        <a href="pytania.php">Zarządzanie pytaniami</a>
        <a href="logout.php">Wyloguj się</a>
    </nav>
    <section>
        <p>
        <h3><a href="add.php">Dodaj pytanie</a></li>
        </h3>
        </p>
        <table>
            <caption>
                Lista pytań
            </caption>
            <tr>
                <th>Nr</th>
                <th>Treść</th>
                <th>Zdjęcie</th>
                <th>Odp. A</th>
                <th>Odp. B</th>
                <th>Odp. C</th>
                <th>Odp. D</th>
                <th>Pop. odp</th>
                <th>Kategoria</th>
                <th colspan="2">Operacje</th>
            </tr>

            <?php
            require_once 'connect.php';

            $conn = new mysqli($host, $db_user, $db_pass, $db_name);

            $sql1 = "SELECT * FROM pytania";
            $q1 = $conn->query($sql1);

            if ($q1->num_rows > 0) {
                while ($fa = $q1->fetch_assoc()) {
                    echo "<tr>
                    <td>{$fa['nr_pyt']}</td>
                    <td>" . htmlspecialchars($fa['tresc']) . "</td>
                    <td>" . htmlspecialchars($fa['obraz']) . "</td>
                    <td>" . htmlspecialchars($fa['a']) . "</td>
                    <td>" . htmlspecialchars($fa['b']) . "</td>
                    <td>" . htmlspecialchars($fa['c']) . "</td>
                    <td>" . htmlspecialchars($fa['d']) . "</td>
                    <td>" . htmlspecialchars($fa['pop_odp']) . "</td>
                    <td>" . htmlspecialchars($fa['kategoria']) . "</td>
                    <td><a href='modify.php?id={$fa['id_pyt']}'>Modyfikuj</a></td>
                    <td><a href='delete.php?id={$fa['id_pyt']}'>Usuń</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Brak wyników</td></tr>";
            }
            $conn->close();

            ?>
        </table>
    </section>
</body>

</html>