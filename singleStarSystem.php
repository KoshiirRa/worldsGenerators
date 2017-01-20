<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
require_once('classes.php');
echo "<br />";
/*if (isset($_GET['starType'])) {
	$starType[0] = $_GET['starType'];
	$starType[1] = $_GET['starSize'];
} else {*/
	$starType = genStar();
//}

echo "<br />";
//var_dump($starType); //0 = Star Type, 1 = Star Size
$numPlanets = numPlanets($starType[0], $starType[1]);
echo $numPlanets." Planets<br /><br />";
if ($numPlanets > 0) {
	$count = 0;
	$gasGiants = 0; //track number of gas giants (needed for asteroid belt generation)
	$asteroids = FALSE;  //track whether or not there are asteroid belts
	$asteroidBelts = array(); //track number of asteroid belts (needed for asteroid belt generation)
	$planetArray = array(); //hold the text for each planet
	//generate the planets and sort them by zone
	$planets = genPlanetZones($starType[0], $numPlanets);
	//var_dump($planets);
	sort($planets);
	
	foreach($planets as $zone) {
		$count++;
		$stringHolder = "Planet ".$count."<ul>";
		
		//PLANET ZONE
		//$zone key: 1 = hot zone, 2 = habitable zone, 3 = cold zone
		switch($zone) {
			case "1":
				$stringHolder.="<li>Hot Zone</li>";
				break;
			case "2":
				$stringHolder.="<li>Habitable Zone</li>";
				break;
			case "3":
				$stringHolder.="<li>Cold Zone</li>";
				break;
		}
		
		//PLANET TYPE
		//$type key: 1 = gas giant, 2 = terrestrial, 3 = asteroid belt, 4 = icy
		$type = genPlanetType($zone);
		//echo "FOOBAR: ".$type[0];
		switch($type[0]) {
			case "1":
				$stringHolder.="<li><em>Gas Giant</em> - ".$type[1]."</li>";
				$gasGiants++;
				break;
			case "2":
				$stringHolder.="<li><em>Terrestrial Planet -</em> ".$type[1]."</li>";
				break;
			case "3":
				$stringHolder = "Asteroid Belt ".(count($asteroidBelts)+1);
				$numBelt = count($asteroidBelts)+1;
				
				array_push($asteroidBelts, $numBelt.",".($count-1));
				$asteroids = TRUE;
				break;
			case "4":
				$stringHolder.="<li><em>Icy Planet - </em>".$type[1]."</li>";
		}
		//abort the rest of the iteration if an asteroid belt
		if ($type[0] == "3") {
			//$stringHolder.="</ul>";
			array_push($planetArray, $stringHolder);
			continue;
		}

		//PLANET SIZE
		//$size[0] key: 1 = diminutive, 2 = fine, 3 = tiny, 4 = small, 5 = medium, 6 = large, 7 = huge, 8 = small gas giant, 9 = medium gas giant, 10 = huge gas giant, 11 = gargantuan gas giant, 12 = y-class brown dwarf
		//$size[1] is the size text
		$size = genPlanetSize($zone, $type[0]);
		$stringHolder.="<li>".$size[1]."</li>";
		
		//PLANET GRAVITY
		//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
		if ($size[0] <= 7) {
			$gravity = genGravity($size[0],$type);
		} else {
			$gravity[0] = 7;
			$gravity[1] = "Extreme Gas Giant Gravity (way more than 4.0 G)";
		}
		$stringHolder.="<li>".$gravity[1]."</li>";
		
		//PLANET ATMOSPHERIC DENSITY
		//$atmosphere[0] key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
		if ($size[0] <= 7) {
			$atmosphere = genAtmoDense($gravity[0], $zone);
			$stringHolder.="<li>".$atmosphere[1]."</li>";
		}
		
		//PLANET ATMOSPHERIC COMPOSITION
		//$atmosphereComposition[0] key: 1 = corrosive, 2 = poisonous, 3 = inert, 4 = breathable, 5 = breathable(tainted), 6 = variable
		if ($atmosphere[0]!=1 && $size[0] <= 7) {
			$atmosphereComposition = genAtmoComp($zone);
			$stringHolder.="<li>".$atmosphereComposition[1]."</li>";
		} else {
			$atmosphereComposition = array(0,0);
		}
		
		//PLANET GEOLOGY
		//$planetGeology[0] key: 1 = very flat, 2 = flat, 3 = stndard, 4 = rugged, 5 = very rugged
		if ($size[0] <= 7) {
			$planetGeology = genPlanetGeo($gravity[0], $atmosphere[0]);
			$stringHolder.="<li>".$planetGeology[1]."</li>";
		}
		
		//PLANET VOLCANISM
		//$planetVolcanism[0] key: 1 = dead, 2 = stable, 3 = active, 4 = very active, 5 = extreme
		if ($size[0] <= 7) {
			$planetVolcanism = genPlanetVolcanism($gravity[0], $planetGeology[0]);
			$stringHolder.="<li>".$planetVolcanism[1]."</li>";
		}
		
		//PLANET HYDROSPHERE
		//$planetHydrosphere key: 0 = type, 1 = fluff text, 2 = percentage
		if ($size[0] <= 7) {
			$planetHydrosphere = genPlanetHydrosphere($atmosphere[0], $zone, $planetVolcanism[0], $planetGeology[0]);
			$stringHolder.="<li>".$planetHydrosphere[1]."</li>";
		}
		
		//PLANET CLIMATE
		if ($size[0] <= 7 && $atmosphere[0] != 1 && $zone == 2) {
			$planetClimate = genPlanetClimate($atmosphere[0], $starType[0], $starType[1], $planetVolcanism[0], $planetHydrosphere[2], $size[0]);
			$stringHolder.="<li>".$planetClimate."</li>";
		} elseif ($zone == 1) {
			$planetClimate[0] = "Hot";
			$stringHolder.="<li>Hot Climate</li>";
		} elseif ($zone == 3) {
			$planetClimate[0] = "Cold";
			$stringHolder.="<li>Cold Climate</li>";
		} else {
			$stringHolder.="<li>Vacuum Climate (broiling in sunlight, freezing in shadow)</li>";
		}
		
		//PLANET BIOSPHERE
		//$planetBiosphere key: [0] = density, [1] = complexity, [2] = density fluff, [3] = complexity fluff, [4] = classification
		//biosphere density key: 1 = None, 2 = Very Scarce, 3 = Scarce, 4 = Infrequent, 5 = Standard, 6 = Abundant, 7 = Very Abundant
		//biosphere complexity key: 1 = very simple, 2 = simple, 3 = basic, 4 = moderate, 5 = advanced, 6 = very advanced, 7 = native intelligence
		if ($size[0] <= 7) {
			$planetBiosphere = genPlanetBiosphere ($atmosphere[0], $planetHydrosphere[0], $zone, $atmosphereComposition[0], $planetVolcanism[0]);
			$stringHolder.="<li>".$planetBiosphere[2];
			if ($planetBiosphere[0]!=1) {
				$stringHolder.="<ul><li>".$planetBiosphere[3];
				if ($planetBiosphere[1] >= 1 && $planetBiosphere[1] <= 2) {
					$word = "basic";
				} elseif ($planetBiosphere[1] == 3) {
					$word = "simple";
				} elseif ($planetBiosphere[1] >= 4 && $planetBiosphere[1] <= 6) {
					$word = "complex";
				}
				if ($planetBiosphere[1] == 7) {
					$stringHolder.="<ul><li>".genForm("sentient")."</li><li>".genQuirk("sentient")."</li></ul>";
				} else {
					$num = 1;
					while ($num <= $planetBiosphere[1]) {
						$stringHolder.="<ul><li>Sample Lifeform: ".genClassification($word)."<ul><li>".genForm($word)."</li><li>Quirks: ".genQuirk($word);
								$stringHolder.="</li></ul></li></ul>";
								$num++;
					}
					$stringHolder.="</li></ul>";
				}
				$stringHolder.="</li></ul>";
			}
			$stringHolder.="</li>";
		}
		
		//PLANET POPULATION
		if ($size[0] <= 7 && $planetBiosphere[1] == 7) {
			$planetPopulation=genPlanetPopulation($planetBiosphere[0], $planetBiosphere[1], $atmosphereComposition[0], $zone, $planetHydrosphere[0], $planetVolcanism[0]);
			$stringHolder.="<li>".$planetPopulation[1]."</li>";
		}
		
		//PLANET TECHNOLOGY LEVEL
		if ($size[0] <= 7 && $planetBiosphere[1] == 7) {
			$planetTechnology=genPlanetTechnology($planetPopulation[0], $gravity[0], $atmosphereComposition[0], $atmosphere[0], $planetVolcanism[0], $planetClimate[0], $planetBiosphere[0]);
			$stringHolder.="<li>".$planetTechnology[1]."</li>";
		}
		
		//CHECK FOR ALIEN ARTIFACTS
		$roll = mt_rand(1,100);
		if ($roll == 1) {
			$stringHolder.="<li>Alien Artifacts Present.  Sample Artifact Follows: <ul><li>";
			$stringHolder.=generateArtifact();
			$stringHolder.="</li></ul></li>";
		}
		
		//MOON GENERATION (OH GODS WHY)
		$numMoons = 0;
		$numMoonlets = 0;
//$size[0] key: 1 = diminutive, 2 = fine, 3 = tiny, 4 = small, 5 = medium, 6 = large, 7 = huge, 8 = small gas giant, 9 = medium gas giant, 10 = huge gas giant, 11 = gargantuan gas giant, 12 = y-class brown dwarf
		if ($size[0] == 8 || $size[0] == 9) {
			$numMoons = mt_rand(1,6)+mt_rand(1,6);
			$numMoonlets = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6);
		} elseif ($size[0] == 10 || $size[0] == 11) {
			$numMoons = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6);
			$numMoonlets = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6);
		} elseif ($size[0] == 12) {
			$numMoons = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6);
			$numMoonlets = mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6)+mt_rand(1,6);
		} elseif ($size[0] == 6) {
			$numMoons = mt_rand(1,6)-2;
			$numMoonlets = mt_rand(1,6)-3;
		} elseif ($size[0] == 4 || $size[0] == 5) {
			$numMoons = mt_rand(1,6)-4;
			$numMoonlets = mt_rand(1,6)-3;
		}
		if ($numMoons > 0) {
			$stringHolder.="<li>".$numMoons." Moons<ul class=\"moons\">";
			$currentMoon = 1;
			while ($currentMoon <= $numMoons) {
				if ($zone == "1") {
					$moonType = 2;
				} elseif ($zone == "2") {
					$rand = mt_rand(1,20);
					if ($rand <= 15) {
						$moonType = 2;
					} else {
						$moonType = 4;
					}
				} else {
					$rand = mt_rand(1,20);
					if ($rand <= 10) {
						$moonType = 2;
					} else {
						$moonType = 4;
					}
				}
				$stringHolder.="<li>Moon ".$currentMoon."<ul id=\"planet".$count."moon".$currentMoon."\">";
				switch($moonType[0]) {
					case "2":
						$stringHolder.="<li><em>Terrestrial Moon - </em>".$moonType[1]."</li>";
						break;
					case "4":
						$stringHolder.="<li><em>Icy Moon - </em>".$moonType[1]."</li>";
						break;
				}
				//MOON SIZE
				//$size[0] key: 1 = diminutive, 2 = fine, 3 = tiny, 4 = small, 5 = medium, 6 = large, 7 = huge, 8 = small gas giant, 9 = medium gas giant, 10 = huge gas giant, 11 = gargantuan gas giant, 12 = y-class brown dwarf
				//$size[1] is the size text
				$moonSize = genPlanetSize($zone, $moonType, TRUE, $size[0]);
				$stringHolder.="<li>".$moonSize[1]."</li>";
				//MOON GRAVITY
				//$gravity[0] key: 1 = microgravity, 2 = very low gravity, 3 = low gravity, 4 = standard gravity, 5 = high gravity, 6 = very high gravity, 7 = extreme gravity
				if ($moonSize[0] <= 7) {
					$moonGravity = genGravity($moonSize[0],$moonType, TRUE, $gravity[0]);
				} else {
					$moonGravity[0] = 7;
					$moonGravity[1] = "Extreme Gas Giant Gravity (way more than 4.0 G)";
				}
				//var_dump($moonGravity);
				$stringHolder.="<li>".$moonGravity[1]."</li>";
				//MOON ATMOSPHERIC DENSITY
				//$atmosphere[0] key: 1 = vacuum, 2 = very thin, 3 = thin, 4 = standard, 5 = dense, 6 = very dense, 7 = extremely dense
				if ($moonSize[0] <= 7) {
					$moonAtmosphere = genAtmoDense($moonGravity[0], $zone, TRUE);
					$stringHolder.="<li>".$moonAtmosphere[1]."</li>";
				}
				//MOON ATMOSPHERIC COMPOSITION
				//$atmosphereComposition[0] key: 1 = corrosive, 2 = poisonous, 3 = inert, 4 = breathable, 5 = breathable(tainted), 6 = variable
				if ($moonAtmosphere[0]!=1 && $moonSize[0] <= 7) {
					$moonAtmosphereComposition = genAtmoComp($zone);
					$stringHolder.="<li>".$moonAtmosphereComposition[1]."</li>";
				} else {
					$moonAtmosphereComposition = array(0,0);
				}
				//MOON GEOLOGY
				//$planetGeology[0] key: 1 = very flat, 2 = flat, 3 = stndard, 4 = rugged, 5 = very rugged
				if ($moonSize[0] <= 7) {
					$moonGeology = genPlanetGeo($moonGravity[0], $moonAtmosphere[0]);
					$stringHolder.="<li>".$moonGeology[1]."</li>";
				}
				//MOON VOLCANISM
				//$planetVolcanism[0] key: 1 = dead, 2 = stable, 3 = active, 4 = very active, 5 = extreme
				if ($moonSize[0] <= 7) {
					$moonVolcanism = genPlanetVolcanism($moonGravity[0], $moonGeology[0]);
					$stringHolder.="<li>".$moonVolcanism[1]."</li>";
				}
				//MOON HYDROSPHERE
				//$planetHydrosphere key: 0 = type, 1 = fluff text, 2 = percentage
				if ($moonSize[0] <= 7) {
					$moonHydrosphere = genPlanetHydrosphere($moonAtmosphere[0], $zone, $moonVolcanism[0], $moonGeology[0]);
					$stringHolder.="<li>".$moonHydrosphere[1]."</li>";
				}
				//MOON CLIMATE
				if ($moonSize[0] <= 7 && $moonAtmosphere[0] != 1 && $zone == 2) {
					$moonClimate = genPlanetClimate($moonAtmosphere[0], $starType[0], $starType[1], $moonVolcanism[0], $moonHydrosphere[2], $moonSize[0]);
					$stringHolder.="<li>".$moonClimate."</li>";
				} elseif ($zone == 1) {
					$moonClimate[0] = "Hot";
					$stringHolder.="<li>Hot Climate</li>";
				} elseif ($zone == 3) {
					$moonClimate[0] = "Cold";
					$stringHolder.="<li>Cold Climate</li>";
				} else {
					$stringHolder.="<li>Vacuum Climate (broiling in sunlight, freezing in shadow)</li>";
				}
				//MOON BIOSPHERE
				//$planetBiosphere key: [0] = density, [1] = complexity, [2] = density fluff, [3] = complexity fluff, [4] = classification
				//biosphere density key: 1 = None, 2 = Very Scarce, 3 = Scarce, 4 = Infrequent, 5 = Standard, 6 = Abundant, 7 = Very Abundant
				//biosphere complexity key: 1 = very simple, 2 = simple, 3 = basic, 4 = moderate, 5 = advanced, 6 = very advanced, 7 = native intelligence
				if ($moonSize[0] <= 7) {
					$moonBiosphere = genPlanetBiosphere ($moonAtmosphere[0], $moonHydrosphere[0], $zone, $moonAtmosphereComposition[0], $moonVolcanism[0]);
					$stringHolder.="<li>".$moonBiosphere[2];
					if ($moonBiosphere[0]!=1) {
						$stringHolder.="<ul><li>".$moonBiosphere[3];
						if ($planetBiosphere[1] >= 1 && $moonBiosphere[1] <= 2) {
							$word = "basic";
						} elseif ($moonBiosphere[1] == 3) {
							$word = "simple";
						} elseif ($moonBiosphere[1] >= 4 && $moonBiosphere[1] <= 6) {
							$word = "complex";
						}
						if ($moonBiosphere[1] == 7) {
							$stringHolder.="<ul><li>".genForm("sentient")."</li><li>".genQuirk("sentient")."</li></ul>";
						} else {
							$num = 1;
							while ($num <= $moonBiosphere[1]) {
								$stringHolder.="<ul><li>Sample Lifeform: ".genClassification($word)."<ul><li>".genForm($word)."</li><li>Quirks: ".genQuirk($word);
								$stringHolder.="</li></ul></li></ul>";
								$num++;
							}
							$stringHolder.="</li></ul>";
						}
						$stringHolder.="</li>";
					}
					$stringHolder.="</li>";
				}
				
				//PLANET POPULATION
				if ($moonSize[0] <= 7 && $moonBiosphere[1] == 7) {
					$moonPopulation=genPlanetPopulation($moonBiosphere[0], $moonBiosphere[1], $moonAtmosphereComposition[0], $zone, $moonHydrosphere[0], $moonVolcanism[0]);
					$stringHolder.="<li>".$moonPopulation[1]."</li>";
				}
				
				//PLANET TECHNOLOGY LEVEL
				if ($size[0] <= 7 && $planetBiosphere[1] == 7) {
					$moonTechnology=genPlanetTechnology($moonPopulation[0], $moonGravity[0], $moonAtmosphereComposition[0], $moonAtmosphere[0], $moonVolcanism[0], $moonClimate[0], $moonBiosphere[0]);
					$stringHolder.="<li>".$moonTechnology[1]."</li>";
				}
				
				//CHECK FOR ALIEN ARTIFACTS
				$roll = mt_rand(1,100);
				if ($roll == 1) {
					$stringHolder.="<li>Alien Artifacts Present.  Sample Artifact Follows: ";
					$stringHolder.=generateArtifact();
					$stringHolder.="</li>";
				}
				$stringHolder.="</li></ul>";
				$currentMoon++;
			}
			$stringHolder.="</ul></li>";
		}
		if ($numMoonlets > 0) {
			$stringHolder.="<li>".$numMoonlets." Moonlets</li>";
		}
		$stringHolder.="</ul></li></ul>";
		array_push($planetArray, $stringHolder);
		//end planet generation
	}
	//check for/generate asteroid belts
	if ($asteroids == TRUE) {
		//echo "<hr /><strong>ASTEROID BELT DETAILS FOLLOW</strong>";
		$beltDensity = 0;
		$modifier = 0;
		if ($gasGiants >= 3) {
			$modifier-=4;
		} elseif ($gasGiants <= 1) {
			$modifier+=2;
		}
		foreach ($asteroidBelts as $belt) {
			$hold = explode(",", $belt);
			$stringHolder="<ul>";
			$stringHolder.=genRoids($modifier);
			$stringHolder.="</ul></li></ul>";
			$planetArray[$hold[1]].=$stringHolder;
		}
	}
	foreach ($planetArray as $text) {
		echo $text;
	}
	//check for/generate/display other system features
	$features = genSystemFeatures();
	if ($features[0] == TRUE) {
		$drop = array_shift($features);
		echo "<hr /><strong>ADDITIONAL SYSTEM FEATURES FOLLOW</strong><ul>";
		foreach ($features as $feature) {
			echo "<li>".$feature."</li>";
		}
		echo "</ul>";
	}
}
?>
</body>
</html>