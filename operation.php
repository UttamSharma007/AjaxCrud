<?php 
echo "string";
echo "demo";
echo "demo";
require_once('db.php');

extract($_POST);

if(isset($_POST['stu_name']) && isset($_POST['f_name']) && isset($_POST['email']) && isset($_POST['mobile_number']) && isset($_POST['degree']) && isset($_POST['year'])) {
	$q  = "INSERT INTO `student` (`s_name`, `s_f_name`, `s_email`, `s_m_number`, `s_degree`, `s_year`) values('$stu_name', '$f_name', '$email', '$mobile_number', '$degree', '$year') ";

	mysqli_query($con, $q);
}

if(isset($_POST['records'])) {
	$q  = "SELECT * FROM `student`";

	$result = mysqli_query($con, $q);

	if( mysqli_num_rows($result) > 0 ) {
		$number = 1;
		$data = "";
		while ($row = mysqli_fetch_array($result)) {
			$data .= '<tr>
						<td>'.$number.'</td>
						<td>'.$row["s_name"].'</td>
						<td>'.$row["s_f_name"].'</td>
						<td>'.$row["s_email"].'</td>
						<td>'.$row["s_m_number"].'</td>
						<td>'.$row["s_degree"].'</td>
						<td>'.$row["s_year"].'</td>
						<td><button type="button" class="btn btn-primary d-flex justify-content-center btn-warning" onclick="edit_data('.$row["s_id"].')">Edit</button></td>
						<td><button type="button" class="btn btn-primary justify-content-center btn-danger" onclick="delete_data('.$row["s_id"].')">Delete</button></td>
					</tr>';
			$number++;
		}
	}
	echo $data;
}

if(isset($_POST['id']) && '' != $_POST['id'] ) {

	$q  = "DELETE FROM `student` WHERE s_id = $id";

	$result = mysqli_query($con, $q);
}

if(isset($_POST['edit_id']) && '' != $_POST['edit_id'] ) {
	$user_id = $_POST['edit_id'];
	$que  = "SELECT * FROM student WHERE s_id = '$user_id'";

	$results = mysqli_query($con, $que);
	$response = array();
	if( mysqli_num_rows($results) > 0 ) {
		while ($row = mysqli_fetch_assoc($results)) {
			$response = $row;
		}
	}
	else{
		$response['status'] = 200;
	}

	echo json_encode($response);
}

if(isset($_POST['edit_stu_name']) && isset($_POST['edit_f_name']) && isset($_POST['edit_email']) && isset($_POST['edit_mobile_number']) && isset($_POST['edit_degree']) && isset($_POST['edit_year']) && isset($_POST['hidden_id'])) {
	var_dump($edit_mobile_number);
	$q  = "UPDATE `student` SET `s_name` = '$edit_stu_name', `s_f_name` = '$edit_f_name', `s_email` = '$edit_email', `s_m_number` = '$edit_mobile_number', `s_degree` = '$edit_degree', `s_year` = '$edit_year' WHERE s_id = '$hidden_id' ";

	mysqli_query($con, $q);
}
?>