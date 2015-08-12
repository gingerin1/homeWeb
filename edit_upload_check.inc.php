<?php

	function upload_main_image($type) {
		$fileError = 0;
		$submit = 0;
		$filepath = "";	

		if(empty($_FILES[$type]['name'])){
	   			 //file not selected
		} else if(isset($_FILES[$type])) { 
			$submit = 1;
			$fileError = 1;
			$ext = "";
			if(exif_imagetype($_FILES[$type]['tmp_name']) == IMAGETYPE_JPEG) {
				$ext = ".jpeg";
				$fileError = 0;
			}
			if(exif_imagetype($_FILES[$type]['tmp_name']) == IMAGETYPE_PNG) {
				$ext = ".png";
				$fileError = 0;
			}
			if(exif_imagetype($_FILES[$type]['tmp_name']) == IMAGETYPE_GIF) {
				$ext = ".gif";
				$fileError = 0;
			}

			if($_FILES[$type]['size'] > 5000000) {
				$fileError = 1;
			}


			if($type == 'profileImg') {
				$filepath = "data/" . $_SESSION['user_id'] . "/profile" . $ext; 
				if(!$fileError)
					$_SESSION['profileExt'] = $ext;
			} else if($type == 'coverImg') {
				$filepath = "data/" . $_SESSION['user_id'] . "/cover" . $ext;
				if(!$fileError)
					$_SESSION['coverExt'] = $ext;
			} else {
				$fileError = 3;
			}
			if(!$fileError) {
				if (!is_uploaded_file($_FILES[$type]['tmp_name']) || !copy($_FILES[$type]['tmp_name'], $filepath)) {
					$fileError = 2;
				}
			}
		}
		return $fileError;
	}

	function checkPassword() {
		if(isset($_POST['currentPass']) && isset($_POST['newPass']) && isset($_POST['repeatPass'])) {
			if(empty($_POST['currentPass']) && empty($_POST['newPass']) && empty($_POST['repeatPass'])) {
				return 0;
			}
			if(($_POST['currentPass'] != "password") || ($_POST['newPass'] != "password") || ($_POST['repeatPass'] != "password")) {
				if(!empty($_POST['currentPass']) && !empty($_POST['newPass']) && !empty($_POST['repeatPass'])) {
					if(hash("sha512", $_POST['currentPass']) == $_SESSION['password']) {
						if($_POST['newPass'] == $_POST['repeatPass']) {
							if(strlen($_POST['newPass']) >= 8) {
								return 0;
							} else
								return 5;
						} else 
							return 4;
					} else
						return 3;
				} else
					return 2;
			} else 
				return 1;
		} else return 0;
	}


	function checkPhone() {
		if(strlen($_POST['phone']) == 13 &&  ereg("\+42.9[0-9]*", $_POST['phone'])) {
			return 0;
		}

		if(strlen($_POST['phone']) == 8 &&  ereg("09[0-9]*", $_POST['phone'])) {
			return 0;
		}
		return 1;
	}

	function checkAddress() {
		if(ereg(".*<.*", $_POST['address']) || ereg(".*>.*", $_POST['address']) || ereg(".*'.*", $_POST['username']) || ereg('.*".*', $_POST['username']))
			return 1;
		return 0;
	}

	function checkBirth() {
		$dateArr = preg_split("/[-]/", $_POST['birthdate']);
		if((int)$dateArr[0] > 2015 || (int)$dateArr[0] < 1900)
			return 1;
		if((int)$dateArr[1] > 12 || (int)$dateArr[1] < 1)
			return 1;
		if((int)$dateArr[2] > 31 || (int)$dateArr[2] < 1)
			return 1;
		return 0;
	}

	function checkEmail() {
		if(ereg(".*@.*", $_POST['email']))
			return 0;
		return 1;
	}

	function checkUsername($sth) {
		if(strpos($sth, ' ') === FALSE) {
			if(ereg(".*<.*", $sth) || ereg(".*>.*", $sth) || ereg(".*'.*", $sth) || ereg('.*".*', $sth))
				return 2;
			return 0;
		} else return 1;
	}

	function checkAdditional() {
		if(ereg(".*<.*", $_POST['covertext']) || ereg(".*>.*", $_POST['covertext']) || ereg(".*'.*", $_POST['covertext']) || ereg('.*".*', $_POST['covertext']))
			return 1;
		return 0;
	}

?>