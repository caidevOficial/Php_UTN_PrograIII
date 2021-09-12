<?php
    require_once 'usuario.php';
    
    $opcion = $_GET['tarea'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $mail = $_POST['mail'];
    
    var_dump($opcion);
    
    switch ($opcion) {
        case 'crear':
            $user = new Usuario($nombre, $clave, $mail);
            Usuario::MostrarUsuario($user);
            Usuario::UserToCSV($user);
            break;
    }
?>