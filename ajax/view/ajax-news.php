<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');

$json = array();

$json["id"] = $news->getId();
$json["heading"] = $news->getHeading();
$json["image"] = $news->getImage();
$json["text"] = $news->getText();

echo json_encode($json);
?>
