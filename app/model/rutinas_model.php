<?php
namespace App\Model;

use App\Lib\Response;

class RutinasModel{
    private $db;
    private $table = 'rutinas_ejecicios';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
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
                         ->where('tipo_re', $id)
                         ->orderBy('id_re ASC')
                         ->fetchAll();
                         
        $total = $this->db->from($this->table)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->where('tipo_re', $id)
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
                        ->where('id_re', $id)
                        ->fetch();
    }
    
    //REGISTRAR USUARIO
    public function registrar($data){

        $file = $_FILES["img_re"]["name"];
        $foto = date("Y-m-d").date("H-I-s").'.jpg';
        $data['img_re'] = $foto;
        move_uploaded_file($_FILES["img_re"]["tmp_name"], "imagenes/".$foto);
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
        
        $this->db->update($this->table, $data)
                 ->where('id_re', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_re', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}