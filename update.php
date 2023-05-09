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
			$new_pass= $_POST["new_password"];
			$confirm_new_pass=$_POST["confirm_new_password"];
			$role = $_POST["role"];


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
		<h1 class="title">EDIT USER</h1>

		<form method="post" action="update.php">

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
				<input type="password" name="new_password" placeholder="new password, leave blank if don't want to change" value="" >
			</div>

			<div class="input-filed">
				<input type="password" name="confirm_new_password" placeholder="confirm new password" value="" >
			</div>

			<div class="input-filed">
				<select name="role" value="<?php echo $role; ?>" required>
					<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
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