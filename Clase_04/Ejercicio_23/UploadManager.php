<?php
    class UploadManager
    {
        
        //--- Attributes ---//
        private $_DIR_TO_SAVE = 'Uploads/';
        private $_fileName;
        private $_fileExtension;
        private $_newFileName;
        private $_pathToSaveImage;

        //--- Constructor ---//
        public function __construct($array)
        {
            if (!file_exists($this->_DIR_TO_SAVE)) {
                mkdir($this->_DIR_TO_SAVE, 0777, true);
            }
            $this->saveFileIntoDir($array);
        }
        
        //--- Setters ---//

        /**
         * Set the file name of the actual file to upload.
         *
         * @param string $filename The file name of the actual file to upload.
         */
        public function setFileName($filename){
            $this->_fileName = $filename;
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
         * @param string $newFileNameArray Array with the name and extension of the new file to upload.
         */
        public function setNewFileName($newFileNameArray){
            $this->_newFileName = $newFileNameArray[0] . '_' . date('Y_m_d__H_i_s', time()) . '.' . $this->getFileExtension();
        }

        /**
         * Set the path to save the image.
         */
        public function setPathToSaveImage(){
            $this->_pathToSaveImage = $this->_DIR_TO_SAVE. $this->getNewFileName();
        }
        
        //--- Getters ---//
        
        /**
         * Get the file name of the actual file to upload.
         * @return string The file name of the actual file to upload.
         */
        public function getFileName(){
            return $this->_fileName;
        }

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

        //--- Methods ---//

        /**
         * Save the file into the directory.
         */
        public function saveFileIntoDir($array):bool{
            $success = false;
            $newFileNameArray = explode('.', $array['image']['name']);
            try {
                $this->setFileName($array['image']['name']);
                $this->setFileExtension(end($newFileNameArray));
                $this->setNewFileName($newFileNameArray);
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