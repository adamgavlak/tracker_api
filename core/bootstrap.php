<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 12:41
 */

use App\Core\App;
use App\Core\Database\{QueryBuilder, Connection};
use App\Core\Session;

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'sem',
    'username'  => 'adam',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->bootEloquent();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, X-Api-Key');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE');

App::bind('config', require 'config.php');

App::bind('db', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

function json($model)
{
    echo json_encode($model);
}