<?php
//Generate a star
function genStar () {
	$starNum = 0;
	$starType = "";
	$starColor = "";
	$starSize = "";
	$starNum = mt_rand(1,10)+mt_rand(1,10);
	if ($starNum == 2) {
		$starType = "B";
		$starColor = "Blue-White";
	} elseif ($starNum == 3) {
		$starType = "A";
		$starColor = "White";
	} elseif ($starNum >= 4 && $starNum <= 5) {
		$starType = "F";
		$starColor = "Yellow-White";
	} elseif ($starNum >= 6 && $starNum <= 10) {
		$starType = "G";
		$starColor = "Yellow";
	} elseif ($starNum >= 11 && $starNum <= 13) {
		$starType = "K";
		$starColor = "Orange";
	} elseif ($starNum >= 14 && $starNum <= 17) {
		$starType = "M";
		$starColor = "Red";
	} elseif ($starNum >= 18) {
		$starType = "L";
		$starColor = "Dark Red (Brown Dwarf)";
	} elseif ($starNum >= 19) {
		$starType = "T";
		$starColor = "Purple (Brown Dwarf (Methane))";
	} elseif ($starNum >= 20) {
		$starType = "Y";
		$starColor = "Dark Purple (Sub-Brown Dwarf)";
	}
	$starNum = mt_rand(1,10)+mt_rand(1,10);
	if ($starNum == 2) {
		$starSize = "IV";
		$starFluff = "(Subgiant)";
	} elseif ($starNum >= 3 && $starNum <= 16) {
		$starSize = "V";
		$starFluff = " (Main Sequence)";
	} else {
		$starSize = "VI";
		$starFluff = " (Subdwarf)";
	}
	echo $starType.$starSize.$starFluff." (".$starColor.")";
	return array ($starType, $starSize);
}

//determine number of planets.  numStars defaults to 1 if not specified
function numPlanets ($starType, $starSize, $numStars=1) {
	$count = 0;
	$modifier = 0;
	//penalize for number of stars...
	if ($numStars==2) {
		$modifier-=2;
	} elseif ($numStars==3) {
		$modifier-=6;
	}
	switch ($starSize) {
		case "Ia":
			$modifier-=8;
			break;
		case "Ib":
			$modifier-=6;
			break;
		case "II":
			$modifier-=4;
			break;
		case "III":
			$modifier-=2;
			break;
		case "IV":
			$modifier-=1;
			break;
		case "V":
			break;
		case "VI":
			$modifier-=1;
			break;
		case "VII":
			$modifier-=4;
			break;
	}
	switch ($starType) {
		case "O":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-15;
			break;
		case "B":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-12;
			break;
		case "A":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-10;
			break;
		case "F":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-4;
			break;
		case "G":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-2;
			break;
		case "K":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-6;
			break;
		case "M":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-10;
			break;
		case "L":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-14;
			break;
		case "T":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-15;
			break;
		case "Y":
			$count = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+$modifier-16;
			break;
	}
	if ($count < 0) {
		$count = 0;
	}
	return $count;
}

