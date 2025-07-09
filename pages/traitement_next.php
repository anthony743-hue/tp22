<?php
session_start();
$id = $_GET['id'];
$size = $_SESSION['size'];
$cmp = $_SESSION['compteur'];
if( $id == -1 ){
    $cmp = ( $cmp - 20 <= 0 ) ? 0 : $cmp - 20;
} else if( $id == 1 ){
    $cmp = ($cmp + 20 >= $size) ? $cmp : $cmp + 20;
}
$_SESSION['compteur'] = $cmp;
$cmp = $_SESSION['compteur'];
header("Location: modal.php?p=result.php");
exit;
?>