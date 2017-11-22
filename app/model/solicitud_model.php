<?php
namespace App\Model;

use App\Lib\Response;

class SolicitudModel{
    private $db;
    private $table = 'solicitud';
    private $table2 = 'contactos';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR SOLICITUDES
    public function listar($id){
      
        return $this->db->from($this->table)
                        ->where('tokenUser2', $id)
                        ->select(null)
                        ->select('idSolicitud, tokenUser1')
                        ->fetchAll();
                    
    }
    
    public function obtener($id){
      
        return $this->db->from($this->table)
                        ->where('idSolicitud', $id)
                        ->select(null)
                        ->select('idSolicitud, tokenUser2')
                        ->fetch();
                    
    } 
    
    //ENVIAR SOLICITUD
    public function enviar($data){

        $tokenUser1 = $data["tokenUser1"];
        $tokenUser2 = $data["tokenUser2"];

        $total = $this->db->from($this->table)
                          ->where('tokenUser1', $tokenUser1)
                          ->where('tokenUser2', $tokenUser2)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

        if($total == 0){
            
            $this->db->insertInto($this->table, $data)
                         ->execute();

            return $this->response->SetResponse(true, "Solicitud enviada");
            
           
        } else {
            return $this->response->SetResponse(true, "Ya existe la solicitud");
        }
      
       
    }
    
    //ELIMINAR SOLICUTUD
    public function eliminar($id){

        $total = $this->db->from($this->table)
                          ->where('idSolicitud', $id)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

        if($total != 0){

            $this->db->deleteFrom($this->table)
                 ->where('idSolicitud', $id)
                 ->execute();
        
            return $this->response->SetResponse(true, "Se ha eliminado");
  
        } else {
            return $this->response->SetResponse(true, "Ya no existe la solicitud");
        }

        
        
    } 



    public function aceptar($data){

        $tokenUser1 = $data["tokenUser1"];
        $tokenUser2 = $data["tokenUser2"];

        $total = $this->db->from($this->table)
                          ->where('tokenUser1', $tokenUser1)
                          ->where('tokenUser2', $tokenUser2)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

        if($total != 0){

            $total = $this->db->from($this->table2)
                          ->where('tokenUser1', $tokenUser1)
                          ->where('tokenUser2', $tokenUser2)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

            if($total == 0){
                $this->db->insertInto($this->table2, $data)
                         ->execute();

                return $this->response->SetResponse(true, "Solicitud aceptada");
            } else {
                return $this->response->SetResponse(true, "Ya haz aceptado la solicitud anteriormente");
            }
          
           
        } else {
            return $this->response->SetResponse(true, "No existe la solicitud");
        }
      
       
    }
}