<?php
	require 'session.inc.php';

	if(logged_in()) {
		header('Location: profile.php');
 	}

	$error = 0;
	require 'connect.inc.php';
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = hash("sha512", $_POST['password']);
		if(!empty($username) && !empty($password) && $username != "username") {
			try {
				$result = $db->prepare("select * from `users` where username=:username and password=:password");
				$result->bindParam(':username', $username);
				$result->bindParam(':password', $password);
				$result->execute();

				if($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$user_id = $row['id'];
					$_SESSION['user_id'] = $user_id;
					$_SESSION['username'] = $row['username'];
					$_SESSION['firstname'] = $row['first_name'];
					$_SESSION['lastname'] = $row['last_name'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['birthdate'] = $row['birth_date'];
					$_SESSION['address'] = $row['address'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['covertext'] = $row['cover_text'];
					$_SESSION['profileExt'] = $row['profileImg_ext'];
					$_SESSION['coverExt'] = $row['coverImg_ext'];
					header('Location: profile.php'); 
				} else {
					$error = 1;
				}
			} catch (PDOException $e){
				$error = 1;
			}
		} else {
			$error = 1;
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>

<title>Sign in</title>
<meta name="viewport" content="initial-scale=1">
<link href="style.php" type="text/css" rel="stylesheet"\>
<link rel="shortcut icon" href="images/icon.png">
<script src="http://code.jquery.com/jquery-1.11.3.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>

<body>
<div id="header">
	<h1 id="mainHeading" class="AbsoluteCenter">Home</h1>
</div>

<div id="menu">
	<ul>
		<a href="index.php"><li>Welcome</li></a>
		<a href="signin.php"><li class="active">Sign in</li></a>
		<a href="about.php"><li>About</li></a>
	</ul>
</div>

<div id="content">
	<div id="text">
		<h1>Sign in</h1>
		<hr>

		<div id="formDiv">
			<form id="signFields" method="POST">
			<div class="formLine">
				<p style="color:red">
					<?php
						if($error == 1) {
							echo "Please supply a valid username and a valid password.";
						}
					?>
				</p>
			</div>

			<div class="formLine">
				<input type="text" value=<?php
					if(isset($_POST['username']))
						echo htmlspecialchars($_POST['username']);
					else echo 'username';
				?>
				 name="username" id="username" class="emptyOnClick">
			</div>
			<div class="formLine">
				<input type="password" value="password" name="password" id="password" class="emptyOnClick">
			</div>
			<div class="formLine">
				<input type="submit" id="submit" value="Sign in">
			</div>
			</form>

		</div>
	</div>

</div>

<div id="footer">
	<p>#created by *gingerin</p>
</div>

</body>

</html>