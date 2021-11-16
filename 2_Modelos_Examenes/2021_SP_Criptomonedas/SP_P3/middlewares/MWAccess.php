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

class MWAccess{
    
    public function validateToken($request, $rHandler){
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

    public function isAdmin($request, $handler) {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        if (!empty($header)) {
            $token = trim(explode("Bearer", $header)[1]);
            $data = JWTAuthenticator::getTokenData($token);
            if ($data->type == "Admin") {
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


    public function isAdminOrCustomer($request, $handler) {
        $header = $request->getHeaderLine('authorization');
        $response = new Response();
        try {
            if (!empty($header)) {
                $token = trim(explode("Bearer", $header)[1]);
                $data = JWTAuthenticator::getTokenData($token);
                if ($data->type == "Customer" || $data->type == "Admin") {
                    if ($data->type == "Customer") {
                        // Verificar token de la compra
                        JWTAuthenticator::verifyToken($token);
                        $response = $handler->handle($request);
                    }else{
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
}
