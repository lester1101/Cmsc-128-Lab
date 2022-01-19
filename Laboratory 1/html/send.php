<?php
require_once '../../Database/connection.inc.php';

$subject = $_POST['subject'];	//assigning the values to a variable
$body = $_POST['body']; 

$headers = 'From: komsai.things@gmail.com' . '\n';	//the details of the sender
$headers .= 'Reply-To: komsai.things@gmail.com' . '\n';
$headers .= 'Content-Type: text/plain; charset="iso-8859-1"' . "\n";
$headers .= 'Content-Transfer-Encoding: 8bit';

$query = "SELECT * FROM $table";	//selecting all the emails in the database
$result = mysqli_query($dbc, $query)
	or die('Error querying database' . mysqli_error($dbc));

while ($row = mysqli_fetch_array($result)){
	$user_name = $row['Name'];
	$email_add = $row['Email'];

	$msg="Dear $user_name, \n$body";//compose message

	if (mail($email_add, $subject, $msg, $headers)){
		echo 'Email sent to ' . $email_add . '<br>';	//will echo the successfull process
	} else {
		echo 'Error while sending an email to: ' . $email_add;	//will tell if the email address is invalid
	}
}

mysqli_close($dbc);