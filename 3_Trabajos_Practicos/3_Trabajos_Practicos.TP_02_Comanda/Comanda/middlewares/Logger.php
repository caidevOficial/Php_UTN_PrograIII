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

use GuzzleHttp\Psr7\Log;
use Slim\Handlers\Strategies\RequestHandler;

class Logger
{
    public static function OperationLog($request, $response, $next)
    {
        $retorno = $next($request, $response);
        return $retorno;
    }

    public static function validateGP($request, $handler){
        
        $requestType = $request->getMethod();
        $response = $handler->handle($request);

        if($requestType == 'GET'){
            $response->getBody()->write('<h1>GET Method</h1>');
        }else if($requestType == 'POST'){
            $response->getBody()->write('<h1>POST Method</h1>');
            $data = $request->getParsedBody();
            $name = $data['name'];
            $type = $data['type'];

            if ($type == 'Admin') {
                $response->getBody()->write('<h1> Welcome '.$name.'!</h1>');
            }else{
                $response->getBody()->write('<h1> You are not allowed to access this page!</h1>');
            }
        }

        return $response;
    }

}
?>