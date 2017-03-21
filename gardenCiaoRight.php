<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<style>
	#foodItem {
		color: #BF1E2D;
		font-size:38px;
	}
    
    #content{
        padding-top: 20%;
    }
</style>
</head>
<body>

<?php include 'ver3.php'; ?>
<div id="content">
		<?php
		$optionMenu = createArray("gc.txt", "ciao");
		
		$time = date("h:i:sa");
		$hour = $time[0] . $time[1];
		$minute = $time[3] . $time[4];
	
		$orderToInclude = array("entree","available","protein","starch","sides");
        $sortedLinner = sortOrder($optionMenu['linner'], $orderToInclude, null);
	
	    if((strpos($time, 'pm')) && $hour >= 3 && $hour < 5 && $hour != 12 && $sortedLinner == null) {
		  echo "<br><span id='foodItem'>We are now in Continuous Dining.</span>";
		  echo "<br><span id='foodItem'>Full menu options will return for dinner at 5 PM.</span>";
	    } else {
		
		// Ciao doesn't serve breakfast, left as breadcrumb
		//$sortedBreak = sortOrder($optionMenu['breakfast'], $orderToInclude);	

		$orderToInclude = array("pizza");
		$sortedLunch = sortOrder($optionMenu['lunch'], $orderToInclude, null);
		
		$sortedDinner = sortOrder($optionMenu['dinner'], $orderToInclude, null);
		
		$sorted = array("breakfast" => null, "lunch" => $sortedLunch, "linner" => $sortedLinner, "dinner" => $sortedDinner);
		displayMenu($sorted);
		}

		?>

</div>

</body>
</html>