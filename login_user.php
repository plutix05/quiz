<?php


session_start();

if ((isset($_SESSION['zalogowany_user'])) && ($_SESSION['zalogowany_user'] == true)) {
    header('Location: user.php');
    exit();
}

if (isset($_POST['login'])) {
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);

        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];

            $login = htmlentities($login, ENT_QUOTES, "UTF-8");

            if ($rezultat = $polaczenie->query(
                sprintf(
                    "SELECT * FROM user WHERE user='%s'",
                    mysqli_real_escape_string($polaczenie, $login)
                )
            )) {
                $ilu_userow = $rezultat->num_rows;
                if ($ilu_userow > 0) {
                    $wiersz = $rezultat->fetch_assoc();

                    if (password_verify($haslo, $wiersz['pass'])) {
                        $_SESSION['zalogowany_user'] = true;
                        $_SESSION['id'] = $wiersz['id_admin'];
                        $_SESSION['user'] = $wiersz['user'];
                        unset($_SESSION['blad']);
                        $rezultat->free_result();
                        header('Location: user.php');
                    } else {
                        $_SESSION['blad'] = '<span style="color:red">Nieprawidłowe hasło!</span>';
                        header('Location: login_user.php');
                        exit();
                    }
                } else {

                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login</span>';
                    header('Location: login_user.php');
                    exit();
                }
            } else {
                throw new Exception($polaczenie->error);
            }

            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Spróbuj ponownie później!</span>';
        //echo '<br />Informacja developerska: ' . $e;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egzamin - zaloguj się do swojego konta</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav>
        <a href="index.html">Strona główna</a>
        <a href="login_user.php">Egzamin</a>
        <a href="login.php">Admin</a>
    </nav>
    <section>
        <h1>
            Zaloguj się na swoje konto
        </h1>
        <form method="post">
            <label for="login">Login:</label><br>
            <input type="text" name="login"><br>
            <label for="haslo">Hasło:</label><br>
            <input type="password" name="haslo"><br><br>
            <input type="submit" value="Zaloguj się"><br>
            <?php
            if (isset($_SESSION['blad'])) {
                echo $_SESSION['blad'];
                unset($_SESSION['blad']);
            }
            ?>
        </form>
        <p>Nie masz konta? <a href="signup.php">Zarejestruj się!</a></p>
    </section>
</body>

</html>