<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$id = $_POST['id'];
		$emp_name = $_POST['emp_name'];
		$emp_dept = $_POST['emp_dept'];
		$emp_salary = $_POST['emp_salary'];
		$emp_level = $_POST['emp_level'];
		
		$stmt = $DB_con->prepare("UPDATE tbl_employees SET emp_name=:en, emp_dept=:ed, emp_salary=:es, emp_level=:el WHERE emp_id=:id");
		$stmt->bindParam(":en", $emp_name);
		$stmt->bindParam(":ed", $emp_dept);
		$stmt->bindParam(":es", $emp_salary);
		$stmt->bindParam(":el", $emp_level);
		$stmt->bindParam(":id", $id);
		
		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
	}

?>