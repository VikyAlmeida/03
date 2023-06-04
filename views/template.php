<!DOCTYPE html>
<html lang="en">
<?php
	include ('./views/modules/partials/head.php');
?>
<body>
	<?php 
		$const = new ControllerConst();
		$routes = $const->getRoutes();

		//include ('./views/modules/partials/loader.php');
		if(isset($_GET["route"])):
			if($_GET["route"]!=="login" && $_GET["route"]!=="register" && $_GET["route"]!=="forgotPassword" && $_GET["route"]!=="code"):
				include ('./views/modules/partials/header.php');
			endif;
		else:
			include ('./views/modules/partials/header.php');
		endif;
		
		include ('./views/modules/partials/message.php');
		include ('./views/modules/partials/routes.php');	

		include ('./views/modules/partials/footer.php');
		include ('./views/modules/partials/scripts.php');
	?>
</body>

</html>