<?php
require("connect.php");

function initEmployees(){
    $req = "create or replace view v_employees_departments
as select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date
FROM employees v1
JOIN dept_emp v2 ON v1.emp_no = v2.emp_no";
mysqli_query(dbconnect(), $req);
}

function init_current_Employees(){
    $req = "create or replace view v_current_employees_departments
as select * FROM v_employees_departments 
WHERE to_date = ( select max(to_date) FROM v_employees_departments )";
mysqli_query(dbconnect(), $req);
}

function init_managers_departments(){
    $req = "create or replace view v_managers_departments
as select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date 
FROM employees v1 JOIN dept_manager v2 ON v1.emp_no = v2.emp_no
ORDER BY dept_no";
mysqli_query(dbconnect(), $req);
}

function init_current_departments(){
    $req = "create or replace view v_current_departments
as select * from departments";
mysqli_query(dbconnect(), $req);
}

function init_current_managers_departments(){
    $req = "create or replace view v_current_managers_departments
as SELECT
    d.dept_name,
    v1.dept_no,
    v1.emp_no,
    v1.birth_date,
    v1.first_name,
    v1.last_name,
    v1.gender,
    v1.hire_date,
    v1.from_date,
    v1.to_date,
    COUNT(v3.emp_no) AS compte
FROM
    v_managers_departments v1
JOIN
    v_current_departments v2 ON v1.dept_no = v2.dept_no
JOIN
    v_current_employees_departments v3 ON v1.dept_no = v3.dept_no
JOIN
    departments d ON v1.dept_no = d.dept_no 
WHERE
    v1.from_date = (SELECT MAX(from_date) FROM v_managers_departments WHERE dept_no = v1.dept_no)
AND 
    v3.emp_no != v1.emp_no 
GROUP BY
    d.dept_name, v1.dept_no, v1.emp_no, v1.birth_date, v1.first_name, v1.last_name, v1.gender, v1.hire_date, v1.from_date, v1.to_date
ORDER BY
    d.dept_name";
mysqli_query(dbconnect(), $req);
}

function init_salary(){
    $req = "create or replace view v_salary_title as
    SELECT
    v2.title as 'emploi',
    SUM(CASE WHEN gender = 'M' THEN 1 ELSE 0 END) AS male_count,
    SUM(CASE WHEN gender = 'F' THEN 1 ELSE 0 END) AS female_count,
    AVG(v3.salary) AS medium_salary
FROM
    v_current_employees_departments v1
JOIN 
    titles v2 ON v2.emp_no = v1.emp_no
JOIN
    salaries v3 ON v3.emp_no = v1.emp_no
WHERE v2.to_date = ( SELECT max(to_date) FROM titles ) 
and v3.to_date = ( SELECT max(to_date) FROM salaries )
GROUP BY v2.title";
mysqli_query(dbconnect(), $req);
}

function init_view(){
    initEmployees();
    init_current_Employees();
    init_current_departments();
    init_managers_departments();
    init_current_managers_departments();
    init_salary();
}

// 1. Home.php

// 1.1 Formulaire

