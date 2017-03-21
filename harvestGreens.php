<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: #2F974A;
		font-size:38px;		
	}
	#menu {
		width: 1320px;
		padding-left: 12%;
    	padding-top: 3%;
/*     	border: solid black 1px; */
	}
</style>
</head>
<body>

<?php include 'ver3.php'; ?>
<div id="menu">
	<?php
	$optionMenu = createArray("gc.txt", "harvest");
	
	$time = date("h:i:sa");
	$hour = $time[0] . $time[1];
	$minute = $time[3] . $time[4];
	
	$orderToInclude = array("entree","available","protein","starch","sides");
    $sortedLinner = sortOrder($optionMenu['linner'], $orderToInclude, null);
	
	if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12 && $sortedLinner == null) {
		echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
		echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
	} else {
	
	$orderToInclude = array("appetizer", "entree", "salad", "fruit");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, array("salad","entree"));
	
	$orderToInclude = array("soup", "veg", "salad", "fruit", "dessert");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	// Harvest Greens serves the same menu for lunch & dinner
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "linner" => $sortedLinner, "dinner" => $sortedDinner);
	displayMenu($sorted);
	}

?>
</div>

</body>
</html>