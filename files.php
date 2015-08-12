<?php
	require 'session.inc.php';
	require 'connect.inc.php';
	require 'edit_upload_check.inc.php';

	if(!logged_in()) {
		header('Location: signin.php');
	}

	$nameError = 0;
	$fileError = 0;



	if(isset($_POST['type']) && $_POST['type'] == 'folder') {
		if(isset($_POST['name']) && !empty($_POST['name'])) {
			$name = trim($_POST['name']);
			$nameError = checkUsername($name);
			if(strpos($name, '.')) {
				$nameError = 1;
			}
			if(!$nameError) {
				if(isset($_SESSION['location']) && !empty($_SESSION['location'])) {
					$filepath = $_SESSION['location'] . '/' . $name;
				} else {
					$filepath = "data/" . $_SESSION['user_id'] . "/home/" . $name;
				}
				if(!file_exists($filepath)) {
					mkdir($filepath);
					copy("data/.htaccess", $filepath . "/.htaccess");
				} else $fileError = 4;
			}
		} else {
			$nameError = 3;
		}

	} else if(isset($_POST['type']) && $_POST['type'] == 'file') {
		if(!empty($_FILES['fileChoose']['tmp_name']) && isset($_FILES['fileChoose']) ) {
			$submit = 1;
			$fileError = 0;

			if($_FILES['fileChoose']['size'] > 5000000) {
				$fileError = 1;
			}

			if(!$fileError) {
				$filepath = "";

				if(isset($_POST['name']) && !empty($_POST['name'])) {
					$name = trim($_POST['name']);
					$nameError = checkUsername($name);
					$file_parts = pathinfo($_FILES['fileChoose']['name']);
					$extension = '.' . $file_parts['extension'];

					if(!$nameError) {
						if(isset($_SESSION['location']) && !empty($_SESSION['location'])) {
							$filepath = $_SESSION['location'] . '/' . $name . $extension;
						} else {
							$filepath = "data/" . $_SESSION['user_id'] . "/home/" . $name . $extension;
						}
					}
				} else {
					$name = $_FILES['fileChoose']['name'];
					$file_parts = pathinfo($name);
					$extension = '.' . $file_parts['extension'];

					if(isset($_SESSION['location']) && !empty($_SESSION['location'])) {
						$filepath = $_SESSION['location'] . '/' . $_FILES['fileChoose']['name'];
					} else {
						$filepath = "data/" . $_SESSION['user_id'] . "/home/" . $_FILES['fileChoose']['name'];
					}
				}

				if(!$fileError && !$nameError) {
					if(!file_exists($filepath)) {
						if (!is_uploaded_file($_FILES['fileChoose']['tmp_name']) || !copy($_FILES['fileChoose']['tmp_name'], $filepath)) {
							$fileError = 2;
						} else {
							chmod($filepath, 776);
						}
					} else {
						$fileError = 4;
					}
				}
			}
		} else {
			if(isset($_POST['name']) && !empty($_POST['name'])) {
				$name = trim($_POST['name']);
				$nameError = checkUsername($name);
				if(!$nameError) {
					if(isset($_SESSION['location']) && !empty($_SESSION['location'])) {
						$filepath = $_SESSION['location'] . '/' . $name . '.txt';
					} else {
						$filepath = "data/" . $_SESSION['user_id'] . "/home/" . $name . ".txt";
					}

					if(!file_exists($filepath)) {
						$file = fopen($filepath, "w");
						if($file) {
							fclose($file);
						} else {
							$fileError = 2;
						}
					} else {
						$fileError = 4;
					}
				}
			}
		}
	}



?>



<!DOCTYPE html>


<html>
<head>

<title><?php echo $_SESSION['username']; ?>'s files</title>
<meta name="viewport" content="initial-scale=1">
<link href="style.php" type="text/css" rel="stylesheet"\>
<link rel="shortcut icon" href="images/icon.png">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>

<body>

<div id="menu">
	<ul>
		<a href="profile.php"><li>Profile</li></a>
		<a href="files.php"><li class="active">Files</li></a>
		<a href="logout.php"><li>Sign out</li></a>
	</ul>
</div>


