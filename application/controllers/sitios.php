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

class Sitios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('sitio');
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

        $query = $this->ci->sitio->consultar();

        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["id"] = $row->id;
            $arraytemp["id_categoria"] = $row->id_categoria;
            $arraytemp["id_usuario"] = $row->id_usuario;
            $arraytemp["nombre"] = $row->nombre;
            $arraytemp["latitud"] = $row->latitud;
            $arraytemp["longitud"] = $row->longitud;
            $arraytemp["estado"] = $row->estado;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }

    function consultar_sugeridos() {

        $query = $this->ci->sitio->consultar_sugeridos();

        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["id"] = $row->id;
            $arraytemp["id_categoria"] = $row->id_categoria;
            $arraytemp["id_usuario"] = $row->id_usuario;
            $arraytemp["categoria"] = $row->categoria;
            $arraytemp["usuario"] = $row->usuario;
            $arraytemp["nombre"] = $row->nombre;
            $arraytemp["latitud"] = $row->latitud;
            $arraytemp["longitud"] = $row->longitud;
            $arraytemp["estado"] = $row->estado;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }

    function consultar_especifica($id_categoria) {

        $id = $this->input->post("id");
        $query = null;

        if ($id === false) {
            $query = $this->ci->sitio->consultar_especifica($id_categoria);
        } else {
            $query = $this->ci->sitio->consultar_especifica($id);
        }


        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["id"] = $row->id;
            $arraytemp["id_categoria"] = $row->id_categoria;
            $arraytemp["id_usuario"] = $row->id_usuario;
            $arraytemp["nombre"] = $row->nombre;
            $arraytemp["latitud"] = $row->latitud;
            $arraytemp["longitud"] = $row->longitud;
            $arraytemp["estado"] = $row->estado;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }

    function consultar_sitio_especifico($id_sitio) {

        $id = $this->input->post("id");
        $query = null;

        if ($id === false) {
            $query = $this->ci->sitio->consultar_sitio_especifico($id_sitio);
        } else {
            $query = $this->ci->sitio->consultar_sitio_especifico($id);
        }

        $arrayR = array();

        foreach ($query->result() as $row) {

            $arraytemp = array();
            $arraytemp["id"] = $row->id;
            $arraytemp["id_categoria"] = $row->id_categoria;
            $arraytemp["id_usuario"] = $row->id_usuario;
            $arraytemp["nombre"] = $row->nombre;
            $arraytemp["latitud"] = $row->latitud;
            $arraytemp["longitud"] = $row->longitud;
            $arraytemp["estado"] = $row->estado;

            $arrayR[] = $arraytemp;
        }

        echo json_encode($arrayR);
    }

    //retorna el ultimo id en la tabla de sitios
    function consultar_sitio_id() {

        $array = array();
        $array_id = array();

        foreach ($this->ci->sitio->consultar_sitio_id()->result() as $id) {
            $array_id["id"] = $id->id;
        }
        $array[] = $array_id;

        echo json_encode($array);
    }

    function insertar($id_categoria_url, $id_usuario_url, $nombre_url, $latitud_url, $longitud_url, $estado_url) {

        $id_categoria = $this->input->post("id_categoria");
        $id_usuario = $this->input->post("id_usuario");
        $nombre = $this->input->post("nombre");
        $latitud = $this->input->post("latitud");
        $longitud = $this->input->post("longitud");
        $estado = $this->input->post("estado");
        $data = array();

        if ($nombre === false) {
            $data["id_categoria"] = $id_categoria_url;
            $data["id_usuario"] = $id_usuario_url;
            $data["nombre"] = $nombre_url;
            $data["latitud"] = $latitud_url;
            $data["longitud"] = $longitud_url;
            $data["estado"] = $estado_url;
        } else {
            $data["id_categoria"] = $id_categoria;
            $data["id_usuario"] = $id_usuario;
            $data["nombre"] = $nombre;
            $data["latitud"] = $latitud;
            $data["longitud"] = $longitud;
            $data["estado"] = $estado;
        }
        $query = $this->ci->sitio->insertar($data);

        echo json_encode($query);
    }

    function editar($id_url, $id_categoria_url, $id_usuario_url, $nombre_url, $latitud_url, $longitud_url, $estado_url) {

        $id = $this->input->post("id");
        $id_categoria = $this->input->post("id_categoria");
        $id_usuario = $this->input->post("id_usuario");
        $nombre = $this->input->post("nombre");
        $latitud = $this->input->post("latitud");
        $longitud = $this->input->post("longitud");
        $estado = $this->input->post("estado");
        $data = array();

        if ($nombre === false) {
            $id = $id_url;
            $data["id_categoria"] = $id_categoria_url;
            $data["id_usuario"] = $id_usuario_url;
            $data["nombre"] = $nombre_url;
            $data["latitud"] = $latitud_url;
            $data["longitud"] = $longitud_url;
            $data["estado"] = $estado_url;
        } else {
            $data["id_categoria"] = $id_categoria;
            $data["id_usuario"] = $id_usuario;
            $data["nombre"] = $nombre;
            $data["latitud"] = $latitud;
            $data["longitud"] = $longitud;
            $data["estado"] = $estado;
        }
        $query = $this->ci->sitio->editar($id, $data);

        echo json_encode($query);
    }

    function eliminar($id_url) {

        $id = $this->input->post("id");

        if ($id === false) {
            $id = $id_url;
        }
        $query = $this->ci->sitio->eliminar($id);

        echo json_encode($query);
    }

}

?>
