<?php

session_start();

if (isset($_POST['nick'])) {

    $wszystko_OK = true;

    $nick = $_POST['nick'];
    $nick_pattern = "/^[^0-9]\w+$/";

    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick musi składać się od 3 do 20 znaków";
    } else {
        $_SESSION['c_nick'] = "Nick jest poprawny";
    }

    if (preg_match($nick_pattern, $nick) == false) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick może składać się z liter, cyfr i znaku podkreślenia (bez polskich znaków)";
    } else {
        $_SESSION['c_nick'] = "Nick jest poprawny";
    }

    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    $pat_mal = '/^(?=.*[a-z]).+$/';
    $pat_duz = '/^(?=.*[A-Z]).+$/';
    $pat_cyf = '/^(?=.*\d).+$/';
    $pat_zna = '/^^(?=.*[\W_]).+$/';
    $pat_spa = '/^(?!.*\s).+$/';

    if ((strlen($haslo1) < 8)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać minimalnie 8 znaków";
    } elseif ((strlen($haslo1) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać maksymalnie 20 znaków";
    } elseif (!preg_match($pat_mal, $haslo1)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać przynajmniej 1 małą literę";
    } elseif (!preg_match($pat_duz, $haslo1)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać przynajmniej 1 wielką literę";
    } elseif (!preg_match($pat_cyf, $haslo1)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać przynajmniej 1 cyfrę";
    } elseif (!preg_match($pat_zna, $haslo1)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło musi posiadać przynajmniej 1 dowolny znak specjalny";
    } elseif (!preg_match($pat_spa, $haslo1)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo1'] = "Hasło nie może zawierać spacji";
    } else {
        $_SESSION['c_haslo1'] = "Hasło jest poprawne";
    }

    if ($haslo1 != $haslo2) {
        $wszystko_OK = false;
        $_SESSION['e_haslo2'] = "Hasła nie są identyczne";
    } else {
        $_SESSION['c_haslo2'] = "Hasła są identyczne";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    require_once "connect.php";

    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;

    mysqli_report(MYSQLI_REPORT_STRICT);

    try {

        $polaczenie = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            $rezultat  = $polaczenie->query("select id_user from user where user='$nick'");

            if (!$rezultat) {
                throw new Exception($polaczenie->error);
            }

            $ile_takich_nickow = $rezultat->num_rows;

            if ($ile_takich_nickow > 0) {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = "Istnieje konto przypisane do podanego nicku. Wybierz inny.";
            }

            if ($wszystko_OK == true) {
                if ($polaczenie->query("insert into user values (null, '$nick','$haslo_hash')")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: register.php');
                } else {
                    throw new Exception($polaczenie->error);
                }
            }

            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo "<span style='color: red;'>Błąd serwera! Spróbuj ponownie później</span>";
        //echo "<br />Informacja deweloperska: " . $e;
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egzamin - Zarejestruj się</title>
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
            <h3>
                Utwórz konto aby podejść do egzaminu
            </h3>
            <form method="post">
                <label for="nick">Login: </label><br />
                <input type="text" value="<?php
                                            if (isset($_SESSION['fr_nick']))
                                                echo $_SESSION['fr_nick'];
                                            unset($_SESSION['fr_nick']);
                                            ?>" name="nick" /> <br />
                <?php
                if (isset($_SESSION['e_nick'])) {
                    echo '<div class="error">' . $_SESSION['e_nick'] . '</div>';
                    unset($_SESSION['e_nick']);
                } elseif (isset($_SESSION['c_nick'])) {
                    echo '<div class="correct">' . $_SESSION['c_nick'] . '</div>';
                    unset($_SESSION['c_nick']);
                }
                ?>
                <label for="haslo1">Hasło: </label><br />
                <input type="password" value="<?php
                                                if (isset($_SESSION['fr_haslo1']))
                                                    echo $_SESSION['fr_haslo1'];
                                                unset($_SESSION['fr_haslo1']);
                                                ?>" name="haslo1" /> <br />
                <?php
                if (isset($_SESSION['e_haslo1'])) {
                    echo '<div class="error">' . $_SESSION['e_haslo1'] . '</div>';
                    unset($_SESSION['e_haslo1']);
                } elseif (isset($_SESSION['c_haslo1'])) {
                    echo '<div class="correct">' . $_SESSION['c_haslo1'] . '</div>';
                    unset($_SESSION['c_haslo1']);
                }
                ?>
                <label for="haslo2">Powtórz hasło:</label><br />
                <input type="password" value="<?php
                                                if (isset($_SESSION['fr_haslo2']))
                                                    echo $_SESSION['fr_haslo2'];
                                                unset($_SESSION['fr_haslo2']);
                                                ?>" name="haslo2" /> <br />
                <?php
                if (isset($_SESSION['e_haslo2'])) {
                    echo '<div class="error">' . $_SESSION['e_haslo2'] . '</div>';
                    unset($_SESSION['e_haslo2']);
                } elseif (isset($_SESSION['c_haslo2'])) {
                    echo '<div class="correct">' . $_SESSION['c_haslo2'] . '</div>';
                    unset($_SESSION['c_haslo2']);
                }
                ?><br />
                <input type="submit" value="Zarejestruj się" />
                <p>Masz już konto? <a href="login.php">Kliknij ten link</a></p>
            </form>
        </section>
    </div>
</body>

</html>