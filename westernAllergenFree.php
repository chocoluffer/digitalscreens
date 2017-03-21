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
    	padding-top: 2%;
/*     	border: solid black 1px; */
	}
	#leftSide {
		width: 950px;
		float: left;
/* 	   	border: solid blue 1px; */
	
	}
	#rightSide {
		width: 950px;
		float: right;
/*     	border: solid red 1px; */
	}
</style>
</head>
<body>

<?php 
	include 'ver3.php'; 
	$optionMenu = createArray("wdc.txt","allergen");
// 	$optionMenu = parseRestaurant($buildingMenu, "allergen");
?>
<div id="menu">
	<div id="leftSide">
		<?php
		$time = date("h:i:sa");
		$hour = $time[0] . $time[1];
		$minute = $time[3] . $time[4];
	
		if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12) {
			echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
			echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
		} else {
		
		// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
		// $sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
		
		$leftOrderToInclude = array("entree","pasta","starch","veg","dessert");
		$leftSortedLunch = sortOrder($optionMenu['lunch'], $leftOrderToInclude, null);
	
// 		$leftOrderToInclude = array("salad","fruit","dessert");
		$leftSortedDinner = sortOrder($optionMenu['dinner'], $leftOrderToInclude, null);
	
		$leftSorted = array("breakfast" => null, "lunch" => $leftSortedLunch, "dinner" => $leftSortedDinner);
		displayMenu($leftSorted);
		}
		?>
	</div>	
	<div id="rightSide">
		<?php
		$time = date("h:i:sa");
		$hour = $time[0] . $time[1];
		$minute = $time[3] . $time[4];
	
		if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12) {
			
		} else {
		
		// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
		// $sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);

		$rightOrderToInclude = array("salad","fruit");
		$rightSortedLunch = sortOrder($optionMenu['lunch'], $rightOrderToInclude, array("salad"));
	
// 		$rightOrderToInclude = array("appetizer","entree","veg");
		$rightSortedDinner = sortOrder($optionMenu['dinner'], $rightOrderToInclude, array("salad"));
	
		$rightSorted = array("breakfast" => null, "lunch" => $rightSortedLunch, "dinner" => $rightSortedDinner);
		displayMenu($rightSorted);
		
		}
		?>
	
	
	</div>
</div>

</body>
</html>