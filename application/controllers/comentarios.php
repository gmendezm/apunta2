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

class Comentarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('comentario');
    }

    function index() {
       
    }

    /*
     * Carga la vista de la pagina principal, donde el usuario
     * tiene la opcion de selecionar si desea agragar una nueva 
     * solicitud para prestamo del laboratorio o de un activo.
     */
    
    function consultar_especifica($id_imagen_url) {

        $id = $this->input->post("id");
        
        $query = null;

        if ($id === false) {
            $query = $this->ci->comentario->consultar_especifica($id_imagen_url);
        } else {
            $query = $this->ci->comentario->consultar_especifica($id);
            }
            
            $arrayR = array();

            foreach ($query->result() as $row) {

                $arraytemp = array();
                
                $arraytemp["id"]          = $row->id;
                $arraytemp["id_imagen"]   = $row->id_imagen;
                $arraytemp["usuario"]   = $row->usuario;
                $arraytemp["comentario"]  = $row->comentario;

                $arrayR[] = $arraytemp;
            }

            echo json_encode($arrayR);
    }
    
    
   function insertar($id_imagen_url,$usuario_url, $comentario_url) {

        $id_imagen = $this->input->post("id_imagen");
        $usuario = $this->input->post("usuario");
        $comentario = $this->input->post("comentario");
        
        $data = array();

        if ($comentario === false) {
            $data["id_imagen"] = $id_imagen_url;
            $data["usuario"]   = $usuario_url;
            $data["comentario"] = $comentario_url;
        } else {
            $data["id_imagen"] = $id_imagen;
            $data["usuario"]   = $usuario;
            $data["comentario"] = $comentario;
        }
        $query = $this->ci->comentario->insertar($data);

        echo json_encode($query);
    }



}

?>
