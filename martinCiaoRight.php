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
	
	$orderToInclude = array("pizza","salad","bread");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, array("salad"));
	
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, array("salad"));
	
	$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
		
	?>
</div>

</body>
</html>