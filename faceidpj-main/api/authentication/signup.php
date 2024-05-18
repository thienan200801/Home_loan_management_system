<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);


$username = $data['username'];
$password = $data['password'];
$data_ret = '{"error":-1}';

if (isset($username) && !empty($username) && isset($password) && !empty($password))
{
	$sql = 'SELECT user_id, user_username, user_name, user_password, banker_id FROM face_id where user_username="'.$username.'"';
	// create table face_id (user_id text, user_username text, user_name text,user_password text, banker_id text);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  		if(md5($password) === $row['user_password'])
	  		{
	  			$user_id = $row["user_id"];
	  			$user_name = $row["user_username"];
	  			$time = time();
	  			$token = encrypt('{"user_id":"'.$user_id.'","user_username":"'.$user_name.'","time":"'.$time.'"}',$enc_password);
	  			$data_ret = '{"access_token":"'.$token.'"}';
	  			echo $data_ret;
	  		}
//	    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	} else {
	  echo $data_ret;
	}
	$conn->close();
}


?>
