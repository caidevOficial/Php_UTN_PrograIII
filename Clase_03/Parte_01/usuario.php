<?php

    include_once 'File.php';
    
    class Usuario{
        
        private $nombre;

        /**
         * Creates an object of type Usuario.
         * @param string $nombre The name of the user.
         */
        public function __construct($nombre="Sin Nombre"){
            $this->nombre = $nombre;
        }

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         */
        public static function MostrarUsuario(String $usuario){
            echo "El usuario es: ".$Usuario->usuario;
        }

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         */
        public function getNombre(){
            return $this->nombre;
        }

        /**
         * Writes a file with the name of the user.
         */
        public function GuardarCSV(){
            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $this->nombre."\n");
                fclose($archivo);
            }
        }

    }
?>