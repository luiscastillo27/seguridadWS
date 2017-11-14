<?php
namespace App\Model;

use App\Lib\Response;

class NutricionModel{
    private $db;
    private $table = 'nutricion';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR TODOS
    public function listarTodos($l, $p){
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
    //LISTAR POR TIPO
    public function listar($l, $p, $id){
        $data = $this->db->from($this->table)
                         ->limit($l)
                         ->offset($p)
                         ->where('tipo_nutr', $id)
                         ->orderBy('id_nutr DESC')
                         ->fetchAll();
                         
        $total = $this->db->from($this->table)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->where('tipo_nutr', $id)
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
                        ->where('id_nutr', $id)
                        ->fetch();
    }
    
    //REGISTRAR USUARIO
    public function registrar($data){

        $file = $_FILES["img_nutr"]["name"];
        $foto = date("Y-m-d").date("H-I-s").'.jpg';
        $data['img_nutr'] = $foto;
        move_uploaded_file($_FILES["img_nutr"]["tmp_name"], "imagenes/".$foto);

        
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
        $this->db->update($this->table, $data)
                 ->where('id_nutr', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_nutr', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}