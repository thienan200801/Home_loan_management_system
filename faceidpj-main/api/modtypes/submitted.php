<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);


$user_id = $data['user_id'];
$data_ret = '{"error":-1}';

$headers = apache_request_headers();
$token = $headers['access-token'];

$json_token = json_decode(decrypt($token,$enc_password),true);

if (isset($user_id) && !empty($user_id) && !empty($json_token["user_username"]))
{
	$sql = 'SELECT id, fix_my_home_loan, cancel_my_fixed_rate_period, reduce_my_loan_limit, change_io_to_pi, loan_split, change_loan_purpose FROM mod_types where id="'.$user_id.'"';
	// create table face_id (user_id text, user_username text, user_name text,user_password text, user_id text);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {

	  	$data_ret = '{"Fix my home loan": '.$row["fix_my_home_loan"].',"Cancel my fixed rate period": '.$row["cancel_my_fixed_rate_period"].',"Reduce my loan limit": '.$row["reduce_my_loan_limit"].',"Change IO to PI": '.$row["change_io_to_pi"].',"Loan split": '.$row["loan_split"].',"Change of loan purpose": '.$row["change_loan_purpose"].'}';
	  	echo $data_ret;

//	    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	} else {
	  echo $data_ret;
	}
	$conn->close();
}


?>


