<?php

require_once 'usuario.php';

$option = $_GET['task'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

var_dump($option);

switch ($option) {
    case 'register':
        $user = new Usuario($name, $password, $email);
        if($user->SaveToJSON()){
            echo "Usuario guardado correctamente";
        }else{
            echo "Error al guardar el usuario";
        }
        break;
}
?>