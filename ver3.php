<!DOCTYPE html>
<html>    

<?php
/**
* Returns an array with each meal period (breakfast, lunch, linner when applicable and dinner) based on the file extension given
* Parameters: 
*	file: Appropriate file extension
*	optionGiven: Shorthand for the option desired
*/
function createArray($file, $optionGiven) {
	
	// This variable holds the URL for where the dump is, inserting the appropriate file based on the option.
		// i.e. Comfort Thyme would pass in gc.txt, as all of Garden is contained in gc.txt
	$handle = file_get_contents('https://www.hdg.muohio.edu/Code/MyCardStorage/Dining/FSSDigitalDisplayTraitData/' . $file);

	// Each line in every file starts with MMM DD YYYY - so we split the file based on today's date to get the correct meal info 
	$todayDate = date("m/d/y");
	$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	$month = $todayDate[0] . $todayDate[1];
	$thisMonth = $months[$month-1];
	$thisDay = $todayDate[3] . $todayDate[4];
    if($thisDay < 10) {
        $thisDay = str_replace("0","",$thisDay);
    }
	
	// Program that creates the dump will replace the 0 in 01 with a space, so this padding is added to account for that
	$data = explode( (str_pad($thisMonth, 4, " ") . str_pad($thisDay, 2," ",STR_PAD_LEFT)) , $handle);   
	$size = count($data);                   // Gets size of items in the file

	// Initializes the arrays that will hold the food items for each meal time
	$breakfast = null;
	$lunch = null;
	$linner = null;			// Lunch + Dinner = Linner, 3-5 PM :)
	$dinner = null;

	for($i = 1; $i < $size; $i++) {             // Iterates through the text file line by line. Index 0 will always be empty.
    	$dataItem = explode('|', $data[$i]);    // Gets the pieces of info about the food item
    
    	$mealType = explode('-', $dataItem[1]); // Meal type (Entree, Appetizer etc) is in the system as "number - meal type"
    	$mealType = strtolower($mealType[1]);
    
    	$formalName = $dataItem[2]; 			// Formal name is the forward/customer facing name
    
    	$mealTimes = explode('/', $dataItem[4]);	// Meal times are provided as Breakfast/Lunch/Dinner, so by breaking them up
    	$times = count($mealTimes);						// by "/", we catch every time the food item should be included
    	
    	if(strpos($file, "mss") !== false) {		// MSS is the only one with an underscore, so this just ensures it grabs the correct file
    		$optionSplit = "mss";
    	} else {
    		$optionSplit = substr($file, 0, (strlen($file)-4));
    	}
    	$option = explode($optionSplit, strtolower($dataItem[5]));
    	$option = $option[1];
    	
    	$b = false;
    	$l = false;
    	$lin = false;			
    	$d = false;
    
    	// Each item has a list of times that item is offered, so here we check which ones it applies to so that
    		// it gets listed for every meal time and not just the first one
    	for($j = 0; $j < $times; $j++) {
        	$timeCheck = strtolower($mealTimes[$j]);
        	if(strpos($timeCheck, 'break') !== false) {
            	$b = true;                                  // Boolean that checks for breakfast(b), lunch(l) and dinner(d). Brunch 
        	}                                                   // is included in breakfast as it's the same time frame
        	if (strpos($timeCheck, 'lun') !== false && strpos($timeCheck, 'late') === false) {
            	$l = true;
        	}
        	if (strpos($timeCheck, 'lun') !== false && strpos($timeCheck, 'late') !== false) {
        		$lin = true;
        	}
        	if (strpos($timeCheck, 'din') !== false) {
            	$d = true;
        	}
    	}
    
    	$trait = $dataItem[7];                  // The traits for each food item are split onto separate lines.
    	if(strpos($option, $optionGiven) !== false) {
    	// For whichever meal time the item is included in, it's added to the appropriate array with the information
    		// of it's name, which option it's part of, the type of meal (entree, appetizer etc) and traits.
    	if($b === true) {
        	if($breakfast === null) {
            	$breakfast = array
                	(
                	"{$formalName}" => array("{$formalName}","{$option}","{$mealType}","{$trait}")
                	);
        	} else if ($breakfast !== null && array_key_exists($formalName, $breakfast)) {
            	$theseTraits = $breakfast[$formalName];
            	if(in_array($trait, $theseTraits)) {
            	} else {
                	$theseTraits[] = "{$trait}";
            	}
            	$breakfast[$formalName] = $theseTraits;
        	} else {
            	$newTraits = array("{$formalName}","{$option}","{$mealType}","{$trait}");
            	$breakfast[$formalName] = $newTraits;
        	}
    	}
    
    	if($l === true) {
        	if($lunch === null) {
            	$lunch = array
                	(
                	"{$formalName}" => array("{$formalName}","{$option}","{$mealType}","{$trait}")
                	);
        	} else if ($lunch !== null && array_key_exists($formalName, $lunch)) {
            	$theseTraits = $lunch[$formalName];
            	if(in_array($trait, $theseTraits)) {
            	} else {
                	$theseTraits[] = "{$trait}";
            	}
            	$lunch[$formalName] = $theseTraits;
        	} else {
            	$newTraits = array("{$formalName}","{$option}","{$mealType}","{$trait}");
            	$lunch[$formalName] = $newTraits;
        	}
    	}
    
    	if($lin === true) {
        	if($linner === null) {
            	$linner = array
                	(
                	"{$formalName}" => array("{$formalName}","{$option}","{$mealType}","{$trait}")
                	);
        	} else if ($linner !== null && array_key_exists($formalName, $linner)) {
            	$theseTraits = $linner[$formalName];
            	if(in_array($trait, $theseTraits)) {
            	} else {
                	$theseTraits[] = "{$trait}";
            	}
            	$linner[$formalName] = $theseTraits;
        	} else {
            	$newTraits = array("{$formalName}","{$option}","{$mealType}","{$trait}");
            	$linner[$formalName] = $newTraits;
        	}
    	}
    
    	if($d === true) {
        	if($dinner === null) {
            	$dinner = array
                	(
                	"{$formalName}" => array("{$formalName}","{$option}","{$mealType}","{$trait}")
                	);
        	} else if ($dinner !== null && array_key_exists($formalName, $dinner)) {
            	$theseTraits = $dinner[$formalName];
            	if(in_array($trait, $theseTraits)) {
            	} else {
                	$theseTraits[] = "{$trait}";
            	}
            	$dinner[$formalName] = $theseTraits;
        	} else {
            	$newTraits = array("{$formalName}","{$option}","{$mealType}","{$trait}");
            	$dinner[$formalName] = $newTraits;
        	}        
    	}
    
    	// "Unsetting" these variables as otherwise php holds onto them
    	$b = false;
    	$l = false;
    	$lin = false;
    	$d = false;
    	}
	} // end text file loop
	
	// One array to hold all the info for every meal for the one option
	
//	$restaurant = array("breakfast" => $breakfast, "lunch" => $lunch, "dinner" => $dinner);
 	$restaurant = array("breakfast" => $breakfast, "lunch" => $lunch, "linner" => $linner, "dinner" => $dinner);
	return $restaurant;
}