function genPlanetZones ($starType, $numPlanets) {
	$planets = array();
	//1 = hot zone, 2 = habitable zone, 3 = cold zone
	$count = 0;
	while ($count < $numPlanets) {
		$count++;
		$position = mt_rand(1,20);
		switch ($starType) {
			case "O":
				if ($position >= 1 && $position <= 12) {
					array_push($planets, "1");
				} elseif ($position >= 13 && $position <= 14) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "B":
				if ($position >= 1 && $position <= 10) {
					array_push($planets, "1");
				} elseif ($position >= 11 && $position <= 12) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "A":
				if ($position >= 1 && $position <= 8) {
					array_push($planets, "1");
				} elseif ($position >= 9 && $position <= 10) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "F":
				if ($position >= 1 && $position <= 6) {
					array_push($planets, "1");
				} elseif ($position >= 7 && $position <= 9) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "G":
				if ($position >= 1 && $position <= 5) {
					array_push($planets, "1");
				} elseif ($position >= 6 && $position <= 9) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "K":
				if ($position >= 1 && $position <= 4) {
					array_push($planets, "1");
				} elseif ($position >= 5 && $position <= 6) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "M":
				if ($position >= 1 && $position <= 2) {
					array_push($planets, "1");
				} elseif ($position == 3) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "L":
				if ($position == "1") {
					array_push($planets, "1");
				} elseif ($position == 2) {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "T":
				if ($position == "1") {
					array_push($planets, "2");
				} else {
					array_push($planets, "3");
				}
				break;
			case "Y":
				array_push($planets, "3");
				break;
		}
	}
	return $planets;
}

function genPlanetType($zone) {
	$roll = mt_rand(1,20);
	$type = 0;
	switch ($zone) {
		//zone key: 1 = hot zone, 2 = habitable zone, 3 = cold zone
		//planet key: 1 = gas giant, 2 = terrestrial, 3 = asteroid belt, 4 = icy
		case "1":
			if ($roll >= 1 && $roll <= 2) {
				$type = 1;
			} elseif ($roll >= 3 && $roll <= 19) {
				$type = 2;
			} else {
				$type = 3;
			}
			break;
		case "2":
			if ($roll >= 1 && $roll <= 4) {
				$type = 1;
			} elseif ($roll >= 5 && $roll <= 18) {
				$type = 2;
			} elseif ($roll == 19) {
				$type = 3;
			} else {
				$type = 4;
			}
			break;
		case "3":
			if ($roll >= 1 && $roll <= 8) {
				$type = 1;
			} elseif ($roll >= 9 && $roll <= 11) {
				$type = 2;
			} elseif ($roll >= 11 && $roll <= 12) {
				$type = 3;
			} else {
				$type = 4;
			}
			break;
	}
	return $type;
}

function genRoids($modifier) {
	$returnString = "";
	$beltDensity = mt_rand(1,20)+$modifier;
	if ($beltDensity <= 5) {
		$returnString = $returnString."<li>Light Density - Light belts are almost nothing more than a slight increase in the density of space debris in a region. They are not generally detected as belts prior to space travel, though the major asteroids (if any) would have been mapped by optical telescopes relatively early in a species’ technological history.</li>";
		$majors = mt_rand(1,6)-3;
		if ($majors > 0) {
			$numRoids = 0;
			while ($numRoids < $majors) {
				$numRoids++;
				$size = mt_rand(1,20);
				if ($size <= 10) {
					$diameter = round(1.609344*(mt_rand(1,10)+mt_rand(1,10)+20));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} elseif ($size >= 11 && $size <= 18) 						 {
					$diameter = round(1.609344*(100+(mt_rand(1,10)*10)));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} else {
					$diameter = round(1.609344*(100*(mt_rand(1,4)+mt_rand(1,4))));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				}
			}
		}
	} elseif ($beltDensity >= 6 && $beltDensity <= 15) {
		$returnString = $returnString."<li>Standard Density - Standard belts are readily detectable by a pre-starfaring civilisation. They pose very little hazard to navigation, except due to microdebris. The images of ships flying through densely-packed rock, ducking and weaving to survive, are false; most ships will be unaware they are passing through a belt, except by the increase in micrometeorites.</li>";
		$majors = mt_rand(1,6)-1;
		if ($majors > 0) {
			$numRoids = 0;
			while ($numRoids < $majors) {
				$numRoids++;
				$size = mt_rand(1,20);
				if ($size <= 10) {
					$diameter = round(1.609344*(mt_rand(1,10)+mt_rand(1,10)+20));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} elseif ($size >= 11 && $size <= 18) 						 {
					$diameter = round(1.609344*(100+(mt_rand(1,10)*10)));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} else {
					$diameter = round(1.609344*(100*(mt_rand(1,4)+mt_rand(1,4))));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				}
			}
		}
	} elseif ($beltDensity >= 16 && $beltDensity <= 19) {
		$returnString = $returnString."<li>Dense Density - Dense belts are rare and are considerably more difficult to navigate. Debris too large to be casually bounced off hull plating is more common and collisions between larger fragments lead to random spreads of new debris. In technologically advanced systems, sensor and tracking buoys regularly scan such fields and pass this data along to ships, alerting them to particularly hazardous clusters of fast-moving material. In addition, the high metal content of many of the rocks can interfere with sensor systems (–3 to –6 modifier to skill checks made to operate sensors).</li>";
		$majors = mt_rand(1,6)+2;
		if ($majors > 0) {
			$numRoids = 0;
			while ($numRoids < $majors) {
				$numRoids++;
				$size = mt_rand(1,20);
				if ($size <= 10) {
					$diameter = round(1.609344*(mt_rand(1,10)+mt_rand(1,10)+20));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} elseif ($size >= 11 && $size <= 18) 						 {
					$diameter = round(1.609344*(100+(mt_rand(1,10)*10)));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} else {
					$diameter = round(1.609344*(100*(mt_rand(1,4)+mt_rand(1,4))));
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				}
			}
		}
	} else {
		$returnString = $returnString."<li>Very Dense Density - Very Dense belts are extremely rare and are usually relatively recent. In such belts, navigation can be a serious problem, not so much due to the massive rocks crashing back and forth but due to the high levels of dust and larger fragments. A direct collision with a rock of any significant size is a rarity but the accumulated damage of countless small collisions can wreak havoc with a ship of Colossal (Frigate) size or smaller. Colossal (Cruiser) or larger ships are more resistant. The sensor effects of a dense belt are magnified (–6 to –12 modifier to skill checks made to operate sensors).</li>";
		$majors = mt_rand(1,6)+6;
		if ($majors > 0) {
			$numRoids = 0;
			while ($numRoids < $majors) {
				$numRoids++;
				$size = mt_rand(1,20);
				if ($size <= 10) {
					$diameter = round(1.609344*(mt_rand(1,10)+mt_rand(1,10)+20));
					$diameter = number_format($diameter);
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} elseif ($size >= 11 && $size <= 18) 						 {
					$diameter = round(1.609344*(100+(mt_rand(1,10)*10)));
					$diameter = number_format($diameter);
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				} else {
					$diameter = round(1.609344*(100*(mt_rand(1,4)+mt_rand(1,4))));
					$diameter = number_format($diameter);
					$returnString = $returnString."<li>Major Asteroid ".$numRoids.": ".$diameter." Kilometers</li>";
				}
			}
		}
	}
	return $returnString;
}

function genPlanetSize($zone, $type, $moon = FALSE, $planetSize = 1) {
	$modifier = 0;
	$returnArray = array(); //[0] is size code, [1] is the size string
	//$zone key: 1 = hot zone, 2 = habitable zone, 3 = cold zone
	switch ($zone) {
		case "1":
			$modifier-=1;
			break;
		case "2":
			break;
		case "3":
			$modifier+=1;
	}
	//$type key: 1 = gas giant, 2 = terrestrial, 3 = asteroid belt (shouldnt happen), 4 = icy
	switch ($type) {
		case "1":
			$modifier+=20;
			break;
		case "2":
			break;
		case "4":
			$modifier-=3;
			break;
	}
	if ($moon==TRUE) {
		$modifier-=5;
	}
	$roll = mt_rand(1,20)+$modifier;
	if ($roll <= -4) {
		$returnArray[0] = 1;
	} elseif ($roll >= -3 && $roll <= 0) {
		$returnArray[0] = 2;
		
	} elseif ($roll >= 1 && $roll <= 5) {
		$returnArray[0] = 3;
	} elseif ($roll >= 6 && $roll <= 10) {
		$returnArray[0] = 4;
	} elseif ($roll >= 11 && $roll <= 15) {
		$returnArray[0] = 5;
	} elseif ($roll >= 16 && $roll <= 18) {
		$returnArray[0] = 6;
	} elseif ($roll >= 19 && $roll <= 20) {
		$returnArray[0] = 7;
	} elseif ($roll >= 21 && $roll <= 25) {
		$returnArray[0] = 8;
	} elseif ($roll >= 26 && $roll <= 35) {
		$returnArray[0] = 9;
	} elseif ($roll >= 36 && $roll <= 38) {
		$returnArray[0] = 10;
	} else {
		$chance = mt_rand(1,20);
		if ($chance == 20) {
			$returnArray[0] = 12;
		} else {
			$returnArray[0] = 11;
		}
	}
	//check to make sure moon is not larger than planet
	if ($moon == TRUE) {
		$loop = 2;
		while ($loop == 2) {
			if ($planetSize <= $returnArray[0]) {
				$returnArray[0]--;
			} else {
				$loop = 1;
			}
		}
	}
	//set fluff text and determine size
	if ($returnArray[0] == 1) {
		$diameter = round(1.609344*(mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+50));
		$diameter = number_format($diameter);
		$returnArray[1] = "Diminutive (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 2) {
		$diameter = round(1.609344*(mt_rand(1,4)*100));
		$diameter = number_format($diameter);
		$returnArray[1] = "Fine (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 3) {
		$diameter = round(1.609344*((mt_rand(1,6)+mt_rand(1,6))*100));
		$diameter = number_format($diameter);
		$returnArray[1] = "Tiny (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 4) {
		$diameter = round(1.609344*(1000*(mt_rand(1,2)+1)));
		$diameter = number_format($diameter);
		$returnArray[1] = "Small (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 5) {
		$diameter = round(1.609344*1000*(mt_rand(1,4)+mt_rand(1,4)+4));
		$diameter = number_format($diameter);
		$returnArray[1] = "Medium (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 6) {
		$diameter = round(1.609344*1000*(mt_rand(1,4)+12));
		$diameter = number_format($diameter);
		$returnArray[1] = "Large (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 7) {
		$diameter = round(1.609344*1000*(mt_rand(1,6)+16));
		$diameter = number_format($diameter);
		$returnArray[1] = "Huge (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 8) {
		$diameter = round(1.609344*1000*(mt_rand(1,6)+mt_rand(1,6)+20));
		$diameter = number_format($diameter);
		$returnArray[1] = "Small Gas Giant (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 9) {
		$diameter = round(1.609344*1000*(mt_rand(1,8)+mt_rand(1,8)+mt_rand(1,8)+30));
		$diameter = number_format($diameter);
		$returnArray[1] = "Medium Gas Giant (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 10) {
		$diameter = round(1.609344*1000*(mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+mt_rand(1,10)+50));
		$diameter = number_format($diameter);
		$returnArray[1] = "Huge Gas Giant (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 11) {
		$diameter = round(1.609344*1000*(mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+60));
		$diameter = number_format($diameter);
		$returnArray[1] = "Gargantuan Gas Giant (".$diameter." Kilometer diameter)";
	} elseif ($returnArray[0] == 12) {
		$diameter = round(1.609344*1000*(mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+60));
		$diameter = number_format($diameter);
		$returnArray[1] = "Gargantuan Y-Class Brown Dwarf (".$diameter." Kilometer diameter)";
	}
	return $returnArray;
}

function genSystemFeatures () {
	$returnArray = array();
	$returnArray[0] = FALSE;
	if (mt_rand(1,100) <= 8) {
		$returnArray[0] = TRUE;
		array_push($returnArray, "<strong>Debris Field - </strong>This system contains a debris disk, either as a result of failed planetary development, planetary development currently in progress, or other reasons.");
	}
	if (mt_rand(1,100) <= 2) {
		$returnArray[0] = TRUE;
		array_push($returnArray, "<strong>Flare Star - </strong>This star is prone to flares of higher than normal intensity.");
	}
	if (mt_rand(1,100) <= 10) {
		$returnArray[0] = TRUE;
		array_push($returnArray, "<strong>Oort Cloud - </strong>This system contains an Oort cloud.");
	}
	if (mt_rand(1,100) <= 5) {
		$returnArray[0] = TRUE;
		array_push($returnArray, "<strong>Raider Haven - </strong>This sytem is a haven for raiders of interstellar commerce.  It might not have native life at all, but raiders have decided to set up shop here.  Considering most interstellar commerce flows via the Flux Space trade lanes, this means that there is most likely a Flux Space Gateway within this system - though this may not always be the case.");
	}
	$flux = mt_rand(1,20);
	if ($flux == 20) {
		array_push($returnArray, "<strong>Flux Space Gateway - </strong>For reasons unknown, this system has a Flux Space Gateway but has not been charted.  The identity of who built the gateway is not evident at first glance, more examination is required.");
	} elseif ($flux <= 5) {
		array_push($returnArray, "<strong>Flux Space-Capable - </strong>This system sits along a Flux Space gradient, be it a currently utilized one or not.  Vessels could easily access this system if a Flux Space Gateway were built.");
	}
	return $returnArray;
}

function genGravity ($size, $type, $moon = FALSE, $planetGrav = FALSE) {
	$returnArray = array();
	//if $type = 4, subtract 4 from the roll
	$modifier = 0;
	if ($type == 4) {
		$modifier-=4;
	}
	if ($moon == TRUE) {
		$modifier-=4;
	}
	//if $moon = true, subtract 4 from the roll
	$roll = mt_rand(1,20)+$modifier;
	//$size key: 1 = diminutive, 2 = fine, 3 = tiny, 4 = small, 5 = medium, 6 = large, 7 = huge
	//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
	switch($size) {
		case "1":
			if ($roll <= 19) {
				$returnArray[0] = 1;
			} else {
				$returnArray[0] = 2;
			}
			break;
		case "2":
			if ($roll <= 15) {
				$returnArray[0] = 1;
			} else {
				$returnArray[0] = 2;
			}
			break;
		case "3":
			if ($roll <= 10) {
				$returnArray[0] = 1;
			} else {
				$returnArray[0] = 2;
			}
			break;
		case "4":
			if ($roll <= 10) {
				$returnArray[0] = 2;
			} elseif ($roll >= 11 && $roll >= 19) {
				$returnArray[0] = 3;
			} else {
				$returnArray[0] = 4;
			}
			break;
		case "5":
			if ($roll <= 2) {
				$returnArray[0] = 2;
			} elseif ($roll >= 3 && $roll >= 7) {
				$returnArray[0] = 3;
			} elseif ($roll >= 8 && $roll <= 15) {
				$returnArray[0] = 4;
			} else {
				$returnArray[0] = 5;
			}
			break;
		case "6":
			if ($roll <= 2) {
				$returnArray[0] = 3;
			} elseif ($roll >= 3 && $roll >= 5) {
				$returnArray[0] = 4;
			} elseif ($roll >= 6 && $roll <= 12) {
				$returnArray[0] = 5;
			} elseif ($roll >= 13 && $roll <= 18) {
				$returnArray[0] = 6;
			} else {
				$returnArray[0] = 7;
			}
			break;
		case "7":
			if ($roll <= 1) {
				$returnArray[0] = 3;
			} elseif ($roll >= 2 && $roll >= 3) {
				$returnArray[0] = 4;
			} elseif ($roll >= 4 && $roll <= 10) {
				$returnArray[0] = 5;
			} elseif ($roll >= 11 && $roll <= 16) {
				$returnArray[0] = 6;
			} else {
				$returnArray[0] = 7;
			}
			break;
	}
	var_dump($returnArray);
	if ($planetGrav != FALSE) {
		$loop = TRUE;
		while ($loop == TRUE) {
			//echo "FOO";
			//var_dump($returnArray);
			if ($planetGrav <= $returnArray[0]) {
				$returnArray[0]--;
				//echo "REDUCTION";
			} else {
				$loop = FALSE;
			}
		}
	}
	//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
	if ($returnArray[0] == 1) {
		$returnArray[1] = "Microgravity (0.1 G or lower)";
	} elseif ($returnArray[0] == 2) {
		$returnArray[1] = "Very Low Gravity (0.1 to 0.5 G)";
	} elseif ($returnArray[0] == 3) {
		$returnArray[1] = "Low Gravity (0.51 to 0.8 G)";
	} elseif ($returnArray[0] == 4) {
		$returnArray[1] = "Standard Gravity (0.81 to 1.2 G)";
	} elseif ($returnArray[0] == 5) {
		$returnArray[1] = "High Gravity (1.21 to 2.0 G)";
	} elseif ($returnArray[0] == 6) {
		$returnArray[1] = "Very High Gravity (2.01 to 4.0 G)";
	} elseif ($returnArray[0] == 7) {
		$returnArray[1] = "Extreme Gravity (4.0 G or higher)";
	}
	return $returnArray;
}

function genAtmoDense($gravity, $zone, $moon = FALSE) {
	$returnArray = array();
	$modifier = 0;
	if ($zone == 1 || $zone == 3) {
		$modifier-=4;
	}
	if ($moon == TRUE) {
		$modifer-=2;
	}
	$roll = mt_rand(1,20)+$modifier;
	switch ($gravity) {
		case "1":
			if ($roll <= 19) {
				$returnArray[0] = 1;
			} else {
				$returnArray[0] = 2;
			}
			break;
		case "2": 
			if ($roll <= 9) {
				$returnArray[0] = 1;
			} elseif ($roll >= 11 && $roll <= 18) {
				$returnArray[0] = 2;
			} else {
				$returnArray[0] = 3;
			}
			break;
		case "3": 
			if ($roll <= 5) {
				$returnArray[0] = 1;
			} elseif ($roll >= 6 && $roll <= 10) {
				$returnArray[0] = 2;
			} elseif ($roll >= 11 && $roll <= 15) {
				$returnArray[0] = 3;
			} else {
				$returnArray[0] = 4;
			}
			break;
		case "4": 
			if ($roll <= 2) {
				$returnArray[0] = 1;
			} elseif ($roll >= 3 && $roll <= 6) {
				$returnArray[0] = 2;
			} elseif ($roll >= 7 && $roll <= 10) {
				$returnArray[0] = 3;
			} elseif ($roll >= 11 && $roll <= 15) {
				$returnArray[0] = 4;
			} elseif ($roll >= 16 && $roll <= 19) {
				$returnArray[0] = 5;
			} else {
				$returnArray[0] = 6;
			}
			break;
		case "5": 
			if ($roll <= 1) {
				$returnArray[0] = 1;
			} elseif ($roll >= 2 && $roll <= 3) {
				$returnArray[0] = 2;
			} elseif ($roll >= 4 && $roll <= 7) {
				$returnArray[0] = 3;
			} elseif ($roll >= 8 && $roll <= 11) {
				$returnArray[0] = 4;
			} elseif ($roll >= 12 && $roll <= 16) {
				$returnArray[0] = 5;
			} else {
				$returnArray[0] = 6;
			}
			break;
		case "6": 
			if ($roll <= 1) {
				$returnArray[0] = 1;
			} elseif ($roll == 2) {
				$returnArray[0] = 2;
			} elseif ($roll >= 3 && $roll <= 4) {
				$returnArray[0] = 3;
			} elseif ($roll >= 5 && $roll <= 6) {
				$returnArray[0] = 4;
			} elseif ($roll >= 7 && $roll <= 13) {
				$returnArray[0] = 5;
			} else {
				$returnArray[0] = 6;
			}
			break;
		case "7": 
			if ($roll <= 1) {
				$returnArray[0] = 1;
			} elseif ($roll == 2) {
				$returnArray[0] = 2;
			} elseif ($roll == 3) {
				$returnArray[0] = 3;
			} elseif ($roll == 4) {
				$returnArray[0] = 4;
			} elseif ($roll >= 5 && $roll <= 8) {
				$returnArray[0] = 5;
			} elseif ($roll >= 9 && $roll <= 18) {
				$returnArray[0] = 6;
			} else {
				$returnArray[0] = 7;
			}
			break;
	}
	//key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
	if ($returnArray[0] == 1) {
		$returnArray[1] = "<em>Vacuum - </em>Vacuum means no atmosphere or so little that it is effectively nil. ";
	} elseif ($returnArray[0] == 2) {
		$returnArray[1] = "<em>Very Thin Atmosphere - </em>Very Thin atmospheres range from 0.1 to 0.69 Atmospheres (Earth has an air pressure of 1 Atmosphere at sea level). While not quite as bad as vacuum, they still are not pleasant. They cannot be breathed directly by any of the major races but air compressors can make them breathable without the need for carrying bulky tanks. However, this still provides sub-optimal airflow; they are good for brief exposure but not for the long term. After an hour of using a compressor in a very thin atmosphere, characters must begin to make a Endurance check (DC 15, +1 for each hour of exposure) or suffer from hypoxia. Each failed check moves the character 1 step down on the condition track - when a character reaches the bottom of the condition track from Hypoxia they begin to die of slow suffocation.  They must make a Constitutuion check every minute (DC 15, +1 for each subsuquent minute).  Failure at this checkd rops the character to 0 hit points.  The following round, the character drops to -1 hit points and is dying.  In the third round after the character fails the check, they die unless provided with medical assistance.  Creatures native to such an environment do not suffer from hypoxia.  Condition track movement from hypoxia is considered a persistent condition.";
	} elseif ($returnArray[0] == 3) {
		$returnArray[1] = "<em>Thin Atmosphere - </em>Thin atmospheres range from 0.7 to 0.9 Atmospheres. These atmospheres are dense enough to breathe without artificial aid, though it often takes some time to acclimate and strenuous activity can be very stressful. Atmospheres of 0.8 or less will induce hypoxia in those not acclimated to it, though natives can deal with atmospheres down to 0.7.  After a period of time to thin atmosphere (4 hours for 0.8 atmospheres, 2 hours for 0.75 atmospheres, 1 hour for 0.7 atmospheres), characters must begin to make a Endurance check (DC 15, +1 for each hour of exposure) or suffer from hypoxia. Each failed check moves the character 1 step down on the condition track - when a character reaches the bottom of the condition track from Hypoxia they begin to die of slow suffocation.  They must make a Constitutuion check every minute (DC 10, +1 for each subsuquent minute).  Failure at this checkd rops the character to 0 hit points.  The following round, the character drops to -1 hit points and is dying.  In the third round after the character fails the check, they die unless provided with medical assistance.  Creatures native to such an environment do not suffer from hypoxia.  Condition track movement from hypoxia is considered a persistent condition.";
	} elseif ($returnArray[0] == 4) {
		$returnArray[1] = "<em>Standard Atmosphere - </em>Standard atmospheres range from 0.91 to 1.1 Atmospheres. Most major species can breathe these atmospheres without difficulty.";
	} elseif ($returnArray[0] == 5) {
		$returnArray[1] = "<em>Dense Atmosphere - </em>Dense atmospheres range from 1.11 to 1.3 Atmospheres. These are breathable without artificial aid but the high density can cause problems.";
	} elseif ($returnArray[0] == 6) {
		$returnArray[1] = "<em>Very Dense Atmosphere - </em>Very Dense atmospheres ranges from 1.31 to 1.5 Atmospheres. These are dangerous, as the extreme pressure can produce bends-like symptoms. Pressure suits are required for all but brief exposures.";
	} elseif ($returnArray[0] == 7) {
		$returnArray[1] = "<em>Extremely Dense Atmosphere - </em>Extremely Dense atmospheres are in excess of 4.01 Atmospheres. Special construction techniques and materials are needed to resist the pressure; normal vehicles will begin to show signs of strain rapidly unless the internal and external pressures are allowed to equalise. Unprotected Humans and similar species will begin to suffer grievous harm in just a few moments and may simply be crushed outright if the pressure is high enough.";
	}
	return $returnArray;
}

function genAtmoComp($zone, $moon = FALSE) {
	$returnArray = array();
	$modifier = 0;
	if ($moon == TRUE) {
		$modifier-=2;
	}
	$roll = mt_rand(1,20)+$modifier;
	switch ($zone) {
		case "1": 
			if ($roll <= 5) {
				$returnArray[0] = 1;
			} elseif ($roll >= 6 && $roll <= 10) {
				$returnArray[0] = 2;
			} else {
				$returnArray[0] = 3;
			}
			break;
		case "2":
			if ($roll <= 3) {
				$returnArray[0] = 2;
			} elseif ($roll >= 4 && $roll <= 5) {
				$returnArray[0] = 3;
			} elseif ($roll >= 6 && $roll <= 12) {
				$returnArray[0] = 4;
			} else {
				$returnArray[0] = 5;
			}
			break;
		case "3":
			if ($roll <= 10) {
				$returnArray[0] = 3;
			} elseif ($roll >= 11 && $roll <= 15) {
				$returnArray[0] = 2;
			} elseif ($roll >= 16 && $roll <= 18) {
				$returnArray[0] = 1;
			} else {
				$returnArray[0] = 6;
			}
			break;
	}
	//$atmosphereComposition[0] key: 1 = corrosive, 2 = poisonous, 3 = inert, 4 = breathable, 5 = breathable(tainted), 6 = variable
	if ($returnArray[0] == 1) {
		$returnArray[1] = "<em>Corrosive Atmosphere - </em>The atmosphere eats away at flesh and technology. Each round of exposure, living and non-living things take 2d6 points of damage. Damage Reduction does not apply unless the material is immune to the nature of the corrosion, which should be determined by the Games Master. Worlds with corrosive atmospheres rarely have settlements; if they do, they are usually deep underground or in domes made of a substance immune to the corrosion. Even in such cases, getting people or supplies down to the settlement is very costly and dangerous; for a settlement to exist there must be something truly vital on the world.";
	} elseif ($returnArray[0] == 2) {
		$returnArray[1] = "<em>Poisonous Atmosphere - </em>The atmosphere is toxic to life forms. The atmosphere may be high in chlorine gas or contain more complex poisons. Unlike a merely tainted atmosphere, even a few breaths are deadly; each minute, a Constitution check (DC 10) must be made, with 1d4 points of attribute damage (the exact attribute is up to the Games Master
and depends on the nature of the poison – in most cases, it will be Constitution) being the consequence of failure. The DC of the check increases by 1 for every ten minutes of exposure. It is possible that native organisms have built up a natural tolerance to the Poisonous atmosphere – this is extremely unlikely but not unheard of.";
	} elseif ($returnArray[0] == 3) {
		$returnArray[1] = "<em>Inert Atmosphere - </em>As regards most races biology or technology, the atmosphere is just there, and has no effect. It cannot be breathed but direct exposure to it is not immediately harmful to either life or equipment. An atmosphere similar to Earth’s, but with only 5% oxygen and more nitrogen, would be a good example of an Inert atmosphere, as would
a mostly CO2 atmosphere. Note that to races with different biologies, an ‘inert’ atmosphere could be extremely noninert, perhaps Breathable or Corrosive.";
	} elseif ($returnArray[0] == 4) {
		$returnArray[1] = "<em>Human-Breathable Atmosphere - </em>The atmosphere can be breathed, without assistance, by humanity and similar species.  In short, a standard oxygen/nitrogen mix, though
there may be odd contaminants which will have an impact only on prolonged (multiple-month) exposure.";
	} elseif ($returnArray[0] == 5) {
		$roll2 = mt_rand(1,6);
		if ($roll2 == 1) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Polluted) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  The pollution rampant in this atmosphere inflicts 1 point of Constitution damage per day.  It is not unheard of for native organisms to have built a natural tolerance to this atmosphere, however it is not likely.";
		} elseif ($roll2 == 2) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Low Oxygen) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  This atmosphere, while breathable by humans, has a low oxygen count.  It is treated as having an atmospheric pressure of 0.7 for the purposes of hypoxia.  If it was already at this pressure lower, reduce the effective pressure by 0.1.  After a period of time to this atmosphere (4 hours for 0.8 atmospheres (post reduction), 2 hours for 0.75 atmospheres (post reduction), 1 hour for 0.7 atmospheres or lower (post reduction)), characters must begin to make a Endurance check (DC 15, +1 for each hour of exposure) or suffer from hypoxia. Each failed check moves the character 1 step down on the condition track - when a character reaches the bottom of the condition track from Hypoxia they begin to die of slow suffocation.  They must make a Constitutuion check every minute (DC 10, +1 for each subsuquent minute).  Failure at this checkd rops the character to 0 hit points.  The following round, the character drops to -1 hit points and is dying.  In the third round after the character fails the check, they die unless provided with medical assistance.  Creatures native to such an environment do not suffer from hypoxia.  Condition track movement from hypoxia is considered a persistent condition.";
		} elseif ($roll2 == 3) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Radioactive) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  All areas exposed to this atmosphere are considered to have at least Mild levels of radiation (+1 attack, 2d6 damage, DC 15 Treat Injury), though it is possible for some areas to be higher.  It is not unheard of for native organisms to have built a natural tolerance to this atmosphere, however it is not likely.";
		} elseif ($roll2 == 4) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Druglike) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  There are odd chemicals in this atmosphere that mimic the effects of hallucinogenic drugs.  Breathing it for more than 1 hour results in delusions. Continued exposure causes a 1d4 Wisdom damage per day.  Creatures native to this environment are not effected.";
		} elseif ($roll2 == 5) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Allergens) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  This atmosphere is loaded with universal allergens that affect species which can breathe human-standard atmospheres.  Each hour of unfiltered exposure requires a DC 10 Constitution check to resist moving -1 step on the condition track.  This movement can only happen once, and is considered a persistent condition.  Once it is removed, th e character is vulnerable to this effect again.  Antihistamines can be developed for this atmosphere, however they are specific to this atmosphere only.  Developing it requires a Knowledge [Life Sciences] check (DC 30) and 24 hours of work.  Manufacaturing the antihistamine costs 5 credits per dose, and each dose protects for 12 hours.  Creatures native to this environment are not effected.";
		} elseif ($roll2 == 6) {
			$returnArray[1] = "<em>Human-Breathable Atmosphere (Tainted - Diseased) - </em>The atmosphere is not instantly lethal and will sustain life but it contains taints which require a filter mask in order to breath safely for more than a few minutes.  This atmosphere is loaded with a particularly virulent pathogen which attacks all who breathe it.  Each day of unfiltered exposure requires the character to make a DC 10 Constitution check or suffer the effects of the pathogen (GM determined).  This pathogen can be analyzed and treated, however this requires an amount of time and a Knowledge [Life Sciences] check determined by the GM.  Creatures native to this environment are not affected, and may be a good source of assistance in treating the pathogen (possibly antibodies as well).";
		}
	} elseif ($returnArray[0] == 6) {
		$returnArray[1] = "<em>Variable - </em>On some worlds in the outer reaches of star systems, the atmospheric composition changes over the course of the worlds long orbit. During planetary summer, gasses are released into the atmosphere; during winter, they freeze and fall as snow. This can lead to a world where the atmosphere is inert for twenty years and corrosive for five, as the orbital cycle frees and then recaptures various elements.";
	}
	return $returnArray;
}

