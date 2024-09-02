<?php
include_once 'helpers/header.php';

try {
    $params = explode('/api/', $_SERVER['REQUEST_URI'])[1];
    if ($params) {
        $controller = explode('/', $params)[0];
        $controller = implode('_', (explode('-', $controller)));
        $action = explode('/', $params)[1];
        $action = implode('_', (explode('-', $action)));
        $params = explode('/', $params);
        array_splice($params, 0, 2);
        include_once 'controllers/' . $controller . '.php';
        $instance = new $controller();
        $post = json_decode(file_get_contents('php://input'));
        echo json_encode($instance->$action($post, ...$params));
    } else {
        echo json_encode(['api' => 'Está rodando']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
