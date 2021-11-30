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

require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable
{

    /**
     * Create a new Usuario into the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     */
    public function CargarUno($request, $response, $args){

        $parametros = $request->getParsedBody();
        var_dump($parametros);
        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];

        // Creamos el usuario
        $usr = new Usuario();
        $usr->usuario = $usuario;
        $usr->clave = $clave;
        $usr->crearUsuario();

        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Get an specific Usuario from the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return Usuario The Usuario object.
     */
    public function TraerUno($request, $response, $args){

        // Buscamos usuario por nombre
        $usr = $args['usuario'];
        $usuario = Usuario::obtenerUsuario($usr);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets all the Usuarios from the database.
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @param mixed $args The arguments.
     * @return array The Usuarios array.
     */
    public function TraerTodos($request, $response, $args){

        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuario" => $lista));

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

        $parametros = $request->getParsedBody();
        var_dump($parametros);
        if(isset($parametros['usuario'])){
            $usr = $parametros['usuario'];
            $myUser = Usuario::obtenerUsuario($usr);
            $myUser->usuario = $parametros['usuario'];
            $myUser->clave = $parametros['clave'];

            //--- Test Data ---//
            echo $myUser->usuario."<br>";
            var_dump($myUser);
            //--- End Test Data ---//
            if(!Usuario::modificarUsuario($myUser)){
              $payload = json_encode(array("mensaje" => "Usuario no modificado"));
            }else{
              $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));
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
        $parametros = $request->getParsedBody();

        $usuarioId = $parametros['usuarioId'];
        Usuario::borrarUsuario($usuarioId);

        $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));

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
      
        $parametros = $request->getParsedBody();

        if (isset($parametros['usuario']) && isset($parametros['clave'])) {
            $usuario = $parametros['usuario'];
            $clave = $parametros['clave'];
            $myUser = Usuario::obtenerUsuario($usuario);

            if ($myUser != null && ($myUser->usuario == $usuario && $myUser->clave == $clave)) {
                $payload = json_encode(array("mensaje" => "Login exitoso"));
            } else {
                $payload = json_encode(array("mensaje" => "Login fallido"));
            }
        }

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}