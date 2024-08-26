<?php
include 'helpers/header.php';
try {
    $params = explode('/api/', $_SERVER['REQUEST_URI'])[1];
    $controller = explode('/', $params)[0];
    $action = explode('/', $params)[1];
    $action = implode('_', (explode('-', $action)));
    $params = explode('/', $params);
    array_splice($params, 0, 2);
    include 'controllers/' . $controller . '.php';
    $instance = new $controller();
    echo json_encode($instance->$action(...$params));
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
