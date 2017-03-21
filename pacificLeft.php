<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: black;
		font-size:30px;		
	}
	#menu {
		width: 1220px;
/* 		padding-left: 5%; */
    	padding-top: 5%;
/*     	border: solid black 1px; */
	}
	#leftSide {
		width: 600px;
		float: left;
/* 	   	border: solid blue 1px; */
	
	}
	#rightSide {
		width: 600px;
		float: right;
/*     	border: solid red 1px; */
/* 		padding-right: 2%; */
	}
</style>
</head>
<body>

<?php 
	include 'ver3.php'; 
	$buildingMenu = createArray("mss_pac.txt","pacific");
// 	$optionMenu = parseRestaurant($buildingMenu, "pacific");
?>
<div id="menu">
	<div id="leftSide">
	<?php	
// 		$orderToInclude = array("entree", "starch", "sauce", "bread","available");
// 		$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
	
		$leftOrderToInclude = array("stir fry");
		$leftSortedLunch = sortOrder($buildingMenu['lunch'], $leftOrderToInclude, null);
	
// 		$orderToInclude = array("entree","protein","starch","veg","sauce","bread");
		$leftSortedDinner = sortOrder($buildingMenu['dinner'], $leftOrderToInclude, null);
	
		$leftSorted = array("breakfast" => null, "lunch" => $leftSortedLunch, "dinner" => $leftSortedDinner);
		displayMenu($leftSorted);
	?>
	</div>
	<div id="rightSide">
	<?php
// 		$orderToInclude = array("entree", "starch", "sauce", "bread","available");
// 		$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
	
		$rightOrderToInclude = array("sides","salad");
		$rightSortedLunch = sortOrder($buildingMenu['lunch'], $rightOrderToInclude, array("salad"));
	
// 		$orderToInclude = array("entree","protein","starch","veg","sauce","bread");
		$rightSortedDinner = sortOrder($buildingMenu['dinner'], $rightOrderToInclude, array("salad"));
	
		$rightSorted = array("breakfast" => array(), "lunch" => $rightSortedLunch, "dinner" => $rightSortedDinner);
		displayMenu($rightSorted);
	?>
	</div>

</body>
</html>