<?php

require_once 'Users.php';
require_once 'UploadManager.php';

$option = $_GET['task'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

//--- Sets the timezone to use. ---//
date_default_timezone_set('America/Argentina/Buenos_Aires');
$newID = 0;
$firstRegister = false;

//--- Instance of the class UploadManager. ---//
$UpManager = new UploadManager($_FILES);
var_dump($option);

switch ($option) {
    case 'register':
        if (!$firstRegister) {
            $firstRegister = true;
            $newID = rand(1, 10001);
        } else {
            $newID +=1;
        }
        $registerDate = new DateTime("now");
        $user = new Usuario($newID, $name, $password, $email, $registerDate->format('d-m-Y H:m:s'));
        //--- Gets the old array of users from the file. ---//
        $myArray = Usuario::ReadJSON();

        //--- Adds the new user to the array. ---//
        array_push($myArray, $user);
        
        //--- Saves the New Array of Users in a JSON file. ---//
        if ($user->SaveToJSON($myArray)) {
            echo $user->errorMessageOfJSON().'<br>';
            echo "Usuario guardado correctamente<br>";
        } else {
            echo "Error al guardar el usuario";
        }

        if ($UpManager->saveFileIntoDir($_FILES)) {
            echo "Archivo guardado correctamente<br>";
        }
        break;
}
?>