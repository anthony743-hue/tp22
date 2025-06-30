<?php
include("../inc/fonction.php");
$dep = $_POST['departement'];
$name = $_POST['nom'];
$min = $_POST['min'];
$max = $_POST['max'];
$emp = getRelative_Employees($dep,$name, $min, $max);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>