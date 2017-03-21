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
        padding-top:8%;
        padding-left:20%;
        width: 1320px;
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
	
	$orderToInclude = array("entree","available","protein","starch","sides");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null); 
	
	if($day == 6 || $day == 0) {
		$orderToInclude = array("entree","protein","starch","sides");
		$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
		$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	} else {
		$orderToInclude = array("sandwich","deli");
		$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, array("sandwichB"));
		$orderToInclude = array("grill");
		$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
	}
	
	$sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "linner" => $sortedLinner, "dinner" => $sortedDinner);
	displayMenu($sorted);
	}
?>

</div>




</body>
</html>