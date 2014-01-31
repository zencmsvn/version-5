<?php
/**
 * ZenCMS Software
 * Author: ZenThang
 * Email: thangangle@yahoo.com
 * Website: http://zencms.vn or http://zenthang.com
 * License: http://zencms.vn/license or read more license.txt
 * Copyright: (C) 2012 - 2013 ZenCMS
 * All Rights Reserved.
 */
if (!defined('__ZEN_KEY_ACCESS')) exit('No direct script access allowed');

Class captcha
{
    public $keystring;

    public function create()
    {
        // create a 88*31 image
        $im = imagecreate(100, 40);
        // random colored background and text
        $bg = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
        $textcolor = imagecolorallocate($im, 0, 0, rand(0, 255));

        // write the random 4 digits number at a random locaton (x= 0-20, y=0-20),
        $random = rand(1000, 9999);
        imagestring($im, 20, rand(3, 60), rand(0, 25), $random, $textcolor);
        //$this->distortion($im,"ffffff");
        header("Content-type: image/jpeg");
        imagejpeg($im);
        imagedestroy($im);
    }



    function generate_captcha() {

        $alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";
        $allowed_symbols = "23456789abcdeghkmnpqsuvxyz";
        $fontsdir = 'files/systems/fonts/captcha';
        $length = mt_rand(4, 5);
        $width = 100;
        $height = 50;
        $fluctuation_amplitude = 5;
        $no_spaces = true;
        $show_credits = false;
        $credits = '';
        $foreground_color = array (
            mt_rand(0, 100),
            mt_rand(0, 100),
            mt_rand(0, 100)
        );

        $background_color = array (
            mt_rand(200, 255),
            mt_rand(200, 255),
            mt_rand(200, 255)
        );

        $jpeg_quality = 90;
        ////////////////////////////////////////////////////////////
        $fonts = array ();
        $fontsdir_absolute = __SITE_PATH . '/' . $fontsdir;

        if (($handle = opendir($fontsdir_absolute)) !== false) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match('/\.png$/i', $file)) {
                    $fonts[] = $fontsdir_absolute . '/' . $file;
                }
            }
            closedir($handle);
        }
        $alphabet_length = strlen($alphabet);

        do {
            // generating random keystring
            while (true) {
                $this->keystring = '';
                for ($i = 0; $i < $length; $i++) {
                    $this->keystring .= $allowed_symbols{mt_rand(0, strlen($allowed_symbols) - 1)};
                }
                if (!preg_match('/cp|cb|ck|c6|c9|rn|rm|mm|co|do|cl|db|qp|qb|dp|ww/', $this->keystring))
                    break;
            }


            $font_file = $fonts[mt_rand(0, count($fonts) - 1)];

            $font = imagecreatefrompng($font_file);
            imagealphablending($font, true);
            $fontfile_width = imagesx($font);
            $fontfile_height = imagesy($font) - 1;
            $font_metrics = array ();
            $symbol = 0;
            $reading_symbol = false;
            // loading font
            for ($i = 0; $i < $fontfile_width && $symbol < $alphabet_length; $i++) {
                $transparent = (imagecolorat($font, $i, 0) >> 24) == 127;
                if (!$reading_symbol && !$transparent) {
                    $font_metrics[$alphabet{$symbol}] = array ('start' => $i);
                    $reading_symbol = true;
                    continue;
                }
                if ($reading_symbol && $transparent) {
                    $font_metrics[$alphabet{$symbol}]['end'] = $i;
                    $reading_symbol = false;
                    $symbol++;
                    continue;
                }
            }
            $img = imagecreatetruecolor($width, $height);
            imagealphablending($img, true);
            $white = imagecolorallocate($img, 255, 255, 255);
            imagefilledrectangle($img, 0, 0, $width - 1, $height - 1, $white);
            // draw text
            $x = 1;
            for ($i = 0; $i < $length; $i++) {
                $m = $font_metrics[$this->keystring{$i}];
                $y = mt_rand(-$fluctuation_amplitude, $fluctuation_amplitude) + ($height - $fontfile_height) / 2 + 2;
                if ($no_spaces) {
                    $shift = 0;
                    if ($i > 0) {
                        $shift = 10000;
                        for ($sy = 7; $sy < $fontfile_height - 20; $sy += 1) {
                            for ($sx = $m['start'] - 1; $sx < $m['end']; $sx += 1) {
                                $rgb = imagecolorat($font, $sx, $sy);
                                $opacity = $rgb >> 24;
                                if ($opacity < 127) {
                                    $left = $sx - $m['start'] + $x;
                                    $py = $sy + $y;
                                    if ($py > $height)
                                        break;
                                    for ($px = min($left, $width - 1); $px > $left - 12 && $px >= 0; $px -= 1) {
                                        $color = imagecolorat($img, $px, $py) & 0xff;
                                        if ($color + $opacity < 190) {
                                            if ($shift > $left - $px) {
                                                $shift = $left - $px;
                                            }
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                        if ($shift == 10000) {
                            $shift = mt_rand(4, 6);
                        }
                    }
                } else {
                    $shift = 1;
                }
                imagecopy($img, $font, $x - $shift, $y, $m['start'], 1, $m['end'] - $m['start'], $fontfile_height);
                $x += $m['end'] - $m['start'] - $shift;
            }
        } while ($x >= $width - 10); // while not fit in canvas
        $center = $x / 2;
        // credits. To remove, see configuration file
        $img2 = imagecreatetruecolor($width, $height + ($show_credits ? 12 : 0));
        $foreground = imagecolorallocate($img2, $foreground_color[0], $foreground_color[1], $foreground_color[2]);
        $background = imagecolorallocate($img2, $background_color[0], $background_color[1], $background_color[2]);
        imagefilledrectangle($img2, 0, 0, $width - 1, $height - 1, $background);
        imagefilledrectangle($img2, 0, $height, $width - 1, $height + 12, $foreground);
        $credits = empty($credits) ? $_SERVER['HTTP_HOST'] : $credits;
        imagestring($img2, 2, $width / 2 - imagefontwidth(2) * strlen($credits) / 2, $height - 2, $credits, $background);
        // periods
        $rand1 = mt_rand(750000, 1200000) / 10000000;
        $rand2 = mt_rand(750000, 1200000) / 10000000;
        $rand3 = mt_rand(750000, 1200000) / 10000000;
        $rand4 = mt_rand(750000, 1200000) / 10000000;
        // phases
        $rand5 = mt_rand(0, 31415926) / 10000000;
        $rand6 = mt_rand(0, 31415926) / 10000000;
        $rand7 = mt_rand(0, 31415926) / 10000000;
        $rand8 = mt_rand(0, 31415926) / 10000000;
        // amplitudes
        $rand9 = mt_rand(330, 420) / 110;
        $rand10 = mt_rand(330, 450) / 110;

        //wave distortion
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $sx = $x + (sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6)) * $rand9 - $width / 2 + $center + 1;
                $sy = $y + (sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8)) * $rand10;
                if ($sx < 0 || $sy < 0 || $sx >= $width - 1 || $sy >= $height - 1) {
                    continue;
                } else {
                    $color = imagecolorat($img, $sx, $sy) & 0xFF;
                    $color_x = imagecolorat($img, $sx + 1, $sy) & 0xFF;
                    $color_y = imagecolorat($img, $sx, $sy + 1) & 0xFF;
                    $color_xy = imagecolorat($img, $sx + 1, $sy + 1) & 0xFF;
                }
                if ($color == 255 && $color_x == 255 && $color_y == 255 && $color_xy == 255) {
                    continue;
                } else if ($color == 0 && $color_x == 0 && $color_y == 0 && $color_xy == 0) {
                    $newred = $foreground_color[0];
                    $newgreen = $foreground_color[1];
                    $newblue = $foreground_color[2];
                } else {
                    $frsx = $sx - floor($sx);
                    $frsy = $sy - floor($sy);
                    $frsx1 = 1 - $frsx;
                    $frsy1 = 1 - $frsy;

                    $newcolor = ($color * $frsx1 * $frsy1 + $color_x * $frsx * $frsy1 + $color_y * $frsx1 * $frsy + $color_xy * $frsx * $frsy);
                    if ($newcolor > 255)
                        $newcolor = 255;
                    $newcolor = $newcolor / 255;
                    $newcolor0 = 1 - $newcolor;
                    $newred = $newcolor0 * $foreground_color[0] + $newcolor * $background_color[0];
                    $newgreen = $newcolor0 * $foreground_color[1] + $newcolor * $background_color[1];
                    $newblue = $newcolor0 * $foreground_color[2] + $newcolor * $background_color[2];
                }
                imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
            }

        }

        ob_start();
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        $ext = '';
        if (function_exists("imagejpeg")) {
            header("Content-Type: image/jpeg");
            imagejpeg($img2, null, $jpeg_quality);
            $ext = 'jpg';
        } else if (function_exists("imagegif")) {
            header("Content-Type: image/gif");
            imagegif($img2);
            $ext = 'gif';
        } else if (function_exists("imagepng")) {
            header("Content-Type: image/x-png");
            imagepng($img2);
            $ext = 'png';
        }
        header('Content-Disposition: inline; filename=' . ((rand(10, 9999))) . '.' . $ext);
        header('Content-Length: ' . ob_get_length());
        ob_end_flush();

    }

    // returns keystring
    function getKeyString() { return $this->keystring; }




    public function image($security = 'captcha_code') {
        if (empty($security)) {
            $security = 'captcha_code';
        }
        $this->generate_captcha();
        $_SESSION['session_'.$security] = $this->getKeyString();

    }

    function distortion($image,$background,$width=0,$height=0)
    {
        if(!$width) $width = imagesx($image);
        if(!$height) $height = imagesy($image);

        $background = $this->_color($background, $image);

        $orig = imagecreatetruecolor($width,$height );
        imageColorTransparent($orig, $background);

        imagecopy( $orig, $image, 0, 0, 0, 0, $width, $height );

        imagefilledrectangle( $image, 0, 0,$width,$height, $background );


        $v_f1 = rand ( 250, 300 )/100; //  od 2 do 3 za fju
        $v_w1 = rand ( 0, $width * 100 )/100;// od 0 do width

        $v_f2 = rand ( 40, 60 )/100;// od 0.1 do 1 za prigusenje
        $v_w2 = rand ( 0, $width * 100 )/100; // od 0 do width

        $v_f3 = rand ( 40, 60 )/100;// od 0.1 do 1 za prigusenje dolje
        $v_w3 = rand ( 0, $width * 100 )/100; // od 0 do width

        $y4_max = 0;
        $y5_max = 0;

        $an = array();
        $as = array();

        for($x=0; $x<$width; $x++)
        {

            $y1 = $this->_sin($x, $v_f1, $v_w1, $width, $height);
            $y2 = $this->_sin($x, $v_f2, $v_w2, $width, $height);
            $y3 = $this->_sin($x, $v_f3, $v_w3, $width, $height);

            $y4 = $y1 * $y2 / $height / 3;
            $y5 = $y1 * $y3 / $height / 3;

            $an[$x] = $y4;
            $as[$x] = $y5;

            if($y4>$y4_max)$y4_max = $y4;
            if($y5>$y5_max)$y5_max = $y5;

        }

        for($x=0; $x<$width; $x++)
        {
            $as[$x] = $height - $y5_max - 1 + $as[$x];

            for($y=0; $y<$height; $y++)
            {

                imagesetpixel($image, $x,
                    $this->_y($y, $an[$x], $as[$x], $height),
                    imagecolorat ( $orig, $x, $y )
                );
            }

        }

    }
    function _sin($x, $f, $w, $width,$height)
    {

        return (int) ($height/2)*( 1 - sin($f * 2 * M_PI * ( $x + $w ) / $width ) );

    }

    function _y($y, $b1, $b2, $height)
    {

        return (int)  $b1 + ($y / $height * ($b2- $b1));

    }

    function _color($hex, &$image)
    {
        if(is_int($hex)) return $hex;
        return ImageColorAllocate($image, hexdec("0x".substr($hex,0,2)), hexdec("0x".substr($hex,2,2)), hexdec("0x".substr($hex,4,2)));
    }
}

?>