<?php
require("connect.php");

function getDepartments(){
    $req = "SELECT dept_name departement from departments";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function getDepartments_manager(){
    $req = "SELECT employees.first_name 'nom', employees.last_name 'prenom', departments.dept_name 'departement' 
    FROM departments JOIN
    dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON dept_manager.emp_no = employees.emp_no";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function getEmployees_departments($name){
    $req = "SELECT employees.first_name, employees.last_name, departments.dept_name 
FROM departments JOIN
dept_emp ON departments.dept_no = dept_emp.dept_no
JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE departments.dept_name LIKE '%s'";
    $req = sprintf($req, $name);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}