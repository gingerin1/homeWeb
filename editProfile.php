<?php
	require_once 'session.inc.php';
	require_once 'connect.inc.php';
	require_once 'edit_upload_check.inc.php';

	if(!logged_in()) {
		header('Location: signin.php');
	}

	$passwordChanged = 0;
	$imageChanged = 0;
	$basicChanged = 0;
	$additionalChanged = 0;

	if(!empty($_FILES['coverImg']['name']) || !empty($_FILES['profileImg']['name'])) {
		$imageChanged = 1;
	}

	// Image check

	$profileError = upload_main_image("profileImg");
	$coverError = 0;
	if(!$profileError) {
		$stmt = $db->prepare("update `users` set profileImg_ext=:profExt where id=:id");
		$stmt->bindParam(":profExt", $_SESSION['profileExt']);
		$stmt->bindParam(":id", $_SESSION['user_id']);
		$stmt->execute();

		$coverError = upload_main_image("coverImg");

		if(!$coverError) {
			$stmt = $db->prepare("update `users` set coverImg_ext=:coverExt where id=:id");
			$stmt->bindParam(":coverExt", $_SESSION['coverExt']);
			$stmt->bindParam(":id", $_SESSION['user_id']);
			$stmt->execute();
		}
	}

	// Password check


	$passwordError = checkPassword();
	if(!$passwordError && isset($_POST['newPass']) && !empty($_POST['newPass'])) {
		try {
			$stmt = $db->prepare("update `users` set password=:password where id=:id");
			$stmt->bindParam(":password", hash("sha512", $_POST['newPass']));
			$stmt->bindParam(":id", $_SESSION['user_id']);
			$stmt->execute();
			$passwordChanged = 1;
		} catch(PDOException $e) {
			$passwordError = -1;
		}
	}

	// Basic data check

	$phoneError = $addressError = $emailError = $dateError = $usernameError =  0;
	$phoneChanged = $addressChanged = $emailChanged = $dateChanged = $usernameChanged = 0;

	if(isset($_POST['username']) && !empty($_POST['username']) && addslashes($_POST['username']) != $_SESSION['username']) {
		$usernameError = checkUsername($_POST['username']);
		if($usernameError == 0) {
			try {
				$stmt = $db->prepare("select * from `users` where username=:username");
				$stmt->bindParam(":username", addslashes($_POST['username']));
				$stmt->execute();
				if($row = $stmt->fetch(PDO::FETCH_ASSOC))
					$usernameError = 3;
			} catch(PDOException $e) {
				echo "Database error";
			}
		}
		$basicChanged = 1;
		$usernameChanged = 1;
	}

	if(isset($_POST['phone']) && !empty($_POST['phone']) && addslashes($_POST['phone']) != $_SESSION['phone']) {
		$phoneError = checkPhone();
		$basicChanged = 1;
		$phoneChanged = 1;
	}

	if(isset($_POST['address']) && !empty($_POST['address']) && addslashes($_POST['address']) != $_SESSION['address']) {
		$addressError = checkAddress();
		$basicChanged = 1;
		$addressChanged = 1;
	}

	if(isset($_POST['birthdate']) && !empty($_POST['birthdate']) && addslashes($_POST['birthdate']) != $_SESSION['birthdate']) {
		$dateError = checkBirth();
		$basicChanged = 1;
		$dateChanged = 1;
	}

	if(isset($_POST['email']) && !empty($_POST['email']) && $_SESSION['email'] != addslashes($_POST['email'])) {
		$emailError = checkEmail();
		$basicChanged = 1;
		$emailChanged = 1;
	}

	if($phoneError == 0 && $addressError == 0 && $emailError == 0 && $dateError == 0 && $usernameError == 0) {
		if($usernameChanged) {
			try {
				$stmt = $db->prepare("update `users` set username=:username where id=:id");
				$stmt->bindParam(":username", addslashes($_POST['username']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['username'] = addslashes($_POST['username']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		if($phoneChanged && !$phoneError) {
			try {
				$stmt = $db->prepare("update `users` set phone=:phone where id=:id");
				$stmt->bindParam(":phone", addslashes($_POST['phone']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['phone'] = addslashes($_POST['phone']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		if($addressChanged && !$addressError) {
			try {
				$stmt = $db->prepare("update `users` set address=:address where id=:id");
				$stmt->bindParam(":address", addslashes($_POST['address']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['address'] = addslashes($_POST['address']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		if($dateChanged && !$dateError) {
			try {
				$stmt = $db->prepare("update `users` set birth_date=:birthdate where id=:id");
				$stmt->bindParam(":birthdate", addslashes($_POST['birthdate']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['user_id'] = addslashes($_POST['birthdate']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		if($emailChanged && !$emailError) {
			try {
				$stmt = $db->prepare("update `users` set email=:email where id=:id");
				$stmt->bindParam(":email", addslashes($_POST['email']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['email'] = addslashes($_POST['email']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		//additional change
		$additionalError = 0;
		if(isset($_POST['covertext']) && !empty($_POST['covertext']) && addslashes($_POST['covertext']) != $_SESSION['covertext']) {
			$additionalError = checkAdditional();
			$additionalChanged = 1;
		}

		if($additionalChanged && !$additionalError) {
			try {
				$stmt = $db->prepare("update `users` set cover_text=:cover_text where id=:id");
				$stmt->bindParam(":cover_text", addslashes($_POST['covertext']));
				$stmt->bindParam(":id", $_SESSION['user_id']);
				$stmt->execute();
				$_SESSION['covertext'] = addslashes($_POST['covertext']);
			} catch(PDOException $e) {
				echo "Database error";
			}
		}

		if(isset($_POST['email']) && !$basicChanged && !$passwordChanged && !$imageChanged && !$additionalChanged) {
			header('Location: profile.php');
		}
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
		<form action="editProfile.php" method="POST" enctype="multipart/form-data">
			<div id="editData">

				<div id="basicSettings">
					<div class="detailsLine">
						<h3>Nickname</h3>
						<input type="text" value=
						<?php
							echo "'" . htmlentities($row['username']) . "'";
						?> name="username">
					</div>

					<div class="detailsLine">
						<h3>Email</h3>
						<input type="email" value=
						<?php
							echo "'" . htmlspecialchars($row['email']) ."'";
						?> name="email">
					</div>
					<div class="detailsLine">
						<h3>Birthdate</h3>
						<input type="date" value= 
						<?php
							echo "'" . htmlspecialchars($row['birth_date']) . "'";
						?> name="birthdate" >
					</div>
					<div class="detailsLine">
						<h3>Phone</h3>
						<input type="text" value=
						<?php
								echo "'" . htmlspecialchars($row['phone']) . "'";
						?> name="phone">
					</div>
					<div class="detailsLine">
						<h3>Address</h3>
						<input type="text" maxlength="255" value=
						<?php
								echo "'" . htmlspecialchars($row['address'])  . "'";
						?> name="address">
					</div>

					<div class="editError">
						<?php
							if($usernameError) {
								if($usernameError == 1) 
									echo "<p>Username cannot contain white spaces.</p>";
								if($usernameError == 2)
									echo "<p>Username cannot contain characters ' \" < or >.</p>";
								if($usernameError == 3)
									echo "<p>Username is in use by another person</p>";
							}

							if($emailError) {
								echo "<p>Incorrect email format.</p>";
							}

							if($dateError) {
								echo "<p>Incorrect date.</p>";
							}

							if($phoneError) {
								echo "<p>Incorrect phone format.</p>";
							}

							if($addressError) {
								echo "<p>Address cannot contain characters ' \" < or >.</p>";
							}
						?>
					</div>

				</div>

			
				<div id="additionalSettings">
					<h3 class="editHeading">ADDITIONAL</h3>
					<hr>
					<div class="detailsLine">
						<h3>Cover text</h3>
						<input type="text" maxlength="255" value=
						<?php
							echo "'" . htmlentities($row['cover_text']) . "'";
						?> name="covertext">
					</div>

					<div class="editError">
						<?php
							if($additionalError)
								echo "<p>Cover text cannot contain characters ' \" < or >.</p>";
						?>
					</div>
				</div>

				<div id="passwordSettings">
					<h3 class="editHeading">PASSWORD</h3>
					<hr>
					<div class="detailsLine">
						<h3>Current Password</h3>
						<input type="password" value="" name="currentPass">
					</div>
					<div class="detailsLine">
						<h3>New Password</h3>
						<input type="password" value="" name="newPass">
					</div>
					<div class="detailsLine">
						<h3>Repeat password</h3>
						<input type="password" value="" name="repeatPass">
					</div>
					<div class="editError">
						<?php 
							switch($passwordError) {
								case 2:
									echo "<p>All fields must be completed in order to change password.</p>";
									break;
								case 3:
									echo "<p>Incorrect password.</p>";
									break;
								case 4:
									echo "<p>Passwords do not match.</p>";
									break;
								case 1:
								case 5:
									echo "<p>Password must be at least 8 letters long and not trivial.</p>";
									break;
								case -1:
									echo "<p>Database problem. Try again later.</p>";
									break;
							}
						?>
					</div>
				</div>

				<div id="imageSettings">
					<h3 class="editHeading">IMAGES</h3>
					<hr>
					<div class="detailsLine">
						<h3>Profile Picture*</h3>
						<input type="file" name="profileImg" class="getFile">
					</div>
					<div class="detailsLine">
						<h3>Cover Image*</h3>
						<input type="file" name="coverImg" class="getFile">
					</div>
					<div class="help">
						<p>*Profile and cover images can be set via files, too</p>
					</div>

					<div class="editError">
						<?php
						if($profileError == 1 || $coverError == 1)
							echo "<p>Please use only files in JPEG, PNG or GIF formats, which size doesn't exceed 5MB.</p>";
						if($profileError == 2 || $coverError == 2)
							echo "<p>Error while getting file. Please try again.</p>";
						?>
					</div>
				</div>
			</div>

			<div id="imgPassButtons">
				<button class="editButton buttonHover" type="button" id="showAdditionalOptions">ADDITIONAL</button>
				<button class="editButton buttonHover" type="button" id="showPassOptions">PASSWORD</button>
				<button class="editButton buttonHover" type="button" id="showImageOptions">IMAGES</button>
			</div>
			<div id="cancelSaveButtons">
				<input type="submit" class="editButton buttonHover" value="SAVE">
				<a href="profile.php"><button class="editButton buttonHover" type="button">CANCEL</button></a>
			</div>
		</form>
	</div>
</div>

<div id="footer">
	<p>#created by *gingerin</p>
</div>

</body>

</html>