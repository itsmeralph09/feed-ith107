<?php
session_start();

if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == "admin") {
		header('Location: index.php');
		exit;
	} else{
		header('Location: user_index.php');
		exit;
	}
		
}


$username = "";
$password = "";

require 'dbconn.php';

if (isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM tbl_users WHERE username = '$username'";

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result)>0) {

		$row = mysqli_fetch_assoc($result);

		$hashed_pass = $row['password'];

		// echo $hashed_pass;
		if (password_verify($password, $hashed_pass)) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = $row['role'];

			if ($_SESSION['role'] == "admin") {
				header('Location: index.php');				
			} else{
				header('Location: ./user/user_index.php');
			}
			exit;

		} else{
			$error = "Incorrect Password";
		}
		
	} else{
		$error = "Username not found!";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	

	<div class="container">
		<h1 class="title">LOGIN PAGE</h1>
		<form method="post" action="login.php">

			<?php if(isset($error)) { ?>
				<div class="error"><p style="color: red"><?php echo $error; ?></p></div>				
			<?php } ?> 

			<div class="input-filed">
				<input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-filed">
				<input type="password" name="password" placeholder="password" value="<?php echo $password; ?>" required>
			</div>

			<div class="input-filed">
				<input type="submit" name="submit" value="Login">
			</div>
		</form>
	</div>


</body>
</html>
