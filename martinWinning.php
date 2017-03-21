<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: black;
		font-size:38px;		
	}
</style>
</head>
<body>

<?php include 'ver3.php'; ?>
<div id="content">
	<?php
	$optionMenu = createArray("martin.txt","winning");
	
	$orderToInclude = array("entree","proteins","sides","starch","available");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null); 
	
	$orderToInclude = array("entree","proteins","starch","veg","sides","available");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
	$orderToInclude = array("entree","starch","veg");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
		
	?>
</div>

</body>
</html>