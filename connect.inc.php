<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=home_users", "root", "XnTQskUj3Z");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	printf("Error while connecting to the database: %s\n", $e->getMessage()); 
}	
?>