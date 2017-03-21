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
		width: 1920px;
		padding-left: 2%;
    	padding-top: 5%;
/*     	border: solid black 1px; */
	}
	#leftSide {
		width: 960px;
		float: left;
/* 	   	border: solid blue 1px; */
	
	}
	#rightSide {
		width: 960px;
		float: right;
/*     	border: solid red 1px; */
	}
</style>
</head>
<body>

<?php 
	include 'ver3.php'; 
	$optionMenu = createArray("wdc.txt","international");
// 	$optionMenu = parseRestaurant($buildingMenu, "international");
	$day = date("w");
?>
<div id="menu">
	<div id="leftSide">
		<?php
		// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
		// $sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
		
		$time = date("h:i:sa");
		$hour = $time[0] . $time[1];
		$minute = $time[3] . $time[4];
	
		if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12) {
			echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
			echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
		} else {
		
		// If it's the weekend...
		if($day == 6 || $day == 0) {
			$leftOrderToInclude = array("entree","proteins","starch","sauce","available");
		} else {
			$leftOrderToInclude = array("appetizer","entree","veg");
		}
		$leftSortedLunch = sortOrder($optionMenu['lunch'], $leftOrderToInclude, null);
	
		// Display same items as lunch	
		$leftSortedDinner = sortOrder($optionMenu['dinner'], $leftOrderToInclude, null);
		
		$leftSortedLinner = sortOrder($optionMenu['linner'], $leftOrderToInclude, null);
	
		$leftSorted = array("breakfast" => null, "lunch" => $leftSortedLunch, "linner" => $leftSortedLinner, "dinner" => $leftSortedDinner);
		displayMenu($leftSorted);
		
		}
		?>
	</div>	
	<div id="rightSide">
		<?php
		// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
		// $sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
		
		$time = date("h:i:sa");
		$hour = $time[0] . $time[1];
		$minute = $time[3] . $time[4];
	
		if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12) {
			
		} else {
		
		// If it's the weekend...
		if($day == 6 || $day == 0) {
			$rightOrderToInclude = null;
		} else {
			$rightOrderToInclude = array("starch","international","dessert","available");
		}
		$rightSortedLunch = sortOrder($optionMenu['lunch'], $rightOrderToInclude, null);
	
		// Display same items as lunch	
		$rightSortedDinner = sortOrder($optionMenu['dinner'], $rightOrderToInclude, null);
	
		$rightSorted = array("breakfast" => null, "lunch" => $rightSortedLunch, "dinner" => $rightSortedDinner);
		displayMenu($rightSorted);
		
		}
		?>
	
	
	</div>
</div>

</body>
</html>