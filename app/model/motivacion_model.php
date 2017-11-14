<?php
namespace App\Model;

use App\Lib\Response;

class MotivacionModel{
    private $db;
    private $table = 'motivacion';
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
                        ->where('id_mot', $id)
                        ->fetch();
    }
    
    //REGISTRAR USUARIO
    public function registrar($data){

        $file = $_FILES["imagen_mot"]["name"];
        $foto = date("Y-m-d").date("H-I-s").'.jpg';
        $data['imagen_mot'] = $foto;
        move_uploaded_file($_FILES["imagen_mot"]["tmp_name"], "imagenes/".$foto);
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
  
        $this->db->update($this->table, $data)
                 ->where('id_mot', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_mot', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}