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

require_once './models/User.php';
require_once './interfaces/IApiUsable.php';
require_once './middlewares/AuthJWT.php';

class UserController extends User implements IApiUsable{

  /**
     * Create a new User into the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     */
    public function CargarUno($request, $response, $args){

        $params = $request->getParsedBody();
        echo '<br>Datos de User a crear:<br>';
        var_dump($params);
        
        // Creamos el User
        $user = User::createUser(
          $params['username'], 
          $params['password'], 
          $params['isAdmin'], 
          $params['user_type'],
          $params['status'], 
          date('Y-m-d H:i:s'));
        echo '<br> User a crear:<br>';
        $user->printSingleEntityAsTable();
        if (User::insertUser($user) > 0) {
            $payload = json_encode(array("mensaje" => "User creado con exito"));
        }else{
            $payload = json_encode(array("mensaje" => "Error al crear el User"));
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Get an specific User from the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return User The User object.
     */
    public function TraerUno($request, $response, $args){

        // Buscamos User por nombre
        $usr = $args['id'];
        $User = User::getUserById($usr);
        $payload = json_encode($User);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Users from the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return array The Users array.
     */
    public function TraerTodos($request, $response, $args){

        $usersList = User::getAllUsers();
        User::printEntitiesAsTable($usersList);
        $payload = json_encode(array("UsersList" => $usersList));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    /**
     * Modify a user by id.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The route arguments.
     */
    public function ModificarUno($request, $response, $args){

        $params = $request->getParsedBody();
        var_dump($params);
        if(isset($params['username'])){
            $usr = $params['username'];
            $myUser = User::getUserByUsername($usr);
            $myUser->setUsername($params['username']);
            $myUser->setPassword($params['password']);

            //--- Test Data ---//
            echo $myUser->getUsername()."<br>";
            var_dump($myUser);
            //--- End Test Data ---//
            if(!User::modifyUser($myUser)){
              $payload = json_encode(array("mensaje" => "User no modificado"));
            }else{
              $payload = json_encode(array("mensaje" => "User modificado con exito"));
            }
            $response->getBody()->write($payload);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Makes a logic delete of a user by id.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     */
    public function BorrarUno($request, $response, $args)
    {
        $params = $request->getParsedBody();

        $userForDelete = User::getUserById($params['Id']);
        User::deleteUser($userForDelete);

        $payload = json_encode(array("mensaje" => "User borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Try to login a user by submitting a username and password.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The route arguments.
     */
    public function Login($request, $response, $args){
      
        $params = $request->getParsedBody();

        if (isset($params['username']) && isset($params['password'])) {
            $username = $params['username'];
            $password = $params['password'];
            $myUser = User::getUserByUsername($username);

            if ($myUser != null && ($myUser->getUsername() == $username && $myUser->getPassword() == $password)) {
                $payload = json_encode(array("mensaje" => "Login exitoso"));
            } else {
                $payload = json_encode(array("mensaje" => "Login fallido"));
            }
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets the job position of the user.
     *
     * @param Request $request The request object.
     * @return Response The response object.
     */
    public static function GetInfoByToken($request){
      $header = $request->getHeader('Authorization');
      $token = trim(str_replace("Bearer", "", $header[0]));
      $user = JWTAuthenticator::getTokenData($token);
      
      return $user;
    }
}
?>