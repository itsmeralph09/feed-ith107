<?php
session_start();

if (!isset($_SESSION['username'])) {
	header('Location: ../login.php');
	exit;
}else{
	$username = $_SESSION['username'];
}
if ($_SESSION['role'] != "admin") {
	header('Location: ../login.php');
	exit;
}

require './dbconn.php';

$id="";
$fname="";
$lname="";


	$sql = "SELECT * FROM tbl_users WHERE username='$username'";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);

	$id=$row['id'];
	$fname=$row['fname'];
	$lname=$row['lname'];

	if (isset($_POST['submit'])) {
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$username=$_POST['username'];
			$new_pass=$_POST['new_password'];
			$confirm_new_pass=$_POST['confirm_new_password'];
		// check if may laman ang new password input
		if (!empty($new_pass)) {
				// check if tugma si new pass at confirm new pass
			if ($new_pass==$confirm_new_pass) {
				$final_pass = password_hash($new_pass, PASSWORD_DEFAULT);

				$sql = "UPDATE tbl_users ". "SET fname='$fname', lname='$lname', username='$username', password='$final_pass'". "WHERE id = $id";
				$result = $conn->query($sql);

				header("location: ./index.php");
				exit;

			}else{
				echo "New password and password confirmation do not match!";
			}
			
		}else{
			$sql = "UPDATE tbl_users ". "SET fname='$fname', lname='$lname', username='$username'". "WHERE id = $id";
				$result = $conn->query($sql);
				header("location: ./index.php");
				exit;
		}
		
	}
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UPDATE</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	

	<div class="container">
		<h1 class="title">UPDATE PROFILE</h1>

		<form method="post" action="user_update_profile.php">

			<?php if(isset($error)) { ?>
				<div class="error"><p style="color: red"><?php echo $error; ?></p></div>				
			<?php } ?> 

			<?php if(isset($success)) { ?>
				<div class="error"><p style="color: green"><?php echo $success; ?></p></div>				
			<?php } ?>			

			<div class="input-filed">
				<div class="input-label"><label>First Name</label></div>
				<input type="text" name="fname" placeholder="first name" value="<?php echo $fname; ?>" required>
			</div>

			<div class="input-filed">
				<div class="input-label"><label>Last Name</label></div>
				<input type="text" name="lname" placeholder="last name" value="<?php echo $lname; ?>" required>
			</div>

			<div class="input-filed">
				<div class="input-label"><label>Username</label></div>
				<input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" required>
			</div>

			<div class="input-filed">
				<div class="input-label"><label>New Password</label></div>
				<input type="password" name="new_password" placeholder="type new password, leave blank if you do not want to update">
			</div>

			<div class="input-filed">
				<div class="input-label"><label>Confirm New Password</label></div>
				<input type="password" name="confirm_new_password" placeholder="confirm new password">
			</div>

			<!-- <div class="input-filed">
				<select name="role" value="<?php echo $role; ?>" required>
					<option value="-1">Select a Role</option>
					<option value="admin">admin</option>
					<option  value="user">user</option>
				</select>
			</div>		 -->

			<div class="input-filed">
				<input type="submit" name="submit" value="submit">
			</div>

			<div class="input-filed">
				<a href="./index.php">Back</a>
			</div>

		</form>
	</div>


</body>
</html>