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
require_once './models/Employee.php';
require_once './models/Area.php';
require_once './models/User.php';
require_once 'UserController.php';
//require_once 'AreaController.php';

class EmployeeController extends Employee implements IApiUsable{

    /**
     * Saves an employee in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function CargarUno($request, $response, $args){
        $params = $request->getParsedBody();
        var_dump($params);
        $employee_name = $params['Name'];
        $employee_area = $params['Area'];
        $employee_user = $params['User'];
        $employee_area = Area::getAreaByName($employee_area);
        $employee_user_id = User::getUserByUsername($employee_user)->getId();
        $newEmployee = Employee::createEmployee($employee_user_id, $employee_area->getAreaId(), $employee_name, date("Y-m-d H:i:s"));
        
        echo 'Employee to Create:<br>';
        $newEmployee->printSingleEntityAsTable();

        if (Employee::insertEmployee($newEmployee) > 0) {
            $payload = json_encode(array("mensaje" => "Usuario creado con exito"));
            $response->getBody()->write("Employee created successfully");
        }else{
            $response->getBody()->write("Something failed while creating the employee");
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets an specific employee from the database bassed on the id.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerUno($request, $response, $args){
        $params = $request->getParsedBody();
        $employee_id = $params['Id'];
        $employee = Employee::getEmployeeById($employee_id);
        $payload = json_encode($employee);
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Saves an employee in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function TraerTodos($request, $response, $args){
        $employees = Employee::getAllEmployees();
        echo 'Employees: <br>';
        Employee::printEntitiesAsTable($employees);

        $payload = json_encode(array("Employees" => $employees));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Saves an employee in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function BorrarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $employee_id = $params['Id'];
        $employee = Employee::getEmployeeById($employee_id);
        if (Employee::deleteEmployee($employee) > 0) {
            $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));
            $response->getBody()->write("Employee deleted successfully");
        }else{
            $response->getBody()->write("Something failed while deleting the employee");
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Saves an employee in the database.
     *
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Response The response object.
     */
    public function ModificarUno($request, $response, $args){
        $params = $request->getParsedBody();
        $employee_id = $params['Id'];
        $employee = Employee::getEmployeeById($employee_id);
        $employee_name = $params['Name'];
        $employee_area_id = Area::getAreaByName($params['Area'])->getAreaId();
        $employee_user_id = User::getUserByUsername($params['User'])->getId();

        $employee->setName($employee_name);
        $employee->setEmployeeAreaID($employee_area_id);
        $employee->setUserId($employee_user_id);

        if (Employee::updateEmployee($employee) > 0) {
            $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));
            $response->getBody()->write("Employee updated successfully");
        }else{
            $response->getBody()->write("Something failed while updating the employee");
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
?>