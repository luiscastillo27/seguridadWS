<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\ContactosValidation,
    App\Middleware\AuthMiddleware;

$app->group('/contactos/', function () {

    $this->get('listar', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->listar($req->getParsedBody()))
                   );
    });
    
    $this->get('obtener/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->obtener($args['id']))
                   );
    });  
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->contactos->eliminar($args['id']))
                   );   
    });
    
});