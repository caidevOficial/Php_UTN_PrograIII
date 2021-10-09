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
}
?>