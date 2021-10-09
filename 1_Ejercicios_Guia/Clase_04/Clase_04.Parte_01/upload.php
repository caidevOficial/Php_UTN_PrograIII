<?php
    /* 
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Facundo Falcone <CaidevOficial> 
 */

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