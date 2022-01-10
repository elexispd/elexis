<?php 
	include_once "php/includes/autoload.inc.php";
	$obj = new User();
	session_start();
	$owner = $obj->loggedInUser($_SESSION["user"]);
	if (isset($_POST["submit"])) {
		$n = $obj->profilePicture("deco", $_SESSION["user"]);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>my chat - SETTING</title>
	  <!-- Font awesome -->
    <link href="css/fontawesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">     
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    
    <style>
    	body{font-family: sans-serif; background: #FFEEDF;}
    	.user{font-size: 20px;object-fit: cover;}
    	img{width: 250px; height: 250px; border-radius: 50% !important;}
    	input{background: none !important;}
    	input:focus{outline: none !important;}
    	.image{margin-top: 100px;}
    </style>
</head>
<body>
	<div class="container mx-auto text-center">
		<div class="wrapper">
		<?php 
			foreach ($owner as $value) {?>
				<div class="image">
					<a href='images/profile-man.png'><img src="<?php echo $value["photo"]; ?>" id="preview" ></a>
					<div class="mt-3 user"> Username: Elexis</div>
					<form action="" method="post" class="form-group" id="uploadDp" enctype="multipart/form-data">
						<div class="input-group my-4 container">
	  						<input class="pl-5" type="file" id="file" name="photo" onchange="previewFile(this);">
	  						<button class="btn btn-primary btn-sm mx-auto mt-2" name="submit">Upload</button>
						</div>
					</form>
				</div>
			<?php }

		?>
		</div>
	</div>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script src="js/profile_picture.js"></script>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#preview").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
    $("button").attr("disabled",true);
		$("input").change(function(){
			$("button").removeAttr("disabled");
		})

	var message = "<?php echo $n['dp']; ?>";
	$("button").click(function(){
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
			alert(message);
		}
	})


</script>
</body>
</html>