/**
* Returns parsed array with only the food items for the option included
* Parameters: 
*	restaurant: Array with all food items for overall restaurant 
*	option: specific option that needs to be parsed out
*/
function parseRestaurant($restaurant, $option) {
	$breakfast = $restaurant['breakfast'];
	$lunch = $restaurant['lunch'];
	$linner = $restaurant['linner'];
	$dinner = $restaurant['dinner'];
	
	$parsedBreakfast;
	$parsedLunch;
	$parsedLinner;
	$parsedDinner;
	
	if($restaurant['breakfast'] === null) { // Do nothing
	} else {
	foreach($breakfast as $item) {
		if(strpos($item[1], $option) !== false) {
			if($parsedBreakfast === null) {
				$parsedBreakfast = array
					(
					"{$item[0]}" => $item
					);
			} else {
				$parsedBreakfast[$item[0]] = $item;
			}
		}
	}
	}
	
	if($restaurant['lunch'] === null) {
	} else {
	foreach($lunch as $item) {
		if(strpos($item[1], $option) !== false) {
			if($parsedLunch === null) {
				$parsedLunch = array
					(
					"{$item[0]}" => $item
					);
			} else {
				$parsedLunch[$item[0]] = $item;
			}
		}	
	}
	}
	
	if($restaurant['linner'] === null) {
	} else {
	foreach($linner as $item) {
		if(strpos($item[1], $option) !== false) {
			if($parsedLinner === null) {
				$parsedLinner = array
					(
					"{$item[0]}" => $item
					);
			} else {
				$parsedLinner[$item[0]] = $item;
			}
		}	
	}
	}
	
	if($restaurant['dinner'] === null) {
	} else {
	foreach($dinner as $item) {
		if(strpos($item[1], $option) !== false) {
			if($parsedDinner === null) {
				$parsedDinner = array
					(
					"{$item[0]}" => $item
					);
			} else {
				$parsedDinner[$item[0]] = $item;
			}
		}	
	}
	}
	
//	$restaurantOption = array("breakfast" => $parsedBreakfast, "lunch" => $parsedLunch, "dinner" => $parsedDinner);
 	$restaurantOption = array("breakfast" => $parsedBreakfast, "lunch" => $parsedLunch, "linner" => $parsedLinner, "dinner" => $parsedDinner);	
	return $restaurantOption;
}

