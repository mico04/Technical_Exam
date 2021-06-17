<?php
//insert.php
include ('database_connection.php');
$form_data = json_decode(file_get_contents("php://input"));
$error = '';
$message = '';
$validation_error = '';
$fullname = '';
$sex = '';
$section = '';
$position = '';
$status = '';

if ($form_data->action == 'fetch_single_data') {
    $query = "SELECT * FROM employees WHERE id ='" . $form_data->id . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $out['fullname'] = $row['emp_fullname'];
        $out['position'] = $row['emp_position'];
        $out['status'] = $row['emp_active'];
        $out['sex'] = $row['emp_sex'];
        $out['section'] = $row['emp_section'];
        $out['id'] = $row['id'];
    }
} elseif ($form_data->action == "Delete") {
    $query = "
	DELETE FROM employees WHERE id='" . $form_data->id . "'
	";
    $statement = $connect->prepare($query);
    if ($statement->execute()) {
        $message = 'Data Inserted';
    }
} elseif ($form_data->action == 'Insert') {
    $fullname = $form_data->fullname;
    $sex = $form_data->sex;
    $section = $form_data->section;
    $status = $form_data->status;
    $position = $form_data->position;
    $data = array(':fullname' => $fullname, ':position' => $position, ':sex' => $sex, ':status' => $status, ':section' => $section);
    $query = "
			INSERT INTO employees 
				(emp_fullname, emp_position, emp_section, emp_active, emp_sex ) VALUES 
				(:fullname, :position, :section, :status, :sex)
			";
    $statement = $connect->prepare($query);
    $statement->execute($data);
} elseif ($form_data->action == 'Edit') {
    $fullname = $form_data->fullname;
    $sex = $form_data->sex;
    $section = $form_data->section;
    $status = $form_data->status;
    $position = $form_data->position;
    $data = array(':fullname' => $fullname, ':position' => $position, ':sex' => $sex, ':status' => $status, ':section' => $section, ':id' => $form_data->id);
    $query = "
			UPDATE employees 
			SET emp_fullname = :fullname, emp_position = :position, emp_section = :section, emp_active = :status, emp_sex = :sex 
			WHERE id = :id
			";
    $statement = $connect->prepare($query);
    $statement->execute($data);
} elseif ($form_data->action == 'EmpIn') {
    $query = "
	INSERT INTO attendace
				(att_date, att_in, att_emp, att_out) VALUES
				(now(), now(), '" . $form_data->id . "', '00:00:00')
	";
    $statement = $connect->prepare($query);
    $statement->execute(); 
        
}
 elseif ($form_data->action == 'EmpOut') {
    $query = "
			UPDATE attendace 
			SET att_out = now() 
			WHERE att_emp = '" . $form_data->id . "' and att_date = CURRENT_DATE()
			";
    $statement = $connect->prepare($query);
    $statement->execute(); 
        
}
echo json_encode($out);
?>
