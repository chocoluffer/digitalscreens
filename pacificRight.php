<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: black;
		font-size:36px;		
	}
	#menu {
		width: 1320px;
		padding-left: 7%;
    	padding-top: 5%;
/*     	border: solid black 1px; */
	}
	#leftSide {
		width: 800px;
		float: left;
/* 	   	border: solid blue 1px; */
	
	}
	#rightSide {
		width: 500px;
		float: right;
/*     	border: solid red 1px; */
	}
</style>
</head>
<body>

<?php include 'ver3.php'; ?>
<div id="menu">
	<?php
	$buildingMenu = createArray("mss_pac.txt","pacific");
// 	$optionMenu = parseRestaurant($buildingMenu, "pacific");
	
	$beverages = array
		(
		"Pepsi" => array("Pepsi","filler","filler","Animal"),
		"Diet Pepsi" => array("Diet Pepsi","filler","filler","Animal"), 
		"Dr. Pepper" => array("Dr. Pepper","filler","filler","Animal"), 
		"Cherry Pepsi" => array("Cherry Pepsi","filler","filler","Animal"), 
		"Pink Lemonade" => array("Pink Lemonade","filler","filler","Animal"), 
		"Orange Crush" => array("Orange Crush","filler","filler","Animal"),
		"Sierra Mist" => array("Sierra Mist","filler","filler","Animal"),
		"Mountain Dew" => array("Moutain Dew","filler","filler","Animal"), 
		"Water" => array("Water","filler","filler","Animal") 
		);
	
	// $orderToInclude = array("entree", "starch", "sauce", "bread","available");
// 	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
	
	$orderToInclude = array("dessert");
	$sortedLunch = sortOrder($buildingMenu['lunch'], $orderToInclude, null);
	// include top 2 soup from soup, salad, & fruit
	
// 	$orderToInclude = array("entree","protein","starch","veg","sauce","bread");
	$sortedDinner = sortOrder($buildingMenu['dinner'], $orderToInclude, null);
	
	$beverages = array("breakfast" => array(), "lunch" => $beverages, "dinner" => $beverages);
	$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
	// displayMenu($sorted);
// 	displayMenu($beverages);
	
	?>
	<div id="leftSide">
		<?php
		displayMenu($sorted);
		?>
	</div>
	<div id="rightSide">
		<?php
		displayMenu($beverages);
		?>
	</div>
</div>

</body>
</html>