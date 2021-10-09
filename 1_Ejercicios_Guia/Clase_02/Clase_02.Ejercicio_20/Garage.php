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

/**
 * Crear la clase Garage que posea como atributos privados:
 * _razonSocial (String)
 * _precioPorHora (Double)
 * _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
 * Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
 * i. La razón social.
 * ii. La razón social, y el precio por hora.
 * Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
 * que mostrará todos los atributos del objeto.
 * Crear el método de instancia “Equals” que permita comparar al
 * objeto de tipo Garaje con un objeto de tipo Auto. Sólo devolverá TRUE
 * si el auto está en el garaje. Crear el método de instancia “Add” para
 * que permita sumar un objeto “Auto” al “Garage” (sólo si el auto no está
 * en el garaje, de lo contrario informarlo). Ejemplo: $miGarage->Add($autoUno);
 * Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
 * “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
 * Ejemplo: $miGarage->Remove($autoUno);
 * En testGarage.php, crear autos y un garage. Probar el buen funcionamiento
 * de todos los métodos.
 *
 * @author Facu Falcone
 */

require "Auto.php";

class Garage{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    /**
     * Constructor of Garage Class
    */
    public function __construct($razonSocial, $precioPorHora=50){
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }

    /**
     * Show all 'cars' of Garage Class.
    */
    public function getAutos(){
        return $this->_autos;
    } 

    /**
     * Show Garage
    */
    public function MostrarGarage(){
        echo "<br>Razon Social: " . $this->_razonSocial;
        echo "<br>Precio por hora: " . $this->_precioPorHora;
        echo "<br>Autos: ";
        foreach ($this->_autos as $auto) {
            echo "<br>";
            Auto::MostrarAuto($auto);
        }
    }

    /**
     * Returns TRUE if the auto is in the garage and FALSE if not.
    *
    * @param Auto $auto A car to check if it is in the garage.
    */
    public function Equals($auto){
        foreach ($this->_autos as $autoGarage) {
            if ($autoGarage->Equals($auto)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Add a car to the garage if it is not in the garage.
    *
    * @param Auto $auto A car to add to the garage.
    */
    public function Add($auto){
        if (count($this->_autos)==0 || !$this->Equals($auto)) {
            array_push($this->_autos, $auto);
        }
    }

    /**
     * Remove a car from the garage if it is in the garage.
    *
    * @param Auto $auto A car to remove from the garage.
    */
    public function Remove($auto){
        if (count($this->_autos) > 0 && $this->Equals($auto)) {
            foreach ($this->_autos as $key => $autoGarage) {
                if ($autoGarage->Equals($auto)) {
                    unset($this->_autos[$key]);
                }
            }
        } else {
            echo "<br>El auto no esta en el garage, no se puede eliminar.";
        }
    }

    /**
     * Gets the data of the garage as a string.
    *
    * @return string The data of the garage as a string.
    */
    public function GarageGetData(){
    $stringCars = $this->_razonSocial . "," . $this->_precioPorHora .PHP_EOL;
    foreach ($this->getAutos() as $auto) {
        $stringCars .= $auto->CartoRow();
    }
        
        return $stringCars;
    }

    /**
     * Saves a garage to a csv file.
    *
    * @param string $fileName The name of the file to save the garage.
    */
    public static function GarageToCSV($garage, $file="Garage.csv"){
    $file = fopen($file, "w");
    fwrite($file, $garage->GarageGetData()); 
    fclose($file);
    }

    /**
     * Load a garage from a CSV file.
    *
    * @param String $file The file to load the garage from.
    */
    public static function CSVtoGarage($file="Garage2.csv"): Garage{
    $counter = 0;
        $file = fopen($file, "r");
        while (!feof($file)) {
        $line = fgets($file);
        if (!empty($line)){
            $line = str_replace(PHP_EOL, '', $line);
            $data = explode(',', $line);
            if($counter == 0){
                $garage = new Garage($data[0], $data[1]);
            }else{
                $auto = new Auto($data[0], $data[1], $data[2], $data[3]);
                $garage->Add($auto);
            }
            $counter++;
        }
    }         
        fclose($file);

        return $garage;
    }
}
?>