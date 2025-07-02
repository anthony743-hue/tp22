create or replace view v_employees_departments as 
select v1.dept_no,v2.emp_no, birth_date,first_name, 
last_name,gender,hire_date,from_date,to_date from employees as v2
JOIN dept_emp as v1 ON v2.emp_no = v1.emp_no

create or replace view v_current_employees_departments as
select * from v_employees_departments
WHERE to_date = ( select max(to_date) from v_employees_departments );

create or replace view v_current_departments as
select * from departments GROUP BY dept_name;

create or replace view v_manager_departments as
select v1.dept_no,v2.emp_no, birth_date,first_name, 
last_name,gender,hire_date,from_date,to_date from employees as v2
JOIN dept_manager as v1 ON v2.emp_no = v1.emp_no

create or replace view v_current__manger_departments as 
select * from v_manager_departments
WHERE to_date = ( select max(to_date) from v_current__manger_departments );


