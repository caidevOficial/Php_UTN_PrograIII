<?php
    class File{

        /**
         * Saves the file.
         */
        public static function saveIn(String $text, $mode="csv"){
            switch ($mode) {
                case "csv":
                    $file = fopen("$this->_name.csv", "a+");
                    if ($file) {  // Si se pudo abrir el archivo
                        fwrite($file, $text);
                        fclose($file);
                    }
                    break;
            }
        }

        /**
         * Reads the file.
         * 
         */
        public static function readFrom(String $fileName){
            $file = fopen("$fileName.csv", "r");
            if ($file) {  // Si se pudo abrir el archivo
                while (!feof($file)) {
                    $line = fgetcsv($file , 0, ",");
                    echo $line;
                }
                fclose($file);
            }
        }
    }
?>