<?php
session_start();

if ($_SESSION['role'] == "user") {
	header('Location: user_index.php');
	exit;
}
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$fname="";
$lname="";
$username="";
$password="";
$confirm_password="";
$role="";

if (isset($_POST['submit'])) {
 	
	require 'dbconn.php';

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$username = $_POST['username'];
	// $password = $_POST['password'];
	// $confirm_password = $_POST['confirm_password'];
	$role = $_POST['role'];

	if ($password == $confirm_password) {

		if ($role != -1) {
			$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
			
			$query = "INSERT INTO tbl_users(fname, lname, username, password, role) VALUES ('$fname', '$lname', '$username', '$hashed_pass', '$role')";
			$result = mysqli_query($conn, $query);

			if (!$result) {
				$error = "Error adding user!";
			} else{
				$success="User added successfully!";
				$_SESSION['success'] = $success;
				header('Location: create.php');
				exit;
			}			
		}else{
			$error = "Please select a role!";
		}
	}else{
		$error = "Passwords do not match!";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CREATE</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	

	<div class="container">
		<h1 class="title">ADD USER</h1>
		<form method="post" action="create.php">

			<?php if(isset($error)) { ?>
				<div class="error"><p style="color: red"><?php echo $error; ?></p></div>				
			<?php } ?> 

			<?php if(isset($success)) { ?>
				<div class="error"><p style="color: green"><?php echo $success; ?></p></div>				
			<?php } ?> 			

			<div class="input-filed">
				<input type="text" name="fname" placeholder="first name" value="<?php echo $fname; ?>" required>
			</div>

			<div class="input-filed">
				<input type="text" name="lname" placeholder="last name" value="<?php echo $lname; ?>" required>
			</div>

			<div class="input-filed">
				<input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-filed">
				<input type="password" name="password" placeholder="password" value="<?php echo $password; ?>" required>
			</div>

			<div class="input-filed">
				<input type="password" name="confirm_password" placeholder="confirm password" value="<?php echo $confirm_password; ?>" required>
			</div>

			<div class="input-filed">
				<select name="role" value="<?php echo $role; ?>" required>
					<option value="-1">Select a Role</option>
					<option value="admin">admin</option>
					<option  value="user">user</option>
				</select>
			</div>		

			<div class="input-filed">
				<input type="submit" name="submit" value="Add">
			</div>

			<div class="input-filed">
				<a href="./index.php">Back</a>
			</div>

		</form>
	</div>


</body>
</html>