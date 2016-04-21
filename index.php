<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMySQL;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Register autoloader
$loader = new Loader();
$loader->registerDirs(array(
    'controllers',
    'models'
))->register();

$di = new FactoryDefault();
// Set up database connector
$di->set('db',function() {
    return new PdoMySQL(
        array(
            'host' => "localhost",
            'username' => "root",
            'password' => "pass",
            'dbname' => "carsApi"
        )
    );
});
/*
$di->setShared('session',function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});
*/
$app = new Micro($di);



$cars = new MicroCollection();

$cars->setHandler(new CarsController());
$cars->setPrefix('/cars');

// Routes / API calls
// Listing
$cars->get('/','index');

// Reading single
// GET cars/{carid}
$cars->get('/{id}','index');

// Adding
// POST /cars
$cars->post('/','create');

// Editing
// PUT /cars/{carid}
$cars->put('/{id}','update');

// Deleting
// DELETE /cars/{carid}
//$cars->delete('/{id}','delete');  // TODO


$app->mount($cars);
$app->handle();
?>