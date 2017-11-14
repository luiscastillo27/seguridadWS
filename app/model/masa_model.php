<?php
namespace App\Model;

use App\Lib\Response;

class MasaModel{
    private $db;
    private $table = 'masa_corporal';
    private $response;
    
    public function __CONSTRUCT($db){
        $this->db = $db;
        $this->response = new Response();
    }
    
    //LISTAR
    public function listar($l, $p, $id){
        $data = $this->db->from($this->table)
                         ->limit($l)
                         ->offset($p)
                         ->where('idForeign_corporal', $id)
                         ->orderBy('fecha_corporal DESC')
                         ->fetchAll();
                         
        $total = $this->db->from($this->table)
                          ->select(null)
                          ->select('COUNT(*) Total')
                          ->where('idForeign_corporal', $id)
                          ->fetch()
                          ->Total;
        return [
            'data'  => $data,
            'total' => $total
        ];
    }
    
    //OBTENER UNO EN ESPECIFICO
    public function obtener($id){
        return $this->db->from($this->table)
                        ->where('id_corporal', $id)
                        ->fetch();
    }

    //OBTENER TODOS USUARIO
    public function obtenerTodos($id){
        return $this->db->from($this->table)
                        ->where('idForeign_corporal', $id)
                        ->orderBy('fecha_corporal DESC')
                        ->fetchAll();
    }
    
    //REGISTRAR USUARIO
    public function registrar($data){
        date_default_timezone_set('America/Monterrey');
      
        $data['fecha_corporal'] = date("d/m/Y - h:i a");
        $al = $data['altura_corporal'];
        $pe = $data['peso_corporal'];
        $alt = $al * $al;
        $imc = $pe/$alt;
        $data['imc_corporal'] = $imc;

        $imc = $data['imc_corporal'];
        

        if($imc < 16.00){
            $clasfi = "Delgadez Severa";
        } else {

            if($imc > 16.01 &&  $imc < 16.99){
                $clasfi = "Delgadez Moderada";
            } else {

              if($imc > 17.00  &&  $imc < 18.49){
                  $clasfi = "Delgadez Aceptable";
              } else {

                if($imc > 18.50  &&  $imc < 24.99){
                    $clasfi = "Peso Normal";
                } else {


                  if($imc > 25.00  &&  $imc < 29.99){
                      $clasfi = "Sobrepeso";
                  } else {

                    if($imc > 30.00  &&  $imc < 34.99){
                        $clasfi = "Obeso: Tipo I";
                    } else {

                      if($imc > 35.00  &&  $imc < 40.00){
                          $clasfi = "Obeso: Tipo II";
                      } else {

                        if($imc > 40.00){
                            $clasfi = "Obeso: Tipo III";
                        } 

                      }

                    }

                  }

                }

              }

            }
        }
        
        $data['clasificacion_corporal'] = $clasfi;
      
    
        $this->db->insertInto($this->table, $data)
                  ->execute();
        
        return $this->response->SetResponse(true);

    }
    
    //ACTUALIZAR USUARIO
    public function actualizar($data, $id){
        date_default_timezone_set('America/Monterrey');
       
        $data['fecha_corporal'] = date("d/m/Y - h:i a");
        $al = $data['altura_corporal'];
        $pe = $data['peso_corporal'];
        $alt = $al * $al;
        $imc = $pe/$alt;
        $data['imc_corporal'] = $imc;
        
        $this->db->update($this->table, $data)
                 ->where('id_corporal', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    //ELIMINAR USUARIO
    public function eliminar($id){
        $this->db->deleteFrom($this->table)
                 ->where('id_corporal', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 

    //ELIMINAR TODOS
    public function eliminarTodos($id){
        $this->db->deleteFrom($this->table)
                 ->where('idForeign_corporal', $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}