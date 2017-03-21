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
		padding-left: 15%;
    	padding-top: 5%;
/*     	border: solid black 1px; */
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
	$time = date("h:i:sa");
	$hour = $time[0] . $time[1];
	$minute = $time[3] . $time[4];
	
	$optionMenu = createArray("harris.txt", "tradition");
	$soups = createArray("harris.txt", "soup");

	$orderToInclude = array("entree","protein","starch","bread");
	$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude, null);
    
    $orderToInclude = array("entree","protein","starch","bread");
	$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
    
    $orderToInclude = array("soup");
    $soupBreak = sortOrder($soups['breakfast'], $orderToInclude, null);
    $soupLun = sortOrder($soups['lunch'], $orderToInclude, null);
    $soupDin = sortOrder($soups['dinner'], $orderToInclude, null);
    
	$orderToInclude = array("entree","protein","starch","veg","sauce","bread");
	$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
    
    if($day == 6 || $day == 0) {
        $sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedBreak, "dinner" => $sortedDinner);
    } else {
	   $sorted = array("breakfast" => $sortedBreak, "lunch" => $sortedLunch, "dinner" => $sortedDinner);
    }
	displayMenu($sorted);
    
    $sortedSoup = array("breakfast" => $soupBreak, "lunch" => $soupLun, "dinner" => $soupDin);
	
	if($day == 6 || $day == 0) {
		if(  ( (strpos($time, 'am')) && ( ($hour == 10 && $minute >= 30) || $hour == 11 ) ) 
				|| ( (strpos($time, 'pm')) && ($hour < 4 || $hour == 12) ) ) {
			displayMenu($sortedSoup);
		}
	}
	
	if((strpos($time, 'pm')) && $hour >= 4 && $hour != 12) {
		displayMenu($sortedSoup);
	}
	
	
	?>
</div>

</body>
</html>