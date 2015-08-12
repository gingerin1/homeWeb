<!DOCTYPE html>
<html>
<head>

<title>SHA512</title>
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
		<a href=""><li>About</li></a>
	</ul>
</div>

<div id="content">
	<div id="text">
		<h1>Hash generator</h1>
		<hr>
		<div class="formLine">
				<p style="width:100%;height:1em">
					<?php
						if(isset($_GET['pass'])) {
							echo "Hash:\t" . hash("sha512", $_GET['pass']);
						}
					?>
				</p>
		</div>

		<div id="formDiv">
			<form id="hashes" method="GET">
			<div class="formLine">
				<input type="text" value="password" name="pass">
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