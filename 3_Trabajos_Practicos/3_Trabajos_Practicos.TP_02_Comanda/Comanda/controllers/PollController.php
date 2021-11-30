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

 require_once './models/Poll.php';

 class PollController{

    /**
     * Creates a Poll and inserts it into the database
     *
     * @param Request $request PSR-7 request object.
     * @param Response $response PSR-7 response object.
     * @param mixed $args Route parameters.
     * @return Response The response object.
     */
    public function CreatePoll($request, $response, $args){
        $params = $request->getParsedBody();
        $payload = json_encode(array("message" => "Something faile while creating the Poll."));
        if (isset($params['table_score']) && isset($params['cheff_score'])
        && isset($params['waitress_score']) && isset($params['resto_score'])
        && isset($params['order_id']) && isset($params['comments'])) {
            $order_id = $params['order_id'];
            $table_score = $params['table_score'];
            $resto_score = $params['resto_score'];
            $waitress_score = $params['waitress_score'];
            $cheff_score = $params['cheff_score'];
            $comments = $params['comments'];

            $poll = Poll::CreatePoll($order_id, $table_score, $resto_score, $waitress_score, $cheff_score, $comments);
            //$payload = json_encode(array("Poll" => $poll, "message" => "Poll created successfully, Thanks for choosing us!"));
            $poll->printSingleEntityAsTable();
            if(Poll::insertPoll($poll) > 0){
                echo '<h1>Poll created successfully, Thanks for choosing us!</h1>';
                $payload = json_encode(array("Poll" => $poll, "message" => "Poll created successfully, Thanks for choosing us!"));
            }
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Gets the best polls of the restaurant
     * @param Request $request PSR-7 request object.
     * @param Response $response PSR-7 response object.
     * @param mixed $args Route parameters.
     * @return Response The response object.
     */
    public function GetBestPolls($request, $response, $args){
        $params = $request->getParsedBody();
        $payload = json_encode(array("message" => 'Error while loading polls'));
        if (isset($params['Amount'])){
            $amount = $params['Amount'];
            $polls = Poll::getBestPolls($amount);
            Poll::printEntitiesAsTable($polls);
            $payload = json_encode(array("Best Polls" => $polls));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
 }
?>