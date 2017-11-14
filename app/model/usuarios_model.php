<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Auth;

class UsuariosModel{
    private $db;
    private $table = 'usuarios';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function autenticar($telefono, $nombre)  {

        $usuarios = $this->db->from($this->table)
                             ->where('nombre', $nombre)
                             ->where('telefono', $telefono)
                             ->fetch();

        if(is_object($usuarios)){
            
            $token = Auth::SignIn([
                'telefono' => $usuarios->telefono,
                'nombre' => $usuarios->nombre
            ]);
            
            $data['token'] = $token;

            $this->db->update($this->table, $data)
                 ->where('idUser', $usuarios->idUser)
                 ->execute();
  
            return $this->response->SetResponse(true, $token);
        }else{
            return $this->response->SetResponse(false, "Credenciales no válidas");
        }
        
    }

    //REGISTRAR USUARIO
    public function registrar($data){
        $telefono = $data["telefono"];
        $nombre = $data["nombre"];

        $total = $this->db->from($this->table)
                          ->where('telefono', $telefono)
                          ->where('nombre', $nombre)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

        if($total == 0){
        
            $token = Auth::SignIn([
                'telefono' => $telefono,
                'nombre' => $nombre
            ]);
                    
            $data['token'] = $token;

            $this->db->insertInto($this->table, $data)
                     ->execute();

            return $this->response->SetResponse(true, $token);
            
        } else{
            return $this->response->SetResponse(false, "El usuario ya existe, intentalo con otro");
        }
        
    }
}