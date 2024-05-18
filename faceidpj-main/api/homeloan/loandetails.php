<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);


$user_id = $data['id'];
$data_ret = '{"error":-1}';

$headers = apache_request_headers();
$token = $headers['access-token'];

$json_token = json_decode(decrypt($token,$enc_password),true);

if (isset($user_id) && !empty($user_id) && !empty($json_token["user_username"]))
{
	$sql = 'SELECT loan_account_number, balance, product_name, attachment, rate_type, rate_per_annum, offset_account_number, loan_purpose FROM home_loan_details where user_id="'.$user_id.'"';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	
	  	$data_ret = '{"loanAcc": "'.$row["loan_account_number"].'","currentBalance": '.$row["balance"].',"productName": "'.$row["product_name"].'","AssuranceAttachment": "'.$row["attachment"].'", "RateType": "'.$row["rate_type"].'", "inrestRate": '.$row["rate_per_annum"].', "offsetAcc": "'.$row["offset_account_number"].'", "loanPurpose": "'.$row["loan_purpose"].'"}';
	  	echo $data_ret;

//	    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	} else {
	  echo $data_ret;
	}
	$conn->close();
}


?>
