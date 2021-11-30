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
require_once './models/Order.php';
require_once './models/Table.php';
require_once './models/UploadManager.php';
require_once './controllers/UserController.php';

class OrderController extends Order implements IApiUsable{

    /**
     * Saves a Order in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerUno($request, $response, $args){
        $params = $request->getParsedBody();
        $id = $params['Id'];
        $order = Order::getOrderById($id);
        $payload = json_encode($order);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Order from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function TraerTodos($request, $response, $args){
        $orders = Order::getAll();

        echo 'Orders: <br>';
        Order::printEntitiesAsTable($orders);

        $payload = json_encode(array("Orders" => $orders));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Order from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function TraerSegunArea($request, $response, $args){
        $user_type = UserController::GetInfoByToken($request)->getUserType();

        //TODO: Check the correct functionality of this method.
        $dishes = Dish::getDishesByUserType($user_type);

        echo 'Dishes for: '.${$user_type}.'<br>';
        Dish::printEntitiesAsTable($dishes);

        $payload = json_encode(array("Dishes" => $dishes));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the orders ordered by time DESC.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerPedidosTiempo($request, $response, $args){
        $orders = Order::getOrdersWithTime();
        echo 'Orders: <br>';
        Order::printStdEntitiesAsTable($orders);

        $payload = json_encode(array("Orders" => $orders));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets a Order from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function CargarUno($request, $response, $args){
        $imagesDirectory = "./OrderImages/";
        $params = $request->getParsedBody();
        
        $table_id = $params['table_id'];
        
        $order = Order::createOrder(
            $table_id, 
            $params['order_status'], 
            $params['customer'], 
            $params['order_cost']
        );
        
        $payload = json_encode($order);
        $order_id = Order::insertOrder($order);
        if($order_id > 0){
            $payload = json_encode(array("mensaje" => "Orden Creada con exito"));
            $response->getBody()->write("Order created successfully");
            $fileManager = new UploadManager($imagesDirectory, $order_id, $_FILES);
            $order = Order::getOrderById($order_id);
            $order->setOrderPicture(UploadManager::getOrderImageNameExt($fileManager, $order_id));
            Order::updatePicture($order);
            echo 'Order Created: <br>';
            $order->printSingleEntityAsTable();
        }
        else{
            $response->getBody()->write("Something failed while creating the Order");
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');

    }

    /**
     * Deletes a Order from the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function BorrarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $id = $params['Id'];
        $order = Order::getOrderById($id);
        $payload = json_encode($order);
        if(Order::deleteOrderById($id) > 0){
            $payload = json_encode(array("mensaje" => "Orden Eliminada con exito"));
            $response->getBody()->write("Order deleted successfully");
        }
        else{
            $response->getBody()->write("Something failed while deleting the Order");
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Modifies a Order in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
	public function ModificarUno($request, $response, $args){

        $params = $request->getParsedBody();
        $id = $params['Id'];
        
        $order = Order::getOrderById($id);
        $order->setOrderStatus($params['Status']);
        $order->setOrderCost(Dish::getSumOfDishesByOrder($order->getId()));

        echo 'New order data: <br>';
        $order->printSingleEntityAsTable();

        if (Order::updateOrder($order) > 0) {
            $payload = json_encode(array("mensaje" => "Orden modificada con exito"));
            $response->getBody()->write("Order updated successfully");
        }else{
            $response->getBody()->write("Something failed while updating the Order");
        }
    }
}
?>