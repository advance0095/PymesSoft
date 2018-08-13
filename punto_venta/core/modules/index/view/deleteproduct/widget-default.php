<?php

// print_r($_POST);

$operation =ProductData::getById($_GET["id"]);
$pid = $operation->id;
$operation->del();

header("Location: index.php?view=products&id=".$pid);

?>