<?php

/*
  Document   : prestamo
  Created on : 06/04/2013, 02:24:33 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */

class Eventos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('evento');
    }

    function index() {
        $this->consultar();
    }

    /*
     * Carga la vista de la pagina principal, donde el usuario
     * tiene la opcion de selecionar si desea agragar una nueva 
     * solicitud para prestamo del laboratorio o de un activo.
     */

    function consultar() {

        $query = $this->ci->evento->consultar();

            $arrayR = array();

            foreach ($query->result() as $row) {

                $arraytemp = array();
                $arraytemp["id"]           = $row->id;
                $arraytemp["id_sitio"]  = $row->id_sitio;
                $arraytemp["nombre"]       = $row->nombre;
                $arraytemp["descripcion"]       = $row->descripcion;
                $arraytemp["fecha_inicio"]       = $row->fecha_inicio;
                $arraytemp["fecha_final"]       = $row->fecha_final;
                $arraytemp["repeticiones"]       = $row->repeticiones;
                  
                $arrayR[] = $arraytemp;
            }

            echo json_encode($arrayR);

    }

    function consultar_evento_especifico($id_evento) {

        $id = $this->input->post("id");
        $query = null;

        if ($id === false) {
            $query = $this->ci->evento->consultar_evento_especifico($id_evento);
        } else {
            $query = $this->ci->evento->consultar_evento_especifico($id);
            }
            
            $arrayR = array();

            foreach ($query->result() as $row) {

                $arraytemp = array();
                
                $arraytemp["id"]           = $row->id;
                $arraytemp["id_sitio"]  = $row->id_sitio;
                $arraytemp["nombre"]       = $row->nombre;
                $arraytemp["descripcion"]       = $row->descripcion;
                $arraytemp["fecha_inicio"]       = $row->fecha_inicio;
                $arraytemp["fecha_final"]       = $row->fecha_final;
                $arraytemp["repeticiones"]       = $row->repeticiones;

                $arrayR[] = $arraytemp;
            }

            echo json_encode($arrayR);
    }

    
    function consultar_especifica($id_sitio) {

        $id = $this->input->post("id");
        $query = null;

        if ($id === false) {
            $query = $this->ci->evento->consultar_especifica($id_sitio);
        } else {
            $query = $this->ci->evento->consultar_especifica($id);
            }
            
            $arrayR = array();

            foreach ($query->result() as $row) {

                $arraytemp = array();
                
                $arraytemp["id"]           = $row->id;
                $arraytemp["id_sitio"]  = $row->id_sitio;
                $arraytemp["nombre"]       = $row->nombre;
                $arraytemp["descripcion"]       = $row->descripcion;
                $arraytemp["fecha_inicio"]       = $row->fecha_inicio;
                $arraytemp["fecha_final"]       = $row->fecha_final;
                $arraytemp["repeticiones"]       = $row->repeticiones;

                $arrayR[] = $arraytemp;
            }

            echo json_encode($arrayR);
    }
    
    
   function insertar($id_sitio_url, $nombre_url, $descripcion_url, $fecha_inicio_url, $fecha_fin_url, $repeticiones_url) {

        $id_sitio = $this->input->post("id_sitio");
        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $fecha_inicio = $this->input->post("fecha_inicio");
        $fecha_final = $this->input->post("fecha_final");
        $repeticiones = $this->input->post("repeticiones");
        $data = array();

        if ($nombre === false) {
            $data["id_sitio"] = $id_sitio_url;
            $data["nombre"] = $nombre_url;
            $data["descripcion"] = $descripcion_url;
            $data["fecha_inicio"] = $fecha_inicio_url;
            $data["fecha_final"] = $fecha_fin_url;
            $data["repeticiones"] = $repeticiones_url;
        } else {
            $data["id_sitio"] = $id_sitio;
            $data["nombre"] = $nombre;
            $data["descripcion"] = $descripcion;
            $data["fecha_inicio"] = $fecha_inicio;
            $data["fecha_final"] = $fecha_final;
            $data["repeticiones"] = $repeticiones;
        }
        $query = $this->ci->evento->insertar($data);

        echo json_encode($query);
    }


     function editar($id_url,$id_sitio_url, $nombre_url, $descripcion_url, $fecha_inicio_url, $fecha_fin_url, $repeticiones_url) {

        $id = $this->input->post("id");
        $id_sitio = $this->input->post("id_sitio");
        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $fecha_inicio = $this->input->post("fecha_inicio");
        $fecha_final = $this->input->post("fecha_final");
        $repeticiones = $this->input->post("repeticiones");
        $data = array();

        if ($nombre === false) {
            $data["id_sitio"] = $id_sitio_url;
            $data["nombre"] = $nombre_url;
            $data["descripcion"] = $descripcion_url;
            $data["fecha_inicio"] = $fecha_inicio_url;
            $data["fecha_final"] = $fecha_fin_url;
            $data["repeticiones"] = $repeticiones_url;
        } else {
            $id_url = $id;
            $data["id_sitio"] = $id_sitio;
            $data["nombre"] = $nombre;
            $data["descripcion"] = $descripcion;
            $data["fecha_inicio"] = $fecha_inicio;
            $data["fecha_final"] = $fecha_final;
            $data["repeticiones"] = $repeticiones;
        }
        
        $query = $this->ci->evento->editar($id_url,$data);

        echo json_encode($query);
    }
    
    

    function eliminar($id_url) {

        $id = $this->input->post("id");

        if ($id === false) {
            $query = $this->ci->evento->eliminar($id_url);
        } else {
            $query = $this->ci->evento->eliminar($id);
        }

        echo json_encode($query);
    }

}

?>
