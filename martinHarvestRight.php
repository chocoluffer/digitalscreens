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
	$optionMenu = createArray("martin.txt","harvest");
	
	$orderToInclude = array("appetizer","fruit","available");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null); 
	
	$orderToInclude = array("fruit","dessert");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, array("fruit"));
	
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, array("fruit"));
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
		
	?>
</div>

</body>
</html>