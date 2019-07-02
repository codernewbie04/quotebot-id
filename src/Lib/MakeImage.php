<?php

namespace App\Lib;

class MakeImage
{
    function create($quote, $author="Anonymouse")
    {
        $txt = $quote;
        $padingAuthor = 0;

        if(strlen($txt) > 200){
            $padingAuthor = 150;
        } else if(strlen($txt) > 160){ 
            $padingAuthor = 120;
        } else if(strlen($txt) > 120){
            $padingAuthor = 90;
        } else if(strlen($txt) > 80){
            $padingAuthor = 60;
        } else if(strlen($txt) > 40){
            $padingAuthor = 30;
        }

        $input_text = wordwrap($txt, 40, "\n");
        $width = 640;
        $height = 640;
        $image = imagecreate($width, $height);
        $box = imagettfbbox(20, 0, './fonts/Sanchezregular-ita.otf', $input_text);
        $textX = -$box[6] + 30;
        $textY = -$box[7] + 6;
        $x = imagesx($image) / 2;
        $y = imagesy($image) / 2;


        $color = imagecolorallocate($image, 255, 255, 255);
        $color2 = imagecolorallocate($image, 255, 255, 255);
        imagecolortransparent($image, $color);
        ImageTTFText($image, 20, 0, $textX, $y, $color2, './fonts/Sanchezregular-ita.otf', $input_text);
        ImageTTFText($image, 14, 0, $textX, $y + 50 + $padingAuthor, $color2, './fonts/Sanchezregular-ita.otf', "- ".$author);


        // create background image layer
        $background = imagecreatefromjpeg("bg_ig".rand(0,4).".jpg");

        // Merge background image and text image layers
        imagecopymerge($background, $image, 15, 15, 0, 0, $width, $height, 100);


        $output = imagecreatetruecolor($width, $height);
        imagecopy($output, $background, 0, 0, 20, 13, $width, $height);


        ob_start();
        imagepng( $output, 'file.jpg' );
        return '<img id="output" height = "640" width ="640" src="data:image/png;base64,'.base64_encode(ob_get_clean()).'" />';
    }
}
