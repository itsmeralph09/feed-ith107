<?php

session_start();


if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}


if (!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit;
}else{
	$username = $_SESSION['username'];
}

if(isset($_POST['submit'])){
	include 'dbconn.php';

	$post = $_POST['post'];

	$query = "INSERT INTO tbl_post(username, post) VALUES ('$username', '$post')";
	$result = mysqli_query($conn, $query);

	if (!$result) {
				$error = "Error posting!";
				$_SESSION['error'] = $error;

			} else{
				$success="Posted successfully!";
				$_SESSION['success'] = $success;
				header('Location: feed.php');
				exit;
			}			
}

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Feed</title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
		<link rel="stylesheet" type="text/css" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="./css/feed.css">
	</head>
	<body>
		<div class="container">

			<form action="feed.php" method="post">
			<?php if(isset($error)) { ?>
				<div class="error"><p style="color: red"><?php echo $error; ?></p></div>				
			<?php } ?> 

			<?php if(isset($success)) { ?>
				<div class="error"><p style="color: green"><?php echo $success; ?></p></div>				
			<?php } ?>
		  	<label class="form-label" for="form4Example3">What's on your mind...</label>
		    <textarea class="form-control" id="form4Example3" rows="5" name="post" required></textarea>
		  	<button type="submit" value="submit" name="submit" class="btn btn-primary btn-block mb-4 float-end" style="margin: 3px;">
		    Post
		  </button>
		  </form>
		</div>
		<div class="container1">

			<?php

				include 'dbconn.php';

				$sql = "SELECT * FROM tbl_post";

				$result = mysqli_query($conn, $sql);

				if (!$result){

					die("Invalid query: ");

				}

				while ($row = mysqli_fetch_assoc($result)) {
					echo "
					 <div class='card'>
						 <div class='username-date'>
						 <p class='float-start'>$row[username]</p>
						 <p class='float-end'>$row[date]</p></div>
						 <div class='post-area'><p>$row[post]</p></div>
					</div>
					";
				}

			?>
			
		</div>
	</body>
</html>