/**
* Returns array that has the elements for the specific screen in the proper order & adjusted appropriately
* Parameters: 
*	optionMenu: array with menu for specific meal period (ONLY breakfast, lunch or dinner)
*	orderToInclude: order of meal types (Pizza first, then Bread etc)
*	$fringeCases: an array that includes an item if their fringe case should be applied 
*						(fruit/salad bar be fully displayed, only show first entry under entree, etc)
*/
function sortOrder($optionMenu, $orderToInclude, $fringeCases) {
	$newOrderOption;
	
	if($orderToInclude === null || $optionMenu === null) {
		return $emptyArray = array();
	}
	
	// Fringe case data members, defaulted to non-fringe case
	//	Salad: Fringe case is displaying full list of items
	$simplifySalad = true;
	$foundSalad = false;
	//	Fruit: Fringe case is dispalying full list of items
	$simplifyFruit = true;
	$foundFruit = false;
	//	Entree: Fringe case is displaying only the first item
	$simplifyEntree = false;
	$foundEntree = false;
	//	Sandwich: Fringe case when the sandwich category must be split between screens
	$splitSand = false;
	$foundSand = false;
	$isTop = null;
	//	Deli Bar: Fringe case is displaying the full list of items
	$simplifyDeli = true;
	$foundDeli = false;
	// Pasta Bar: Fringe case is to only display the first three items
	$displayX = false;
	$count = 0;	
	// Display a certain range of items (usually 0-x)
	$displayXX = false;
	$displayMeal = null;
	$displayNum = 0;
	// Display the title before the items
	$showTitle = false;
	$titleOf = null;
	$foundSection = false;
	// Campus Grill specific case for welcome week
	$showChili = false;

	
	// Checks for data members & set the cases as need be
	if($fringeCases === null) {
	} else {
		foreach($fringeCases as $case) {
			if(strpos($case, "salad") !== false) {
				$simplifySalad = false;
			} else if(strpos($case, "fruit") !== false) {
				$simplifyFruit = false;
			} else if (strpos($case, "entree") !== false) {
				$simplifyEntree = true;
			} else if (strpos($case, "sand") !== false) {
				$splitSand = true;
				if(strpos($case, "B") !== false) {
					$isTop = false;
				} else if(strpos($case, "T") !== false) {
					$isTop = true;
				}
			} else if (strpos($case, "deli") !== false) {
				$simplifyDeli = false;
			} else if (strpos($case, "pasta") !== false) {
				$displayX = true;
			} else if(strpos($case[0], "display") !== false) {
				// same thing for display - make it (display, item1, num1, item2, num2) etc
				// $displayXX = true;
// 				$num = count($case);
// 				echo $num;
// 				for($i = 1; $i < $num; $i++) {
// 					if($displayMeal === null) {
// 						$displayMeal = array
// 							(
// 							"{$case[$i]}" => $case[$i+1]
// 							);									
// 						$i = $i + 2;
// 						echo $displayMeal;
// 						echo $case[$i];
// 						echo $case[$i+1];
// 					} else {
// 						echo "gooooot here";
// 						echo $name;
// 						$name = $case[$i];
// 						$displayMeal["{$name}"] = $case[$i+1];
// 						echo "test" + $displayMeal["{$name}"];
// 						$i = $i + 2;
// 					}
// 				}
				// $displayMeal = $case[1];
// 				$displayNum = $case[2];
			} else if(strpos($case[0], "title") !== false) {
				$showTitle = true;
				$titleOf = $case[1];
				// put all titles in the same array, so it would be array("title,meal1, meal2) etc
			// 	if($titleOf === null) {
// 					$titleOf = array($case[1]);
// 				} else {
// 					$newArray = $titleOf;
// 					$newArray[] = $case[1];
// 					$titleOf = $newArray;
// 				}
			} else if(strpos($case, "chili") !== false) {
				$showChili = true;			
			}
		} // end fringe foreach
	} // end else statement
	
	foreach($orderToInclude as $mealIncluded) {
		foreach($optionMenu as $item) {
			// If the mealType is marked as included, and the there is no fringe case...
			if(strpos($item[2], $mealIncluded) !== false 
				&& ( strpos($mealIncluded, "fruit") === false 	|| ($simplifyFruit == false) )
				&& ( strpos($mealIncluded, "salad") === false 	|| ($simplifySalad == false) ) 
				&& ( strpos($mealIncluded, "entree") === false 	|| ($simplifyEntree == false) ) 
				&& ( strpos($mealIncluded, "sand") === false 	|| ($splitSand == false) ) 		
				&& ( strpos($mealIncluded, "deli") === false	|| ($simplifyDeli == false) )	
				&& ( strpos($mealIncluded, "pasta") === false 	|| ($displayX == false) )		
				&& ( strpos($mealIncluded, "topp") === false	|| ($showChili == false) )		
				&& ( $displayMeal["{$mealIncluded}"] === null 	|| ($displayXX == false) ) 	)  {
				
				if($newOrderOption === null) {
					$newOrderOption = array
						(
						"{$item[0]}" => $item				
						);
				} else {
					$newOrderOption[$item[0]] = $item;				
				}
			}
			
			// Below is fruit default case - Fruit fringe case is to display the full list versus just "Fruit Bar" 
			else if(strpos($item[2], $mealIncluded) !== false 
				&& strpos($mealIncluded, "fruit") !== false 
				&& $simplifyFruit == true) {	
				
				if($foundFruit === false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"Fruit Bar" => array("Fruit Bar","{item[1]}","fruit bar", null)
							);
					} else {
						$newOrderOption["Fruit Bar"] = array("Fruit Bar","{item[1]}","fruit bar", null);				
					}
					$foundFruit = true;
				} else if ($foundFruit == true) {
					// Do nothing since the new item was already added					
				}
			}
			
			// Below is Salad default case - Salad fringe case is to display the full list of items versus just "Salad Bar"
			else if(strpos($item[2], $mealIncluded) !== false 
				&& strpos($mealIncluded, "salad") !== false 
				&& $simplifySalad == true) {
				
				if($foundSalad == false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"Salad Bar" => array("Salad Bar","{item[1]}","salad bar", "Animal")
							);
					} else {
						$newOrderOption["Salad Bar"] = array("Salad Bar","{item[1]}","salad bar", "Animal");				
					}
					$foundSalad = true;
				} else if ($foundSalad == true) {
					// Do nothing since the new item was already added				
				}
			}
			
			// Entree fringe case is to only display the first item that is listed as entree
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($mealIncluded, "entree") !== false
				&& $simplifyEntree == true) {
			
				if($foundEntree == false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{item[0]}" => $item
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
					$foundEntree = true;
				} else if ($foundEntree == true) {
					// Do nothing since the first entree (oatmeal) should've already been added
				}			
			}
			
			// Sandwich fringe case is to split the category
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($mealIncluded, "sand") !== false
				&& $splitSand == true) {
				
				if($foundSand == false && $isTop == true) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
					$foundSand = true;
				} else if($foundSand == false && $isTop == false) {
					// Do nothing, need the second entry
					$foundSand = true;
				} else if($foundSand == true && $isTop == true) {
					// Do nothing, already got the first entry
				} else if($foundSand == true && $isTop == false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
				}
				
			}
			
			// Below is Deli default case - Deli fringe case is to display the full list
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($mealIncluded, "deli") !== false
				&& $simplifyDeli == true) {
				
				if($foundDeli == false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"Deli Bar" => array("Create your own custom sandwich","{item[1]}","deli bar", "Animal")
							);
					} else {
						$newOrderOption["Deli Bar"] = array("Create your own custom sandwich","{item[1]}","deli bar", "Animal");				
					}
				} else if($foundDeli == true) {
					// Do nothing, replacement entry already in
				}	
			}
			
			// Pasta
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($mealIncluded, "pasta") !== false
				&& $displayX == true) {
				
				if($count >= 5 && count < 7) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
					$count = $count + 1;
				} else {
					$count = $count + 1;
					// Do nothing since the first 3 pastas should be displayed
				}								
			}
			
			// Show the title
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($mealIncluded, $titleOf) !== false
				&& $showTitle == true && $foundSection === false) {
				
				if($foundSection === false) {
					// Add title into array
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{item[2]} Title" => array("{item[2]}","{item[1]}","{item[2]}", "Animal")
							);
					} else {
						$newOrderOption["{item[2]} Title"] = array("{item[2]}","{item[1]}","{item[2]}", "Animal");				
					}
					// Add item like normal into array
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
					if($displayXX == true && strpos($displayMeal, $mealIncluded) !== false) {
						$displayNum = $displayNum - 1;
					} 
					$foundSection = true;
				}
			}
			
			// Display a specific range of numbers
			else if(strpos($item[2], $mealIncluded) !== false
				&& $displayMeal["{$mealIncluded}"] !== null
				&& $displayXX == true) {
				
				$count = 0;
				$displayNum = $displayMeal["{$mealIncluded}"];
				
				if($count < $displayNum) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}
					$count = $count + 1;
				} else {
					// Do nothing since the number of items that needed to be displayed should
						// already be displayed
				}				
				
			}
			
			else if(strpos($item[2], $mealIncluded) !== false
				&& strpos($item[2], "toppin") !== false
				&& $showChili == true) {
				
				if(strpos($item[0], "Miami Chunky Chili") !== false) {
					if($newOrderOption === null) {
						$newOrderOption = array
							(
							"{$item[0]}" => $item				
							);
					} else {
						$newOrderOption[$item[0]] = $item;				
					}				
				} else {
					// Do nothing since we're only showing chili from toppings
				}
				
			}
					
		} // end foreach of option menu array	
	} // end foreach of order to include
	
	return $newOrderOption; 
}


