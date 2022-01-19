<?php
require_once '../../Database/connection.inc.php';

$user_name = $_POST['Name'];	//assigning the values to a variable
$email_add = $_POST['Email'];

$query = "SELECT Email FROM $table WHERE Email='$email_add'";
$result = $dbc->query($query);

if ($result->num_rows > 0){		//if statement if ever the email add already exist
	echo 'This email has been already subscribed.';
}else{

$date = date("Y-m-d H:i:s");	//setting the format of the date
								//if it is unique, it will be added to the database
$query = "INSERT INTO $table (Name, Email, Date) VALUES ('$user_name', '$email_add', '$date')";

mysqli_query($dbc, $query)		//error catcher
	or die ("Error inserting email" . mysqli_error($dbc));
header('Location: quaranthings.html');	//after the process is done, it will be back to the homepage
}

mysqli_close($dbc);