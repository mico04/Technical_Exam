<?php

//fetch_data.php

include('database_connection.php');

$query = "SELECT * FROM attendace left join employees on attendace.att_emp = employees.emp_id ORDER BY id_att";
$statement = $connect->prepare($query);
if($statement->execute())
{
	
	while($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$data[] = $row;
	}

	echo json_encode($data);
}

?>