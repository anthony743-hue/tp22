<?php
session_start();
include("../inc/fonction.php");
$_SESSION['departement'] = isset($_POST['departement']) ? $_POST['departement'] : '';
$_SESSION['nom'] = isset($_POST['nom']) ? $_POST['nom'] : '';
$_SESSION['min'] = isset($_POST['min']) ? (int)$_POST['min'] : 0; 
$_SESSION['max'] = isset($_POST['max']) ? (int)$_POST['max'] : PHP_INT_MAX; 
 $_SESSION['compteur'] = 0;
header("Location: modal.php?p=result.php");
exit;
?>