function genPlanetGeo($gravity, $atmosphere) {
	//$planetGeology[0] key: 1 = very flat, 2 = flat, 3 = stndard, 4 = rugged, 5 = very rugged
	//$atmosphere[0] key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
	//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
	$returnArray = array();
	$modifier = 0;
	switch ($gravity) {
		case "1":
			$modifier-=4;
			break;
		case "2":
			$modifier-=2;
			break;
		case "3":
			$modifier-=1;
			break;
		case "4":
			break;
		case "5":
			$modifier+=1;
			break;
		case "6":
			$modifier+=2;
			break;
		case "7":
			$modifier+=4;
			break;
	}
	switch ($atmosphere) {
		case "1":
			$modifier+=3;
			break;
		case "2":
			$modifier+=1;
			break;
		case "3":
			break;
		case "4":
			break;
		case "5":
			break;
		case "6":
			$modifier-=2;
			break;
		case "7":
			$modifier-=4;
			break;
	}
	$roll = mt_rand(1,20)+$modifier;
	if ($roll <= 3) {
		$returnArray[0] = 1;
		$returnArray[1] = "<em>Very Flat Geology - </em>Very Flat planets have few significant surface features. This does not mean they are polished smooth but rather that there are no meaningful mountain ranges, deep trenches or the like. There may be a few rolling hills or the occasional meandering river but the world overall is lacking in serious geography. This implies an old or very stable world. Oceans are very shallow, closer to vast swamps, in fact. Because of the lack of barriers to migration, lifeforms tend to be more uniform, as the isolation required for speciation is much rarer.";
	} elseif ($roll >= 4 && $roll <= 7) {
		$returnArray[0] = 2;
		$returnArray[1] = "<em>Flat Geology - </em>Flat planets have only rare spots where there is significant geological activity. There may be a small mountain range or two, or one ocean which shows real depth. Hilly or rolling areas are fairly common. Rivers have carved out valleys in many areas, though not great canyons. The highest mountains will be only a mile or two high. There may be
well-worn dormant volcanoes, but no active ones.";
	} elseif ($roll >= 8 && $roll <= 13) {
		$returnArray[0] = 3;
		$returnArray[1] = "<em>Standard Geology - </em>Standard planets show a wide range of geological activity. There are tall mountains (up to five miles), deep trenches, river canyons and so on. The world has many sprawling plains as well, areas of minimal geological activity. Almost any terrain can be found here. A world with standard geography but no extant water either had high levels of volcanism in the past (and possibly ongoing) or was once considerably wetter than it currently is.";
	} elseif ($roll >= 14 && $roll <= 17) {
		$returnArray[0] = 4;
		$returnArray[1] = "<em>Rugged Geology - </em>Rugged planets have few large, flat areas. Oceans are riddled with deep subsea canyons or punctured by archipelagos. The land is twisted, with many large mountain chains criss-crossing each other. Truly immense mountains dot the landscape. The world is likely to be biologically rich, as constant isolation forces speciation to occur often.";
	} elseif ($roll >= 18) {
		$returnArray[0] = 5;
		$returnArray[1] = "<em>Very Rugged Geology - </em>Very Rugged planets are geological nightmares. There are flatlands, but they are rare, and are often found atop plateaus. Hills and mountains are everywhere and both mountain chains and oceanic trenches tend to extremes. Such worlds are often young or very geologically active and they may be suffering from tidal stress caused by a large moon.";
	}
	return $returnArray;
}

