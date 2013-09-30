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

class Evento extends CI_Model {

//Tablas en la base de datos
    private $eventos = 'eventos';

//Constructor de la Clase
    function __construct() {

        parent::__construct();
    }

    /*
     * Obtiene los activos
     * Retorna la consulta si esta obtuvo resultados
     * de lo contario retorna NULL
     */

    function consultar() {

        $query = $this->db->query('SELECT * FROM ' . $this->eventos);

        if ($query->num_rows() > 0)
            return $query;
        else {
            return NULL;
        }
    }

    function consultar_evento_especifico($id_evento) {

        $query = "SELECT * FROM eventos
                  WHERE id = $id_evento ";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }
    
    
    
        function consultar_especifica($id_sitio) {

        $query = "SELECT * FROM eventos
                  WHERE id_sitio = $id_sitio ";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }
    
    

    function insertar($datos) {
        try {
            $this->db->insert($this->eventos, $datos);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception;
        }
    }

    function eliminar($id) {

        $this->db->where('id', $id);
        $this->db->delete($this->eventos);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function editar($id, $datos) {

        $this->db->where('id', $id);
        $this->db->update($this->eventos, $datos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>