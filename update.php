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
				$errorMessage = "Invalid Query: ".$conn->error;
				break;
			}

			$successMessage = "Student updated successfully";
			// close na ang db connection
			$conn->close();

			header("location: ./index.php");
			exit;
		}
		while (true);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name ="viewport" content ="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href = "./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./style.css">
	<title>Edit Student</title>
</head>
<body>
	<div class = "container my-5">
		<h2>Edit Student</h2>

		<?php
		if (!empty($errorMessage)){
			echo"

			<div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
			<strong>$errorMessage</strong>
			<button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Close'</button>
			</div>
			";	
		}

		?>

		<form method = "post">
			<input type="hidden" name="student-id" value="<?php echo $student_id; ?>">
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Last Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "last-name" value= "<?php echo $last_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>First Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "first-name" value= "<?php echo $first_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Extension Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "extension-name" value= "<?php echo $extension_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Middle Name</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "middle-name" value= "<?php echo $middle_name; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Email</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "email" value= "<?php echo $email; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Phone Number</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "phone-number" value= "<?php echo $phone_number; ?>">
				</div>
			</div>
			<div class = "row mb-3">
				<label class ="col-sm-3" col-form-label>Address</label>
				<div class = "col-sm-6">
					<input type = "text" class = "form-control" name = "address" value= "<?php echo $address; ?>">
				</div>
			</div>


			<?php

			if (!empty($successMessage)){
				echo"
				<div class = 'row mb-3'>
					<div class ='offset-sm-3 col-sm-6'>
						<div class='alert alert-success alert-dismissable fade show' role='alert'>
					<strong>$successMessage</strong>
					<button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label</button>
						</div>
					</div>
				</div>

				";
			}
			?>

			<div class = "row mb-3">
				<div class="offset-sm-3 d-grid">
					<button type ="submit" class ="btn btn-primary">Submit</button>
				</div>
				<div class = "col-sm-3 d-grid">
					<a class="btn btn-outline-secondary" href ="./index.php" role="button">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>