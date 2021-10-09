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

class UploadManager{

    //--- Attributes ---//
    private $_DIR_TO_SAVE;
    private $_fileExtension;
    private $_newFileName;
    private $_pathToSaveImage;

    //--- Constructor ---//

    /**
     * Instance and upload a file for 'Venta' or 'Pizza' class.
     * @param string $dirToSave The directory where the file will be saved.
     * @param Venta $venta The object of 'Venta' or 'Pizza' class.
     * @param array $array The array with the file information.
     */
    public function __construct($dirToSave, $venta, $array){
        $this->createDirIfNotExists($dirToSave);
        $this->setDirectoryToSave($dirToSave);
        $this->saveFileIntoDir($venta, $array);
    }
    
    //--- Setters ---//

    /**
     * Sets the directory to save the file.
     *
     * @param string $dirToSave The directory to save the file.
     */
    public function setDirectoryToSave($dirToSave){
        $this->_DIR_TO_SAVE = $dirToSave;
    }

    /**
     * Set the extension of the actual file to upload.
     *
     * @param string $fileExtension The extension of the actual file to upload.
     */
    public function setFileExtension($fileExtension){
        $this->_fileExtension = $fileExtension;
    }

    /**
     * Set the new file name of the actual file to upload.
     *
     * @param string $newFileName The new name of the actual file to upload.
     */
    public function setNewFileName($newFileName){
        $this->_newFileName = $newFileName;
    }

    /**
     * Set the path to save the image.
     */
    public function setPathToSaveImage(){
        $this->_pathToSaveImage = $this->getDirectoryToSave().$this->getNewFileName().'.'.$this->getFileExtension();
    }
    
    //--- Getters ---//
    
    /**
     * Get the extension of the actual file to upload.
     * @return string The extension of the actual file to upload.
     */
    public function getFileExtension(){
        return $this->_fileExtension;
    }

    /**
     * Get the new file name of the actual file to upload.
     * @return string The new file name of the actual file to upload.
     */
    public function getNewFileName(){
        return $this->_newFileName;
    }

    /**
     * Get the path to save the image.
     * @return string The path to save the image.
     */
    public function getPathToSaveImage(){
        return $this->_pathToSaveImage;
    }

    /**
     * Gets the directory where the file is going to be saved.
     * @return string The directory where the file is going to be saved.
     */
    public function getDirectoryToSave(){
        return $this->_DIR_TO_SAVE;
    }

    //--- Methods ---//

    /**
     * If not exists the directory to save the file, it creates it.
     * @param string $dirToSave The directory to save the file.
     */
    private function createDirIfNotExists($dirToSave){
        if (!file_exists($dirToSave)) {
            mkdir($dirToSave, 0777, true);
        }
    }

    /**
     * Save the file into the directory.
     */
    public function saveFileIntoDir($obj, $array):bool{
        $success = false;
        
        $newFileNameArray = explode('.', $array['image']['name']);
        try {
            if(get_class($obj) == "Pizza"){
                $this->setNewFileName($obj->getTipo()."_".$obj->getSabor());
            }else{
                $userEmail = explode('@', $obj->getUserEmail())[0];
                $this->setNewFileName($obj->getPizzaType().'_'.$obj->getPizzaFlavor().'_'.$userEmail.'_'.$obj->getDate());
            }
            $this->setFileExtension(end($newFileNameArray));
            $this->setPathToSaveImage();
            if ($this->moveUploadedFile($array['image']['tmp_name'])) {
                $success = true;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }finally{
            return $success;
        }
    }

    /**
     * Move the file to the directory.
     *
     * @param string $tmpFileName The temporary file name to been saved.
     */
    public function moveUploadedFile($tmpFileName){
        return move_uploaded_file($tmpFileName, $this->getPathToSaveImage());
    }
}

?>