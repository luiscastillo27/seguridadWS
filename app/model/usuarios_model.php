<?php
namespace App\Model;

use App\Lib\Response;

class UsuariosModel{
    private $db;
    private $table = 'usuarios';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
    public function listar($l, $p){
        $data = $this->db->from($this->table)
                         ->limit($l)
                         ->offset($p)
                         ->select(NULL)
                         ->select(array('id_usr', 'tipo_usr' ,'nick_usr','edad_usr', 'sexo_usr' ,'avatar_usr'))
                         ->fetchAll();
                         
        $total = $this->db->from($this->table)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        return [
            'data'  => $data,
            'total' => $total
        ];
    }
    
    //OBTENER
    public function obtener($id){
        return $this->db->from($this->table)
                        ->where('id_usr', $id)
                        ->select(NULL)
                        ->select(array('id_usr', 'tipo_usr' ,'nick_usr','edad_usr', 'sexo_usr', 'avatar_usr'))
                        ->fetch();
    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
        if(isset($data['password_usr'])){
            $data['password_usr'] = md5($data['password_usr']);            
        }
        
        $this->db->update($this->table, $data)
                 ->where('id_usr', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_usr', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}