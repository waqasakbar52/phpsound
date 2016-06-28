<?php
// Set the header
header("Content-type: image/png");

// Start the session
session_start();

// Generate the 6 digits random string
$text = mt_rand(100000, 999999);

// Explode the letters into separate array elements
$letters = str_split($text);

// Store the generated code into the _SESSION captcha
$_SESSION['captcha'] = $text;
 
// Define the Image Height & Width
$width = 75;
$height = 26;  

// Create the Image
$image = imagecreate($width, $height); 

// Set the background color
$black = imagecolorallocate($image, 255, 255, 255);
// Set the text color
$white = imagecolorallocate($image, 0, 0, 0);

// Set the font size
$font_size = 1; 

// Draw background circles
for($i = 0; $i < 1; $i++) {
	// The outside circle diameter
	$outside = 60-$i*20;

	// The inside circle diamater
	$inside = 59-$i*20;

	// Randomize the horizontal position and vertical position
	$oc = array(mt_rand(30, 40), mt_rand(10, 20));

	// Draw the outer circle
	imagefilledellipse($image, $oc[0], $oc[1], $outside, $outside, $white);
	
	// Draw the inner circle
	imagefilledellipse($image, $oc[0], $oc[1], $inside, $inside, $black);
}

// Generate noise
for($noise = 0; $noise <= 15; $noise++) {
	$x = mt_rand(10, $width-10);
	$y = mt_rand(10, $height-10);
	imageline($image, $x, $y, $x, $y, $white);
}

// Letter position
$position = array(8, 18, 28, 38, 48, 58);

for($i = 0; $i < count($letters); $i++) {
	// Generate an rgb random value, from light gray to white
	$color = rand(0, 55);
	
	// Output the letters
	imagestring($image, 5, $position[$i], mt_rand(5, 7), $letters[$i], imagecolorallocate($image, $color, $color, $color));
}

// Generate random vertical and horizontal lines
imageline($image, 0, mt_rand(10, $height-10), $width, mt_rand(10, $height-10), $white);
imageline($image, mt_rand(15, $width-15), 0, 0, mt_rand(15, $width-15), $white);

// Output the $image, don't save the file name, set quality
imagepng($image, null, 9); 
?>