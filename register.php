<?php
session_start();

if ((!isset($_SESSION['udanarejestracja']))) {
  header('Location: zarejestruj-sie');
  exit();
} else {
  unset($_SESSION['udanarejestracja']);
}

// Usuwanie zmiennych pamiętających wartości inputów w rejestracja.php
if (isset($_SESSION['fr_nick'])) {
  unset($_SESSION['fr_nick']);
}

if (isset($_SESSION['fr_email'])) {
  unset($_SESSION['fr_email']);
}

if (isset($_SESSION['fr_haslo1'])) {
  unset($_SESSION['fr_haslo1']);
}

if (isset($_SESSION['fr_haslo2'])) {
  unset($_SESSION['fr_haslo2']);
}

if (isset($_SESSION['fr_regulamin'])) {
  unset($_SESSION['fr_regulamin']);
}

// Usuwanie błędów rejestracji
if (isset($_SESSION['e_nick'])) {
  unset($_SESSION['e_nick']);
}

if (isset($_SESSION['e_email'])) {
  unset($_SESSION['e_email']);
}

if (isset($_SESSION['e_haslo1'])) {
  unset($_SESSION['e_haslo1']);
}

if (isset($_SESSION['e_haslo2'])) {
  unset($_SESSION['e_haslo2']);
}

if (isset($_SESSION['e_regulamin'])) {
  unset($_SESSION['e_regulamin']);
}
if (isset($_SESSION['e_bot'])) {
  unset($_SESSION['e_bot']);
}

// Usuwanie poprawnych wartości rejestracj
if (isset($_SESSION['c_nick'])) {
  unset($_SESSION['c_nick']);
}

if (isset($_SESSION['c_email'])) {
  unset($_SESSION['c_email']);
}

if (isset($_SESSION['c_haslo1'])) {
  unset($_SESSION['c_haslo1']);
}

if (isset($_SESSION['c_haslo2'])) {
  unset($_SESSION['c_haslo2']);
}

if (isset($_SESSION['c_regulamin'])) {
  unset($_SESSION['c_regulamin']);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WORD - Rejestracja ukończona!</title>
  <meta http-equiv="refresh" content="5,url='zaloguj-sie'">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="container">
    <header>Egzamin</header>
    <nav>
      
    </nav>
    <section>
      <form>
        <p>
          Dziękujemy za rejestrację w serwisie! Za <span id="timer">5</span> sek. zostaniesz przeniesiony do formularza logowania. Jeżeli tak się nie stało kliknij w <a href="zaloguj-sie">ten link</a>
        </p>
      </form>
    </section>
  </div>
</body>
<script src="timer.js"></script>

</html>