<?php
namespace App\Model;

use App\Lib\Response;

class ContactosModel{
    private $db;
    private $table = 'dietas';
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
                         ->where('tipo_die', $id)
                         ->orderBy('id_die DESC')
                         ->fetchAll();
                         
        $total = $this->db->from($this->table)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->where('tipo_die', $id)
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
                        ->where('id_die', $id)
                        ->fetch();
    }
    
    //REGISTRAR USUARIO
    public function registrar($data){
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
        $this->db->update($this->table, $data)
                 ->where('id_die', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_die', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}