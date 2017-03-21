<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" type="text/css" href="main.css">
<style>	
	#foodItem {
		color: #BF1E2D;
		font-size:32px;	
	}
	#leftSide {
		width: 945px;
		float: left;
/* 	   	border: solid blue 1px; */
	
	}
	#rightSide {
		width: 945px;
		float: right;
/*     	border: solid red 1px; */
	}
	#menu {
		width: 1920px;
		padding-left: 2%;
		padding-top: 5%;
	
	}
</style>
</head>
<body>

<?php include 'ver3.php'; 
	$optionMenu = createArray("gc.txt", "ciao");
	$day = date("w");
?>
<div id="menu">
	<?php						
		// Ciao doesn't serve breakfast, left as breadcrumb
//		$leftSortBreak = sortOrder($optionMenu['breakfast'], $leftOrder);
        $orderToInclude = array("entree","available","protein","starch","sides");
        $sortedLinner = sortOrder($optionMenu['linner'], $orderToInclude, null);
																
		// If it's saturday or sunday... (lunch display is different)
		if($day == 6 || $day == 0) {
			$leftOrder = array("entree");
			$rightOrder = array();
		} else {
			$leftOrder = array("pasta","sauce");
			$rightOrder = array("veg","bread","dessert","available");
		}
		$leftSortLun = sortOrder($optionMenu['lunch'], $leftOrder, array("pasta"));
		$rightSortLun = sortOrder($optionMenu['lunch'], $rightOrder, array("pasta"));
		
		$leftOrder = array("pasta","sauce");
		$leftSortDin = sortOrder($optionMenu['dinner'], $leftOrder, array("pasta"));
		$rightOrder = array("veg","bread","dessert","available");
		$rightSortDin = sortOrder($optionMenu['dinner'], $rightOrder, array("pasta"));
					
		$leftSorted = array("breakfast" => null, "lunch" => $leftSortLun, "linner" => $sortedLinner, "dinner" => $leftSortDin);
		$rightSorted = array("breakfast" => null, "lunch" => $rightSortLun, "linner" => $sortedLinner, "dinner" => $rightSortDin);	
	?>
	<div id="leftSide">
	
		<?php 
			$time = date("h:i:sa");
			$hour = $time[0] . $time[1];
			$minute = $time[3] . $time[4];
	
			
	
	if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12 && $sortedLinner == null) {
		echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
		echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
	} else {
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
				displayMenu($rightSorted);
			}
		?>
	</div>
</div>

</body>
</html>