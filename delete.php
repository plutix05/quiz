<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
  header("Location: login.php");
  exit();
}

$id_pyt = $_GET['id'];

try {
  require_once 'connect.php';
  $conn = new mysqli($host, $db_user, $db_pass, $db_name);
  if ($conn->connect_errno != 0) {
    throw new Exception(mysqli_connect_errno());
  } else {
    $sql1 = "SELECT * FROM pytania where id_pyt = $id_pyt";
    $q1 = $conn->query($sql1);
    $fa = $q1->fetch_assoc();

    $nr = $fa['nr_pyt'];
    $tresc = $fa['tresc'];
    $obraz = $fa['obraz'];
    $a = $fa['a'];
    $b = $fa['b'];
    $c = $fa['c'];
    $d = $fa['d'];
    $pop = $fa['pop_odp'];
    $kat = $fa['kategoria'];

    if (isset($_POST['tak'])) {
      $sql2 = "DELETE FROM `pytania` WHERE id_pyt = $id_pyt";
      $q2 = $conn->query($sql2);
      $_SESSION['deleted'] = true;
      header("Location: deleted.php");
    } elseif (isset($_POST['nie'])) {
      header("Location: pytania.php");
    } else {
      throw new Exception($conn->error);
    }
  }
} catch (Exception $e) {
  echo "Błąd serwera <br />";
  //echo "Dev info" . $e;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Egzamin - usuwanie pytania</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Egzamin</h1>
  <table>
    <caption>
      Pytanie
    </caption>
    <tr>
      <th>Nr</th>
      <th>Treść</th>
      <th>Zdjęcie</th>
      <th>Odp. A</th>
      <th>Odp. B</th>
      <th>Odp. C</th>
      <th>Odp. D</th>
      <th>Pop. odp</th>
      <th>Kategoria</th>
    </tr>
    <tr>
      <td><?php echo $nr; ?></td>
      <td><?php echo $tresc; ?></td>
      <td><?php echo $obraz; ?></td>
      <td><?php echo $a; ?></td>
      <td><?php echo $b; ?></td>
      <td><?php echo $c; ?></td>
      <td><?php echo $d; ?></td>
      <td><?php echo $pop; ?></td>
      <td><?php echo $kat; ?></td>
    </tr>
  </table>
  <fieldset>
    <legend>Czy na pewno chcesz usunąć to pytanie?</legend>
    <form method="post">
      <input type="submit" value="Tak" name="tak" />
      <input type="submit" value="Nie" name="nie" />
    </form>
  </fieldset>
</body>

</html>