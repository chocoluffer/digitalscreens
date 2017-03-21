<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: black;
		font-size:38px;		
	}
	#menu {
		width: 1320px;
		padding-left: 15%;
    	padding-top: 5%;
/*     	border: solid black 1px; */
	}
</style>
</head>
<body>

<?php include 'ver3.php'; ?>
<div id="menu">
	<?php
	$optionMenu = createArray("harris.txt", "spice");
	
	$orderToInclude = array("entree","sandwich","starch","veg","side","sauce");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
	$orderToInclude = array("entree","protein","starch","veg","sauce");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);

	$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
	?>
</div>

</body>
</html>