<?php
// Filnavn, sortering og lidt af hvert
session_start(); 
header("Cache-Control: private, max-age=10800, pre-check=10800");
header("Pragma: private");
header("Expires: " . date(DATE_RFC822,strtotime(" 2 day")));
$toHeight = 250;
$toWidth = 448;
$folder = $_REQUEST["l"];
$filename = $_REQUEST["f"];
$path = "images/".$folder."/".$filename;
list($width, $height) = getimagesize($path);

$prop =$width/$height; 
if ($prop<=1)
	$h=$toHeight; 
else  
	$w=$toWidth;
 			
 			
$newwidth = $toWidth;
$newheight = $toHeight;

if (isset($w))
{
	$str = $w;
	$forhold = $height/$width;
	$newwidth = $str;
	$newheight = $newwidth*$forhold;
}

if (isset($h))
{
	$str = $h;
	$forhold = $width/$height;
	$newheight = $str;
	$newwidth = $newheight*$forhold;
}

$fromX = "0";
$fromY = "0";

$borderx = ($newwidth<$toWidth) ? ceil(($toWidth-$newwidth)/2) : "0";
$bordery = ($newheight< $toHeight) ? ceil(($toHeight - $newheight)/2) : "0";
//echo $borderx." - ".$bordery." - ".$newwidth." - ".$newheight;
$type = explode(".",$filename);
$type = $type[1];

// Content type
	header('Content-type:image/'.strtolower($type));

// Load
$thumb = imagecreatetruecolor($toWidth, $toHeight);
$white = imagecolorallocate($thumb, 255,255,255);
//imagefill($thumb, 0,0, $white);

	switch(strtolower($type)){
		case "gif":
		$source = imagecreatefromgif($path);
		break;
		case "jpg":
		$source = imagecreatefromjpeg($path);
		break;
		case "png":
		$source = imagecreatefrompng($path);
		break;
	}	

// Resize
imagecopyresampled($thumb, $source, $borderx, $bordery, $fromX, $fromY, $newwidth, $newheight, $width, $height);

// Og så skal billedet vises :D

	switch(strtolower($type)){
		case "gif":
		imagegif($thumb);
		break;
		case "jpg":
		imagejpeg($thumb);
		break;
		case "png":
		imagepng($thumb);
		break;
	}


?> 