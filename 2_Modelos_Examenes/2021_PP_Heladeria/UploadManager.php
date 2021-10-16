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
    public function __construct($dirToSave, $venta, $array)
    {
        if (!file_exists($dirToSave)) {
            mkdir($dirToSave, 0777, true);
        }
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
     * Save the file into the directory.
     */
    public function saveFileIntoDir($venta, $array):bool{
        $success = false;
        $userEmail = explode('@', $venta->getUserEmail())[0];
        $newFileNameArray = explode('.', $array['Image']['name']);
        try {
            if(isset($array)){
                $this->setNewFileName($venta->getType().'_'.$venta->getFlavor().'_'.$userEmail.'_'.$venta->getDate());
                //$this->setFileExtension(end($newFileNameArray));
                $this->setFileExtension('png');
                $this->setPathToSaveImage();
                if ($this->moveUploadedFile($array['Image']['tmp_name'])) {
                    $success = true;
                }
            }else{
                echo '<h3>Error while loading the image.</h3><br>';
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