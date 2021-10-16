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
    public function __construct($dirToSave, $object, $array)
    {
        self::createDirIfNotExists($dirToSave);
        $this->setDirectoryToSave($dirToSave);
        $this->saveFileIntoDir($object, $array);
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
     * Set the extension of the actual file to upload. Default is png.
     *
     * @param string $fileExtension The extension of the actual file to upload.
     */
    public function setFileExtension($fileExtension = 'png'){
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
     * Gets the fullpath of the image of an specific sale.
     * @param Venta $venta Venta class to take the neccessary data.
     * @return string The fullpath of the image of the Sale as a string.
     */
    public static function getSalesImageName($obj){
        $fullpath = $obj->getType().'_'.$obj->getFlavor().'_'
        .explode('@', $obj->getUserEmail())[0].'_'.$obj->getDate().'.png';
        return $fullpath;
    }

    /**
     * If not exists the directory to save the file, it creates it.
     * @param string $dirToSave The directory to save the file.
     */
    private static function createDirIfNotExists($dirToSave){
        if (!file_exists($dirToSave)) {
            mkdir($dirToSave, 0777, true);
        }
    }

    /**
     * Save the file into the directory.
     */
    public function saveFileIntoDir($obj, $array):bool{
        $success = false;
        
        $newFileNameArray = explode('.', $array['Image']['name']);
        try {
            if(is_a($obj, 'Helado')){
                $this->setNewFileName($obj->getType()."_".$obj->getFlavor());
            }else{
                $userEmail = explode('@', $obj->getUserEmail())[0];
                $this->setNewFileName($obj->getType().'_'.$obj->getFlavor().'_'.$userEmail.'_'.$obj->getDate());
            }
            $this->setFileExtension();
            $this->setPathToSaveImage();
            if ($this->moveUploadedFile($array['Image']['tmp_name'])) {
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

    /**
     * Moves an image from a directory to another.
     * @param string $oldDir The directory where the image is allocated.
     * @param string $newDir The new directory where the image will be allocate.
     * @param string $imageName The name of the image to be moved.
     * @return bool True if can move the image, false otherwise.
     */
    public static function moveImageFromTo($oldDir, $newDir, $fileName){
        self::createDirIfNotExists($newDir);
        return rename($oldDir.$fileName, $newDir.$fileName);
    }
}

?>