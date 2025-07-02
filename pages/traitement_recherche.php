<?php
session_start();
include("../inc/fonction.php");
$_SESSION['departement'] = isset($_POST['departement']) ? $_POST['departement'] : '';
$dep = $_SESSION['departement'];
$_SESSION['nom'] = isset($_POST['nom']) ? $_POST['nom'] : '';
$_SESSION['min'] = isset($_POST['min']) ? (int)$_POST['min'] : 0; 
$_SESSION['max'] = isset($_POST['max']) ? (int)$_POST['max'] : PHP_INT_MAX; 
if( isset($_SESSION['compteur']) ){
    $_SESSION['compteur'] = 0;
}
header("Location: result.php");
exit;
?>
