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

require_once './models/Currency.php';
require_once './interfaces/IApiUsable.php';
require_once './models/UploadManager.php';

class CurrencyController extends Currency implements IApiUsable{

    public function LoadOne($request, $response, $args){
        $dirToSave = "./Currency_image/";
        $dirBackup = "./Backup/";
        $fileManager = new UploadManager($dirToSave);

        $params = $request->getParsedBody();
        $file = $request->getUploadedFiles();

        
        if (!is_null($file) && array_key_exists('name', $params)
        && array_key_exists('origin', $params)
        && array_key_exists('price', $params)) {
            $currency = Currency::createEntity($params['name'], null, $params['origin'], $params['price']);
            $fileManager->saveFileIntoDir($currency, $file);
            $picturePath = $fileManager->getPathToSaveImage();
            var_dump($picturePath);

            //TODO: Fix move image
            $currency->setImage($picturePath);
            var_dump($currency);
            $auxCrypto = Currency::getEntiyByImage($picturePath);
            if ($auxCrypto != null && $auxCrypto->getImage() == $picturePath) {
                $newPath = str_replace($dirToSave, $dirBackup, $picturePath);
                $currency->setImage($newPath);
                if (!file_exists($dirBackup)) {
                    mkdir($dirBackup, 0777, true);
                }
                $file['image']->moveTo($newPath);
            }
            
            $crypto_id = Currency::insertEntity($currency);

            if ($crypto_id > 0) {

                echo "<h2>Currency created successfully</h2><br>";
                Currency::getEntityById($crypto_id)->printSingleEntityAsTable();

                $payload = json_encode(array("message" => "Currency Inserted"));
                $response->getBody()->write("Currency created successfully");
            } else {
                $response->getBody()->write("Something failed while creating the Currency");
            }
        }else{
            $payload = json_encode(array("message" => "Parameters missing"));
        }
    
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function GetAll($request, $response, $args) {
        $entities = Currency::getAllEntities();
        echo "<h2>All the currencies</h2><br>";
        Currency::printDataAsTable($entities);

        $payload = json_encode(array("Currencies" => $entities));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function GetAllByCountry($request, $response, $args) {
        $country = $args['country'];
        
        if (isset($country)) {
            $entities = Currency::getEntitiesByCountry($country);

            echo "<h2>All the currencies from ".$country."</h2><br>";
            Currency::printDataAsTable($entities);

            $payload = json_encode(array("Currencies" => $entities));
        } else {
            $payload = json_encode(array("message" => "Parameters missing"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function GetOneByID($request, $response, $args){
        $crypto_id = $args['id'];
        $currency = Currency::getEntityById($crypto_id);
        
        if(!is_null($currency)){

            echo "<h2>Currency with ID ".$crypto_id."</h2><br>";
            $currency->printSingleEntityAsTable();

            $payload = json_encode(array("currency" => $currency));
        }else{
            $payload = json_encode(array("error" => "There is no data"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function DeleteOne($request, $response, $args){
        $crypto_id = intval($args['id']);
        $currency = Currency::getEntityById($crypto_id);
        if (isset($currency) && Currency::deleteEntity($currency) > 0) {
            echo "<h2>Currency with ID ".$crypto_id." deleted successfully</h2><br>";
            $currency->printSingleEntityAsTable();

            $payload = json_encode(array("message" => "Entity deleted"));
            $response->getBody()->write("Entity deleted successfully");
        } else {
            $payload = json_encode(array("message" => "Error Deleting"));
            $response->getBody()->write("Something failed while deleting the Entity");
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function ModifyOne($request, $response, $args){
        $dirToSave = "./images/";
        $dirBackup = "./backup/photos/";
        UploadManager::createDirIfNotExists($dirBackup);
        $fileManager = new UploadManager($dirToSave);
        $fileManager->setDirectoryBackup($dirBackup);
        
        $params = $request->getParsedBody();
        
        $id = $args['id'];
        var_dump($id);


        if (isset($id)) {
            $crypto_id = $id;
            var_dump($crypto_id);
            $currency = Currency::getEntityById($crypto_id);

            echo "<h2>Currency before Modify</h2><br>";
            $currency->printSingleEntityAsTable();
            
            // Gets the new data
            $currency_name = $params['name'];
            $currency_image = $params['image'];
            $currency_origin = $params['origin'];
            $currency_price = $params['price'];
            
            // Sets the new data
            $currency->setName($currency_name);
            $currency->setImage($currency_image);
            $currency->setOrigin($currency_origin);
            $currency->setPrice($currency_price);

            $rows = Currency::updateEntity($currency);
            if ($rows > 0) {
                echo "<h2>Currency after Modify</h2><br>";
                $currency->printSingleEntityAsTable();

                $payload = json_encode(array("mensaje" => "Crypto updated"));
                $response->getBody()->write("Crypto updated successfully");
            }else{
                $response->getBody()->write("Something failed while updating the Crypto");
            }
        }else{
            $payload = json_encode(array("error" => "Parameters missing"));
        }
        
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
