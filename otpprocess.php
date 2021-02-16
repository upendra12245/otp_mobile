<?php
session_start();
$url='localhost';
$username = "root";
$password = "";
$dbname = "otp_db";
$conn = mysqli_connect($url, $username, $password, $dbname);
/* Check connection */
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo $rno=$_SESSION['otp'];
   $urno=$_POST['otpvalue'];
if(!strcmp($rno,$urno))
{
	echo $name=$_SESSION['name'];
	echo $email=$_SESSION['email'];
   echo $phone=$_SESSION['phone'];
	
	
/* Create connection */


echo $sql = "INSERT INTO quote (name, email, phone)
VALUES ('$name', '$email', '$phone')";
 exit();
if (mysqli_query($conn, $sql)) {

   $authKey = "abcdefghijkakkkanhas";


$mobileNumber = $phone;
echo $mobileNumber;
/* Sender ID,While using route4 sender id should be 6 characters long. */
$senderId = "ABCDEF";

/* Your message to send, Add URL encoding here. */
$message = urlencode("Thank u for register with us. we will get back to you shortly.");

/* Define route */
$route = "route=4";
/* Prepare you post parameters */
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);


/* API URL */
$url="http://cloud.smsindiahub.in/vendorsms/checkdelivery.aspx?user=demo&password=demo&messageid=messageid";

/* init the resource */
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    /*,CURLOPT_FOLLOWLOCATION => true */
));


/* Ignore SSL certificate verification */
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


/* get response */
$output = curl_exec($ch);

/* Print error if any */
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

header( "Location: success.php" );

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
	return true;
}
else
{
	echo "failure";
	return false;
}
?>