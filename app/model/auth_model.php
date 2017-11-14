<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Auth;

class AuthModel{
    private $db;
    private $table = 'usuarios';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function autenticar($correo, $password) {
        $usuarios = $this->db->from($this->table)
                             ->where('nick_usr', $correo)
                             ->where('password_usr', md5($password))
                             ->fetch();
        
        if(is_object($usuarios)){
            
            $token = Auth::SignIn([
                'id_usr' => $usuarios->id_usr,
                'tipo_usr' => $usuarios->tipo_usr,
                'nick_usr' => $usuarios->nick_usr,
                'edad_usr' => $usuarios->edad_usr,
                'sexo_usr' => $usuarios->sexo_usr,
            ]);
            
            $this->response->result = $token;
            
            return $this->response->SetResponse(true);
        }else{
            return $this->response->SetResponse(false, "Credenciales no válidas");
        }
    }

    //REGISTRAR USUARIO
    public function registrar($data){
        $data['password_usr'] = md5($data['password_usr']);
        $user = $data['nick_usr'];

        $total = $this->db->from($this->table)
                          ->where('nick_usr', $user)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        if($total == 0){
            $this->db->insertInto($this->table, $data)
                 ->execute();
        
            return $this->response->SetResponse(true);
        } else{
            return $this->response->SetResponse(false, "El usuario ya existe, intentalo con otro");
        }
        
    }
}