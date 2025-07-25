create or replace view v_managers_departments
as select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date 
FROM employees v1 JOIN dept_manager v2 ON v1.emp_no = v2.emp_no;

create or replace view v_employees_departments
as select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date
FROM employees v1
JOIN dept_emp v2 ON v1.emp_no = v2.emp_no;

create view v_employees_departments
as select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date
FROM employees v1
JOIN dept_emp v2 ON v1.emp_no = v2.emp_no
WHERE v1.emp_no 
NOT IN ( select emp_no from dept_manager WHERE to_date = '9999-01-01' )

create or replace view v_current_employees_departments
as select * FROM v_employees_departments 
WHERE to_date = ( select max(to_date) FROM v_employees_departments );

create or replace view v_current_departments
as select * from departments;

create or replace view v_current_managers_departments
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
AND v3.emp_no != v1.emp_no
GROUP BY
    d.dept_name, v1.dept_no, v1.emp_no, v1.birth_date, v1.first_name, v1.last_name, v1.gender, v1.hire_date, v1.from_date, v1.to_date
ORDER BY
    d.dept_name;

create or replace view v_current_work_employees 
as select v2.title as 'emploi', v3.salary 'salaire', v1.first_name 'nom', v1.last_name 'prenom'
FROM
    v_current_employees_departments v1
JOIN 
    titles v2 ON v2.emp_no = v1.emp_no
JOIN
    salaries v3 ON v3.emp_no = v1.emp_no
WHERE v2.to_date = ( SELECT max(to_date) FROM titles ) 
and v3.to_date = ( SELECT max(to_date) FROM salaries )

create or replace view v_salary_title as
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
GROUP BY v2.title;

select COUNT(emp_no) FROM v_current_employees_departments;

SELECT
    v2.title as 'emploi',
    v1.first_name, v1.last_name, v1.from_date, v1.to_date, v2.from_date, v2.to_date, v3.from_date, v3.to_date
FROM
    v_current_employees_departments v1
JOIN 
    titles v2 ON v2.emp_no = v1.emp_no
JOIN
    salaries v3 ON v3.emp_no = v1.emp_no;


select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date
FROM employees v1
JOIN dept_emp v2 ON v1.emp_no = v2.emp_no
WHERE first_name LIKe "Leon" AND last_name LIKE "DasSarma";

select dept_no, v1.emp_no, birth_date, first_name, last_name, gender, hire_date,
from_date, to_date 
FROM employees v1 JOIN dept_manager v2 ON v1.emp_no = v2.emp_no
WHERE first_name LIKe "Leon" AND last_name LIKE "DasSarma";



