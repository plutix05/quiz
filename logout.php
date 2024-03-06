<?php
session_start();

$_SESSION['wylogowanie'] = "<span style = 'color: green'>Pomyślnie wylogowano</span>";

session_unset();

header('Location: login.php');
