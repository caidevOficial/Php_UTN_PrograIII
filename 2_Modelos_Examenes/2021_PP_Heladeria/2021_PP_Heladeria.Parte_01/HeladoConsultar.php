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

require_once 'Helado.php';

    if(isset($_POST['Sabor']) && isset($_POST['Tipo'])){
        $hFlavor = $_POST['Sabor'];
        $hType = $_POST['Tipo'];
        var_dump(key($_POST));

        //--- Gets the old array of objects from the file. ---//
        $myArray = Helado::ReadJSON();

        echo '<h1>Helado a Buscar</h1><br>';
        echo '<h2> Sabor: '.$hFlavor.' | Tipo: '.$hType.'</h2><br>';

        //--- search the object in the array. ---//
        echo '<h3>Resultado de la Busqueda: de '.$hFlavor.' y '.$hType.'</h3>';
        echo '<h3>'.Helado::SearchFor($myArray, $hFlavor, $hType).'</h3> <br>';
    } 
?>