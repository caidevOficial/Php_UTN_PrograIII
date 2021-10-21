<?php
/**
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * You should have received a copy of the MIT license
 * along with this program.  If not, see <https://opensource.org/licenses/MIT>.
 *
 * @author Facundo Falcone <CaidevOficial> 
 */

class Devolucion{

    //--- Attributes ---//
    public $_idSale;
    public $_text;

    //--- Constructor ---//

    /**
     * Devolucion constructor.
     */
    public function __construct(){}

    //--- Getters ---//

    /**
     * Gets the id of the Devolution.
     * @return int The id of the Devolution.
     */
    public function getIdDevolution(){
        return $this->_idSale;
    }

    /**
     * Gets the text of the Devolution.
     * @return string The text of the Devolution.
     */
    public function getText(){
        return $this->_text;
    }

    //--- Setters ---//

    /**
     * Sets the id of the Devolution.
     * @param int $idDevolution The id of the Devolution.
     */
    public function setIdDevolution($idDevolution){
        if(is_numeric($idDevolution)){
            $this->_idSale = $idDevolution;
        }
    }

    /**
     * Sets the text of the Devolution.
     * @param string $text The text of the Devolution.
     */
    public function setText($text){
        if(is_string($text)){
            $this->_text = $text;
        }
    }

    //--- Methods ---//
    /**
     * Creates a new instance of Devolucion.
     * @param int $idSale The id of the sale to make the 'Devolucion'.
     * @param string $text The text of the Devolucion's causes.
     * @return Devolucion An instance of Devolucion.
     */
    public static function CreateDevolucion($idSale, $text){
        $return = new Devolucion();
        $return->setIdDevolution(intval($idSale));
        $return->setText($text);
        return $return;
    }

    //--- File Handlers ---//
    /**
     * Reads a json file and returns a list of Devolucion objects.
     * @param string $filename The file to read.
     * @return array An array of Devolucion objects.
     */
    public static function readJson($filename = 'Devoluciones.json'){
        $arrayObjects = array();
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            try{
                $json = fread($file, filesize($filename));
                $array = json_decode($json, true);
                foreach ($array as $newObject) {
                        $myObject = Devolucion::CreateDevolucion(
                            $newObject['_idSale'],
                            $newObject['_text']
                        );
                    array_push($arrayObjects, $myObject);
                }
            }catch(\Throwable $e){
                echo $e->getMessage();
            }finally{
                fclose($file);
            }
        }

        return $arrayObjects;
    }

    /**
     * Writes the json file with the array of 'Devolucion'.
     * @param array $arrayObjects Array of 'Devolucion'.
     * @param string $fileName Name of the json file.
     * @return bool True if the file was written, false if not.
     */
    public static function writeJson($arrayObjects, $filename = 'Devoluciones.json'):bool{
        $success = false;
        try{
            $file = fopen($filename, 'w');
            $json = json_encode($arrayObjects, JSON_PRETTY_PRINT);
            fwrite($file, $json);
            
            $success = true;
        }catch(\Throwable $e){
            echo $e->getMessage();
        }finally{
            fclose($file);
            return $success;
        }
    }

    /**
     * Adds a new 'Devolucion' to the json file.
     *
     * @param Devolucion $object 'Devolucion' to add.
     * @param string $filename Name of the json file.
     * @return boolean True if the 'Devolucion' was added, false if not.
     */
    public static function updateFile($object, $filename = 'Devoluciones.json'){
        $arrayObjects = Devolucion::readJson($filename);
        array_push($arrayObjects, $object);
        return Devolucion::writeJson($arrayObjects, $filename);
    }

    //--- Information ---//
    /**
     * Prints the 'Devolucion' information as a table content.
     */
    private function printDevolutionsAsTableContent(){
        echo '<td>['.$this->getIdDevolution().']</td>';
        echo '<td>['.$this->getText().']</td>';
    }

    /**
     * Prints the 'Devolucion' information as a table.
     * @param array $arrayDevolutions Array of 'Devolucion' objects.
     */
    public static function printDevolutionsAsTable($arrayDevolutions){
        echo '<table>';
        echo '<th>[ID_Return]</th><th>[Return Causes]</th>';
        foreach($arrayDevolutions as $devolution){
            echo "<tr align='center'>";
            $devolution->printDevolutionsAsTableContent();
            echo '</tr>';
        }
        echo '</table>';
    }

    /**
     * Prints the 'Devolucion' & Coupons information as a table.
     * @param array $arrayDevoluciones Array of 'Devolucion' objects.
     * @param array $arrayCoupons Array of 'Coupon' objects.
     */
    public static function printDevolutionsAndCouponsAsTable($arrayDevoluciones, $arrayCoupons){
        echo '<table>';
        echo '<th>[ID_Return]</th><th>[Return Causes]</th><th>[ID_Coupon]</th><th>[Used Status]</th>';
        foreach($arrayDevoluciones as $devolution){
            echo "<tr align='center'>";
            $devolution->printDevolutionsAsTableContent();
            Coupon::getCouponByID($devolution->getIdDevolution(), $arrayCoupons)->printCouponAsATableContent();
            echo '</tr>';
        }
        echo '</table>' ;
    }
}
?>