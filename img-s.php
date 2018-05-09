<?php

	$f = $_FILES['ff']['tmp_name'];

	$rawInput = base64_encode(file_get_contents($f));

	 //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "../qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = md5($_FILES['ff']['name']).'.png';

    $errorCorrectionLevel = 'H';

    $matrixPointSize = 4;

    QRcode::raw($rawInput, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';