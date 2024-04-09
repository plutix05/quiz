<?php

session_start();

if (!isset($_SESSION['zalogowany_user'])) {
    header("Location: login_user.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamin - użytkownik <?php echo $_SESSION['user'] ?></title>
</head>

<body>
    <nav>
        <a href="user.php">Konto</a>
        <a href="egzamin.php">Egzamin</a>
        <a href="wyniki.php">Wyniki</a>
        <a href="logout_user.php">Wyloguj się</a>
    </nav>
    <h1>
        Wyniki <?php echo $_SESSION['user'] ?>
    </h1>
    <table>
        <tr>
            <td>Data</td>
            <td>Wynik</td>
        </tr>
        <?php

        require_once 'connect.php';

        $conn = new mysqli($host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM wyniki where user='{$_SESSION['user']}'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['data']}</td>
                <td>{$row['wynik']}%</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Brak wyników</td></tr>";
        }

        $conn->close();
        ?>
    </table>

</body>

</html>