// Obtenir la liste des noms des departements distincts
function getDepartments(){
    $req = "SELECT * from v_current_departments";
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

// Obtenir l'age maximale sur l'ensemble des employees
function getMaxEmployee_age(){
    $req = "SELECT MAX(2025 - YEAR(birth_date)) 'age' from v_current_employees_departments";
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir l'age moyen sur l'ensemble des employees
function getAverageEmployee_age(){
    $req = "SELECT AVG(2025 - YEAR(birth_date)) 'age' from v_current_employees_departments";
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// 1.2 Tableau des managers par departements

// Obtenir la listes des managers en cours pour chacun des departements
function getDepartments_manager(){
    $req = "SELECT * FROM v_current_managers_departments";
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
    $req = "SELECT * FROM  v_current_employees_departments
     WHERE dept_no LIKE '%s' AND emp_no NOT IN ( SELECT emp_no FROM  v_current_managers_departments )";
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
    $req = "SELECT * FROM v_current_employees_departments WHERE first_name LIKE '%s' and last_name LIKE '%s'";
    $req = sprintf($req, $name, $last_name);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir le nom du departement a partir d'un id_department
function getDepartmentName($dept_no){
    $req = "SELECT dept_name 
        FROM v_current_departments 
        WHERE dept_no LIKE '%s'";
    $req = sprintf($req, $dept_no);
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

// Obtenir les effectifs pour chaque sexe(M,F) par emploi
function getDetailledEmploi(){
    $req = "SELECT * FROM v_salary_title";
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

// Obtenir le salaire actuelle d'un employee
function getCurrent_salary($id){
    $req = "SELECT * FROM salaries WHERE emp_no = '%s' 
    AND from_date = ( SELECT MAX(from_date) FROM salaries WHERE emp_no = '%s' )";
    $req = sprintf($req, $id, $id);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

// Obtenir le manager a partir d'un id_department
function getManager($dept_no){
    $req = "SELECT * from v_current_managers_departments WHERE dept_no LIKE '%s'";
    $req = sprintf($req, $dept_no);
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows;
}

function updateActualManager($emp_no, $date){
    $req = "UPDATE dept_manager SET to_date = '%s' WHERE emp_no  = '%s'";
    $req = sprintf($req, $date, $emp_no);
    mysqli_query(dbconnect(), $req);
}

function insert_new_manager($emp_no, $dept_no, $date){
    $req = "INSERT INTO dept_manager VALUES('%d', '%s', '%s', '9999-01-01')";
    $req = sprintf($req, $emp_no, $dept_no, $date);
     mysqli_query(dbconnect(), $req);
}

function getEmployees_filtered($dep, $name, $min, $max, $count){
    $req = "SELECT * FROM v_current_employees_departments WHERE 1 = 1";

    $name_query_part = ( $name != "" && isset($name) ) ? sprintf(" AND first_name LIKE '%s'", $name) : "";
    $year_query_part = sprintf(" AND (2025 - YEAR(birth_date)) BETWEEN %d AND %d", $min, $max);
    $dept_query_part = ( $dep == "Tous" ) ? "" : sprintf(" AND dept_no LIKE '%s'", $dep);

    $req = $req.$name_query_part.$year_query_part.$dept_query_part." LIMIT %d, 20";
    $req = sprintf($req, $count);
    $resultat = mysqli_query(dbconnect(), $req);
    $retour = array();
    while( $done = mysqli_fetch_assoc($resultat) ){
        $retour[] = $done;
    }
    mysqli_free_result($resultat);
    return $retour; 
}

function count_Employees_Filtered($dep, $name, $min, $max){
    $req = "SELECT count(emp_no) as compte FROM v_current_employees_departments WHERE 1 = 1";

    $name_query_part = ( $name != "" && isset($name) ) ? sprintf(" AND first_name LIKE '%s'", $name) : "";
    $year_query_part = sprintf(" AND (2025 - YEAR(birth_date)) BETWEEN %d AND %d", $min, $max);
    $dept_query_part = ( $dep == "Tous" ) ? "" : sprintf(" AND dept_no LIKE '%s'", $dep);

    $req = $req.$name_query_part.$year_query_part.$dept_query_part;
    $resultat = mysqli_query(dbconnect(), $req);
    $rows = mysqli_fetch_assoc($resultat);
    return $rows['compte'];
}

function display_next_previous_button($cmp, $size){
    $previous_enabled = ( $cmp > 0 ) ? "" : "disabled";
    $next_enabled = ( $cmp + 20 < $size ) ? "" : "disabled";
    ?>                    
        <a href="traitement_next.php?id=-1" class="btn btn-secondary btn-lg <?= $previous_enabled; ?>">Precedent</a> 
        <a href="traitement_next.php?id=1" class="btn btn-secondary btn-lg <?= $next_enabled; ?>">Suivant</a>
    <?php 
}
?>