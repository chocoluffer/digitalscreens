<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: #2F974A;
		font-size:38px;		
	}
    #menu{
        padding-left:20%;
        padding-top:8%;
    }
</style>
</head>
<body>

<?php 
	include 'ver3.php'; 
	$day = date("w");
?>
<div id="menu">
	<?php
	$optionMenu = createArray("gc.txt", "comfort");
	
	$time = date("h:i:sa");
	$hour = $time[0] . $time[1];
	$minute = $time[3] . $time[4];
	
	$orderToInclude = array("entree","available","protein","starch","sides");
    $sortedLinner = sortOrder($optionMenu['linner'], $orderToInclude, null);
	
	if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12 && $sortedLinner == null) {
		echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
		echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
	} else {
	
	$orderToInclude = array("entree","available","protein","starch","sides","sauce");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null); 
	
	$orderToInclude = array("entree","sandwich","starch","protein","grill");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, array("sandwichB"));

	$orderToInclude = array("entree","starch","veg","grill");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "linner" => $sortedLinner, "dinner" => $sortedDinner);
	displayMenu($sorted);
	}
?>

</div>




</body>
</html>