/**
* Displays the information for the option based on current time
* Parameter: array with an array for each meal period, keys must be named breakfast, lunch and dinner, may be null
*/
function displayMenu($parsedRestaurant) {
	$time = date("h:i:sa");
// 	$time = "01:30pm";
	$hour = $time[0] . $time[1];
	$minute = $time[3] . $time[4];

	// Displays breakfast at anytime before 10:30 am, starting at midnight.
	if( (strpos($time, 'am')) && (($hour == 10 && $minute < 30) || ($hour < 10) || $hour == 12) ) {
		if($parsedRestaurant['breakfast'] === null) {
			echo "<br><span id='foodItem'>Breakfast is not offered at this location.</span>";
		} else {
    		$breakfastItemsCount = count($parsedRestaurant['breakfast']);
    		foreach ($parsedRestaurant['breakfast'] as $item) {
        		echo "<br><span id='foodItem'>".$item[0];
        		echo displayTraitIcons($item);
        		echo "</span>";
    		}
    	}
	// Displays dinner at anytime after 4 pm 
	} else if ((strpos($time, 'pm')) && $hour >= 4 && $hour != 12) {
		if($parsedRestaurant['dinner'] === null) {
			echo "<br><span id='foodItem'>Dinner is not offered at this location.</span>";
		} else { 
    		$dinnerItemsCount = count($parsedRestaurant['dinner']);
    		foreach ($parsedRestaurant['dinner'] as $item) {
        		echo "<br><span id='foodItem'>".$item[0];
        		echo displayTraitIcons($item);
        		echo "</span>";
        	}
    	}
	// Displays lunch between 10:30am and before 4
	} else if (  ( (strpos($time, 'am')) && ( ($hour == 10 && $minute >= 30) || $hour == 11 ) ) || ( (strpos($time, 'pm')) && ($hour < 4 || $hour == 12) ) ) {
		if($parsedRestaurant['lunch'] === null) {
			echo "<br><span id='foodItem'>Lunch is not offered at this location.</span>";
		} else {
    		$lunchItemsCount = count($parsedRestaurant['lunch']);
    		foreach ($parsedRestaurant['lunch'] as $item) {
        		echo "<br><span id='foodItem'>".$item[0];
        		echo displayTraitIcons($item);
        		echo "</span>";
			}
		}
	} else {
    	echo "<span id='foodItem';'>There was a problem displaying the menu information.</span>";
	}
}

