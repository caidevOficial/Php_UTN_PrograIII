<?php
    class Usuario{
        
        //--- Attributes ---
        public $_id;
        public $_name;
        public $_password;
        public $_email;
        public $_registerDate;

        //--- Constructor ---
        /**
         * Creates an object of type Usuario.
         * @param string $name The name of the user.
         * @param string $password The password of the user.
         * @param string $email The email of the user.
         */
        public function __construct($id, $name, $password, $email, $registerDate){
            $this->setId($id);
            $this->setName($name);
            $this->setPassword($password);
            $this->setEmail($email);
            $this->setRegisterDate($registerDate);
        }

        //--- Setters ---

        /**
         * Sets the name of the user.
         * @param string $name The name of the user.
         */
        public function setName($name){
            if (is_string($name) && !empty($name)) {
                $this->_name = $name;
            }
        }

        /**
         * Sets the password of the user.
         * @param string $password The password of the user.
         */
        public function setPassword($password){
            if (is_string($password) && !empty($password)) {
                $this->_password = $password;
            }
        }

        /**
         * Sets the email of the user.
         * @param string $email The email of the user.
         */
        public function setEmail($email){
            if (is_string($email) && !empty($email)) {
                $this->_email = $email;
            }
        }

        /**
         * Sets the id of the user.
         *
         * @param int $id The id of the user.
         */
        public function setId($id){
            if (is_int($id) && !empty($id)) {
                $this->_id = $id;
            }
        }

        /**
         * Sets the register date of the user.
         *
         * @param String $registerDate The register date of the user.
         */
        function setRegisterDate($registerDate){
            if (is_string($registerDate) && !empty($registerDate)) {
                $this->_registerDate = $registerDate;
            }
        }

        //--- Getters ---

        /**
         * Returns the name of the user.
         * @return string The name of the user.
         */
        public function getName(){
            return $this->_name;
        }

        /**
         * Returns the password of the user.
         * @return string The password of the user.
         */
        public function getPassword(){
            return $this->_password;
        }

        /**
         * Returns the email of the user.
         * @return string The email of the user.
         */
        public function getEmail(){
            return $this->_email;
        }

        /**
         * Returns the id of the user.
         * @return int The id of the user.
         */
        public function getId(){
            return $this->_id;
        }

        /**
         * Returns the register date of the user.
         * @return string The register date of the user.
         */
        public function getRegisterDate(){
            return $this->_registerDate;
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

        private static function ListUsers($users):bool{
            $success = false;
            echo "<ul>";
            foreach ($users as $user) {
                echo "<li>".$user->getId()."</li>";
                echo "<li>".$user->getName()."</li>";
                echo "<li>".$user->getPassword()."</li>";
                echo "<li>".$user->getEmail()."</li>";
                echo "<li>".$user->getRegisterDate()."</li>";
                $success = true;
            }
            echo "</ul>";

            return $success;
        }


        /**
         * Reads a file with information of the users.
         * @return array The array with the information of the users.
         */
        public static function ReadCSV($filename="usuarios.csv"){
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

        /**
         * Saves a file with the information of the users.
         *
         * @param array $usersArray The array with the information of the users.
         * @param string $filename The name of the file.
         * @return boolean True if the file was saved successfully, false otherwise.
         */
        public function SaveToJSON($usersArray, $filename="Users.json"):bool{
            $success = false;
            try {
                $file = fopen($filename, "w");
                if ($file) {
                    var_dump($usersArray);
                    $json = json_encode($usersArray, JSON_PRETTY_PRINT);
                    echo $json . '<br>';
                    fwrite($file, $json);
                    $success = true;
                }
            } catch (\Throwable $th) {
                echo "Error al guardar el archivo";
            } finally {
                fclose($file);
                return $success;
            }
        }

        /**
         * Reads a file with information of the users.
         *
         * @param string $filename The name of the file to read.
         * @return array The array with the information of the users.
         */
        public static function ReadJSON($filename="Users.json"):array{
            $users = array();
            
            try {
                $file = fopen($filename, "r");
                if ($file) {
                    $json = fread($file, filesize($filename));
                    $users = json_decode($json, true);

                }
            } catch (\Throwable $th) {
                echo "Error while reading the file";
            } finally {
                fclose($file);
                return $users;
            }
        }

        /**
         * Validates if a user exist in the file.
         * @return boolean True if the user exist, false otherwise.
         */
        public static function ValidateUser($email, $password):bool{
            $success = false;
            $users = array();
            try {
                $users = Usuario::ReadCSV();
                if ($users) {
                    foreach ($users as $user) {
                        if ($user->getEmail() == $email && $user->getPassword() == $password) {
                            $success = true;
                        }
                    }
                }
            } catch (\Throwable $th) {
                echo "Error while reading the file";
            } finally {
                return $success;
            }
        }

        public function errorMessageOfJSON(){
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    return "No ha ocurrido ningún error";
                case JSON_ERROR_DEPTH:
                    return "Se ha excedido la profundidad máxima de la pila.";
                case JSON_ERROR_STATE_MISMATCH:
                    return "Error por desbordamiento de buffer o los modos no coinciden";
                case JSON_ERROR_CTRL_CHAR:
                    return "Error del carácter de control, posiblemente se ha codificado de forma incorrecta.";
                case JSON_ERROR_SYNTAX:
                    return "Error de sintaxis.";
                case JSON_ERROR_UTF8:
                    return "Caracteres UTF-8 mal formados, posiblemente codificados incorrectamente.";
                case JSON_ERROR_RECURSION:
                    return "El objeto o array pasado a json_encode() incluye referencias recursivas y no se puede codificar.";
                case JSON_ERROR_INF_OR_NAN:
                    return "El valor pasado a json_encode() incluye NAN (Not A Number) o INF (infinito)";
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    return "Se proporcionó un valor de un tipo no admitido para json_encode(), tal como un resource.";
                default:
                    return "Error desconocido";
            }
        }
    }
?>