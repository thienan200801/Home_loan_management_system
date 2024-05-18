<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);


$banker_id = $data['id'];
$data_ret = '{"error":-1}';

$headers = apache_request_headers();
$token = $headers['access-token'];

$json_token = json_decode(decrypt($token,$enc_password),true);

if (isset($banker_id) && !empty($banker_id) && !empty($json_token["user_username"]))
{
	$sql = 'SELECT banker_name, banker_area, banker_email FROM banker_details where banker_id="'.$banker_id.'"';
	// create table face_id (user_id text, user_username text, user_name text,user_password text, banker_id text);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	
	  	$data_ret = '{"bankerId": "'.$banker_id.'","bankerName": "'.$row["banker_name"].'","bankerArea": "'.$row["banker_area"].'","bankerEmail": "'.$row["banker_email"].'"}';
	  	echo $data_ret;

//	    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	} else {
	  echo $data_ret;
	}
	$conn->close();
}


?>