function genPlanetVolcanism($gravity, $geology, $moon = FALSE) {
	//$planetVolcanism[0] key: 1 = dead, 2 = stable, 3 = active, 4 = very active, 5 = extreme
	//$planetGeology[0] key: 1 = very flat, 2 = flat, 3 = standard, 4 = rugged, 5 = very rugged
	//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
	$returnArray = array();
	$modifier = 0;
	if ($moon == TRUE) {
		$modifier-=2;
	}
	switch ($gravity) {
		case "1":
			$modifier-=4;
			break;
		case "2":
			$modifier-=2;
			break;
		case "3":
			$modifier-=1;
			break;
		case "4":
			break;
		case "5":
			$modifier+=1;
			break;
		case "6":
			$modifier+=2;
			break;
		case "7":
			$modifier+=4;
			break;
	}
	switch ($geology) {
		case "1":
			$modifier-=5;
			break;
		case "2":
			$modifier-=3;
			break;
		case "3":
			break;
		case "4":
			$modifier+=1;
			break;
		case "5":
			$modifier+=3;
			break;
	}
	$roll = mt_rand(1,10)+$modifier;
	if ($roll <= 4) {
		$returnArray[0] = 1;
		$returnArray[1] = "<em>Dead Volcanism -</em> The planet is geologically dead and has had no significant volcanic activity for millions of years.";
	} elseif ($roll >= 5 && $roll <= 6) {
		$returnArray[0] = 2;
		$returnArray[1] = "<em>Stable Volcanism - </em>The planet is geologically very stable; the few active volcanoes are well charted and there are few, if any, surprises.";
	} elseif ($roll >= 7 && $roll <= 9) {
		$returnArray[0] = 3;
		$returnArray[1] = "<em>Active Volcanism - </em>The planet is geologically active with active volcano belts. There are occasional unexpected eruptions.";
	} elseif ($roll >= 10 && $roll <= 11) {
		$returnArray[0] = 4;
		$returnArray[1] = "<em>Very Active Volcanism - </em>The planet is geologically active; areas near to known volcano belts are generally not inhabited due to the frequency and randomness of eruptions.";
	} else {
		$returnArray[0] = 5;
		$returnArray[1] = "<em>Extreme Volcanism - </em> The planet is a nightmare; at any given moment, any point can erupt suddenly. Such planets are very rarely colonised or give rise to native complex lifeforms – they are simply too unstable for any complex organism to survive for long.";
	}
	
	return $returnArray;	
}

function genPlanetHydrosphere($atmosphere, $zone, $geology, $volcanism, $moon = FALSE) {
	//$planetHydrosphere key: 0 = type, 1 = fluff text, 2 = percentage
	//$planetHydrosphere[0] key: 0 = none, 1 = very dry, 2 = dry, 3 = damp, 4 = moist, 5 = wet, 6 = very wet
	//$atmosphere[0] key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
	//$zone key: 1 = hot, 2 = habitable, 3 = cold
	$modifier = 0;
	$returnArray = array();
	if ($moon == TRUE) {
		$modifier-=2;
	}
	switch ($atmosphere) {
		case "1":
			$modifier-=8;
			break;
		case "2":
			$modifier-=4;
			break;
		case "3":
			$modifier-=2;
			break;
		case "4":
			break;
		case "5":
			$modifier+=2;
			break;
		case "6":
			$modifier+=4;
			break;
		case "7":
			$modifier+=6;
			break;
	}
	switch ($atmosphere) {
		case "1":
			$modifier-=4;
			break;
		case "2":
			$modifier+=2;
			break;
		case "3":
			$modifier-=2;
			break;
	}
	$roll = mt_rand(1,20)+$modifier;
	//$planetHydrosphere[0] key: 1 = none, 2 = very dry, 3 = dry, 4 = damp, 5 = moist, 6 = wet, 7 = very wet
	if ($roll <= 6) {
		$returnArray[0] = 1;
		$returnArray[1] = "<em>No Hydrosphere</em>";
		$returnArray[2] = 0;
	} elseif ($roll >=7 && $roll <=10) {
		$returnArray[0] = 2;
		$percent = mt_rand(1,20);
		$returnArray[1] = "<em>Very Dry Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	} elseif ($roll >=11 && $roll <=13) {
		$returnArray[0] = 3;
		$percent = mt_rand(1,10)+21;
		$returnArray[1] = "<em>Dry Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	} elseif ($roll >=14 && $roll <=15) {
		$returnArray[0] = 4;
		$percent = mt_rand(1,20)+30;
		$returnArray[1] = "<em>Damp Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	} elseif ($roll >=16 && $roll <=17) {
		$returnArray[0] = 5;
		$percent = mt_rand(1,20)+50;
		$returnArray[1] = "<em>Moist Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	} elseif ($roll >=18 && $roll <=19) {
		$returnArray[0] = 6;
		$percent = mt_rand(1,20)+70;
		$returnArray[1] = "<em>Wet Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	} else {
		$returnArray[0] = 7;
		$percent = mt_rand(1,10)+90;
		$returnArray[1] = "<em>Very Wet Hydrosphere</em> (".$percent."%, ";
		$returnArray[2] = $percent;
	}
	//$planetGeology[0] key: 1 = very flat, 2 = flat, 3 = stndard, 4 = rugged, 5 = very rugged
	//$planetVolcanism[0] key: 1 = dead, 2 = stable, 3 = active, 4 = very active, 5 = extreme
	//if continents
	if ($returnArray[2] >= 50) {
		$modifier = 0;
		switch ($volcanism) {
			case "1":
				$modifier-=4;
				break;
			case "2":
				$modifier-=2;
				break;
			case "3":
				break;
			case "4":
				$modifier+=2;
				break;
			case "5":
				$modifier+=6;
				break;
		}
		switch ($geology) {
			case "1":
				$modifier-=2;
				break;
			case "2":
				$modifier-=1;
				break;
			case "3":
				break;
			case "4":
				$modifier+=2;
				break;
			case "5":
				$modifier+=4;
				break;
		}
		if ($returnArray[2] >= 61 && $returnArray[2] <= 75) {
			$modifier+=4;
		} elseif ($returnArray[2] >= 76 && $returnArray[2] <= 100) {
			$modifier+=8;
		}
		$roll = mt_rand(1,20)+$modifier;
		if ($roll <= 5) {
			$returnArray[1].="One Supercontinent)<ul><li>A world with a single supercontinent has over 90% of its land mass in a single, continuous body. This can take several forms – it may be a roughly square or ovoid mass, or it may be a long, sinuous, stretch of land. In the case of the former, areas in the centre are likely to mountainous, as they are likely points where continental plates have smashed together. Further, depending on wind patterns and rivers, areas inland will be progressively dryer, so that large portions of the continent will be arid or desert. In the case of ‘sinuous’ continents, where no area is too far from the water, this is less likely to happen.<br />If the planet has had a single continent for a long time, there will somewhat less evolutionary diversity on the planet, as there are fewer opportunities for populations to separate and form new species. This may not be the case if the continent is also geologically active, continually throwing up new mountain ranges or forming impassable chasms. A sentient race which evolved on the continent would quickly spread across it, unless there were extensive natural barriers. This might lead to slower technological progress, as there would not be a need to solve problems of population growth and because more room to expand could mean less cause for conflict. On the other hand, if the continent is not easily crossed or if large portions are uninhabitable, then this would not be the case.<br />A single continent can indicate a young world, where the breakup of the continental plates has not occurred or it could indicate an ancient world, in which tectonic energy is spent and there is no force driving the motion of the continents.</li></ul>";
		} elseif ($roll >=6 && $roll <= 10) {
			$returnArray[1].=(mt_rand(1,4)+1);
			$returnArray[1].=" Large Continents)<ul><li>In general, a ‘large’ continent accounts for 25% or more of the planets mass; a ‘small’ continent 5% to 25%. Multiple continents generally imply a middle-aged world with an active tectonic system, though it is possible that the current layout has remained stagnant for a long time. Separation tends to increase biological diversity – consider Australia, on Earth. Because it was disconnected from other land masses, it preserved a rich diversity of marsupial life (which continued to evolve on its own) while placental mammals dominated most of the rest of the world. It can also lead to cultural diversity – sentient beings who make the long journey to a new continent, either via water or a temporary landbridge, will diverge socially and culturally from those left behind, because there is no easy way of exchanging cultural information. Very large continents (such as Asia on Earth) have many of the traits of supercontinents, including largely uninhabitable interior regions.</li></ul>";
		} elseif ($roll >= 11 && $roll <= 15) {
			$returnArray[1].=(mt_rand(1,2));
			$returnArray[1].=" Large Continents and ";
			$returnArray[1].=(mt_rand(1,4)+1);
			$returnArray[1].=" Small Continents)<ul><li>In general, a ‘large’ continent accounts for 25% or more of the planets mass; a ‘small’ continent 5% to 25%. Multiple continents generally imply a middle-aged world with an active tectonic system, though it is possible that the current layout has remained stagnant for a long time. Separation tends to increase biological diversity – consider Australia, on Earth. Because it was disconnected from other land masses, it preserved a rich diversity of marsupial life (which continued to evolve on its own) while placental mammals dominated most of the rest of the world. It can also lead to cultural diversity – sentient beings who make the long journey to a new continent, either via water or a temporary landbridge, will diverge socially and culturally from those left behind, because there is no easy way of exchanging cultural information. Very large continents (such as Asia on Earth) have many of the traits of supercontinents, including largely uninhabitable interior regions.</li></ul>";
		} else {
			$returnArray[1].=" Large Islands and Archipelagos Only)<ul><li>This arrangement of land is usually found only on Wet or Very Wet worlds. If the world is relatively dry but still lacks any large continents, it will be covered with islands which are fairly close to each other, creating something akin to having a lot of small continents. Lifeforms will move from island to island relatively easily, creating some continuity of species over distance. In most cases, though, the island chains will be scattered, separated from each other by vast ocean gulfs. Life will be very diverse, with many species having no analogues from one chain to the next. If the intelligent life is land-dwelling, each cluster of islands may host very different cultures, with hundreds of languages. There will be very few deserts or uninhabitable zones, though newly-formed islands will be lifeless until species can migrate there from other areas. The first species to ‘claim’ a newly formed island or island chain will likely hold it against latecomers and thus determine the baseline from which life in that chain will evolve.</li></ul>";
		}
	}
	//if oceans
	if ($returnArray[2] > 0 && $returnArray[2] < 50) {
		$modifier = 0;
		switch ($volcanism) {
			case "1":
				$modifier-=4;
				break;
			case "2":
				$modifier-=2;
				break;
			case "3":
				break;
			case "4":
				$modifier+=2;
				break;
			case "5":
				$modifier+=4;
				break;
		}
		switch ($geology) {
			case "1":
				$modifier-=4;
				break;
			case "2":
				$modifier-=1;
				break;
			case "3":
				break;
			case "4":
				$modifier+=1;
				break;
			case "5":
				$modifier+=2;
				break;
		}
		if ($returnArray[2] >= 1 && $returnArray[2] <= 30) {
			$modifier+=4;
		} elseif ($returnArray[2] >= 41 && $returnArray[2] <= 49) {
			$modifier-=4;
		}
		$roll = mt_rand(1,20)+$modifier;
		if ($roll <= 5) {
			$returnArray[1].="Single Ocean)<ul><li>All of the planets liquid are gathered in one spot, with perhaps a few tiny lakes elsewhere. If the planet has a relatively high hydrosphere (40%+) it is likely this single ocean will be fed with several robust river systems; otherwise, rivers will be few. Assuming life on the planet depends on liquid (a common assumption), there will be a ‘fertile zone’ around the ocean and desert beyond; all life will cluster around this central point. Sentient beings will spread around the shoreline rather than outwards and developing the technology to settle ‘the drylands’ will be a major step in the race’s technological evolution.</li></ul>";
		} elseif ($roll >=6 && $roll <= 10) {
			$returnArray[1].=(mt_rand(1,4)+1);
			$returnArray[1].=" Oceans)<ul><li>An ‘ocean’ will have 25% or more of the planets free liquid; a sea, 5% to 25%. Seas which are linked (or were relatively recently linked) by rivers will see some species commonality, as well as providing sentients an easy way to travel between them. Widely separated bodies of water which have never linked, or which were joined in the distant past, may have very different sets of lifeforms. Furthermore, if the land between them is harsh or infertile, it may take a long time for sentients to move from one ‘life zone’ to another, leading to great cultural drift.</li></ul>";
		} elseif ($roll >= 11 && $roll <= 15) {
			$returnArray[1].=(mt_rand(1,2));
			$returnArray[1].=" Oceans and ";
			$returnArray[1].=(mt_rand(1,4)+1);
			$returnArray[1].=" Seas)<ul><li>An ‘ocean’ will have 25% or more of the planets free liquid; a sea, 5% to 25%. Seas which are linked (or were relatively recently linked) by rivers will see some species commonality, as well as providing sentients an easy way to travel between them. Widely separated bodies of water which have never linked, or which were joined in the distant past, may have very different sets of lifeforms. Furthermore, if the land between them is harsh or infertile, it may take a long time for sentients to move from one ‘life zone’ to another, leading to great cultural drift.</li></ul>";
		} else {
			$returnArray[1].="Scattered Lakes)<ul><li>All liquid on the planet is divided among a large number of lakes, ranging from those which are close to being small seas to tiny near-puddles which may intermittently dry up. Many times, this is due to meteor infall causing a cratered area in one part of the planet where liquid can collect; at other times, it may simply be that there is too little water to form larger bodies. Either way, such a situation can lead to considerable cultural or biological diversity. Sentient beings will stake out a lake or lake, which can lead to constant war over water sources, or it might be that watering holes are ‘treaty zones’ where all may come and share freely.</li></ul>";
		}
	}
	return $returnArray;
}

