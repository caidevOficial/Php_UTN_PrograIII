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

require_once './interfaces/IApiUsable.php';
require_once './models/Table.php';

class TableController extends Table implements IApiUsable{

    /**
     * Saves a Table in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerUno($request, $response, $args){
        $params = $request->getParsedBody();
        $id = $params['table_id'];
        $table = Table::getTableById($id);
        $table->printSingleEntityAsTable();
        $payload = json_encode($table);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Table from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function TraerTodos($request, $response, $args){
        $tables = Table::getAllTables();

        echo 'Tables: <br>';
        Table::printEntitiesAsTable($tables);

        $payload = json_encode(array("Tables" => $tables));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets a Dish from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function CargarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $table = Table::createTable($params['table_code'], $params['employee_id'], $params['state']);
        
        $payload = json_encode($table);
        $table_id = Table::insertTable($table);
        if($table_id > 0){
            echo 'Table Created: <br>';
            $table->setId($table_id);
            $table->printSingleEntityAsTable();
            $payload = json_encode(array("mensaje" => "Mesa creado con exito"));
            $response->getBody()->write("Table created successfully");
        }
        else{
            $response->getBody()->write("Something failed while creating the Table");
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');

    }

    /**
     * Deletes a Dish from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function BorrarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $id = $params['table_id'];
        $table = Table::getTableById($id);
        $payload = json_encode($table);
        if(isset($table) && Table::deleteTable($id) > 0){
            $payload = json_encode(array("mensaje" => "Table deleted successfully"));
        }else{
            $payload = json_encode(array("mensaje" => "Error While deleting the table."));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Modifies a Table in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function ModificarUno($request, $response, $args){

        $params = $request->getParsedBody();
        
        //? Shows all the tables
        $this->TraerTodos($request, $response, $args);
        
        if (isset($params['table_id']) && isset($params['Status']) && isset($params['EmployeeId'])) {
            $tableid = $params['table_id'];
            $employeeid = $params['EmployeeId'];

            $status = $params['Status'];

            $employee = Employee::getEmployeeById($employeeid);
            
            if (isset($employee) && isset($tableid) && strcmp($status, "Cerrada") != 0) {
                $table = Table::getTableById($tableid);
                $table->setState($status);
                $table->setEmployeeId($params['EmployeeId']);
                echo 'Table selected: <br>';
                $table->printSingleEntityAsTable();
            }else{
                echo '<h2>Invalid Action, check the parameters.</h2><br>';
            }
        }
        
        if (isset($table) && Table::updateTable($table) > 0) {
            $payload = json_encode(array("mensaje" => "Table updated successfully"));
        }else{
            $payload = json_encode(array("mensaje" => "Something failed while updating the Table"));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Sets the status of the table to "Con Cliente Pagando" if exists.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function CobrarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $payload = json_encode(array("mensaje" => "Something failed while updating the Table"));

        if(!isset($params['table_id']) && !isset($params['table_status'])){
            $tables = Table::getAllTables();
            echo 'All Tables: <br>';
            Table::printEntitiesAsTable($tables);
        }

        if(isset($params['table_id']) && isset($params['table_status'])){
            $id_table = $params['table_id'];
            $table_status = $params['table_status'];
            $table = Table::getTableById($id_table);

            echo 'Table selected: <br>';
            $table->printSingleEntityAsTable();

            if(isset($table)){
                $table->setState($table_status);
                echo 'Table updated: <br>';
                $table->printSingleEntityAsTable();
                if(Table::updateTable($table) > 0){
                    $payload = json_encode(array("mensaje" => "Table updated successfully"));
                }
            }
        }
        
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Modifies a Table in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function ModificarUnoAdmin($request, $response, $args){

        $params = $request->getParsedBody();
        
        //? Shows all the tables
        $this->TraerTodos($request, $response, $args);
        
        if (isset($params['table_id']) && isset($params['Status'])) {
            $tableid = $params['table_id'];
            $status = $params['Status'];

            if (isset($tableid)) {
                $table = Table::getTableById($tableid);
                
                echo 'Table selected: <br>';
                $table->printSingleEntityAsTable();

                if(strcmp($table->getState(), "Cerrada") == 0 
                && strcmp($status, "Cerrada") == 0){
                    echo '<h2>The table is already closed.</h2><br>';
                }else{
                    $table->setState($status);
                    echo 'Table Modified to: <br>';
                $table->printSingleEntityAsTable();
                }
            }else{
                echo '<h2>Invalid Action, check the parameters.</h2><br>';
            }
        }
        
        if (isset($table) && Table::updateTable($table) > 0) {
            $payload = json_encode(array("mensaje" => "Table updated successfully"));
        }else{
            $payload = json_encode(array("mensaje" => "Something failed while updating the Table"));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets the max waiting time of a specific order and table.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerDemoraPedidoMesa($request, $response, $args){

        $table_code = $args['table_code'];
        $order_id = $args['order_id'];
        $delay = Order::getMaxTimeOrderByTableCode($order_id, $table_code)[0]['time_order'];
        if ($delay == 0){
            echo '<h2>Table Code: '.$table_code.'<br>Waiting Time: '.$delay.' minutes.</h2>
            <h2>Your order is ready, it will be dispatched shortly. Thanks for choosing us, Bon Appetit</h2><br>';
        }else{
            echo '<h2>Table Code: '.$table_code.'<br>Order Will be ready in aprox: '.$delay.' minutes.</h2><br>';
        }
        $payload = json_encode(array("mensaje" => "Waiting Time: ".$delay." minutes"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
?>