<?php
	require 'session.inc.php';
	require 'connect.inc.php';

	if(!logged_in()) {
		header('Location: signin.php');
	}
?>



<!DOCTYPE html>


<html>
<head>

<title><?php echo htmlspecialchars($_SESSION['username']); ?></title>
<meta name="viewport" content="initial-scale=1">
<link href="style.php" type="text/css" rel="stylesheet"\>
<link rel="shortcut icon" href="images/icon.png">
<script src="http://code.jquery.com/jquery-1.11.3.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>

<body>

<div id="menu">
	<ul>
		<a href="profile.php"><li class="active">Profile</li></a>
		<a href="files.php"><li>Files</li></a>
		<a href="logout.php"><li>Sign out</li></a>
	</ul>
</div>

<div id="content">
	<div id="coverImage" <?php echo 'style="background-image:url(\'data/'.$_SESSION['user_id'] . '/cover' . $_SESSION['coverExt'] .'\'")'; ?> >
		<?php
			echo "<img id='profileImage' src='data/{$_SESSION['user_id']}/profile{$_SESSION['profileExt']}' />";
		?>

		

		<h1><?php echo htmlspecialchars($_SESSION['firstname']) . " " . htmlspecialchars($_SESSION['lastname'])   ?></h1>
		<p><i><b>
		<?php 
			try {
				$stmt = $db->prepare("select * from `users` where `id` like :id");
				$stmt->bindParam(':id', $_SESSION['user_id']);
				$stmt->execute();
				if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo htmlspecialchars($row['cover_text']);
				} else {
					die("Database problem");
				}
			} catch(PDOException $e) {
				die("Database problem");
			}

		?>
		</b></i></p>
	</div>
	
	<div id="text">
		<div id="leftRowDetails">
			<div class="detailsLine">
				<h3>Email:</h3>
				<p><?php
					if(!empty($row['email'])) {
						echo htmlspecialchars($row['email']);
					} else {
						echo "Not specified";
					}
					?>
				</p>
			</div>
			<div class="detailsLine">
				<h3>Age:</h3>
				<p><?php
					if(!empty($row['birth_date'])) {
						$today = new DateTime();
						$birthdate = new DateTime($row['birth_date']);
						$interval = $today->diff($birthdate);
						echo $interval->format('%y years');
					} else {
						echo "Not specified";
					}
					?>
				</p>
			</div>
		</div>
		<div id="rightRowDetails">
			<div class="detailsLine">
				<h3>Phone:</h3>
				<p><?php
					if(!empty($row['phone'])) {
						echo htmlspecialchars($row['phone']);
					} else {
						echo "Not specified";
					}
					?>
				</p>
			</div>
			<div class="detailsLine">
				<h3>Address:</h3>
				<p><?php
					if(!empty($row['address'])) {
						echo htmlspecialchars($row['address']);
					} else {
						echo "Not specified";
					}
					?>
				</p>
			</div>
		</div>
		<a href="editProfile.php">
			<div class="editButton">
				EDIT
			</div>
		</a>
	</div>

</div>

<div id="footer">
	<p>#created by *gingerin</p>
</div>

</body>

</html>