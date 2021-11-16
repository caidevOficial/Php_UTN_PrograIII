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

class UserController extends User {

    /**
     * Register a new user into the database
     * 
     * @param Request $request The request object
     * @param Response $response The response object
     * @param mixed $args The arguments
     * @return Response The response object
     */
    public static function registerUser($request, $response, $args){
        $data = $request->getParsedBody();
        var_dump($data);
        if(array_key_exists('username', $data) 
        && array_key_exists('password', $data)){
            if (array_key_exists('type', $data)) {
                $user = User::createEntity($data['username'], $data['password'], $data['type']);
            } else {
                $user = User::createEntity($data['username'], $data['password']);
            }

            $user_id = User::insertEntity($user);
            if ($user_id > 0) {

                $user = USER::getEntityById($user_id);
                echo "<h2>User created successfully</h2><br>";
                $user->printSingleEntityAsTable();

                $payload = json_encode(array("message" => "User Inserted"));
                $response->getBody()->write("User created successfully");
            }
        }else{
            $payload = json_encode(array("message" => "User not inserted"));
            $response->getBody()->write("User not created");
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Verifies if the user exists in the database, then generates a token for the user
     *
     * @param Request $request The request object
     * @param Response $response The response object
     * @param mixed $args The arguments
     * @return Response The response object
     */
    public function verifyUser($request, $response, $args){
        $params = $request->getParsedBody();
        $username = $params['username'];
        $pass = $params['password'];
        
        $user = User::getEntityByUsername($username);
        $payload = json_encode(array('status' => 'Invalid User'));
        
        if(!is_null($user)){
            if(password_verify($pass, $user->getPassword())){
                $userData = array(
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'type' => $user->getType());
                $payload = json_encode(array('Token' => JWTAuthenticator::createToken($userData), 'response' => 'OK', 'UserType' => $user->getType()));
            }
        }
        
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>
