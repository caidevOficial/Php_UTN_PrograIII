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
 
class User{
    
    //--- Attributes ---
    public $_id;
    public $_name;
    public $_surname;
    public $_password;
    public $_email;
    public $_registerDate;
    public $_photoName;

    //--- Constructor ---
    /**
     * Creates an object of type Usuario.
     * @param string $name The name of the user.
     * @param string $password The password of the user.
     * @param string $email The email of the user.
     */
    public function __construct($id, $name, $surname, $password, $email, $registerDate, $photoName){
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setRegisterDate($registerDate);
        $this->setPhotoName($photoName);
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
     * Sets the surname of the user.
     * @param string $surname The surname of the user.
     */
    public function setSurname($surname){
        if (is_string($surname) && !empty($surname)) {
            $this->_surname = $surname;
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
    public function setRegisterDate($registerDate){
        if (is_string($registerDate) && !empty($registerDate)) {
            $this->_registerDate = $registerDate;
        }
    }

    /**
     * Sets the photo name of the user.
     *
     * @param string $photoName The photo name of the user.
     */
    public function setPhotoName($photoName)
    {
        if (is_string($photoName) && !empty($photoName)) {
            $this->_photoName = $photoName;
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
     * Returns the surname of the user.
     *
     * @return string The surname of the user.
     */
    public function getSurname(){
        return $this->_surname;
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

    /**
     * Returns the photo name of the user.
     *
     * @return string The photo name of the user.
     */
    public function getPhotoName(){
        return $this->_photoName;
    }

    //--- Methods ---
    /**
     * Returns the name of the user.
     * @return string The name of the user.
     */
    public static function MostrarUsuario(String $usuario){
        echo "El usuario es: ".$Usuario->usuario;
    }

    //--- Regarding Open or Read ---

    /**
     * Reads a json file with information of the users.
     *
     * @param string $filename The name of the file to be opened.
     * @return array The array with the information of the users.
     */
    private function openJSON($filename="Users.json"){
        $users = array();
        $file = fopen($filename, "r");
        if ($file) {
            $json = fread($file, filesize($filename));
            $users = json_decode($json, true);
        }
        fclose($file);
        return $users;
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
            if (file_exists($filename)) {                  
                $file = fopen($filename, "r");
                if ($file) {
                    $json = fread($file, filesize($filename));
                    $usersFromJson = json_decode($json, true);
                    foreach ($usersFromJson as $user) {
                        array_push($users, new User($user["_id"], $user["_name"], $user["_surname"], $user["_password"], $user["_email"], $user["_registerDate"], $user["_photoName"]));
                        //$users = array_merge($users, $user);
                    }
                }
                fclose($file);
            } 
        }catch (\Throwable $th) {
            echo "Error while reading the file";
        } 
        finally {
            return $users;
        }
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

    //--- Regarding Save or Write ---

    /**
     * Saves a file with the information of the user.
     * @return boolean True if the file was saved successfully, false otherwise.
     */
    public function GuardarCSV():bool{
        $success = false;
        try {
            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) {
                $rows = fwrite($archivo, $this->getName().",".$this->getPassword().",".$this->getEmail().PHP_EOL);
                if ($rows > 0) {
                    $success = true;
                }
            }
        } catch (\Throwable $th) {
            echo "Error al guardar el archivo";
        }finally{
            fclose($archivo);
        }

        return $success;
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
                //var_dump($usersArray);
                $json = json_encode($usersArray, JSON_PRETTY_PRINT);
                //echo $json . '<br>';
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

    //--- Regarding Prints Data ---

    /**
     * Prints the information of the users.
     *
     * @param array $arrayUsers The array with the information of the users.
     */
    public static function PrintsInfoOfUsers($arrayUsers = array()){
        echo "<ul>";
        try {
            if (!empty($arrayUsers)) {
                foreach ($arrayUsers as $user) {
                    echo "<li>".$user->UserData()."</li>";
                }
            }
        } catch (\Throwable $th) {
            echo 'Exception: '.$th->getMessage();
        }finally{
            echo "</ul>";
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

    /**
     * Checks if there are an error regarding the json file.
     *
     * @return string The error message.
     */
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

    /**
     * Prints the full information of the users.
     *
     * @param array $users The array with the information of the users.
     * @return boolean True if the array was read successfully, false otherwise.
     */
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
     * Gets a part of the information of the user.
     *
     * @return string The information of the user.
     */
    public function UserData(){
        return $this->getSurname().",".$this->getName().",".$this->getPhotoName();
    }
}
?>