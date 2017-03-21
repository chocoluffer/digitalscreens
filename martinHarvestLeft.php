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
	
	$orderToInclude = array("entree");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null); 
	
	$orderToInclude = array("salad","soup","veg");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, array("salad"));
	
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, array("salad"));
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
		
	?>
</div>

</body>
</html>