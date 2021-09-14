<?php

require_once 'usuario.php';

$option = $_GET['task'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

var_dump($option);

switch ($option) {
    case 'create':
        $user = new Usuario($name, $password, $email);
        if($user->GuardarCSV()){
            echo "Usuario creado correctamente";
        }
        break;
}
?>