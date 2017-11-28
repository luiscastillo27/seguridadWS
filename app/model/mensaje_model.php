<?php
namespace App\Model;

use App\Lib\Response;

class MemsajesModel{
    private $db;
    private $table = 'mensaje';
    private $table2 = 'contactos';
    private $table3 = 'autoridad';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
    public function listarEmi($id){
      
        return $this->db->from($this->table)
                         ->where('tokenEmisor', $id)
                         ->fetchAll();
                    
    }


    public function listarRes($id){
      
        return $this->db->from($this->table)
                         ->where('tokenReceptor', $id)
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
        $tokenEmisor = $data["tokenEmisor"];
        $tokenReceptor = $data["tokenReceptor"];

        $total = $this->db->from($this->table2)
                          ->where('tokenUser1', $tokenEmisor)
                          ->where('tokenUser2', $tokenReceptor)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        
        if($total != 0){

            $this->db->insertInto($this->table, $data)
                  ->execute();

            $data1 = array('tokenUser1' => $tokenEmisor, 'tokenUser2' => $tokenReceptor);

            $this->db->insertInto($this->table3, $data1)
                  ->execute();

            return [
                'message' => 'El mensaje ha sido enviado',
                'data' => $data
            ];

            return $this->response->SetResponse(true, "El mensaje ha sido enviado");

        } else {
            return $this->response->SetResponse(true, "No se puede enviar el mensaje");
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