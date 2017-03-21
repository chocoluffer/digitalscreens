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
	$optionMenu = createArray("wdc.txt","grill");
	$day = date("w");
	
	$time = date("h:i:sa");
	$hour = $time[0] . $time[1];
	$minute = $time[3] . $time[4];
	
	if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12) {
		echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
		echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
	} else {
	
	if($day == 6 || $day == 0) {
		$orderToInclude = null;
	} else {
		$orderToInclude = array("entree","proteins","starch","available");
	}
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
	
	if($day == 6 || $day == 0) {
		$orderToInclude = array("entree","proteins","starch");
	} else {
		$orderToInclude = array("pizza");
	}
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
 	$orderToInclude = array("pizza");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
	}
?>
</div>

</body>
</html>