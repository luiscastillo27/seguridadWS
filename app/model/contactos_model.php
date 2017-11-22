<?php
namespace App\Model;

use App\Lib\Response;

class ContactosModel{
    private $db;
    private $table = 'contactos';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
    public function listar($id){
      
        return $this->db->from($this->table)
                        ->where('tokenUser1', $id)
                        ->select(null)
                        ->select('idContacto, tokenUser2')
                        ->fetchAll();
                    
    }
    
    //OBTENER
    public function obtener($id){

        return $this->db->from($this->table)
                        ->where('idContacto', $id)
                        ->fetch();

    }
    
    
    //ELIMINAR USUARIO
    public function eliminar($id){

        $this->db->deleteFrom($this->table)
                 ->where('idContacto', $id)
                 ->execute();
        
        return $this->response->SetResponse(true, "Se ha eliminado correctamente");

    } 
}