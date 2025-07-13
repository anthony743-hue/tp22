<?php
ini_set("display_errors",1);
session_start();
include("../inc/fonction.php");
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$info = getInfo_employee($nom, $prenom);
$departmentName = getDepartmentName($info['dept_no']);
$manager = getManager($info['dept_no']);
$date = isset($_POST['date']) ? $_POST['date'] : '';

$date_input = new DateTime($date);
$date_e = new DateTime($info['from_date']);
$date_m = new DateTime($manager['from_date']);

$link = "modal.php?p=manager.php&nom=".$nom."&prenom=".$prenom."&error=date";
if( $date_input <= $date_m ){
    header("Location: ".$link);
    exit;
}
if( $date_input < $date_e ){
    header("Location: ".$link);
    exit;
}
updateActualManager($manager['emp_no'],$date);
insert_new_manager($info['emp_no'], $info['dept_no'], $date);
header("Location: modal.php?p=home.php");
exit;
?>