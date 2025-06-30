<?php
include("../inc/fonction.php");
$dep = $_POST['departement'];
$name = $_POST['nom'];
$min = $_POST['min'];
$max = $_POST['max'];
$emp = getRelative_Employees($dep,$name, $min, $max);
?>