/**
* Displays the traits of the item array that's been passed in
* Parameter: array for the item to have its traits displayed
*/
function displayTraitIcons($item) {
    $itemTraitsCount = count($item);
    $animalByProduct = false;
    
    for($trait = 3; $trait < $itemTraitsCount; $trait++) {
    	if(strpos($item[$trait], "Egg") !== false) {
            $animalByProduct = true;
        	echo '<img src="traitIcons/egg.jpg" alt="Contains Egg" id="trait" />';
        } else if(strpos($item[$trait], "Fish") !== false) {
            $animalByProduct = true;
        	echo '<img src="traitIcons/fish.jpg" alt="Contains Fish" id="trait" />';
        } else if(strpos($item[$trait], "Gluten") !== false) {
            echo '<img src="traitIcons/gluten.jpg" alt="Contains Gluten" id="trait" />';
        } else if(strpos($item[$trait], "Milk") !== false) {
            $animalByProduct = true;
        	echo '<img src="traitIcons/milk.jpg" alt="Contains Milk" id="trait" />';
        } else if(strpos($item[$trait], "Peanut") !== false) {
        	echo '<img src="traitIcons/peanut.jpg" alt="Contains Peanuts" id="trait" />';
        } else if(strpos($item[$trait], "Shellfish") !== false) {
            $animalByProduct = true;
        	echo '<img src="traitIcons/shellfish.jpg" alt="Contains Shellfish" id="trait" />';
        } else if(strpos($item[$trait], "Soy") !== false) {
        	echo '<img src="traitIcons/soy.jpg" alt="Contains Soy" id="trait" />';
        } else if(strpos($item[$trait], "Tree") !== false) {
        	echo '<img src="traitIcons/treenut.jpg" alt="Contains Treenuts" id="trait" />';
        } else if(strpos($item[$trait], "Wheat") !== false) {
        	echo '<img src="traitIcons/wheat.jpg" alt="Contains Wheat" id="trait" />';
        } else if(strpos($item[$trait], "Animal") !== false) {
        	$animalByProduct = true;
        }
    }
    
    if($animalByProduct === false) {
    	echo '<img src="traitIcons/vegan.jpg" alt="Vegan Friendly" id="trait" />';
   	}
}

    ?>

</html>