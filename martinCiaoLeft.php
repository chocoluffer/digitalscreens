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
	$optionMenu = createArray("martin.txt","ciao");
	
// 	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, array("salad","entree")); 
	
	$orderToInclude = array("pasta","veg","available");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
		
	?>
</div>

</body>
</html>