<?php
namespace App\Model;

use App\Lib\Response;

class MemsajesModel{
    private $db;
    private $table = 'mensaje';
    private $table2 = 'contactos';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
    public function listar($tokenEmirsor){
      
        return $this->db->from($this->table)
                         ->where('tokenEmirsor', $tokenEmirsor)
                         ->fetchAll();
                    
    }
    
    //OBTENER UNO EN ESPECIFICO
    public function obtener($id){
        return $this->db->from($this->table)
                        ->where('idMensaje', $id)
                        ->fetch();
    }

    //REGISTRAR USUARIO
    public function enviar($data){

        date_default_timezone_set('America/Monterrey');
        $data['fecha'] = date("d/m/Y - h:i a");
        $tokenEmirsor = $data["tokenEmirsor"];
        $tokenReceptor = $data["tokenReceptor"];

        $total = $this->db->from($this->table2)
                          ->where('tokenUser1', $tokenEmirsor)
                          ->where('tokenUser2', $tokenReceptor)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        
        if($total != 0){

            $this->db->insertInto($this->table, $data)
                  ->execute();

            return $this->response->SetResponse(true, "El mensaje ha sido enviado");

        }
        
        
        

    }
    
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('idMensaje', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 

  
}