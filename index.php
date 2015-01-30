<?php

// debugging
error_reporting(-1);
ini_set('display_errors', 1);

// initalize variables
$names = isset($_GET["n"]) ? explode(" ", $_GET["n"]) : explode(" ", "? ?");
$name = strtoupper(substr($names[0], 0, 1) . substr($names[1], 0, 1));
$radius = isset($_GET["r"]) ? $_GET["r"] : 150;
$size = $radius * 2;

// create a blank image
$image = imagecreatetruecolor($size, $size);

// anti alasing (not very good)
imageantialias($image, true);

// define posible colours for the circle
$colours = array(
    "orange" => imagecolorallocate($image, 241, 143, 0),
    "green" => imagecolorallocate($image, 128, 186, 39),
    "blue" => imagecolorallocate($image, 13, 147, 210),
    "pink" => imagecolorallocate($image, 231, 30, 108)
);

// draw a circle with set colour otherwise pick a random one
$circle_col = isset($_GET["c"]) ? $colours[$_GET["c"]] : $colours(array_rand($colours));
imagefilledellipse($image, $radius, $radius, $size - 1, $size - 1, $circle_col);

// write the text on the center of the circle.
$font = "VAGRounded-Light";
$font_col = imagecolorallocate($image, 255, 255, 255);
$text_box = imagettfbbox($radius, 0, $font, $name);
$text_width = $text_box[2] - $text_box[0];
$x = ($radius) - ($text_width / 2);
$y = $radius + $radius / 2.2;
imagettftext($image, $radius, 0, $x, $y, $font_col, $font, $name);

// remove the black backround
$transparent = imagecolorallocate($image, 0, 0, 0);
imagecolortransparent($image, $transparent);

// output the picture
header("Content-type: image/png");
imagepng($image);

imagedestroy($image);

?>
