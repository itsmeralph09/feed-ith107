<?php
require 'dbconn.php';

$fname="";
$lname="";
$username="";
$role="";


	if ($_SERVER ['REQUEST_METHOD'] == 'GET'){
		//get method: show the data of the client

		if ( !isset ($_GET["id"])){
			header ("location: ./index.php");
			exit;
		}

		$id = $_GET["id"];
		// read the row of the selected client from the db table

		$sql = "SELECT * FROM tbl_users WHERE id=$id";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if (!$row){
			header ("location: ./index.php");
			exit;
		}

			$fname= $row["fname"];
			$lname = $row["lname"];
			$username = $row["username"];
			$role = $row["role"];

	}
	else{

		// Post method: update the data of the client

			$id = $_POST["id"];
			$fname = $_POST["fname"];
			$lname = $_POST["lname"];
			$username = $_POST["username"];
			$role = $_POST["role"];


		do{
			$sql = "UPDATE tbl_users ". "SET fname='$fname', lname='$lname', username='$username', role='$role'". "WHERE id = $id";
			$result = $conn->query($sql);

			if (!$result){
				$error = "Invalid Query: ".$conn->error;
				break;
			}

			$success = "Student updated successfully";
			// close na ang db connection
			$conn->close();

			header("location: ./index.php");
			exit;
		}
		while (true);
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
		<h1 class="title">EDIT USER</h1>

		<form method="post" action="update1.php">

			<?php if(isset($error)) { ?>
				<div class="error"><p style="color: red"><?php echo $error; ?></p></div>				
			<?php } ?> 

			<?php if(isset($success)) { ?>
				<div class="error"><p style="color: green"><?php echo $success; ?></p></div>				
			<?php } ?>

			<input type="hidden" name="id" value="<?php echo $id; ?>"> 			

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