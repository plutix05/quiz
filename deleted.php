<?php
session_start();

if ((!isset($_SESSION['deleted']))) {
    header('Location: pytania.php');
    exit();
} else {
    unset($_SESSION['deleted']);
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egzamin - usuwanie zakończone</title>
    <meta http-equiv="refresh" content="5,url='pytania.php'">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div id="container">
        <header>Egzamin</header>
        <nav>
            <a href="admin.php">Konto</a>
            <a href="pytania.php">Zarządzanie pytaniami</a>
            <a href="logout.php">Wyloguj się</a>
        </nav>
        <section>
            <form>
                <p>
                    Udało się usunąć pytanie! Za <span id="timer">5</span> sek. zostaniesz przeniesiony do listy pytań. Jeżeli tak się nie stało kliknij w <a href="pytania.php">ten link</a>
                </p>
            </form>
        </section>
    </div>
</body>
<script src="timer.js"></script>

</html>