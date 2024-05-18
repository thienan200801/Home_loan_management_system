<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$reconize_system = "/opt/face_recognizer/detector.py";

$img = $data['img'];
$data_ret = '{"error":-1}';

$headers = apache_request_headers();
$token = $headers['access-token'];

$json_token = json_decode(decrypt($token,$enc_password),true);

if (isset($img) && !empty($img) && !empty($json_token["user_username"]))
{
	$img_raw = base64_decode($img);
	file_put_contents("../../uploads/test.png", $img_raw);
	exec($reconize_system." --test -f ../../uploads/test.png", $output);
	$user_username = $output[0];

	$sql = 'SELECT user_id, user_name FROM face_id where user_username="'.$user_username.'"';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {

	  	$data_ret = '{"customerId": "'.$row['user_id'].'","name": "'.$row['user_name'].'"}';
	  	echo $data_ret;
	 }
	}
	else
	{
	 	echo $data_ret;

	}

}


?>
