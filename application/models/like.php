<?php

/*
  Document   : newEmptyPHP
  Created on : 09/04/2013, 12:50:41 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */

class Like extends CI_Model {

//Tablas en la base de datos
    private $likes = 'likes';

//Constructor de la Clase
    function __construct() {

        parent::__construct();
    }

    /*
     * Obtiene los activos
     * Retorna la consulta si esta obtuvo resultados
     * de lo contario retorna NULL
     */

    
        function consultar_especifica($id_imagen) {

        $query = "SELECT COUNT('id_imagen') as cantidad FROM likes
                  WHERE id_imagen = $id_imagen ";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }
    
    

    function insertar($datos) {
        try {
            $this->db->insert($this->likes, $datos);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception;
        }
    }


}

?>