<div id="content">

		<div id="navigation">

			<div id="list">
				<a href="files.php"><div id="home" class="navItem navActive buttonHover"> Home</div></a>
				<?php 
					$numFolders = 0;
					$numFiles = 0;
					$dir = "data/". $_SESSION['user_id'] . "/home/";
					$entries = scandir($dir); 
					$directories = array();
					$files = array(); 
					foreach($entries as $file) {
						if($file[0] != ".") {
							$type = filetype($dir . $file);
							if($type == "dir") {
								$directories[] = $file;
								$numFolders++;
							} else {
								$files[] = $file;
								$numFiles++;
							}
						}
					}
					
					foreach($directories as $dir) {
						echo '<a href="files.php?location='. $dir .'"><div id="home/' . $dir . '" class="navItem buttonHover folderLink"><i class="fa fa-folder-o"></i>' . $dir .'</div></a>';
					}

					foreach($files as $file) {
						echo '<a href=data/'.$_SESSION['user_id'] . '/home/' . $file . '><div class="navItem buttonHover"><i class="fa fa-file-o"></i>' . $file . '</div></a>';
					}
				?>
			</div>
			<div id="navigationButtons">
				<i class="fa fa-plus buttonHover"></i>
			</div>
		</div>

	<div id="files">
		<form action=<?php
			if(isset($_GET['location']) && !empty($_GET['location'])) {
				echo '"files.php?location=' . $_GET['location'] . '"'; 
			} else {
				echo '"files.php"';
			}
		?> method="post" enctype="multipart/form-data" id="newFileForm">
		<?php 
			if($fileError || $nameError) {
				$errorMSG = '';
				if($nameError) {
					$errorMSG = '<p>Name cannot contain characters \' " < or > and extension has to match the filetype.</p>';
				}
				if($fileError) {
					$errorMSG = '<p>File not chosen, too big, already exists or there was problem while uploading file.</p>';
				}
				echo '<div id="error">' . $errorMSG . '</div>';
			}

		?>
		<div id="newItem">
				<div id="folderSelect" class="buttonHover">
					<input type="radio" name="type" value="folder" id="folderRadio"><p>Folder</p>
				</div>
				<div id="fileSelect" class="buttonHover">
					<input type="radio" name="type" value="file" id="fileRadio"><p>File</p>
				</div>
				<div id="rightPart">
					<p id="name">Name:</p><input id="nameField" type="text" name="name">
					<input type="submit" value="Submit" id="fileSubmit" class="buttonHover">
					<input type="button" value="Cancel" id="fileCancel" class="buttonHover">
				</div>
		</div>
		<div id="selectFilePC">
			<input type="file" id="fileChoose" name="fileChoose">
		</div>
		</form>

		<div id="folderContent">
			<?php 
				if(isset($_GET['location']) && !empty($_GET['location'])) {
					$location = $_GET['location'];
					$path = "data/". $_SESSION['user_id'] . "/home/" . $location;
					if(strpos($location, '.') === FALSE && file_exists($path)) {
						$shown = 0;
						$_SESSION['location'] = $path;
						$entries = scandir($path);
						$dirs = array();
						$files = array();
						foreach($entries as $f) {
							if($f[0] != '.' && !strpos($f, '.htaccess')) {
								$shown++;
								$type = filetype($path . '/'.$f);
								if($type == 'dir') {
									$dirs[] = $f;
								} else {
									$files[] = $f;
								}
							}
						}
						foreach($dirs as $d) {
							echo '<a href="files.php?location='. $location . '/'  . $d .'"><div id="' .$path . '/' . $d . '" class="folderItem buttonHover folder folderLink"><i class="fa fa-folder-o"></i><p>' . $d .'</p></div></a>';
						}

						foreach($files as $f) {
							echo '<a href="'.$path . '/'  . $f . '"><div class="folderItem buttonHover file"><i class="fa fa-file-o"></i><p>' . $f . '</p></div></a>';
						}

						if(!$shown) {
							echo '<p id="empty">No files found.</p>';
						}
					} else {
						die("Incorrect path supplied!");
					}
				} else {
					foreach($directories as $dir) {
						echo '<a href="files.php?location='. $dir .'"><div id="home/' . $dir . '" class="folderItem buttonHover folder folderLink"><i class="fa fa-folder-o"></i><p>' . $dir .'</p></div></a>';
					}

					foreach($files as $file) {
						echo '<a href="data/'.$_SESSION['user_id'] . '/home/' . $file . '"><div class="folderItem buttonHover file"><i class="fa fa-file-o"></i><p>' . $file . '</p></div></a>';
					}
				}
			?>
		</div>
	</div>




</div>

<div id="footer">
	<p>#created by *gingerin</p>
</div>

</body>

</html>