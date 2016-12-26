<?php

set_include_path('Core');
spl_autoload_extensions(".php");
spl_autoload_register();

$db = new mysqli('localhost', 'root', '', 'tedis-ukraine');

use Core\Controller;
use Core\Request;
use Core\Db;

$request = new Request($_GET, $_POST, $_SERVER, $_FILES, $_SERVER, $_COOKIE);


// Create connection
$controller = new Controller($db);

if(!empty($request->get('tree'))){
    echo $controller->getNodeTree();
}

if(!empty($request->post('elem'))){
    $controller->updateNodeTree($request);
    sleep(2);
    echo $controller->getNodeTree();
}