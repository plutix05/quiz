<?php
session_start();

if ((!isset($_SESSION['add_complete']))) {
    header('Location: add.php');
    exit();
} else {
    unset($_SESSION['add_complete']);
}

// Usuwanie zmiennych pamiętających wartości inputów w rejestracja.php
if (isset($_SESSION['fr_tresc'])) {
    unset($_SESSION['fr_tresc']);
}

if (isset($_SESSION['fr_obraz'])) {
    unset($_SESSION['fr_obraz']);
}

if (isset($_SESSION['fr_a'])) {
    unset($_SESSION['fr_a']);
}

if (isset($_SESSION['fr_b'])) {
    unset($_SESSION['fr_b']);
}

if (isset($_SESSION['fr_d'])) {
    unset($_SESSION['fr_d']);
}

if (isset($_SESSION['fr_pop'])) {
    unset($_SESSION['fr_pop']);
}

if (isset($_SESSION['fr_kat'])) {
    unset($_SESSION['fr_kat']);
}

// Usuwanie błędów rejestracji
if (isset($_SESSION['e_tresc'])) {
    unset($_SESSION['e_tresc']);
}

if (isset($_SESSION['e_obraz'])) {
    unset($_SESSION['e_obraz']);
}

if (isset($_SESSION['e_a'])) {
    unset($_SESSION['e_a']);
}

if (isset($_SESSION['e_b'])) {
    unset($_SESSION['e_b']);
}

if (isset($_SESSION['e_d'])) {
    unset($_SESSION['e_d']);
}

if (isset($_SESSION['e_pop'])) {
    unset($_SESSION['e_pop']);
}

if (isset($_SESSION['e_kat'])) {
    unset($_SESSION['e_kat']);
}

// Usuwanie poprawnych wartości rejestracj
if (isset($_SESSION['c_tresc'])) {
    unset($_SESSION['c_tresc']);
}

if (isset($_SESSION['c_obraz'])) {
    unset($_SESSION['c_obraz']);
}

if (isset($_SESSION['c_a'])) {
    unset($_SESSION['c_a']);
}

if (isset($_SESSION['c_b'])) {
    unset($_SESSION['c_b']);
}

if (isset($_SESSION['c_d'])) {
    unset($_SESSION['c_d']);
}

if (isset($_SESSION['c_pop'])) {
    unset($_SESSION['c_pop']);
}

if (isset($_SESSION['c_kat'])) {
    unset($_SESSION['c_kat']);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egzamin - dodawanie zakończone</title>
    <meta http-equiv="refresh" content="5,url='add.php'">
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
                    Udało się dodać pytanie! Za <span id="timer">5</span> sek. zostaniesz przeniesiony do panelu dodawania pytań. Jeżeli tak się nie stało kliknij w <a href="add.php">ten link</a>
                </p>
            </form>
        </section>
    </div>
</body>
<script src="timer.js"></script>

</html>