function genPlanetClimate($atmosphere, $starType, $starSize, $planetVolcanism, $planetHydrosphere, $size) {
	//$planetVolcanism[0] key: 1 = dead, 2 = stable, 3 = active, 4 = very active, 5 = extreme	
	//$atmosphere[0] key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
	//$starTypes: O, B, A, F, G, K, M, L, T, Y
	//$size key: 1 = diminutive, 2 = fine, 3 = tiny, 4 = small, 5 = medium, 6 = large, 7 = huge
	$modifier = 0;
	switch ($planetVolcanism) {
		case "1": 
			break;
		case "2": 
			break;
		case "3": 
			$modifier+=1;
			break;
		case "4": 
			$modifier+=2;
			break;
		case "5": 
			$modifier+=4;
			break;
	}
	switch ($atmosphere) {
		case "1":
			//shouldn't ever happen
			break;
		case "2":
			$modifier-=6;
			break;
		case "3":
			$modifier-=2;
			break;
		case "4":
			break;
		case "5":
			$modifier+=2;
			break;
		case "6":
			$modifier+=4;
			break;
		case "7":
			$modifier+=8;
			break;
	}
	switch ($starType) {
		case "O":
			$modifier+=7;
			break;
		case "B":
			$modifier+=5;
			break;
		case "A":
			$modifier+=3;
			break;
		case "F":
			$modifier+=7;
			break;
		case "G":
			break;
		case "K":
			$modifier-=2;
			break;
		case "M":
			$modifier-=5;
			break;
		case "L":
			$modifier-=7;
			break;
		case "T": 
			$modifier-=8;
			break;
		case "Y": 
			$modifier-=9;
			break;
	}
	switch ($starSize) {
		case "Ia":
			$modifier+=7;
			break;
		case "Ib":
			$modifier+=6;
			break;
		case "II":
			$modifier+=5;
			break;
		case "III":
			$modifier+=3;
			break;
		case "IV":
			$modifier+=2;
			break;
		case "V":
			break;
		case "VI":
			$modifier-=4;
			break;
		case "VII":
			$modifier-=8;
			break;
	}
	$roll = mt_rand(1,10)+mt_rand(1,10)+$modifier;
	if ($roll <= 0) {
		$temp = -10;
	} elseif ($roll >= 1 && $roll <= 2) {
		$temp = 0;
	} elseif ($roll >= 3 && $roll <= 4) {
		$temp = 20;
	} elseif ($roll >= 5 && $roll <= 6) {
		$temp = 30;
	} elseif ($roll >= 7 && $roll <= 8) {
		$temp = 40;
	} elseif ($roll >= 9 && $roll <= 12) {
		$temp = 50;
	} elseif ($roll >= 13 && $roll <= 14) {
		$temp = 60;
	} elseif ($roll >= 15 && $roll <= 16) {
		$temp = 70;
	} elseif ($roll >= 17 && $roll <= 18) {
		$temp = 80;
	} elseif ($roll >= 19 && $roll <= 20) {
		$temp = 90;
	} elseif ($roll == 21) {
		$temp = 100;
	} else {
		$temp = 110;
	}
	$mod2 = 0;
	if ($size <= 3) {
		$mod2-=10;
	} elseif ($size == 4) {
		$mod2-=4;
	} elseif ($size == 6) {
		$mod2+=4;
	} elseif ($size == 7) {
		$mod2+=8;
	}
	if ($planetHydrosphere <= 20) {
		$mod2-=2;
	} elseif ($planetHydrosphere >= 60 && $planetHydrosphere <= 80) {
		$mod2+=2;
	} elseif ($planetHydrosphere >= 81) {
		$mod2+=4;
	}
	$variability = 3*(mt_rand(1,10)+mt_rand(1,10)+$mod2);
	$returnText = $temp." F Average Equatorial Temperature (".round((($temp-32)/1.8))." C).  Variability: ".$variability." F (".round((($temp-32)/1.8))." C)";
	return $returnText;
}

function genPlanetBiosphere ($atmopshere, $hydrosphere, $zone, $atmosphericComposition, $volcanism) {
	$modifier = 0;
	$returnArray = array();
	switch ($atmosphere) {
		case "1":
			$modifier-=8;
			break;
		case "2":
			$modifier-=4;
			break;
		case "3":
			$modifier-=2;
			break;
		case "4":
			break;
		case "5":
			$modifier-=2;
			break;
		case "6":
			$modifier-=4;
			break;
		case "7":
			$modifier-=8;
			break;
	}
	//$planetHydrosphere[0] key: 1 = none, 2 = very dry, 3 = dry, 4 = damp, 5 = moist, 6 = wet, 7 = very wet
	switch ($hydrosphere) {
		case "1":
			$modifier-=8;
			break;
		case "2":
			$modifier-=4;
			break;
		case "3":
			break;
		case "4":
			break;
		case "5":
			break;
		case "6":
			$modifier+=4;
			break;
		case "7":
			$modifier+=6;
			break;
	}
	switch ($zone) {
		case "1": 
			$modifier-=8;
			break;
		case "2":
			$modifier+=2;
			break;
		case "3":
			$modifier-=6;
			break;
	}
	switch ($atmosphericComposition) {
		//$atmosphereComposition[0] key: 1 = corrosive, 2 = poisonous, 3 = inert, 4 = breathable, 5 = breathable(tainted), 6 = variable
		case "1": 
			$modifier-=6;
			break;
		case "2":
			$modifier-=4;
			break;
		case "3":
			$modifier-=6;
			break;
		case "4":
			$modifier+=2;
			break;
		case "5":
			$modifier+=2;
			break;
		case "6":
			break;
	}
	if ($volcanism == 5) {
		$modifier-=6;
	}
	$rollDensity = mt_rand(1,20)+$modifier;
	if ($rollDensity <= 5) {
		$returnArray[0] = 1;
		$returnArray[2] = "<em>No Biosphere - </em> The planet has no extant native life. All life is the result of recent colonisation or settlement and does not form a self-sustaining ecosystem. If the current colony vanishes, the life forms brought there will most likely die out. Pluto is a good example of this.";
	} elseif ($rollDensity >= 6 && $rollDensity <= 10) {
		$returnArray[0] = 2;
		$modifier-=10;
		$returnArray[2] = "<em>Very Scarce Biosphere Density - </em>Life exists in a few small, sheltered areas. This may be the first life on the planet or it might be the dying remains of a once-vibrant system. Complexity is likely to be very low but if it is not, this represents a world where only a few portions of the world are conducive to advanced life – perhaps it is life clustered around volcanic vents on a frozen planet or in the ‘shadow zone’ of a world which does not rotate. For at least the next few decades, Mars is typical of this level of life (in setting).";
	} elseif ($rollDensity >= 11 && $rollDensity <= 15) {
		$returnArray[0] = 3;
		$modifier-=5;
		$returnArray[2] = "<em>Scarce Biosphere Density - </em>Life exists in scattered spots around the planet. Many regions are even free of microbes. The comments on complexity apply here as well, although scarce life could indicate an ecosystem which is recovering strength following a catastrophe (perhaps a result of a planetary war of unimaginable scale or an ecosystem which is on its last legs as a plague or other cataclysm wipes it out).";
	} elseif ($rollDensity >= 16 && $rollDensity <= 18) {
		$returnArray[0] = 4;
		$returnArray[2] = "<em>Infrequent Biosphere Density - </em>Life can be found across the planet but not much of it. Large swathes of land are barren or inhabited only by microbes. There are only a few places where there are dense forests, fertile plains or coral reefs. In most area, there are relatively few species and conditions are harsh. The surface of Tau Ceti e (the homeworld of the Hand of Action) is a good example of this.";
	} elseif ($rollDensity >= 19 && $rollDensity <= 21) {
		$returnArray[0] = 5;
		$returnArray[2] = "<em>Standard Biosphere Density - </em>Life is everywhere, and there are few barren or empty places. Even those will have complex ecosystems, with the barrenness only a surface illusion. The Proximan homeworld (Proxima Centauri c) has standard biospheric density.";
	} elseif ($rollDensity >= 22 && $rollDensity <= 25) {
		$returnArray[0] = 6;
		$modifier+=3;
		$returnArray[2] = "<em>Abundant Biosphere Density - </em>Life is everywhere and everywhere it is diverse. Even the most barren regions have at least microscopic life, and there are creatures adapted to every conceivable niche. Earth, with microbes living in volcanic vents and where many cave complexes contain species found only in those caves, is the prime example of a world with abundant life.";
	} elseif ($rollDensity >= 26) {
		$returnArray[0] = 7;
		$modifier+=5;
		$returnArray[2] = "<em>Very Abundant Biosphere Density - </em>The world teems with life. Even the most hostile areas contain complex ecosystems with advanced life forms. There are few, if any, ‘barren’ areas; the deserts and ice caps support a host of species easily visible to even the most unaware observer. Lissonia (the Lissonian homeworld), is the classic example of this sort of world.";
	}
	$rollComplexity = mt_rand(1,20)+$modifier;
	if ($rollComplexity <= 5) {
		$returnArray[1] = 1;
		$returnArray[3] = "<em>Very Simple Biosphere Complexity - </em>Life is either purely microscopic or extremely rudimentary multicellular. Algal mats would represent the pinnacle of life. Photosynthesis or a similar process of chemical energy production exists but life is limited to drifting plankton.";
	} elseif ($rollComplexity >= 6 && $rollComplexity <= 10) {
		$returnArray[1] = 2;
		$returnArray[3] = "<em>Simple Biosphere Complexity - </em>Life is either purely microscopic or extremely rudimentary multicellular. Sponges or hydrae would represent the pinnacle of life. Photosynthesis or a similar process of chemical energy production exists but life is limited to mats of algae or simple mosses.";
		$rollClassification = mt_rand(1,6)+mt_rand(1,6);
	} elseif ($rollComplexity >= 11 && $rollComplexity <= 15) {
		$returnArray[1] = 3;
		$returnArray[3] = "<em>Basic Biosphere Complexity - </em>Multicellular life is common but not advanced. Softbodied invertebrates with very basic internal structures exist; starfish are a good example. Plants are multicellular but there are no trees or flowering plants. There are no symbiotic relations (though there are basic parasitic ones) and no complex adaptations such as mimicry or poison.";
	} elseif ($rollComplexity >= 16 && $rollComplexity <= 18) {
		$returnArray[1] = 4;
		$returnArray[3] = "<em>Moderate Biosphere Complexity - </em>Life is diverse and somewhat complex. Creatures with well-developed internal structures exist. Sexual reproduction is commonplace. Behaviour is becoming more developed; schools, flocks, and herds may exist. Simple symbiosis exists, as do such adaptations as poisons and colour mimicry. More advanced behaviours, such as childrearing, web-spinning or hive insects, have not appeared. Trees appear, though fruit or flowers are not yet present.";
	} elseif ($rollComplexity >= 19 && $rollComplexity <= 21) {
		$returnArray[1] = 5;
		$returnArray[3] = "<em>Advanced Biosphere Complexity - </em>There is a great diversity of life. Creatures develop adaptations to exist in a wide range of specialised niches, and complex developments ranging from nest building to shape mimicry are common place. Instinctive behaviours now cover a large range of actions, with complex social systems and community roles appearing in the most advanced social animals. Complex interactions between plants and animals exist, with symbiotic reproduction via fruits or flowers becoming dominant and effective.";
	} elseif ($rollComplexity >= 22 && $rollComplexity <= 25) {
		$returnArray[1] = 6;
		$returnArray[3] = "<em>Very Advanced Biosphere Complexity - </em>Creatures capable of complex learning and altering their behaviours based on past experiences exist. Extremely complex chains of symbiosis are common. There are very specialised adaptations. Species may be able to use instinctual magical or psionic abilities.";
	} elseif ($rollComplexity >= 26) {
		$returnArray[1] = 7;
		$returnArray[3] = "<em><strong>Native Intelligence</strong> - </em> The world sports a sentient life form or, possibly, more than one.";
	}
		
	//biosphere density key: 1 = None, 2 = Very Scarce, 3 = Scarce, 4 = Infrequent, 5 = Standard, 6 = Abundant, 7 = Very Abundant
	//biosphere complexity key: 1 = very simple, 2 = simple, 3 = basic, 4 = moderate, 5 = advanced, 6 = very advanced, 7 = native intelligence
	return $returnArray;
}

