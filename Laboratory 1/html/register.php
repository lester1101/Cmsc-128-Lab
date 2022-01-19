<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if($uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8) {

		if ($password == $cpassword) {
			$sql = "SELECT * FROM user_data WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			
			if (!$result->num_rows > 0) {
				$sql = "INSERT INTO user_data (username, password)
						VALUES ('$username', '$password')";
				$result = mysqli_query($conn, $sql);

				if ($result) {
					echo "<script>alert('Account created succesfully.')</script>";
					$username = "";
					$_POST['password'] = "";
					$_POST['cpassword'] = "";

				} else {
					echo "<script>alert('Something went wrong.')</script>";
				}

			} else {
				echo "<script>alert('Username already taken.')</script>";
			}

		} else {
			echo "<script>alert('Password didn't match.')</script>";
		}
	} else {
	echo "<script>alert('Password must consists of at least 8 characters, one capital letter, a number, and a symbol.')</script>";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<title>Sign up</title>
</head>

<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 1.5rem; font-weight: 800;">Create your account</p>
			
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>

            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			
			<p class="login-register-text">Already have an account?  <a href="login.php"> Login Here</a> .</p>
		</form>
	</div>
</body>
</html>