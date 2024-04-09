<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamin - panel administracyjny</title>
</head>

<body>
    <nav>
        <a href="admin.php">Konto</a>
        <a href="pytania.php">Zarządzanie pytaniami</a>
        <a href="logout.php">Wyloguj się</a>
    </nav>
    <h1>
        Witaj w panelu admina, <?php echo $_SESSION['user'] ?>
    </h1>
</body>

</html>