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

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('categoria');
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

        $query = $this->ci->categoria->consultar();

        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["id"] = $row->id;
            $arraytemp["nombre"] = $row->nombre;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }
    
    
    

    function consultar_especifica($id_categoria) {

        $id = $this->input->post("id");
        $query = null;

        if ($id === false) {
            $query = $this->ci->categoria->consultar_especifica($id_categoria);
        } else {
            $query = $this->ci->categoria->consultar_especifica($id);
        }


        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["nombre"] = $row->nombre;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }

    function insertar($nombre_url) {

        $nombre = $this->input->post("nombre");
        $data = array();

        if ($nombre === false) {
            $data['nombre'] = $nombre_url;
            $query = $this->ci->categoria->insertar($data);
        } else {
            $data['nombre'] = $nombre;
            $query = $this->ci->categoria->insertar($data);
        } 
        

        echo json_encode($query);
    }

    function editar($id_url, $nombre_url) {


        $id = $this->input->post("id");
        $nombre = $this->input->post("nombre");

        $data = array();

        if ($nombre === false) {
            $data['nombre'] = $nombre_url;
            $query = $this->ci->categoria->editar($id_url, $data);
        } else {
            $data['nombre'] = $nombre;
            $query = $this->ci->categoria->editar($id, $data);
        }

        echo json_encode($query);
    }

    function eliminar($id_url) {

        $id = $this->input->post("id");

        if ($id === false) {
            $query = $this->ci->categoria->eliminar($id_url);
        } else {
            $query = $this->ci->categoria->eliminar($id);
        }

        echo json_encode($query);
    }

}

?>
