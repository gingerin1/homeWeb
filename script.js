$(document).ready(function() {
	var footerPaddingTB = 20;

	setSize();
	setImageSize();

	$(window).resize(function() {
		setSize();
		setImageSize();
	});




	$('.emptyOnClick').focus(function() {
		$(this).val("");
		$(this).css("color", "#000");
	});

	$("#showPassOptions").click(function() {
		$("#passwordSettings").show(500);
	});

	$("#showImageOptions").click(function() {
		$("#imageSettings").show(500);
	});

	$("#showAdditionalOptions").click(function() {
		$("#additionalSettings").show(500);
	});

	$(".navItem").hover(function() {
		$(this).css("background-color", "#333");
	});

	$(".navItem").hover(function() {
		$(this).css("background-color", "#333");
	}, function() {
		$(this).css("background-color", "#444");
	});

	$("#navigationButtons").click(function() {
		$("#newItem").slideToggle(100);
		$("#folderRadio").prop("checked", true);
		$("#selectFilePC").hide(100);
		$("#newFileForm")[0].reset();
	});

	$("#folderSelect").click(function() {
		$("#folderRadio").prop('checked', true);
	}); 

	$("#fileSelect").click(function() {
		$("#fileRadio").prop('checked', true);
		$("#selectFilePC").slideDown(100);
	}); 

	$("#fileCancel").click(function() {
		$("#selectFilePC").hide(100);
		$("#folderRadio").prop("checked", true);
		$("#newItem").hide(100);
		$("#newFileForm")[0].reset();
	});

	var imageNo = 1;
	var home = $("#homeImage");

	$("#leftArrow").click(function() {
		imageNo--;
		if(imageNo < 1) {
			imageNo = 3;
		}

		home.css("background", 'linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url("images/'+imageNo+'.jpg")');

		switch(imageNo) {
			case 1:
				home.attr("class", "textLeft");
				$("#homeImage h1").html("Andy Bernard:");
				$("#homeImage p").html("I wish there was a way to know you're in the good old days before you've actually left them.");
				break;
			case 2:
				home.attr("class", "textRight");
				$("#homeImage h1").html("Oliver Wendell Holmes, Sr.:");
				$("#homeImage p").html("Where we love is home - home that our feet may leave, but not our hearts.");
				break;
			case 3:
				home.attr("class", "textLeft");
				$("#homeImage h1").html("J.R.R. Tolkien:");
				$("#homeImage p").html("Home is behind, the world ahead, and there are many paths to tread through shadows to the edge of night, until the stars are all alight.");
				break;
		}
	});

	$("#rightArrow").click(function() {
		imageNo++;
		if(imageNo > 3) {
			imageNo = 1;
		}
		
		home.css("background", 'linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url("images/'+imageNo+'.jpg")');

		switch(imageNo) {
			case 1:
				home.attr("class", "textLeft");
				$("#homeImage h1").html("Andy Bernard:");
				$("#homeImage p").html("I wish there was a way to know you're in the good old days before you've actually left them.");
				break;
			case 2:
				home.attr("class", "textRight");
				$("#homeImage h1").html("Oliver Wendell Holmes, Sr.:");
				$("#homeImage p").html("Where we love is home - home that our feet may leave, but not our hearts.");
				break;
			case 3:
				home.attr("class", "textLeft");
				$("#homeImage h1").html("J.R.R. Tolkien:");
				$("#homeImage p").html("Home is behind, the world ahead, and there are many paths to tread through shadows to the edge of night, until the stars are all alight.");
				break;
		}
	});


	function setSize() {
		if($("#content").height() < ($(window).innerHeight() - $("#menu").height() - $("#header").height() - $("#footer").height() - footerPaddingTB))
			$("#content").css("height", ($(window).innerHeight() - $("#menu").height() - $("#header").height() - $("#footer").height() - footerPaddingTB));
		$("#list").css("height", $("#navigation").height() - $("#navigationButtons").height() -20);
	}

	function setImageSize() {
		$("#homeImage").css("height", $("#content").height() - 100);
	}

	
});