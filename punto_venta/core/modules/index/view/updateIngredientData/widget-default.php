<?php

if(count($_POST)>0){
	$Ingredient = IngredientData::getById($_POST["id"]);
	$Ingredient->code = $_POST["code"];
	$Ingredient->name = $_POST["name"];
	$Ingredient->price_out = $_POST["price_out"];
	$Ingredient->unit = $_POST["unit"];
	$Ingredient->user_id = Session::getUID();
	$Ingredient->update2();
	setcookie("Ingupd","true");
	print "<script>window.location='index.php?view=ingredients';</script>";


}


?>