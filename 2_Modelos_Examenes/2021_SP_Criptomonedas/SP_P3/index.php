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

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './controllers/UserController.php';
require_once './controllers/SaleController.php';
require_once './controllers/CurrencyController.php';
require_once './controllers/FileController.php';

require_once './db/DataAccess.php';
require_once './middlewares/AuthJWT.php';
require_once './middlewares/MWAccess.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = AppFactory::create();
$app->setBasePath('/SP_P3');
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$app->addErrorMiddleware(true, true, true);

// requests
$app->group('/user', function (RouteCollectorProxy $group) {
  $group->post('/register', \UserController::class . ':registerUser');
  $group->post('/login', \UserController::class . ':verifyUser');
});

$app->group('/cryptocurrency', function (RouteCollectorProxy $group) {
    $group->post('/newCrypto', \CurrencyController::class . ':LoadOne')
      ->add(\MWAccess::class . ':isAdmin');
    $group->get('/getAll/', \CurrencyController::class . ':GetAll');
    $group->get('/getAll/{country}', \CurrencyController::class . ':GetAllByCountry');
    $group->get('/getCrypto/{id}', \CurrencyController::class . ':GetOneByID')
      ->add(\MWAccess::class . ':isAdminOrCustomer');
    $group->put('/modifyCrypto/{id}', \CurrencyController::class . ':ModifyOne')
      ->add(\MWAccess::class . ':isAdmin');
    $group->delete('/deleteCrypto/{id}', \CurrencyController::class . ':DeleteOne')
      ->add(\MWAccess::class . ':isAdmin');
  });

$app->group('/sale', function (RouteCollectorProxy $group) {
    $group->get('/getAll/', \SaleController::class . ':GetAll');
    $group->get('/getAll/{country}/{from}/{to}', \SaleController::class . ':GetAllByCountry')
      ->add(\MWAccess::class . ':isAdmin');
    $group->get('/getAllBy/{crypto_name}', \SaleController::class . ':GetAllByCryptoName')
      ->add(\MWAccess::class . ':isAdmin');  
    $group->post('/newSale', \SaleController::class . ':LoadOne')
      ->add(\MWAccess::class . ':isAdminOrCustomer');
    $group->get('/createReports/', \FileController::class . ':CreatePDF');
  });

// Run app
try {
  $app->run();     
} catch (Exception $e) {    
// We display a error message
die( json_encode(array("status" => "failed", "message" => "This action is not allowed"))); 
}