function genPlanetPopulation($biosphereDensity, $biosphereComplexity, $atmosphere, $zone, $hydrosphere, $volcanism) {
	$modifier = 0;
	$returnArray = array(); //0 = key, 1 = text
	//key: 1 = very low, 2 = low, 3 = moderate, 4 = high, 5 = very high, 6 = extremely high
	switch ($biosphereDensity) {
		case "1":
			$modifier-=8;
			break;
		case "2":
			$modifier-=6;
			break;
		case "3":
			$modifier-=2;
			break;
		case "4":
			break;
		case "5":
			break;
		case "6":
			$modifier+=4;
			break;
		case "7":
			$modifier+=4;
			break;
	}
	switch ($biosphereComplexity) {
		case "1":
			$modifier-=6;
			break;
		case "2":
			$modifier-=6;
			break;
		case "3":
			$modifier-=3;
			break;
		case "4":
			break;
		case "5":
			$modifier+=2;
			break;
		case "6":
			$modifier+=4;
			break;
		case "7":
			$modifier+=6;
			break;
	}
	switch ($atmosphere) {
		//$atmosphereComposition[0] key: 1 = corrosive, 2 = poisonous, 3 = inert, 4 = breathable, 5 = breathable(tainted), 6 = variable
		case "1":
			$modifier-=4;
			break;
		case "2":
			$modifier-=3;
			break;
		case "3":
			$modifier-=2;
			break;
		case "4":
			$modifier+=2;
			break;
		case "5":
			$modifier-=1;
			break;
	}
	switch ($zone) {
		case "1":
			$modifier-=4;
			break;
		case "2":
			$modifier+=2;
			break;
		case "3":
			$modifier-=2;
			break;
	}
	if ($hydrosphere == 6 || $hydrosphere == 7) {
		$modifier+=2;
	}
	if ($volcanism == 5) {
		$modifier-=4;
	}
	$roll = mt_rand(1,10)+mt_rand(1,10)+$modifier;
	if ($roll <= 5) {
		$returnArray[0] = 1;
		$returnArray[1] = mt_rand(1,100)." thousand sentients"; //very low
	} elseif ($roll >= 6 && $roll <= 9) {
		$returnArray[0] = 2;
		$returnArray[1] = mt_rand(1,10)." million sentients"; //low
	} elseif ($roll >= 10 && $roll <= 15) {
		$returnArray[0] = 3;
		$returnArray[1] = mt_rand(1,100)." million sentients"; //moderate
	} elseif ($roll >= 16 && $roll <= 19) {
		$returnArray[0] = 4;
		$returnArray[1] = mt_rand(1,10)." hundred million sentients"; //high
	} elseif ($roll >= 20 && $roll <= 24) {
		$returnArray[0] = 5;
		$returnArray[1] = mt_rand(1,10)." billion sentients"; //very high
	} elseif ($roll >= 25) {
		$returnArray[0] = 6;
		$returnArray[1] = (mt_rand(1,10)+4)." billion sentients"; //extremely high
	}
	return $returnArray;
}

function genPlanetTechnology($population, $gravity, $atmosphereComposition, $atmosphereDensity, $volcanism, $climate, $biosphere) {
	$modifier = 0;
	$returnArray = array();
	switch ($population) {
		case "1":
			$modifier-=2;
			break;
		case "2":
			$modifier-=1;
			break;
		case "3":
			break;
		case "4":
			$modifier+=2;
			break;
		case "5":
			$modifier+=4;
			break;
		case "6":
			$modifier+=5;
			break;
	}
	if ($gravity == 7 || $atmosphereComposition == 1 || $atmosphereDensity == 1 || $atmosphereDensity == 7 || $volcanism == 5 || $climate == "Hot" || $climate == "Cold" || $biosphere == "1") {
		$modifier+=4;
	}
	$roll = mt_rand(1,20)+$modifier;
	if ($roll == "1") {
		$returnArray[0] = 1;
		$returnArray[1] = "Stone Age - The native intelligence here has mastered the use of muscle and animal power, but nothing beyond that.";
	} elseif ($roll >= 2 && $roll <= 3) {
		$returnArray[0] = 2;
		$returnArray[1] = "Bronze Age - The native intelligence here has reached the level of early metalworking and has learned the science of agriculture.";
	} elseif ($roll >= 4 && $roll <= 5) {
		$returnArray[0] = 3;
		$returnArray[1] = "Iron Age - The native intelligence here has developed advanced metalworking and is starting to form large cities.";
	} elseif ($roll >= 6 && $roll <= 7) {
		$returnArray[0] = 4;
		$returnArray[1] = "Renaissance - The native intelligence here has begun to develop advanced social and economic systems, printing, and a diverse array of thought strategies.";
	} elseif ($roll >= 8 && $roll <= 9) {
		$returnArray[0] = 5;
		$returnArray[1] = "Steam Age - The native intelligence has begun on the path to the industrial revolution, utilizing steam power to drive an increasingly diverse array of machinery.";
	} elseif ($roll >= 10 && $roll <= 12) {
		$returnArray[0] = 6;
		$returnArray[1] = "Oil Age - Increasing use of fossil fuels has allowed this native intelligence to develop advanced industry, mechanized air travel, and primitive space flight.";
	} elseif ($roll >= 13 && $roll <= 15) {
		$returnArray[0] = 7;
		$returnArray[1] = "Fusion Age - Finally moving beyond dependency on fossil fuels has allowed this native intelligence to develop orbital industries and in-system spaceflight, along with possibly early interstellar travel or Flux Space use.";
	} elseif ($roll >= 16 && $roll <= 19) {
		$returnArray[0] = 8;
		$returnArray[1] = "Standard Interstellar - This native intelligence is on-par with most interstellar powers.  It has some form of FTL travel, and may or may not have artifical gravity.";
	} elseif ($roll >= 20) {
		$returnArray[0] = 9;
		$returnArray[1] = "Advanced Interstellar - This native intelligence is on-par with the more advanced intestellar powers such as the Chrysoari.  It has some form of FTL travel, and most likely has artificial gravity.  It most likely has some form of directed-energy weaponry.";
	}
	return $returnArray;
}

