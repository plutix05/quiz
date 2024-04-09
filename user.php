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
        Witaj <?php echo $_SESSION['user'] ?>
    </h1>
</body>

</html>