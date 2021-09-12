<?php
    require_once 'usuario.php';
    $opcion = $_GET['tarea'];
    $nombre = $_POST['nombre'];
    var_dump($opcion);
    
    switch ($opcion) {
        case 'mostrar':
            Usuario::MostrarUsuario($nombre);
            break;
        case 'crear':
            $user = new Usuario($nombre);
            Usuario::MostrarUsuario($user->getNombre());
            break;
    }
?>