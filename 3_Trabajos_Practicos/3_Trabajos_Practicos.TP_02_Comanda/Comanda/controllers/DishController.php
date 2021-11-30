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
require_once './models/Area.php';
require_once './models/Dish.php';
require_once './models/Order.php';

class DishController extends Dish implements IApiUsable{

    /**
     * Saves a Dish in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerUno($request, $response, $args){
        $params = $request->getParsedBody();
        $id = $params['Id'];
        $dish = Dish::getDishById($id);
        $payload = json_encode($dish);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Dish from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function TraerTodos($request, $response, $args){
        
        $employee_type = UserController::GetInfoByToken($request)->User_Type;
        $employee_type_id = Area::getAreaByJobs($employee_type);
        $dishes = Dish::getDishesByUserType($employee_type_id);
        $dishesToPrint = array();

        foreach ($dishes as $dish) {
            if($dish->getDishStatus() != 'Listo Para Servir'){
                array_push($dishesToPrint, $dish);
            }
        }

        echo 'Dishes Pendant/ In Preparation for Position: ['.$employee_type.']<br>';
        Dish::printEntitiesAsTable($dishesToPrint);

        $payload = json_encode(array("Dishes" => $dishes));
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
        $area = $params['Area'];
        $order_id = $params['Order_Associated'];
        $area = Area::getAreaByName($area);
        $order = Order::getOrderById($order_id);
        $dish = Dish::createDish(
            $area->getAreaId(), 
            $order->getId(), 
            $order->getOrderStatus(), 
            $params['Description'], 
            $params['Cost'], 
            date("Y-m-d H:i:s")
        );
        
        echo 'Dish Created: <br>';
        $dish->printSingleEntityAsTable();

        $payload = json_encode($dish);
        if(Dish::insertDish($dish) > 0){

            //? Get the order associated with the dish to update the price of the order.
            $order_id = $params['Order_Associated'];
            $order = Order::getOrderById($order_id);
            $order_cost = Dish::getSumOfDishesByOrder($order->getId());
            $order->setOrderCost($order_cost);
            
            //? Update the order cost
            if(Order::updateOrder($order) > 0){
                echo 'Total price of the order has been updated<br>';
                $order->printSingleEntityAsTable();
            }

            $payload = json_encode(array("mensaje" => "Platillo creado con exito"));
            $response->getBody()->write("Dish created successfully");
        }
        else{
            $response->getBody()->write("Something failed while creating the Dish");
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
        $id = $params['Id'];
        $dish = Dish::getDishById($id);
        $payload = json_encode($dish);
        if(Dish::deleteDish($id) > 0){
            $payload = json_encode(array("mensaje" => "Platillo eliminado con exito"));
            $response->getBody()->write("Dish deleted successfully");
        }
        else{
            $response->getBody()->write("Something failed while deleting the Dish");
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Modifies a Dish in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function ModificarUno($request, $response, $args){

        //? Shows the dish of the employee's area.
        $this->TraerTodos($request, $response, $args);
        
        $params = $request->getParsedBody();
        
        if(isset($params['id_dish']) && isset($params['status'])){
            $id = $params['id_dish'];
            $status = $params['status'];
            $dish = Dish::getDishById($id);
            $order = Order::getOrderById($dish->getDishOrderAssociated());

            echo 'Dish before modify: <br>';
            $dish->printSingleEntityAsTable();

            $dish->setDishStatus($status);
            if(strcmp($status, 'Listo Para Servir') == 0){
                $dish->setTimeToFinish(0);
                echo '<h3>Dish "'.$dish->getDishDescription().'" waiting time have been changed to: 0 and its ready to deploy.</h3><br>';
            }
        }

        if(isset($params['time_to_finish'])){
            $time_to_finish = $params['time_to_finish'];
            $dish->setTimeToFinish($time_to_finish);
            $dish->calculateTimeFinished();
        }

        if(isset($dish)){
            echo 'Dish After modify: <br>';
            $dish->printSingleEntityAsTable();
        }
        
        if(isset($dish) && Dish::updateDish($dish) > 0){
            echo '<h3>Dish ID: '.$dish->getDishId().' Has been changed to: '.$dish->getDishStatus().'.</h3><br>';
        }

        if (isset($order) && $order->getOrderStatus() != 'Listo Para Servir' && $status != 'Listo Para Servir') {
            $order->setOrderStatus($status);
            Order::updateOrder($order);
        }

        if (isset($order) && $order->getOrderStatus() != 'Listo Para Servir' && $status == 'Listo Para Servir') {
            //? Get all the dishes of the order
            $dishes = Dish::getDishesByOrderId($order->getId());
            //? Get all the dishes filtered by the status
            $filteredDishes = Dish::filterFinishedDishes($dishes, 'Listo Para Servir');
            

            echo 'Dishes of the order: <br>';
            Dish::printEntitiesAsTable($dishes);

            echo 'Finished dishes: <br>';
            Dish::printEntitiesAsTable($filteredDishes);

            //* Check if the size of the arrays are equals
            if(count($dishes) == count($filteredDishes)){
                $order->setOrderStatus($status);
                Order::updateOrder($order);
                echo '<h3>Order ID: '.$order->getId().' Has been changed to: '.$order->getOrderStatus().' and is ready to deploy.</h3><br>';
                echo '<h3>All the dishes waiting time of the order have been changed to: 0.</h3><br>';
                
                //? Update the table status to "Con Clientes Comiendo"
                $tableid = Table::getTableByOrderId($order->getId());
                $tableid->setState('Con Clientes Comiendo');
                Table::updateTable($tableid);
            }
        }

        if(isset($dish) && Dish::updateDish($dish) > 0){
            $payload = json_encode(array("mensaje" => "Dish modified successfully"));
        }else{
            $payload = json_encode(array("mensaje" => "Something failed while modifying the Dish."));
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
?>