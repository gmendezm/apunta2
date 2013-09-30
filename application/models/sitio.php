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

class Sitio extends CI_Model {

//Tablas en la base de datos
    private $sitios = 'sitios_interes';

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

        $query = $this->db->query("SELECT * FROM  sitios_interes WHERE estado = 'activo' ");

        if ($query->num_rows() > 0)
            return $query;
        else {
            return NULL;
        }
    }

    function consultar_sugeridos() {

        $query = $this->db->query("SELECT sitio.id, sitio.id_categoria, sitio.id_usuario,categorias.nombre as categoria, usuarios.usuario as usuario, sitio.nombre, sitio.latitud, sitio.longitud, sitio.estado 
                                    FROM sitios_interes as sitio, categorias, usuarios
                                    WHERE sitio.id_categoria = categorias.id
                                    AND sitio.id_usuario = usuarios.id_usuario
                                    AND sitio.estado = 'inactivo'");

        if ($query->num_rows() > 0)
            return $query;
        else {
            return NULL;
        }
    }

    function consultar_especifica($id_categoria) {

        $query = "SELECT * FROM sitios_interes
                  WHERE id_categoria = $id_categoria 
                  AND estado = 'activo' ";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }

    function consultar_sitio_especifico($id_sitio) {

        $query = "SELECT * FROM sitios_interes
                  WHERE id = $id_sitio";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }

    //retorna el id del ultimo registro en la tabla de sitio
    function consultar_sitio_id() {

        $query = "SELECT MAX(id) as id
                  FROM sitios_interes";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
            return $result;
        else {
            return NULL;
        }
    }

    function insertar($datos) {
        try {
            $this->db->insert($this->sitios, $datos);

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
        $this->db->delete($this->sitios);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function editar($id, $datos) {

        $this->db->where('id', $id);
        $this->db->update($this->sitios, $datos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>