function genQuirk($type, $force = FALSE) {
	$returnText="";
	if ($force == TRUE) {
		$rand = 1;
	} else {
		$rand = mt_rand(1,100);
	}
	switch ($type) {
		case "sentient":
			if ($rand >= 81) {
				$returnText = "No Quirk";
				break;
			}
			$roll = mt_rand(1,14);
			switch ($roll) {
				case "1":
					$returnText = "<em>Adaptive - </em>The life form can quickly adapt to its surroundings through natural means or sheer force of will to survive.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  This often comes in the form of dense cellular tissues or advanced organelles designed to adapt to a constantly shifting environment.";
					break;
				case "2":
					$returnText = "<em>Resilient - </em>The life form is decidedly difficult to kill or destroy.  Through cellular regeneration or a powerful immune system, the organism gauns numerous benefits.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  Additionally, it regenerates 1d6 hit points per minute.  In the case of organisms too small to actually have hit points, they should be extremely difficult to kill with anything but the most powerful effects.";
					break;
				case "3":
					$returnText = "<em>Naturally Magic - </em>This life form automatically starts out with the Magery Training feat for one of the following schools: Elementalism, Shamanism, Spirit Binding, or Theurgy.";
					break;
				case "4":
					$returnText = "<em>Void-Traveller - </em>The life form has the strange and mysterious ability to survive unaided in the complete vacuum of space, and even in Flux Space!  Whether it is from solar-fuelled survival-based organs or some new and enigmatic state of hibernation, the organism can withstand the deadly onslaughts of the Void.  Strangely enough this does not protect the organism from any other form of damage, merely the effects of hypoxia and cold-related damage.";
					break;
				case "5":
					if (mt_rand(1,100) >= 51) {
						$returnText = "<em>Psionic-Immune - </em>This life form is immune to psionics, and cannot become psionically-talented.  Creatures with this immunity usually have a drastically different way of thinking, both metaphorically speaking and their actual neurochemistry.  This could either be naturally-occuring, or possibly induced via genetic manipulation.";
					} else {
						$returnText = "<em>Magically-Incapable - </em>This life form lacks the genetic capability for innate magical talent.  This could either be naturally-occuring, or possibly induced via genetic manipulation.";
					}
					break;
				case "6":
					$returnText = "<em>Naturally Telepathic - </em>This life form starts play trained in the Psionics skill and with the Perfect Telepathy talent as a bonus talent.  Additionally, it gains access to Psionic Character Advancement.";
					break;
				case "7":
					$returnText = "<em>Fearless/Curious - </em>The life form has either no sense of danger at all or is insanely curious about other things.  All fear-based attacks against its Will defense automatically fail. This also means that the organism is much more likely to try and make contact with explorers, even if it means exposing them to dangerous situations.  This is often the case with any sort of animal evolved in a predator-less environment, or at the top of its food chain.";
					break;
				case "8":
					$returnText = "<em>Symbiotic - </em>The race is actually a combination of two races, the primary form rolled initially, and a symbiote which is rolled separately.";
					break;
				case "9":
					$returnText = "<em>Large Size - </em>This life form is Large sized instead of Medium sized.  In the event that this is rolled multiple times, each time it is rolled increases the size by another step (Large->Huge->Gargantuan->Colossal->Colossal(Frigate)->Colossal(Cruiser)->Colossal(Station))";
					break;
				case "10":
					$returnText = "<em>Small Size - </em>This life form is Small sized instead of Medium sized.  In the event that this is rolled multiple times, each time it is rolled decreases the size by another step (Small->Tiny->Diminutive->Fine)";
					break;
				case "11":
					$returnText = "<em>Naturally Combatant - </em>The life form has grown up in a culture that revels in or forces its members to use their natural appendages to battle or hunt, making them naturally powerful in close combat.  They likely  have claws, fangs, horns or some other natural weaponry in addition to a way to survive blows inflicted upon them.  Due to these evolutionary benefits, the organism gains the following bonuses: Natural Weaponry (claws, fangs, horns or spikes that count as natural weapons which inflict 1d6 damage), Natural Protection (scales, hide or fat that grants natural DR equal to their Constitution modifier), and Battle Instincts (a bonus to their Unarmed Attack and natural weapon attack equal to their Wisdom modifier)";
					break;
				case "12":
					if ($returnText = "") {
						$returnText = genQuirk("sentient", TRUE)."<br />".genQuirk("sentient", TRUE);
						
					} else {
						$returnText .= "<br />".genQuirk("sentient", TRUE)."<br />".genQuirk("sentient", TRUE);
					}
					break;
				case "13":
					$returnText = "<em>Hyper-Reproductive - </em> The life form reproduces at a staggering rate, covering planetoids with its offspring in a few generations if left unchecked. This could be the result of a massive birth rate, longevity or simple mitosis-rate. Depending on the type of organism and its normal average reproductive cycle, this could be a threat to the life-support systems of enclosed vessels. The Games Master has final say as to what the new rate should be, but it is a good point of order that the smaller the organism is, the faster it will reproduce.";
					break;
				case "14":
					$returnText = "<em>Toxic/Venomous - </em> The life form is somehow able to produce or secrete a substance – intentionally or otherwise – that is universally toxic or venomous. Anyone that comes into contact with the organism will need to make a DC ".(10+mt_rand(1,10))." Constitution check or suffer 1D6 points of Constitution damage instantly, testing again every minute for 1d6 minutes after contact is broken. Even those species that are naturally resistant to such things will need to make the check, albeit with a +5 bonus. Unlike the natural dangers of some animals or plants, this is a powerful toxin or venom that seems out of place for the organism and might have evolved as a mutation.";
					break;
			}
			break;
		case "complex":
			if ($rand >= 40) {
				$returnText = "No Quirk";
				break;
			}
			$roll = mt_rand(1,10);
			switch ($roll) {
				case "1":
					$returnText = "<em>Adaptive - </em>The life form can quickly adapt to its surroundings through natural means or sheer force of will to survive.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  This often comes in the form of dense cellular tissues or advanced organelles designed to adapt to a constantly shifting environment.";
					break;
				case "2":
					$returnText = "<em>Resilient - </em>The life form is decidedly difficult to kill or destroy.  Through cellular regeneration or a powerful immune system, the organism gauns numerous benefits.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  Additionally, it regenerates 1d6 hit points per minute.  In the case of organisms too small to actually have hit points, they should be extremely difficult to kill with anything but the most powerful effects.";
					break;
				case "3":
					$returnText = "<em>Hyper-Reproductive - </em> The life form reproduces at a staggering rate, covering planetoids with its offspring in a few generations if left unchecked. This could be the result of a massive birth rate, longevity or simple mitosis-rate. Depending on the type of organism and its normal average reproductive cycle, this could be a threat to the life-support systems of enclosed vessels. The Games Master has final say as to what the new rate should be, but it is a good point of order that the smaller the organism is, the faster it will reproduce.";
					break;
				case "4":
					$returnText = "<em>Void-Traveller - </em>The life form has the strange and mysterious ability to survive unaided in the complete vacuum of space, and even in Flux Space!  Whether it is from solar-fuelled survival-based organs or some new and enigmatic state of hibernation, the organism can withstand the deadly onslaughts of the Void.  Strangely enough this does not protect the organism from any other form of damage, merely the effects of hypoxia and cold-related damage.";
					break;
				case "5":
					$returnText = "<em>Toxic/Venomous - </em> The life form is somehow able to produce or secrete a substance – intentionally or otherwise – that is universally toxic or venomous. Anyone that comes into contact with the organism will need to make a DC ".(10+mt_rand(1,10))." Constitution check or suffer 1D6 points of Constitution damage instantly, testing again every minute for 1d6 minutes after contact is broken. Even those species that are naturally resistant to such things will need to make the check, albeit with a +5 bonus. Unlike the natural dangers of some animals or plants, this is a powerful toxin or venom that seems out of place for the organism and might have evolved as a mutation.";
					break;
				case "6":
					if ($returnText = "") {
						$returnText = genQuirk("complex", TRUE)."<br />".genQuirk("complex", TRUE);
						
					} else {
						$returnText .= "<br />".genQuirk("complex", TRUE)."<br />".genQuirk("complex", TRUE);
					}
					break;
				case "7":
					$returnText = "<em>Fearless/Curious - </em>The life form has either no sense of danger at all or is insanely curious about other things.  All fear-based attacks against its Will defense automatically fail. This also means that the organism is much more likely to try and make contact with explorers, even if it means exposing them to dangerous situations.  This is often the case with any sort of animal evolved in a predator-less environment, or at the top of its food chain.";
					break;
				case "8":
					$returnText = "<em>Carrier/Host - </em>The life form is actually nothing special at all, other than an evolved organism designed specifically to carry another, smaller organism. This is often the case with some breeds of worms that travel unhindered in the gut of a large animal until it is slain or dies, emerging then to seek out new animals to infect. There is a 50% chance that the carried organism is either Basic or Simple Life, and the Games Master should roll all of its traits and classifications as normal.";
					if (mt_rand(1,100) >= 50) {
						//basic
						$returnText .= "<br />Carried Organism Classification: ".genClassification("basic")."<br />Carried Organism Quirks: ".genQuirk("basic");
					} else {
						//simple
						$returnText .= "<br />Carried Organism Classification: ".genClassification("simple")."<br />Carried Organism Quirks: ".genQuirk("simple");
					}
					break;
				case "9":
					$returnText = "<em>Large Size - </em>This life form is Large sized instead of Medium sized.  In the event that this is rolled multiple times, each time it is rolled increases the size by another step (Large->Huge->Gargantuan->Colossal->Colossal(Frigate)->Colossal(Cruiser)->Colossal(Station))";
					break;
				case "10":
					$returnText = "<em>Small Size - </em>This life form is Small sized instead of Medium sized.  In the event that this is rolled multiple times, each time it is rolled decreases the size by another step (Small->Tiny->Diminutive->Fine)";
					break;
			}
			break;
		case "simple":
			if ($rand >= 20) {
				$returnText = "No Quirk";
				break;
			}
			$roll = mt_rand(1,6);
			switch ($roll) {
				case "1":
					$returnText = "<em>Adaptive - </em>The life form can quickly adapt to its surroundings through natural means or sheer force of will to survive.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  This often comes in the form of dense cellular tissues or advanced organelles designed to adapt to a constantly shifting environment.";
					break;
				case "2":
					$returnText = "<em>Resilient - </em>The life form is decidedly difficult to kill or destroy.  Through cellular regeneration or a powerful immune system, the organism gauns numerous benefits.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  Additionally, it regenerates 1d6 hit points per minute.  In the case of organisms too small to actually have hit points, they should be extremely difficult to kill with anything but the most powerful effects.";
					break;
				case "3":
					$returnText = "<em>Hyper-Reproductive - </em> The life form reproduces at a staggering rate, covering planetoids with its offspring in a few generations if left unchecked. This could be the result of a massive birth rate, longevity or simple mitosis-rate. Depending on the type of organism and its normal average reproductive cycle, this could be a threat to the life-support systems of enclosed vessels. The Games Master has final say as to what the new rate should be, but it is a good point of order that the smaller the organism is, the faster it will reproduce.";
					break;
				case "4":
					$returnText = "<em>Void-Traveller - </em>The life form has the strange and mysterious ability to survive unaided in the complete vacuum of space, and even in Flux Space!  Whether it is from solar-fuelled survival-based organs or some new and enigmatic state of hibernation, the organism can withstand the deadly onslaughts of the Void.  Strangely enough this does not protect the organism from any other form of damage, merely the effects of hypoxia and cold-related damage.";
					break;
				case "5":
					$returnText = "<em>Toxic/Venomous - </em> The life form is somehow able to produce or secrete a substance – intentionally or otherwise – that is universally toxic or venomous. Anyone that comes into contact with the organism will need to make a DC ".(10+mt_rand(1,10))." Constitution check or suffer 1D6 points of Constitution damage instantly, testing again every minute for 1d6 minutes after contact is broken. Even those species that are naturally resistant to such things will need to make the check, albeit with a +5 bonus. Unlike the natural dangers of some animals or plants, this is a powerful toxin or venom that seems out of place for the organism and might have evolved as a mutation.";
					break;
				case "6":
					if ($returnText = "") {
						$returnText = genQuirk("simple", TRUE)."<br />".genQuirk("simple", TRUE);
						
					} else {
						$returnText .= "<br />".genQuirk("simple", TRUE)."<br />".genQuirk("simple", TRUE);
					}
					break;
			}
			break;
		case "basic":
			if ($rand >= 10) {
				$returnText = "No Quirk";
				break;
			}
			$roll = mt_rand(1,4);
			switch ($roll) {
				case "1":
					$returnText = "<em>Adaptive - </em>The life form can quickly adapt to its surroundings through natural means or sheer force of will to survive.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  This often comes in the form of dense cellular tissues or advanced organelles designed to adapt to a constantly shifting environment.";
					break;
				case "2":
					$returnText = "<em>Resilient - </em>The life form is decidedly difficult to kill or destroy.  Through cellular regeneration or a powerful immune system, the organism gauns numerous benefits.  The organism is considered to have a +5 bonus to its Fortitude Defense, a DR of 5 against all environmental damage, and a +3 racial bonus to Climb, Survival, and Swim checks.  Additionally, it regenerates 1d6 hit points per minute.  In the case of organisms too small to actually have hit points, they should be extremely difficult to kill with anything but the most powerful effects.";
					break;
				case "3":
					$returnText = "<em>Hyper-Reproductive - </em> The life form reproduces at a staggering rate, covering planetoids with its offspring in a few generations if left unchecked. This could be the result of a massive birth rate, longevity or simple mitosis-rate. Depending on the type of organism and its normal average reproductive cycle, this could be a threat to the life-support systems of enclosed vessels. The Games Master has final say as to what the new rate should be, but it is a good point of order that the smaller the organism is, the faster it will reproduce.";
					break;
				case "4":
					$returnText = "<em>Void-Traveller - </em>The life form has the strange and mysterious ability to survive unaided in the complete vacuum of space, and even in Flux Space!  Whether it is from solar-fuelled survival-based organs or some new and enigmatic state of hibernation, the organism can withstand the deadly onslaughts of the Void.  Strangely enough this does not protect the organism from any other form of damage, merely the effects of hypoxia and cold-related damage.";
					break;
			}
			break;
	}
	return $returnText;
}

