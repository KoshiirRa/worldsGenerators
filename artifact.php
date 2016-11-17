<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form class="form-horizontal" action="artifact.php" method="get">
<fieldset>

<!-- Form Name -->
<legend>Artifact Generator</legend>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="template">Template (If Desired)</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="template-0">
      <input type="radio" name="template" id="template-0" value="FALSE" checked="checked">
      No Preference
    </label> 
    <label class="radio-inline" for="template-1">
      <input type="radio" name="template" id="template-1" value="Armor">
      Armor
    </label> 
    <label class="radio-inline" for="template-2">
      <input type="radio" name="template" id="template-2" value="Gear">
      Gear
    </label> 
    <label class="radio-inline" for="template-3">
      <input type="radio" name="template" id="template-3" value="Weapon">
      Weapon
    </label>
  </div>
</div>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="technology">Technology (If Desired)</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="technology-0">
      <input type="radio" name="technology" id="technology-0" value="FALSE" checked="checked">
      No Preference
    </label>
	</div>
  <div class="radio">
    <label for="technology-1">
      <input type="radio" name="technology" id="technology-1" value="crystal">
      Crystal
    </label>
	</div>
  <div class="radio">
    <label for="technology-2">
      <input type="radio" name="technology" id="technology-2" value="chemical">
      Chemical
    </label>
	</div>
  <div class="radio">
    <label for="technology-3">
      <input type="radio" name="technology" id="technology-3" value="electronic">
      Electronic
    </label>
	</div>
  <div class="radio">
    <label for="technology-4">
      <input type="radio" name="technology" id="technology-4" value="life">
      Life
    </label>
	</div>
  <div class="radio">
    <label for="technology-5">
      <input type="radio" name="technology" id="technology-5" value="mechanical">
      Mechanical
    </label>
	</div>
  <div class="radio">
    <label for="technology-6">
      <input type="radio" name="technology" id="technology-6" value="nanotechnology">
      Nanotechnology
    </label>
	</div>
  <div class="radio">
    <label for="technology-7">
      <input type="radio" name="technology" id="technology-7" value="organic">
      Organic
    </label>
	</div>
  </div>
</div>

<!-- Button -->
<div class="form-group">
 <div class="col-md-4">
    <input type="submit" name="submit" class="btn btn-default" />
  </div>
</div>

</fieldset>
</form>

<?php
require_once('classes.php');
if (isset($_GET["template"])) {
	if ($_GET["template"] == "FALSE") {
		$_GET["template"] = FALSE;
	}
	if (isset($_GET["technology"])) {
		if ($_GET["technology"] == "FALSE") {
			$_GET["technology"] = FALSE;
		}
		echo generateArtifact($_GET["template"], $_GET["technology"]);
	} else {
		echo generateArtifact($_GET["template"]);
	}
} elseif (isset($_GET["technology"])) {
	echo generateArtifact(FALSE, $_GET["technology"]);
} else {
	echo generateArtifact();
}

?>
</body>
</html>