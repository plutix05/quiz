<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['tresc'])) {

    $wszystko_ok = true;

    $tresc = $_POST['tresc'];
    if (strlen($tresc) < 10 || strlen($tresc) > 255) {
        $wszystko_ok = false;
        $_SESSION['e_tresc'] = "Pytanie musi składać się z minimum 10 znaków i maksymalnie 255 znaków";
    } else {
        $_SESSION['c_tresc'] = "Pytanie poprawne";
    }

    // Sprawdź, czy plik został przesłany
    if (!empty($_FILES['obraz']['name'])) {
        $obraz_tmp = $_FILES['obraz']['tmp_name'];
        $obraz_nazwa = basename($_FILES['obraz']['name']);
        $obraz_folder = "photos/";
        $obraz_sciezka = $obraz_folder . $obraz_nazwa;

        // Przenieś przesłane zdjęcie do folderu "photos"
        move_uploaded_file($obraz_tmp, $obraz_sciezka);
    } else {
        // Jeśli nie przesłano zdjęcia, ustaw ścieżkę na null
        $obraz_nazwa = null;
    }

    $a = $_POST['a'];
    if (strlen($a) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_a'] = "Nie podano odpowiedzi A";
    } elseif (strlen($a) > 255) {
        $wszystko_ok = false;
        $_SESSION['e_a'] = "Odpowiedź jest za długa. Musi składać się maksymalnie z 255 znaków";
    } else {
        $_SESSION['c_a'] = "Odpowiedź akceptowalna";
    }

    $b = $_POST['b'];
    if (strlen($b) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_b'] = "Nie podano odpowiedzi B";
    } elseif (strlen($b) > 255) {
        $wszystko_ok = false;
        $_SESSION['e_b'] = "Odpowiedź jest za długa. Musi składać się maksymalnie z 255 znaków";
    } else {
        $_SESSION['c_b'] = "Odpowiedź akceptowalna";
    }

    $c = $_POST['c'];
    if (strlen($c) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_c'] = "Nie podano odpowiedzi C";
    } elseif (strlen($c) > 255) {
        $wszystko_ok = false;
        $_SESSION['e_c'] = "Odpowiedź jest za długa. Musi składać się maksymalnie z 255 znaków";
    } else {
        $_SESSION['c_c'] = "Odpowiedź akceptowalna";
    }

    $d = $_POST['d'];
    if (strlen($d) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_d'] = "Nie podano odpowiedzi D";
    } elseif (strlen($d) > 255) {
        $wszystko_ok = false;
        $_SESSION['e_d'] = "Odpowiedź jest za długa. Musi składać się maksymalnie z 255 znaków";
    } else {
        $_SESSION['c_d'] = "Odpowiedź akceptowalna";
    }

    $pop_odp = $_POST['pop_odp'];
    if ($pop_odp == "null") {
        $wszystko_ok = false;
        $_SESSION['e_pop'] = "Wskaż poprawną odpowiedź";
    } else {
        $_SESSION['c_pop'] = "Wskazano poprawną odpowiedź";
    }

    $kategoria = $_POST['kategoria'];
    if ($kategoria == "null") {
        $wszystko_ok = false;
        $_SESSION['e_kat'] = "Wskaż kategorię";
    } else {
        $_SESSION['c_kat'] = "Wskazano kategorię";
    }

    $_SESSION['fr_tresc'] = $tresc;
    $_SESSION['fr_obraz'] = $obraz_sciezka;
    $_SESSION['fr_a'] = $a;
    $_SESSION['fr_b'] = $b;
    $_SESSION['fr_c'] = $c;
    $_SESSION['fr_d'] = $d;
    $_SESSION['fr_pop'] = $pop_odp;
    $_SESSION['fr_kat'] = $kategoria;

    try {

        require_once "connect.php";

        $conn = new mysqli($host, $db_user, $db_pass, $db_name);

        if ($conn->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            if ($wszystko_ok == true) {
                $sqlMaxNr = "SELECT MAX(nr_pyt) AS max_nr FROM pytania";
                $resultMaxNr = $conn->query($sqlMaxNr);

                if ($resultMaxNr && $rowMaxNr = $resultMaxNr->fetch_assoc()) {
                    $maxNr = $rowMaxNr['max_nr'];
                    $nextNr = $maxNr + 1;
                }

                if ($obraz_nazwa == null) {
                    $sqlInsert = "INSERT INTO pytania VALUES (null, $nextNr, '$tresc', null, '$a','$b','$c','$d','$pop_odp','$kategoria')";
                    $q = $conn->query($sqlInsert);

                    if ($q) {
                        $_SESSION['add_complete'] = true;
                        header('Location: added.php');
                    } else {
                        throw new Exception($conn->error);
                    }
                } elseif ($obraz_nazwa !== null) {
                    $sqlInsert2 = "INSERT INTO pytania VALUES (null, $nextNr, '$tresc','$obraz_nazwa', '$a','$b','$c','$d','$pop_odp','$kategoria')";
                    $q2 = $conn->query($sqlInsert2);

                    if ($q2) {
                        $_SESSION['add_complete'] = true;
                        header('Location: added.php');
                    } else {
                        throw new Exception($conn->error);
                    }
                } else {
                    throw new Exception($conn->error);
                }
            }
        }
    } catch (Exception $e) {
        echo "Błąd Serwera! <br />";
        //echo "Develop info: " . $e;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <a href="admin.php">Konto</a>
        <a href="pytania.php">Zarządzanie pytaniami</a>
        <a href="logout.php">Wyloguj się</a>
    </nav>
    <div class='error'></div>
    <h3>
        Dodaj pytanie
    </h3>
    <form method="post" enctype="multipart/form-data">
        <label for="tresc">Treść:</label><br />
        <textarea name="tresc" cols="30" rows="9" maxlength="255"><?php
                                                                    if (isset($_SESSION['fr_tresc']))
                                                                        echo $_SESSION['fr_tresc'];
                                                                    unset($_SESSION['fr_tresc']);
                                                                    ?></textarea><br />
        <?php
        if (isset($_SESSION['e_tresc'])) {
            echo "<div class='error'>" . $_SESSION['e_tresc'] . "</div>";
            unset($_SESSION['e_tresc']);
        }

        if (isset($_SESSION['c_tresc'])) {
            echo "<div class='correct'>" . $_SESSION['c_tresc'] . "</div>";
            unset($_SESSION['c_tresc']);
        }
        ?>
        <label for="obraz">Obraz (opcjonalnie):</label><br />
        <input type="file" name="obraz"><br />
        <?php
        if (isset($_SESSION['e_obraz'])) {
            echo "<div class='error'>" . $_SESSION['e_obraz'] . "</div>";
            unset($_SESSION['e_obraz']);
        }
        ?>
        <label for="a">Odpowiedź A:</label><br />
        <textarea name="a" cols="30" rows="9" maxlength="255"><?php
                                                                if (isset($_SESSION['fr_a']))
                                                                    echo $_SESSION['fr_a'];
                                                                unset($_SESSION['fr_a']);
                                                                ?></textarea><br /></textarea><br />
        <?php
        if (isset($_SESSION['e_a'])) {
            echo "<div class='error'>" . $_SESSION['e_a'] . "</div>";
            unset($_SESSION['e_a']);
        }

        if (isset($_SESSION['c_a'])) {
            echo "<div class='correct'>" . $_SESSION['c_a'] . "</div>";
            unset($_SESSION['c_a']);
        }
        ?>
        <label for="b">Odpowiedź B:</label><br />
        <textarea name="b" cols="30" rows="9" maxlength="255"><?php
                                                                if (isset($_SESSION['fr_b']))
                                                                    echo $_SESSION['fr_b'];
                                                                unset($_SESSION['fr_b']);
                                                                ?></textarea><br />
        <?php
        if (isset($_SESSION['e_b'])) {
            echo "<div class='error'>" . $_SESSION['e_b'] . "</div>";
            unset($_SESSION['e_b']);
        }

        if (isset($_SESSION['c_b'])) {
            echo "<div class='correct'>" . $_SESSION['c_b'] . "</div>";
            unset($_SESSION['c_b']);
        }
        ?>
        <label for="c">Odpowiedź C:</label><br />
        <textarea name="c" cols="30" rows="9" maxlength="255"><?php
                                                                if (isset($_SESSION['fr_c']))
                                                                    echo $_SESSION['fr_c'];
                                                                unset($_SESSION['fr_c']);
                                                                ?></textarea><br />
        <?php
        if (isset($_SESSION['e_c'])) {
            echo "<div class='error'>" . $_SESSION['e_c'] . "</div>";
            unset($_SESSION['e_c']);
        }

        if (isset($_SESSION['c_c'])) {
            echo "<div class='correct'>" . $_SESSION['c_c'] . "</div>";
            unset($_SESSION['c_c']);
        }
        ?>
        <label for="d">Odpowiedź D:</label><br />
        <textarea name="d" cols="30" rows="9" maxlength="255"><?php
                                                                if (isset($_SESSION['fr_d']))
                                                                    echo $_SESSION['fr_d'];
                                                                unset($_SESSION['fr_d']);
                                                                ?></textarea><br />
        <?php
        if (isset($_SESSION['e_d'])) {
            echo "<div class='error'>" . $_SESSION['e_d'] . "</div>";
            unset($_SESSION['e_d']);
        }

        if (isset($_SESSION['c_d'])) {
            echo "<div class='correct'>" . $_SESSION['c_d'] . "</div>";
            unset($_SESSION['c_d']);
        }
        ?>
        <label for="pop_odp">Poprawna odpowiedź</label><br />
        <select name="pop_odp">
            <option value="null" <?php echo isset($_SESSION['fr_pop']) && $_SESSION['fr_pop'] == 'null' ? 'selected' : ''; ?>> -- Wybierz -- </option>
            <option value="a" <?php echo isset($_SESSION['fr_pop']) && $_SESSION['fr_pop'] == 'a' ? 'selected' : ''; ?>>A</option>
            <option value="b" <?php echo isset($_SESSION['fr_pop']) && $_SESSION['fr_pop'] == 'b' ? 'selected' : ''; ?>>B</option>
            <option value="c" <?php echo isset($_SESSION['fr_pop']) && $_SESSION['fr_pop'] == 'c' ? 'selected' : ''; ?>>C</option>
            <option value="d" <?php echo isset($_SESSION['fr_pop']) && $_SESSION['fr_pop'] == 'd' ? 'selected' : ''; ?>>D</option>
        </select><br />
        <?php
        if (isset($_SESSION['e_pop'])) {
            echo "<div class='error'>" . $_SESSION['e_pop'] . "</div>";
            unset($_SESSION['e_pop']);
        }

        if (isset($_SESSION['c_pop'])) {
            echo "<div class='correct'>" . $_SESSION['c_pop'] . "</div>";
            unset($_SESSION['c_pop']);
        }
        ?>
        <label for="kategoria">Kategoria pytania</label><br />
        <select name="kategoria">
            <option value="null" <?php echo isset($_SESSION['fr_kat']) && $_SESSION['fr_kat'] == 'null' ? 'selected' : ''; ?>> -- Wybierz -- </option>
            <option value="html" <?php echo isset($_SESSION['fr_kat']) && $_SESSION['fr_kat'] == 'html' ? 'selected' : ''; ?>>HTML</option>
            <option value="css" <?php echo isset($_SESSION['fr_kat']) && $_SESSION['fr_kat'] == 'css' ? 'selected' : ''; ?>>CSS</option>
            <option value="js" <?php echo isset($_SESSION['fr_kat']) && $_SESSION['fr_kat'] == 'js' ? 'selected' : ''; ?>>JavaScript</option>
            <option value="php" <?php echo isset($_SESSION['fr_kat']) && $_SESSION['fr_kat'] == 'php' ? 'selected' : ''; ?>>PHP</option>
        </select><br />

        <?php
        if (isset($_SESSION['e_kat'])) {
            echo "<div class='error'>" . $_SESSION['e_kat'] . "</div>";
            unset($_SESSION['e_kat']);
        }

        if (isset($_SESSION['c_kat'])) {
            echo "<div class='correct'>" . $_SESSION['c_kat'] . "</div>";
            unset($_SESSION['c_kat']);
        }
        ?><br />
        <input type="submit" value="Prześlij pytanie">
    </form>
</body>

</html>