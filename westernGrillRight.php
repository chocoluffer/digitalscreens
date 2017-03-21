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
		$orderToInclude = array("grill");
	} else {
		$orderToInclude = array("grill","available");
	}
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
	
	$orderToInclude = array("grill","available");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	$sorted = array("breakfast" => array(), "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	displayMenu($sorted);
	}
// 	echo '<br><img src="menuBackgrounds/harvest-greens-logo-crop215.jpg" alt="Harvest Greens" id="menuLogo" />';
?>
</div>

</body>
</html>