function genClassification ($type) {
	$returnText = "";
	switch ($type) {
		case "basic":
			$rollClassification = mt_rand(1,6)+mt_rand(1,6);
			if ($rollClassification == 2) {
				$returnText = "<em>Lethal - </em>Lethal life forms are examples of basic life, when removed from their normal ecosystems, will surely cause the deaths of other organisms. Deadly bacteria or viruses that can infect hosts with contagions and slime moulds that dissolve flesh and spore are all examples of lethal life forms. Handling and transporting samples of these organisms requires the highest level of protection and safety protocols – sometimes even the use of molecularly fused iso-cubes.<br>Any lethal-class basic life form that comes into contact with another life form will automatically infect it with any number of horrible effects. Constitution checks are only good to stave off the effects of the infections/contagions, and unless a suitable cure can be found in time, death is certain.";
			} elseif ($rollClassification >=3 && $rollClassification <= 5) {
				$returnText = "<em>Dangerous - </em>Dangerous life forms are those that must be handled and stored carefully, as they can cause significant bodily and ecological damage if allowed to. Rapidly growing oxyphilic (consumers of oxygen), algae and organicallyfuelled bacteria are just some of these dangerous finds. Special care and safety measures are required to ensure that no harm comes to or from dangerous-level samples, but should contamination occur the situation can often be handled well enough to avoid irreparable damage.<br /> Any dangerous-class basic life form that is left to its own natural devices will cause damage to anything susceptible to its particular style of danger. A metal-eating bacterium should never be allowed to touch the ship’s hull, and for a flesh-eating virus – environmental suits are a must. Anything affected by the organism will suffer one hit point of damage (no reductions) to the object/character each minute. Although exposure could theoretically cause death, death can be averted – which is the main difference between the dangerous and lethal classes of Basic life.";
			} elseif ($rollClassification >=6 && $rollClassification <= 8) {
				$returnText = "<em>Commonplace - </em>Commonplace life forms are exactly as the name implies – common. While these life forms could be of a previously undiscovered species or sample, thereby worthwhile if only for cataloguing, they do not have any special properties that researchers will find ultimately useful or worth studying for long. They are
a good find, but not terribly distinct or otherwise noteworthy.";
			} elseif ($rollClassification >=9 && $rollClassification <= 10) {
				$returnText = "<em>Interesting - </em>Interesting life forms are what most Rim explorers hope to come across in their travels, as everything else comes with a great deal of stress and circumstance. These examples of how evolution changes from place to place are what researchers jokingly call ‘lab icebreakers,’ as they always bring about the strangest of conversations when being studied. Examples of interesting-class life forms may include a virus that strangely only reproduces in dead cells in order to do absolutely nothing to the host body, bacteria that glows when it gets to a certain temperature or perhaps a sub-anima that behaves very strangely when spoken to.<br />These life forms are not dangerous, nor are they groundbreaking in any way. They tend to have odd quirks that are discovered in the first hours of study and seemingly have no effect on them or their surroundings. While someone could theoretically find a use for their quirky nature, most of the organisms in this class are truly just entertaining on a scientific level.";			
			} elseif ($rollClassification ==11) {
				$returnText = "Useful life forms are examples of an organism that performs some function that is readily apparent and useful to the galaxy as a whole. Oxygen-filtering algae or infection-hunting bacteria are good examples, and once they are put through a series of tests to make sure they are not harmful, these life forms can be put to good use. They are not only good for the cataloguing of new species, but also have several avenues of investment that could fund further missions.<br />It takes a Knowledge (Life Sciences) skill check (DC 20) to decipher exactly what sort of useful ability the basic life form offers, with further checks resulting in the best ways to maximise it. When a Games Master creates this class of life form he must choose what sort of use it has, which should not be too wondrous.";			
			} else {
				$returnText = "Breakthrough life forms are the key to some strange and previously unknown technique or science that, once unlocked, will put the exploration mission’s name down in scientific history. Slime mould that simulates psionic ability, a virus that only infects cancerous tissue or bacteria that generates engine-grade energies; the discovery of these organisms almost guarantees a fortune in profits and further funding of future trips for any Rim explorer. A breakthrough-class life form might change the galaxy, and means a fortune for the team that discovers it.<br />It takes a Knowledge (Life Sciences) skill check (DC 30) to decipher exactly what sort of scientific breakthrough the basic life form has to offer, with any further checks resulting in the best ways to stimulate its unique ability. When a Games Master creates this class of life form he can truly imagine whatever he wants– the Rim has far too much to offer to be limited by conventional thinking.";			
			}
			break;
		case "simple":
			$rollClassification = mt_rand(1,6)+mt_rand(1,6);
			if ($rollClassification == 2) {
				$returnArray[4] = "<em>Dangerous - </em>Dangerous life forms of the simple variety are often just possible predatory species that are capable of causing some kind bodily harm to crew or the vessel. Toxic ferns, virus-laden leeches and paralytic anemones are good examples of these dangerous species. Dangerous life forms must be contained properly and studied under high security due to the possibility of someone becoming injured. Anything that has a poisonous or toxifying evolution falls into this category automatically.<br />Any dangerous-class simple life form that comes into a situation that warrants it will react instinctively and bring its dangerous elements into play. It could be a poisonous squid being handled by a clumsy technician or hull-weakening lichen allowed to overgrow its container. Whatever the effect or the cause, the Games Master has the final say as to what sort of affect an organism will have.";
			} elseif ($rollClassification >=3 && $rollClassification <= 5) {
				$returnText = "<em>Commonplace - </em>Commonplace simple life forms are treated exactly as commonplace-class basic life forms. They are nothing special, but are still worthwhile to collect for specimen catalogues.";
			} elseif ($rollClassification >=6 && $rollClassification <= 8) {
				$returnText = "<em>Interesting - </em>Interesting life forms tend to raise many questions about a planetoid’s chain of evolution, as they have one or a collection of strange quirks that do not seem to have any role in the organism’s life at all. From flatworms that reproduce only to devour their offspring and clams that shed their shells only to grow new ones of the exact same size, to a grass that is brightly coloured and patterned, interesting-class life forms are mysteries to researchers. Unlike interesting-class basic life forms, the oddities are no longer merely amusing – they are puzzling.<br />These life forms make research scientists wonder if they missed something about a species or planetoid that would have caused such an odd evolution. Solving the mysteries of these life forms can easily become the driving goal of a lab researcher with nothing better to do on the long trip back from the Rim.";
			} elseif ($rollClassification >=9 && $rollClassification <= 10) {
				$returnText = "<em>Useful - </em>Useful life forms at the simple level are examples of organisms that can be used to function or aid in some form of action or study. This could include a plant of foodstuff quality that grows with almost no water to help arid species, or maybe a flatworm immune to radiation that could be studied in anti-rad medical research.<br />It takes a Knowledge (Life Sciences) skill check (DC 25) to decipher exactly what sort of useful ability the life form offers, with further checks resulting in the best ways to maximise it. When a Games Master creates this class of life form he must choose what sort of use it has, which should not be too wondrous.";			
			} elseif ($rollClassification ==11) {
				$returnText = "<em>Breakthrough - </em>Breakthrough life forms of the simple level are very rare, as they are often caught in-between their level of usefulness. Too advanced to affect anything on a cellular scale, but too simple to be of major use in the larger galaxy, breakthrough-class molluscs or flatworms are not found often. A species of leech that siphons toxic chemicals in the blood could be a huge boon in the medical industry, while any sort of plant that actually emits massive amounts of oxygen would be fantastic for atmosphere-scrubbing gardens on space stations all across the galaxy.<br />It takes a Knowledge (Life Sciences) skill check (DC 35) to decipher exactly what sort of scientific breakthrough the life form has to offer, with any further checks resulting in the best ways to stimulate its unique ability. When a Games Master creates this class of life form he can truly imagine whatever he wants– the Rim has far too much to offer to be limited by conventional thinking.";
			} else {
				$returnText = "<em>Intelligent - </em>Intelligent-classed life forms actually belong to a subclass attached to any of the other classifications used by Rim explorers. ‘Intelligent’ is not to be mistaken for ‘Sentient,’ as researchers are very specific about throwing about that term. A breed of marine octopus that learns quickly from its mistakes, shows problem-solving skills and can obviously be trained to perform certain functions would be considered intelligent-class, while the same type of animal that choose whether to do all of the above could be classified as Sentient.<br />Whatever the nomenclature attached to this class of life form, such a creature can be a major find in the Void. It is always a boon for scientists to find organisms capable of problem-solving and the like. These finds breed long studies of what these species are capable of, and how such behaviour came about. An Intelligent organism must also be watched far more closely than a common biological sample. If it views its captivity a problem, and has problem-solving capabilities, it is only a matter of time after its capture before it seeks ways to escape. For some samples this might just be the destruction of the container it is in, for others it could be far more sinister – costing mission team lives in the process.<br />For game purposes, anything that is Intelligent-classed should be given a rudimentary Intelligence Ability score of 1d3 (<strong>".mt_rand(1,3)." for this creature)</strong>. This may not seem like much, but when dealing with a colony of snails that can dissolve flesh and open doors…three Intelligence will seem like a lot!";
				$repeat == TRUE;
				$rollAgain = 0;
				while ($repeat == TRUE) {
					$rollAgain = mt_rand(1,6)+mt_rand(1,6);
					if ($rollAgain != 12) {
						$repeat == FALSE;
					}
				}
				if ($rollAgain == 2) {
					$returnText.= "<br /><em>Dangerous - </em>Dangerous life forms of the simple variety are often just possible predatory species that are capable of causing some kind bodily harm to crew or the vessel. Toxic ferns, virus-laden leeches and paralytic anemones are good examples of these dangerous species. Dangerous life forms must be contained properly and studied under high security due to the possibility of someone becoming injured. Anything that has a poisonous or toxifying evolution falls into this category automatically.<br />Any dangerous-class simple life form that comes into a situation that warrants it will react instinctively and bring its dangerous elements into play. It could be a poisonous squid being handled by a clumsy technician or hull-weakening lichen allowed to overgrow its container. Whatever the effect or the cause, the Games Master has the final say as to what sort of affect an organism will have.";
				} elseif ($rollAgain >=3 && $rollAgain <= 5) {
					$returnText.= "<br /><em>Commonplace - </em>Commonplace simple life forms are treated exactly as commonplace-class basic life forms. They are nothing special, but are still worthwhile to collect for specimen catalogues.";
				} elseif ($rollAgain >=6 && $rollAgain <= 8) {
					$returnText.= "<br /><em>Interesting - </em>Interesting life forms tend to raise many questions about a planetoid’s chain of evolution, as they have one or a collection of strange quirks that do not seem to have any role in the organism’s life at all. From flatworms that reproduce only to devour their offspring and clams that shed their shells only to grow new ones of the exact same size, to a grass that is brightly coloured and patterned, interesting-class life forms are mysteries to researchers. Unlike interesting-class basic life forms, the oddities are no longer merely amusing – they are puzzling.<br />These life forms make research scientists wonder if they missed something about a species or planetoid that would have caused such an odd evolution. Solving the mysteries of these life forms can easily become the driving goal of a lab researcher with nothing better to do on the long trip back from the Rim.";
				} elseif ($rollAgain >=9 && $rollAgain <= 10) {
					$returnText.= "<em>Useful - </em>Useful life forms at the simple level are examples of organisms that can be used to function or aid in some form of action or study. This could include a plant of foodstuff quality that grows with almost no water to help arid species, or maybe a flatworm immune to radiation that could be studied in anti-rad medical research.<br />It takes a Knowledge (Life Sciences) skill check (DC 25) to decipher exactly what sort of useful ability the life form offers, with further checks resulting in the best ways to maximise it. When a Games Master creates this class of life form he must choose what sort of use it has, which should not be too wondrous.";			
				} elseif ($rollAgain ==11) {
					$returnText.= "<em>Breakthrough - </em>Breakthrough life forms of the simple level are very rare, as they are often caught in-between their level of usefulness. Too advanced to affect anything on a cellular scale, but too simple to be of major use in the larger galaxy, breakthrough-class molluscs or flatworms are not found often. A species of leech that siphons toxic chemicals in the blood could be a huge boon in the medical industry, while any sort of plant that actually emits massive amounts of oxygen would be fantastic for atmosphere-scrubbing gardens on space stations all across the galaxy.<br />It takes a Knowledge (Life Sciences) skill check (DC 35) to decipher exactly what sort of scientific breakthrough the life form has to offer, with any further checks resulting in the best ways to stimulate its unique ability. When a Games Master creates this class of life form he can truly imagine whatever he wants– the Rim has far too much to offer to be limited by conventional thinking.";		
				}
			}
			break;
		case "complex":
			$rollClassification = mt_rand(1,6)+mt_rand(1,6);
			if ($rollClassification == 2) {
				$returnText = "<em>Dangerous - </em>Dangerous complex life forms have the capability of causing massive bodily harm in short order and are likely to be poisonous, toxic or otherwise deadly in a direct confrontation.";
			} elseif ($rollClassification >=3 && $rollClassification <= 6) {
				$returnText = "<em>Commonplace - </em>Commonplace complex life forms are nothing noteworthy, but are still worthwhile to collect for specimen catalogues. This grouping often includes most small prey animals.";
			} elseif ($rollClassification >=7 && $rollClassification <= 9) {
				$returnText = "<em>Social - </em>Social life forms are those who seem to be singularly interested in interacting with the explorers as much as the researchers want to study them. Either through an ignorant avoidance of outside threats, or simple curiosity, the life form wants to spend quality time with the exploration team crew. Although its inclusion is not unheard of, plant life is normally excluded from this classification altogether.<br>These life forms can be double-edged swords. Researchers can get as close as they like to the life form in order to study it, but always run the risk of the organism changing its behaviour rapidly – possibly turning from inquisitive to savage in a blinding flash of claws and teeth. Even the most attractive and ‘cute’ specimen from the Rim could be capable of anything, and it is best for researchers not to let down their guard.";
			} elseif ($rollClassification ==10) {
				$returnText = "<em>Useful - </em>Useful complex life forms are specimens that seem to offer some form of service or researchable facet to an exploration mission. It could be a bird that senses psionics in use or a fish whose meat is naturally anti-aging.<br>It takes a Knowledge (Life Sciences) skill check (DC 25) to decipher exactly what sort of useful ability the life form offers, with further checks resulting in the best ways to maximise it. When a Games Master creates this class of life form he must choose what sort of use it has, which should not be too wondrous.";	
			} elseif ($rollClassification ==11) {
				$returnText = "<em>Breakthrough - </em>Breakthrough complex life forms are specimens that could be tapped for a new aspect of previously unknown research or a leap in an existing one. From the mysterious chameleonic reptile that actually turns invisible to a cattle-like sloth that somehow weathers 250 degree heat, this classification contains a wide range of possibilities.<br>It takes a Knowledge (Life Sciences) skill check (DC 35) to decipher exactly what sort of scientific breakthrough the life form has to offer, with any further checks resulting in the best ways to stimulate its unique ability. When a Games Master creates this class of life form he can truly imagine whatever he wants– the Rim has far too much to offer to be limited by conventional thinking.";
			} else {
				$returnText = "Intelligent-classed complex life forms are capable of rudimentary communication between members of the same species, and show some true forms of learned behaviour as well as instincts. A ground-dwelling rat that builds protection for its community against a new threat that its species had not faced before and an spider that can open doors and windows to get at household pets both fall into this category.  This creature's intelligence is ".(mt_rand(1,4)).".";
				$repeat == TRUE;
				$rollAgain = 0;
				while ($repeat == TRUE) {
					$rollAgain = mt_rand(1,6)+mt_rand(1,6);
					if ($rollAgain != 12) {
						$repeat == FALSE;
					}
				}
				if ($rollAgain == 2) {
					$returnText.= "<em>Dangerous - </em>Dangerous complex life forms have the capability of causing massive bodily harm in short order and are likely to be poisonous, toxic or otherwise deadly in a direct confrontation.";
				} elseif ($rollAgain >=3 && $rollAgain <= 6) {
					$returnText.= "<em>Commonplace - </em>Commonplace complex life forms are nothing noteworthy, but are still worthwhile to collect for specimen catalogues. This grouping often includes most small prey animals.";
				} elseif ($rollAgain >=7 && $rollAgain <= 9) {
					$returnText.= "<em>Social - </em>Social life forms are those who seem to be singularly interested in interacting with the explorers as much as the researchers want to study them. Either through an ignorant avoidance of outside threats, or simple curiosity, the life form wants to spend quality time with the exploration team crew. Although its inclusion is not unheard of, plant life is normally excluded from this classification altogether.<br>These life forms can be double-edged swords. Researchers can get as close as they like to the life form in order to study it, but always run the risk of the organism changing its behaviour rapidly – possibly turning from inquisitive to savage in a blinding flash of claws and teeth. Even the most attractive and ‘cute’ specimen from the Rim could be capable of anything, and it is best for researchers not to let down their guard.";
				} elseif ($rollAgain ==10) {
					$returnText.= "<em>Useful - </em>Useful complex life forms are specimens that seem to offer some form of service or researchable facet to an exploration mission. It could be a bird that senses psionics in use or a fish whose meat is naturally anti-aging.<br>It takes a Knowledge (Life Sciences) skill check (DC 25) to decipher exactly what sort of useful ability the life form offers, with further checks resulting in the best ways to maximise it. When a Games Master creates this class of life form he must choose what sort of use it has, which should not be too wondrous.";				
				} elseif ($rollAgain ==11) {
					$returnText.= "<em>Breakthrough - </em>Breakthrough complex life forms are specimens that could be tapped for a new aspect of previously unknown research or a leap in an existing one. From the mysterious chameleonic reptile that actually turns invisible to a cattle-like sloth that somehow weathers 250 degree heat, this classification contains a wide range of possibilities.<br>It takes a Knowledge (Life Sciences) skill check (DC 35) to decipher exactly what sort of scientific breakthrough the life form has to offer, with any further checks resulting in the best ways to stimulate its unique ability. When a Games Master creates this class of life form he can truly imagine whatever he wants– the Rim has far too much to offer to be limited by conventional thinking.";		
				}
			}
			break;
	}
	return $returnText;
}
?>