<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: quaranthings.html");
}

if (isset($_POST['submit'])) {
	$user = $_POST['username'];
	$password = ($_POST['password']);

	$sql = "SELECT * FROM user_data WHERE username='$user' AND password='$password'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: quaranthings.html");
	}
	
	else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login</title>
</head>

<body>
	<div class="container">
		<form action="" method="POST" class="login-email">

			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>

			<div class="input-group">
				<input type="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-group">
				<input type="password" placeholder="Password" name="password" id="password" value="<?php echo $_POST['password']; ?>" required>
                <span> <i class= "fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
			</div>

			<script>
				var state = false;
				function toggle(){
					if(state){
						document.getElementById("password").
						setAttribute("type", "password");
						document.getElementById("eye").style.color='#000';
						state = false;
					}
					else{
						document.getElementById("password").
						setAttribute("type", "text");
						document.getElementById("eye").style.color='#00ff80';
						state = true;
					}
				}
			</script>
	
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>

			<p class="login-register-text">Don't have an account? <a href="register.php"> Register Here</a> .</p>
		
		</form>
	</div>
	
</body>
</html>