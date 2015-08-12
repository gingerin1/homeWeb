<?php header("Content-type: text/css");	?>



@font-face {
    font-family: "Helvetica Neue";
    src: url("fonts/HelveticaNeue-Light.otf");
}

* {
	margin:0;
	padding:0;
}

html {
	height:100%;
	font-family: "Helvetica Neue", "Calibri";
	color:#333;
}

body {
	background-attachment: fixed;
	min-height:100%;
	background-image: url("images/headerNew.png");
	background-color: #FEE;
}

h1 {
	text-align: center;
	margin-bottom: 0.5em;
}

p {
	margin-bottom: 1em;
	text-indent: 2em;
}

hr {
	margin-top:0.5em;
	margin-bottom:1em;
}

i {
	margin-right: 0.4em;
}

a {
	text-decoration: none;
}

.buttonHover {
	cursor: pointer; 
	cursor: hand;
}

#header {
	position:relative;
	height:8em;
	text-align: center;
}


#mainHeading {
	font-size: 2.5em;
	position: absolute;   
	top: 50%;   
	left: 50%;   
	transform: translate(-50%, -50%);
}

#menu {
	height: 3em;
	background-color: red;
	border-bottom: 1px solid black;
	position:relative;
}

#menu  ul{
	height:100%;
	width:100%;
	display: block;
	position:relative;
	text-align: center;
}

#menu ul li {
	width:33.33%;
	height:100%;
	display:inline;
	float:left;
	line-height: 1.8em;
	font-size: 1.7em;
	color:#FEE;
}

#menu ul li:hover {
	color:#333;
	background-color:#E60000;
}

.active {
	background-color:#F30000;
}


#content {
	background-color: #FEE;
	min-height:100%;
	display:block;
	position:relative;
}

#homeImage {
	background: linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url('images/1.jpg');
	-webkit-background-size: cover;
	-moz-background-size:cover;
	-o-background-size:cover;
	background-size: cover;
	height:15em;
	padding: 50px;
}

#homeImage h1 , #homeImage p{
	color:#FEE;
	text-align: left;
	text-indent: 0px;
	max-width: 20em;
}

#homeImage.textRight h1, #homeImage.textRight p {
	float:right;
	text-align: right;
	width:100%;
}

#homeImage h1 {
	margin-top:1em;
	font-size: 2.5em;
}

#homeImage p {
	font-size: 1.5em;
	font-style: italic;
}

#homeImage i {
	position: absolute; 
	top: 50%;   
	font-size:6em;
	color:#FEE;
	margin:0;
	padding: 0px 20px;
	background-color:#000;
	opacity:0.2;
}

#leftArrow {  
	left: 0%;   
	transform: translate(0%, -50%);
}

#rightArrow { 
	right: 0%;   
	transform: translate(0%, -50%);
}

#text {
	padding:5% 10%;
	overflow: hidden;
}

#formDiv {
	height :15em;
	position:relative;
}

#signFields, #hashes {
	line-height:142%;
	margin:0;
	position:absolute;
	top:50%;
	left:50%;
	margin-right: -50%;
	transform:translate(-50%, -50%);
}

.formLine p {
	display:inline;
	text-indent: 0;
	margin-bottom:0;
}

.formLine input {
	height: 2.142em;
	min-width:20em;
	padding:0 1em ;
}

.emptyOnClick {
	color:#CCC;
}

#submit {
	background-color: #333;
	color:#FEE;
	height:2.142em;
	min-width: 6em;
	padding: 3px 12px 5px;
	border:0px none;
	margin:10px 0;
}






#footer {
	width:100%;
	padding: 10px 0 10px 0;
	text-align: center;
	background-color:#333;
	color:#FEE;
	float:left;
}

#footer p {
	text-indent: 0;
	margin-bottom: 0;
}


#coverImage {
	background-image: url("data/cover.jpg");
	-webkit-background-size: cover;
	-moz-background-size:cover;
	-o-background-size:cover;
	background-size: cover;
	height:15em;
	padding: 5%;
}

#coverImage h1 , #coverImage p{
	color:#FEE;
	padding-left: 35%;
	text-align: left;
	text-indent: 0px;
}

#coverImage h1 {
	font-size:3em;
}

#coverImage p {
	font-size:1.5em;
}

#profileImage {
	height:15em;
	width:15em;
	float:left;
	margin-left:5%;
}

#leftRowDetails, #rightRowDetails {
	width:40%;
	float:left;
}

.detailsLine {
	width:100%;
	display:inline-block;
}

.detailsLine h3, .detailsLine h3 {
	display:inline;
	float:left;
}



.detailsLine p {
	text-align:center;
}


.detailsLine input {
	width:60%;
	text-align: center;
	height:2em;
	float:right;
	padding: 0 0.5em;
}

.editButton {
	float:right;
	color:#333;
	margin-left:1em;
	margin-bottom:1em;
	text-align: center;
	min-width: 8em;
	padding: 0.5em;
	border:2px solid #444;
	font-weight: bold;
	background-color: #FEE;
	font-size:1.2em;
	font-family: "Helvetica Neue";
}


#cancelSaveButtons {
	margin-top:3em;
	display:block;
	float:left;
	width:100%;
}


#editData {
	width:70%;
	float:left;
}

.editHeading {
	margin-top:2em;
	text-align: center;
}


#imageSettings, #passwordSettings, #additionalSettings {
	display:none;
}

.help {
	color:#333;
	font-style: italic;
}

.help p {
	text-indent: 0;
}

