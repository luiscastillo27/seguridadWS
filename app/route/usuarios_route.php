<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

$app->group('/usuarios/', function () {
  
    $this->post('autenticar', function ($req, $res, $args) {
        $r = UsuarioValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        $parametros = $req->getParsedBody();        
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->autenticar($parametros['telefono'], $parametros['nombre']))
                   );
    });

    $this->post('registrar', function ($req, $res, $args) {
        $r = UsuarioValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuarios->registrar($req->getParsedBody()))
                   ); 
    });
});