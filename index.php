<?php
session_start();

if (!isset($_SESSION['username'])) {
	// $_SESSION['error_message'] = "You need to login first";
	header('Location: login.php');
	exit;
}
if ($_SESSION['role'] != "admin") {
	header('Location: login.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body>
	<div class="container">
		<h2 class="text-center">View Users</h2>
		<p>Hi <span><?php echo $_SESSION['username']; ?></span>, you're an <span><?php echo $_SESSION['role']; ?></span>. You have superpowers to delete, update and create users, hehehe.</p> 


	<a class="add-btn btn btn-success mb-3" href="./create.php" role="button">Create</a>
	<!-- <a class="btn btn-info mb-3 float-start" href="./update_profile.php" role="button">Update Profile</a> -->
	<a class="btn btn-outline-secondary mb-3 float-end" href="./logout.php" role="button">Logout</a>
		<table class="table table-hover bg-light table-striped table-bordered">
			<thead>
				<tr class="text-left">
					<th>ID</th>
					<th>Fisrt Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
				<tbody>
				<?php

				require 'dbconn.php';

				$sql = "SELECT * FROM tbl_users ORDER BY username ASC";

				$result = mysqli_query($conn, $sql);

				// if (!$result){

				// 	die("Invalid query: ");

				// }

				// while ($row = mysqli_fetch_assoc($result)) {
				// 	echo "

					// <tr>
					// 	<td>$row[id]</td>
					// 	<td>$row[fname]</td>
					// 	<td>$row[lname]</td>
					// 	<td>$row[username]</td>
					// 	<td>$row[role]</td>
					// 	<td>
					// 		<a class='btn btn-primary btn-sm' href='./update.php?id=$row[id]'>Update</a>
					// 		<a class='btn btn-danger btn-sm' href='./delete.php?id=$row[id]'>Delete</a>





					// 	</td>
					// </tr>

				// 	";
				// }
		if (mysqli_num_rows($result) > 0){
	    // Output the results in a table
	   
	    $num = 1;
	    while($row = mysqli_fetch_assoc($result)) { ?>

	
				<tr>
				<td><?php echo $num; ?></td>
				<td><?php echo $row['fname']; ?></td>
				<td><?php echo $row['lname']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['role']; ?></td>
				<td>
				<a class='btn btn-primary btn-sm' href='./update.php?id=<?php echo $row['id']; ?>'>Update</a>
				<a class='btn btn-danger btn-sm' href='./delete1.php?id=<?php echo $row['id']; ?>'>Delete</a>
				</td>
				</tr>
				
	    <?php $num++;}
	    echo "</table>";
		} else {
		    echo "0 results";
		}

				mysqli_close($conn);
				?>
				

				</tbody>
			</thead>
		</table>

	</div>

</body>

</html>