.editError p {
	color: red;
	text-indent: 0;
}

#navigation {
	float:left;
	background-color:#444;
	height: 100%;
    width: 20%;
}

#navigation::-webkit-scrollbar { 
	width: 0 !important 
}

#list {
	height:100%;
	overflow: auto;
    overflow-x:hidden;
}

#navigationButtons {
	position:absolute;
	height:1em;
	width:20%;
	color:#FFF;
	font-size: 1em;
	text-align: center;
	padding: 10px 0 10px 0;
	background-color: #333;
}


.navItem {
	width:100%;
	height:1.6em;
	color:#FEE;
	font-size: 1em;
	padding-top:0.4em;
	padding-left:10%;
}



#navItemMain {
	color:#FFF;
}

.navActive {
	background-color: #555;
}


#files {
	position:relative;
	height: 100%;
	float:left;
	width:80%;
	background-color:#E6E6E6;
	overflow: scroll;
}

#newItem {	
	display:none;
	float:left;
	color:#FEE;
	font-size:1.2em;
	height:2em;
	width:100%;
	background-color:#555;
	padding-top:0.4em;
}

#newFileForm {
	float:left;
	width:100%;
}

#newItem p, #newItem input, #newItem #fileSubmit, #newItem #name, #newItem #nameField {
	float:left;
	margin-left:1em;
}


#rightPart {
	float:right;
	margin:0 1em;
}


#newItem p {
	margin-bottom:0;
	text-indent: 0;
}

#fileSubmit, #newItem input {
	background-color: #333;
	color:#FEE;
	height:2em;
	padding: 0 1em;
	border:0px none;
}

#fileSubmit, #fileCancel {
	min-width: 5em;
}

#selectFilePC {
	display:none;
	float:left;
	color:#FEE;
	font-size:1.2em;
	height:2em;
	width:100%;
	background-color:#555;
	padding-top:0.4em;
}

#selectFilePC input {
	color:#FEE;
	height:2em;
	padding: 0 1em;
}

#error {
	float:left;
	color:#F00;
	font-size:1.2em;
	height:2em;
	width:100%;
	background-color:#555;
	padding-top:0.4em;
}


#folderContent {
	text-align: center;
}

#folderContent i {
	margin:0;
}

.folder i {
	height: 1.2em;
	font-size:4em;
}

.file i {
	height: 1.2em;
	font-size:4em;
}

#folderContent .folderItem {
	float:left;
	display:block;
	width:10em;
	color:#333;
	padding:1em;
	font-weight: bold;
}

#folderContent p {
	text-indent: 0;
}

p#empty {
	width:100%;
	color:#CCC;
	font-size: 5em;
	text-align: center;
	margin:0;
	position:absolute;
	top:50%;
	left:50%;
	margin-right: -50%;
	transform:translate(-50%, -50%);
}

.aboutSite, .signoff, .signature {
	text-indent: 0;
	font-size: 1.5em;
	text-align: left;
}

.signoff {
	text-align: center;
}

.signoff {
	margin-top:1em;
}

.signature {
	text-align:right;
	font-style: italic;
	width:100%;
}

@media only screen and (max-width: 500px) {

   * { font-size: 0.9em; }
   #content {
   	font-size:1.5em;
   }

   #homeImage {
   	font-size:0.5em;
   }

	#menu {
		height: 8.2em;
	}
	#menu  ul{
		width:100%;
		display: block;
	}

	#menu ul li {
		width:100%;
		height:100%;
		display:block;
		height:33%;
		float:left;
	}

	#text {
		padding:5% 5%;
		overflow: hidden;
	}

	#coverImage {
		position:relative;
	}

	#coverImage h1 , #coverImage p{
		color:#FEE;
		text-align: center;
		text-indent: 0px;
	}

	#coverImage h1 {
		font-size:2em;
		width:100%;
		text-align: center;
		position:relative;
		padding:0;
		margin-top:5em;
	}

	#coverImage p {
		display:none;
	}

	#profileImage {
		height:10em;
		width:10em;
		margin:0;
		position: absolute;   
		top: 30%;   
		left: 50%;   
		transform: translate(-50%, -50%);
	}

	#leftRowDetails, #rightRowDetails {
		width:100%;
		float:left;
		text-indent: 0;
	}

	.editButton {
		float:left;
		text-align: center;
		margin:0;
		padding:1em 0;
		margin:0.5em 0;
		width:100%;		
		font-size:1em;
	}

	#editData {
		width:100%;
	}

	#navigation {
		height: 50%;
	    width: 100%;
	}


	#files {
		height:100%;
		width:100%;
	}

	#navigationButtons {
		position:relative;
		width:100%;
	}





	#newItem {	
		height:8em;
	}

	

	#newItem p, #newItem input, #newItem #fileSubmit, #newItem #name, #newItem #nameField {
		float:left;
		margin-left:0.5em;
	}

	#newItem p, #newItem #fileSubmit, #newItem #name, #newItem #fileCancel {
		margin-top:0.4em;
	}


	#rightPart {
		float:left;
		margin:0;
	}

	#rightPart #nameField {
		width:60%;
		padding: 0 0.5em;
		float:right;
	}


	#fileSubmit, #fileCancel {
		width:100%;
		margin:0;
		padding:0;
	}

	#selectFilePC {
		
		padding: 0 1em;
	}

	#selectFilePC input {
		color:#FEE;
		height:2em;
		margin: 0;
	}

	#error {
		height:3em;
	}
}




