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



require_once './models/Sale.php';
require_once './models/UploadManager.php';
require_once './interfaces/IApiUsable.php';

class SaleController extends Sale implements IApiUsable{

    public function LoadOne($request, $response, $args) {
        
        $directory = "./CryptoPictures/";
        $fileManager = new UploadManager($directory);

        $params = $request->getParsedBody();
        $file = $request->getUploadedFiles();

        if(array_key_exists('crypto_name', $params)
            && array_key_exists('amount', $params)
            && array_key_exists('customer', $params)
            && array_key_exists('user', $params)){
            
            $sale = Sale::createEntity(
                date('Y-m-d H:i:s'), 
                $params['crypto_name'], 
                $params['amount'], 
                $params['customer'], 
                $params['user']);

            $fileManager->saveFileIntoDir($sale, $file);
            $sale->setImage($fileManager->getNewFileName());
            var_dump($sale);
                $sale_id = Sale::insertEntity($sale);
            if ($sale_id > 0) {

                $sale = Sale::getEntityById($sale_id);
                echo "<h2>Sale created successfully</h2><br>";
                $sale->printSingleEntityAsTable();

                $payload = json_encode(array("message" => "Sale Inserted"));
                $response->getBody()->write("Sale created successfully");
            }else {
                $response->getBody()->write("Something failed while creating the Sale");
            }
        }else{
            $payload = json_encode(array("message" => "Parameters missing"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function GetOneById($request, $response, $args){
        
    }

    public function GetAllByCountry($request, $response, $args) {
        $country = $args['country'];
        $dateFrom = $args['from'];
        $dateTo = $args['to'];

        $sales = Sale::getEntitiesByCountryBetween($country, $dateFrom, $dateTo);
        if (!is_null($sales)) {

            echo "<h2>Sales found</h2><br>";
            Sale::printDataAsTable($sales);

            $payload = json_encode(array("Sales" => $sales));
        }else{
            $payload = json_encode(array("message" => "Sales not found"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function GetAllByCryptoName($request, $response, $args) {
        $params = $args['crypto_name'];

        $users = User::getEntitiesByCrypto($params);
        if (!is_null($users)) {

            echo "<h2>Users that bough ".$params."</h2><br>";
            User::printDataAsTable($users);

            $payload = json_encode(array("Users" => $users));
        }else{
            $payload = json_encode(array("message" => "Users not found"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function GetAll($request, $response, $args) {
        $sales = Sale::getAllEntities();
        if (isset($sales)) {

            echo "<h2>Sales found</h2><br>";
            Sale::printDataAsTable($sales);
            
            $payload = json_encode(array("Sales" => $sales));
        }else{
            $payload = json_encode(array("message" => "Sales not found"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function DeleteOne($request, $response, $args) {}

    public function ModifyOne($request, $response, $args){}
}
