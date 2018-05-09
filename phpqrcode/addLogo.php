<?php

	class addLogo{


		public static function logo($data, $outfile, $errorCorrectionLevel, $matrixPointSize,$margin=2,$save=false,$bg=0xFFFFFF,$fg=0x000000,$logo){

				QRcode::png($data, $outfile, $errorCorrectionLevel, $matrixPointSize, 2);

				$logo_resized = imagecreatetruecolor(50,50);

                $logos = imagecreatefromjpeg($logo);

                list($w,$h) = getimagesize($logo);

                imagecopyresampled($logo_resized,$logos, 0, 0, 0, 0, 50, 50, $w, $h);

                $PNG_TEMP_DIR = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

                imagejpeg($logo_resized,$PNG_TEMP_DIR."logo_resized.jpg");

                $qrcode = imagecreatefrompng($outfile);

                $logo = imagecreatefromjpeg($PNG_TEMP_DIR."logo_resized.jpg");

                list($w,$h) = getimagesize($outfile);

                $start_x = ($w-50)/2;

                $start_y = ($h-50)/2;

                imagecopymerge($qrcode,$logo,$start_x,$start_y,0,0,50,50,100);

                imagepng($qrcode,$outfile);

		}

	}