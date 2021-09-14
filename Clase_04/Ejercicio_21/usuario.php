<?php
    class Usuario{
        
        //--- Attributes ---
        private $_name;
        private $_password;
        private $_email;

        //--- Constructor ---
        /**
         * Creates an object of type Usuario.
         * @param string $name The name of the user.
         * @param string $password The password of the user.
         * @param string $email The email of the user.
         */
        public function __construct($name, $password, $email){
            $this->setName($name);
            $this->setPassword($password);
            $this->setEmail($email);
        }

        //--- Setters ---

        /**
         * Sets the name of the user.
         * @param string $name The name of the user.
         */
        function setName($name){
            if (is_string($name) && !empty($name)) {
                $this->_name = $name;
            }
        }

        /**
         * Sets the password of the user.
         * @param string $password The password of the user.
         */
        function setPassword($password){
            if (is_string($password) && !empty($password)) {
                $this->_password = $password;
            }
        }

        /**
         * Sets the email of the user.
         * @param string $email The email of the user.
         */
        function setEmail($email){
            if (is_string($email) && !empty($email)) {
                $this->_email = $email;
            }
        }

        //--- Getters ---

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         */
        function getName(){
            return $this->_name;
        }

        /**
         * Returns the password of the user.
         * @return string The password of the user.
         */
        function getPassword(){
            return $this->_password;
        }

        /**
         * Returns the email of the user.
         * @return string The email of the user.
         */
        function getEmail(){
            return $this->_email;
        }

        //--- Methods ---
        /**
         * Returns the name of the user.
         * @return string The name of the user.
         */
        public static function MostrarUsuario(String $usuario){
            echo "El usuario es: ".$Usuario->usuario;
        }

        /**
         * Saves a file with the information of the user.
         * @return boolean True if the file was saved successfully, false otherwise.
         */
        public function GuardarCSV():bool{
            $success = false;
            try {
                $archivo = fopen("usuarios.csv", "a+");
                if ($archivo) {
                    fwrite($archivo, $this->getName().",".$this->getPassword().",".$this->getEmail().PHP_EOL);
                    $success = true;
                }
            } catch (\Throwable $th) {
                echo "Error al guardar el archivo";
            }finally{
                fclose($archivo);
            }

            return $success;
        }

        private static function ListUsers($users=array()):bool{
            $success = false;
            echo "<ul>";
            foreach ($users as $user) {
                echo "<li>".$user->getName()."</li>";
                echo "<li>".$user->getPassword()."</li>";
                echo "<li>".$user->getEmail()."</li>";
                $success = true;
            }
            echo "</ul>";

            return $success;
        }


        /**
         * Reads a file with information of the users.
         * @return array The array with the information of the users.
         */
        public static function ReadCSV($filename="usuarios.csv"):bool{
            $file = fopen($filename, "r");
            $users = array();
            try {
                while (!feof($file)) {
                    $line = fgets($file);
                    if (!empty($line)) {
                        $line = str_replace(PHP_EOL, "", $line);
                        $userArray = explode(",", $line);
                        array_push($users, new Usuario($userArray[0], $userArray[1], $userArray[2]));
                    }
                }
            } catch (\Throwable $th) {
                echo "Error while reading the file";
            }finally{
                fclose($file);
                return Usuario::ListUsers($users);
            }
        }
    }
?>