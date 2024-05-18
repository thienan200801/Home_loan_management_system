<?php

require_once('../utils/utils.php');
$json = file_get_contents('php://input');
$data = json_decode($json, true);


$modtype = $data['modtype'];
$data_ret = '{"error":-1}';

$headers = apache_request_headers();
$token = $headers['access-token'];

$json_token = json_decode(decrypt($token,$enc_password),true);

if (isset($modtype) && !empty($modtype) && !empty($json_token["user_username"]))
{
	if ($modtype === "fix")
	{
		echo '{"rule name": "value","credit score": "higher 10"}';
	}
	else
	{
		echo '{"error":-1}';
	}
}


?>
