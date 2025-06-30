<?php
require("connect.php");

// Obtenir la liste des noms des departements distincts
function getDepartments(){
    $req = "SELECT * from departments GROUP BY dept_name";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir la listes des managers en cours pour chacun des departements
function getDepartments_manager(){
    $req = "SELECT employees.first_name 'nom', employees.last_name 'prenom', departments.dept_name 'departement', dept_manager.from_date 
    FROM departments JOIN
    dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON dept_manager.emp_no = employees.emp_no 
    WHERE dept_manager.from_date IN ( SELECT MAX(dept_manager.from_Date) FROM departments JOIN
    dept_manager ON departments.dept_no = dept_manager.dept_no GROUP BY departments.dept_name )";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir les employees d'un departement
function getEmployees_departments($name){
    $req = "SELECT employees.first_name 'nom', employees.last_name 'prenom' FROM departments JOIN
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

// Obtenir les infos personnelles d'un employee
function getInfo_employee($name, $last_name){
    $req = "SELECT * FROM employees WHERE first_name LIKE '%s' and last_name LIKE '%s'";
    $req = sprintf($req, $name, $last_name);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir l'historique de l'emploi d'un employee
function getTitle_employee($id){
    $req = "SELECT * FROM titles WHERE emp_no = '%s'";
    $req = sprintf($req, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir l'historique de salaire d'un employee
function getHistoriq_salaries($id){
    $req = "SELECT * FROM salaries WHERE emp_no = '%s'";
    $req = sprintf($req, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir les noms distincts de chaque employee
function getName_employees(){
    $req = "SELECT * from employees GROUP BY first_name";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir l'age minimum sur l'ensemble des employees
function getMinEmployee_age(){
    $req = "SELECT MIN(2025 - YEAR(birth_date)) 'age' from employees";
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir l'age maximale sur l'ensemble des employees
function getMaxEmployee_age(){
    $req = "SELECT MAX(2025 - YEAR(birth_date)) 'age' from employees";
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir l'age moyen sur l'ensemble des employees
function getAverageEmployee_age(){
    $req = "SELECT AVG(2025 - YEAR(birth_date)) 'age' from employees";
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

//
function getRelative_Employees($name, $min, $max){
    $req = "SELECT first_name, (2025 - YEAR(birth_date)) as age
     FROM employees WHERE first_name LIKE '%s' 
    AND age >= '%s' AND age <= '%s'";
    $req = sprintf($req, $name, $min, $max);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}