<?php
session_start();

// if ((!isset($_SESSION['udanarejestracja']))) {
//   header('Location: signup.php');
//   exit();
// } else {
//   unset($_SESSION['udanarejestracja']);
// }

// Usuwanie zmiennych pamiętających wartości inputów w rejestracja.php
if (isset($_SESSION['fr_nick'])) {
  unset($_SESSION['fr_nick']);
}

if (isset($_SESSION['fr_haslo1'])) {
  unset($_SESSION['fr_haslo1']);
}

if (isset($_SESSION['fr_haslo2'])) {
  unset($_SESSION['fr_haslo2']);
}

// Usuwanie błędów rejestracji
if (isset($_SESSION['e_nick'])) {
  unset($_SESSION['e_nick']);
}


if (isset($_SESSION['e_haslo1'])) {
  unset($_SESSION['e_haslo1']);
}

if (isset($_SESSION['e_haslo2'])) {
  unset($_SESSION['e_haslo2']);
}

// Usuwanie poprawnych wartości rejestracj
if (isset($_SESSION['c_nick'])) {
  unset($_SESSION['c_nick']);
}

if (isset($_SESSION['c_haslo1'])) {
  unset($_SESSION['c_haslo1']);
}

if (isset($_SESSION['c_haslo2'])) {
  unset($_SESSION['c_haslo2']);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Egzamin - Rejestracja ukończona!</title>
  <meta http-equiv="refresh" content="5,url='login_user.php'">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="container">
    <h1>
      Egzamin INF.03
    </h1>
    <nav>
      <a href="index.html">Strona główna</a>
      <a href="login_user.php">Egzamin</a>
      <a href="login.php">Admin</a>
    </nav><br>
    <section>
      <form>
        <p>
          Dziękujemy za rejestrację w serwisie! Za <span id="timer">5</span> sek. zostaniesz przeniesiony do formularza logowania. Jeżeli tak się nie stało kliknij w <a href="login_user.php">ten link</a>
        </p>
      </form>
    </section>
  </div>
</body>
<script src="timer.js"></script>

</html>