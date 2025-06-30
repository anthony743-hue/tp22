<?php
include("../inc/fonction.php");
$dep = $_GET['departement'];
$name = $_GET['nom'];
$min = $_POST['min'];
$max = $_POST['max'];
$emp = getRelative_Employees();
?>