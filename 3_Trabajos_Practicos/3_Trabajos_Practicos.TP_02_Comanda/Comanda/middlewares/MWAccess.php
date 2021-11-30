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

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MWAccess {
    private $userTypes = [
        "Admin", "Camarera", "Cocinero", "Barman"
    ];

    /**
     * Validates if the user is logged in.
     *
     * @param Request $request PSR-7 request.
     * @param RequestHandler $rHandler PSR-15 request handler.
     */
    public function validateToken($request, $rHandler)
    {
        $header = $request->getHeaderLine('Authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            JWTAuthenticator::verifyToken($token);
            $response = $rHandler->handle($request);
        } else {
            $response->getBody()->write(json_encode(array("Token error" => "You need the token")));
            $response = $response->withStatus(401);
        }
        return  $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if the user is Admin.
     *
     * @param Request $request The request object.
     * @param RequestHandler $handler The handler object.
     */
    public function isAdmin($request, $handler)
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = JWTAuthenticator::getTokenData($token);
            
            if ($data->User_Type == 'Admin') {
                $response = $handler->handle($request);
            } else {
                $response->getBody()->write(json_encode(array("error" => "Only admin has access")));
                $response = $response->withStatus(401);
            }
        } else {
            $response->getBody()->write(json_encode(array("Admin error" => "You need the token as Admin")));
            $response = $response->withStatus(401);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if the user is a registered employee bassed in its user type
     * like 'Camarera', 'Cocinero', 'Admin', 'Barman'.
     *
     * @param Request $request The request object.
     * @param RequestHandler $handler The handler object.
     */
    public function isEmployee($request, $handler)
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        try {
            if (!empty($header)) {
                $token = trim(explode("Bearer", $header)[1]);
                $data = JWTAuthenticator::getTokenData($token);
                if (in_array($data->User_Type, $this->userTypes)) {
                    //TODO: Validate for all the user types
                    if ($data->User_Type != "Admin") {
                        // Verify the token of the user.
                        $response = $handler->handle($request);
                    }
                } else {
                    $response->getBody()->write(json_encode(array("error" => "Only registered personnel have access")));
                    $response = $response->withStatus(401);
                }
            } else {
                $response->getBody()->write(json_encode(array("error" => "You need the token")));
                $response = $response->withStatus(401);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if the user is Barman.
     *
     * @param Request $request The request object.
     * @param RequestHandler $handler The handler object.
     */
    public function isBarman($request, $handler)
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = JWTAuthenticator::getTokenData($token);
            if ($data->User_Type == "Barman" 
            || $data->User_Type == "Admin") {
                $response = $handler->handle($request);
            } else {
                $response->getBody()->write(json_encode(array("error" => "Only Barman or Admin has access")));
                $response = $response->withStatus(401);
            }
        } else {
            $response->getBody()->write(json_encode(array("Admin error" => "You need the token as Barman or Admin")));
            $response = $response->withStatus(401);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if the user is Barman.
     *
     * @param Request $request The request object.
     * @param RequestHandler $handler The handler object.
     */
    public function isCheff($request, $handler)
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = JWTAuthenticator::getTokenData($token);
            if ($data->User_Type == "Cocinero"
            || $data->User_Type == "Admin") {
                $response = $handler->handle($request);
            } else {
                $response->getBody()->write(json_encode(array("error" => "Only Cocinero or Admin has access")));
                $response = $response->withStatus(401);
            }
        } else {
            $response->getBody()->write(json_encode(array("Admin error" => "You need the token as Cocinero or Admin")));
            $response = $response->withStatus(401);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if the user is Waitress.
     *
     * @param Request $request The request object.
     * @param RequestHandler $handler The handler object.
     */
    public function isWaitress($request, $handler)
    {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = JWTAuthenticator::getTokenData($token);
            if ($data->User_Type == "Camarera"
            || $data->User_Type == "Admin") {
                $response = $handler->handle($request);
            } else {
                $response->getBody()->write(json_encode(array("error" => "Only Camarera or Admin has access")));
                $response = $response->withStatus(401);
            }
        } else {
            $response->getBody()->write(json_encode(array("Admin error" => "You need the token as Camarera or Admin")));
            $response = $response->withStatus(401);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>