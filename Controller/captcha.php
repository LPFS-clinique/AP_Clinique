<?php
session_start();

$characters = 'abcdefghi0123456789jklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$captchaString = '';

for ($i = 0; $i < 5; $i++) {
    $captchaString .= $characters[rand(0, strlen($characters) - 1)];
}

$_SESSION['captcha'] = $captchaString;

$image = imagecreate(150, 50);
$background = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 45, 20, $captchaString, $textColor);
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
