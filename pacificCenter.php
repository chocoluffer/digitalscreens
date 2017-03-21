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
	$buildingMenu = createArray("mss_pac.txt", "pacific");
// 	$optionMenu = parseRestaurant($buildingMenu, "pacific");
	
	// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
// 	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
	
	$orderToInclude = array("international","entree","starch","veg");
	$sortedLunch = sortOrder($buildingMenu['lunch'], $orderToInclude, null);
	
	$orderToInclude = array("entree","protein","starch","veg","sauce","bread");
	$sortedDinner = sortOrder($buildingMenu['dinner'], $orderToInclude, null);
	
	// Harvest Greens serves the same menu for lunch & dinner
	$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
	?>
</div>

</body>
</html>