<?php
session_start();
require '../autoloader.php';
$routes = new \App\Routes();
$entryPoint = new \Web\EntryPoint($routes);
$entryPoint->run();
