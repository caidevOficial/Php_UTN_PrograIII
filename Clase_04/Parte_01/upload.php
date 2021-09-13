<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    //--- Check if exist Directory ---//
    $destiny = 'Uploads/';
    if (!file_exists($destiny)) {
        mkdir($destiny, 0777, true);
    }
    //--- Obtain the Actual Name of the File ---//
    $fileName = $_FILES['Archivo']['name'];
    
    echo "<br>Original File's name: <br>";
    var_dump($fileName);
    echo "<br>";

    //--- Obtain the Name and the extension of the file ---
    $newFileNameArray = explode('.', $fileName);
    $extension = end($newFileNameArray);

    // --- Sets the new name of the file ---
    $newFileName = $newFileNameArray[0] . '_' . date('Y_m_d__H_i_s', time()) . '.' . $extension;
    
    //--- Setup the path of the file ---//
    $destiny .= $newFileName;
    
    echo "<br>File saved with the name: <br>";
    var_dump($newFileName);
    echo "<br>";

    //--- Move the file to the directory ---//
    move_uploaded_file($_FILES['Archivo']['tmp_name'], $destiny);
    
    echo "<br>File uploaded correctly to: <br>" . $destiny;
    echo "<br>";
?>