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

function init_employees(){
    $req = "create or replace view v_employees_departments as 
select v1.dept_no,v2.emp_no, birth_date,first_name, 
last_name,gender,hire_date,from_date,to_date from employees as v2
JOIN dept_emp as v1 ON v2.emp_no = v1.emp_no";
    mysqli_query(dbconnect(), $req);
}

function init_current_employees(){
    $req = "create or replace view v_current_employees_departments as
select * from v_employees_departments WHERE to_date = ( select max(to_date) from v_employees_departments )";
mysqli_query(dbconnect(), $req);
}

function init_departments(){
    $req = "create or replace view v_current_departments as
select * from departments GROUP BY dept_name";
    mysqli_query(dbconnect(), $req);
}

// Obtenir la listes des managers en cours pour chacun des departements
function getDepartments_manager(){
    $req = "SELECT employees.first_name 'nom', employees.last_name 'prenom', departments.dept_name 'departement',
    departments.dept_no 'no', dept_manager.from_date 
    FROM departments JOIN
    dept_manager ON departments.dept_no = dept_manager.dept_no
    JOIN employees ON dept_manager.emp_no = employees.emp_no 
    WHERE dept_manager.from_date IN ( SELECT MAX(dept_manager.from_Date) FROM departments JOIN
    dept_manager ON departments.dept_no = dept_manager.dept_no GROUP BY departments.dept_name ) ORDER BY departments.dept_name";
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
    $req = "SELECT * FROM titles WHERE emp_no = '%s' 
    AND from_date != ( SELECT MAX(from_date) FROM titles WHERE emp_no = '%s' )";
    $req = sprintf($req, $id, $id);
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
    $req = "SELECT * FROM salaries WHERE emp_no = '%s' 
    AND from_date NOT IN ( SELECT MAX(from_date) FROM salaries WHERE emp_no = '%s' )";
    $req = sprintf($req, $id, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir l'empoi actuelle d'un employee
function getEmploi_name($id){
    $req = "SELECT * FROM titles WHERE emp_no = '%s' 
    AND from_date = ( SELECT MAX(from_date) FROM titles WHERE emp_no = '%s')";
    $req = sprintf($req, $id, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
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

// Obtenir le salaire actuelle d'un employee
function getCurrent_salary($id){
    $req = "SELECT * FROM salaries WHERE emp_no = '%s' 
    AND from_date = ( SELECT MAX(from_date) FROM salaries WHERE emp_no = '%s' )";
    $req = sprintf($req, $id, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
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

function getRelative_Employees($dep,$name, $min, $max, $count){
    $req = "SELECT * FROM employees WHERE first_name LIKE '%s'
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s'
     AND emp_no IN ( SELECT employees.emp_no FROM departments JOIN
dept_emp ON departments.dept_no = dept_emp.dept_no
JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE departments.dept_name LIKE '%s' ) LIMIT %d, 20";
    $req = sprintf($req, $name, $min, $max, $dep, $count);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function getRelate_Employees($name, $min, $max, $count){
    $req = "SELECT * FROM employees WHERE first_name LIKE '%s'
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s' LIMIT %d, 20";
    $req = sprintf($req, $name, $min, $max, $count);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function getEmployees($min, $max, $count){
    $req = "SELECT * FROM employees WHERE 1 = 1 
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s' LIMIT %d, 20";
    $req = sprintf($req, $name, $name, $min, $max, $count);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function test($phrase){
    $req = "SELECT * FROM employees WHERE 1 = 1 %s";
    $req = sprintf($req, $phrase);
    echo $req;
}

function count_result($dep,$name, $min, $max){
    $req = "SELECT count(emp_no) as compte FROM employees WHERE first_name LIKE '%s' 
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s'
     AND emp_no IN ( SELECT employees.emp_no FROM departments JOIN
dept_emp ON departments.dept_no = dept_emp.dept_no
JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE departments.dept_name LIKE '%s' )";
 $req = sprintf($req, $name, $min, $max, $dep);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows['compte'];
}  

function count_resultat($name, $min, $max){
    $req = "SELECT count(emp_no) as compte FROM employees WHERE first_name LIKE '%s' 
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s'";
 $req = sprintf($req, $name, $min, $max);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows['compte'];
}

function count_val($dep, $min, $max){
    $req = "SELECT count(emp_no) as compte FROM employees WHERE 1=1 
    AND (2025 - YEAR(birth_date)) >= '%s' AND(2025 - YEAR(birth_date))<= '%s' AND emp_no IN ( SELECT employees.emp_no FROM departments JOIN
dept_emp ON departments.dept_no = dept_emp.dept_no
JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE departments.dept_name LIKE '%s' )";
 $req = sprintf($req, $min, $max, $dep);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows['compte'];
}

//nombre d employe
function countEmploye($nom_dep){
    $req = "SELECT count(emp_no) as nb FROM dept_emp WHERE dept_no like '%s'";
    $req = sprintf($req, $nom_dep);
    $resultat = mysqli_query(dbconnect(), $req);
    $data = mysqli_fetch_assoc($resultat);
    return $data;
}

function countEmployeHommes($nom_dep){
    $req = "SELECT count(emp_no) as nbHomme FROM dept_emp WHERE dept_no like '%s' AND gender like 'M'";
    $req = sprintf($req, $nom_dep);
    $resultat = mysqli_query(dbconnect(), $req);
    $data = mysqli_fetch_assoc($resultat);
    return $data;
}

function countEmployeFemmes($nom_dep){
    $req = "SELECT count(emp_no) as nbFemme FROM dept_emp WHERE dept_no like '%s' AND gender like 'F'";
    $req = sprintf($req, $nom_dep);
    $resultat = mysqli_query(dbconnect(), $req);
    $data = mysqli_fetch_assoc($resultat);
    return $data;
}



?>


