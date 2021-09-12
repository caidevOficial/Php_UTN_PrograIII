<?php
    
    class Usuario{
        
        private $_name;
        private $_password;
        private $_email;

        /**
         * Creates an object of type Usuario.
         * @param string $_name The name of the user.
         * @param string $_password The password of the user.
         * @param string $_email The email of the user.
         * @return void
         */
        public function __construct($name, $password, $email){
            $this->_name = $name;
            $this->_password = $password;
            $this->_email = $email;
        }

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         * @access public
         */
        public function getUserData():String{
            return $this->_name . " " . $this->_password . " " . $this->_email;
        }
        /**
         * Returns the name of the user.
         * @return string The name of the user.
         * @access public
         */
        public static function MostrarUsuario(Usuario $usuario){
            echo $usuario->getUserData().PHP_EOL;
        }

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         * @access public
         */
        public function getName(){
            return $this->_name;
        }

        /**
         * Returns the password of the user.
         * @return string The password of the user.
         * @access public
         */
        public function getPassword(){
            return $this->_password;
        }

        /**
         * Returns the email of the user.
         * @return string The email of the user.
         * @access public
         */
        public function getEmail(){
            return $this->_email;
        }

        /**
         * Writes a file with the name of the user.
         * @return void
         * @access public
         */
        public static function UserToCSV(Usuario $user){
            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                fwrite($archivo, $user->getUserData() . PHP_EOL);
                fclose($archivo);
            }
        }

    }
?>