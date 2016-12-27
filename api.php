<?php

set_include_path('Core');
spl_autoload_extensions(".php");
spl_autoload_register();

$db = new mysqli('localhost', 'root', '', 'tedis-ukraine');
//$db = null;

use Core\Controller;
use Core\Request;
use Core\ViewHandler;

$request = new Request($_GET, $_POST, $_SERVER, $_FILES, $_SERVER, $_COOKIE);


// Create connection
$controller = new Controller($db);
$viewHandler = new ViewHandler([]);

if(!empty($request->post('elem'))){
    $controller->updateNodeTree($request);
    sleep(2);
}

echo $viewHandler->setTree($controller->getNodeTree())->getHtmlView();