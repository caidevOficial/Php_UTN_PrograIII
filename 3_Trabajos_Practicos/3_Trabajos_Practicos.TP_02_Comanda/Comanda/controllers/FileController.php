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

 require_once './models/HistoricalLogin.php';

 class FileController extends HistoricalLogin{

    /**
     * Reads a csv file and inserts every row into the database
     *
     * @param Request $request PSR-7 request object.
     * @param Response $response PSR-7 response object.
     * @param mixed $args Route parameters.
     * @return Response The response object.
     */
    public function Read($request, $response, $args){
        $filename = './Reports_Files/historical_logins.csv';
        $dataToRead = HistoricalLogin::ReadCsv($filename);
        $payload = json_encode(array("Error" => 'Something Failed'));
        if(!is_null($dataToRead)){
            echo "<h1>Data readed and inserted successfully</h1>";
            $payload = json_encode(array("Success" => 'File inserted to the table.', "Historical Logins" => $dataToRead));
        }
        
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Writes a file with the historical logins from the database.
     *
     * @param Request $request PSR-7 request object.
     * @param Response $response PSR-7 response object.
     * @param mixed $args Route parameters.
     * @return Response The response object.
     */
    public function Write($request, $response, $args){
        $loginsFromDb = HistoricalLogin::getAll();
        $filename = './Reports_Files/historical_logins.csv';
        $payload = json_encode(array("Error" => 'File not Saved',"Historical Logins" => 'Error While Writing The File'));
        if(HistoricalLogin::WriteCsv($loginsFromDb, $filename)){
            echo 'File Saved in '.$filename;
            HistoricalLogin::printEntitiesAsTable($loginsFromDb);
            $payload = json_encode(array("Success" => 'File Saved as historical_logins.csv',"Historical Logins" => $loginsFromDb));
        }
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * Downloads a pdf with the polls needed to be saved.
     *
     * @param Request $request PSR-7 request object.
     * @param Response $response PSR-7 response object.
     * @param mixed $args Route parameters.
     * @return Response The response object.
     */
    public function DownloadPdf($request, $response, $args){
        $params = $request->getParsedBody();
        $directory = './Reports_Files/';
        $payload = json_encode(array("Error" => 'File not Saved',"Best Polls" => 'Error While Writing The File'));
        
        if($params['Amount_Polls']){
            $amountPolls = $params['Amount_Polls'];
            $payload = Poll::DownloadPdf($directory, $amountPolls);
            echo 'File Saved in '.$directory;
        }
        
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
 }
?>