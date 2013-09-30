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

class Likes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('like');
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
            $query = $this->ci->like->consultar_especifica($id_imagen_url);
        } else {
            $query = $this->ci->like->consultar_especifica($id);
            }
            
            $arrayR = array();

            foreach ($query->result() as $row) {

                $arraytemp = array();
                
                $arraytemp["cantidad"]  = $row->cantidad;

                $arrayR[] = $arraytemp;
            }

            echo json_encode($arrayR);
    }
    
    
   function insertar($id_imagen_url,$usuario_url) {

        $id_imagen = $this->input->post("id_imagen");
        $usuario = $this->input->post("usuario");
        
        $data = array();

        if ($id_imagen === false) {
            $data["id_imagen"] = $id_imagen_url;
            $data["id_usuario"]   = $usuario_url;
        } else {
            $data["id_imagen"] = $id_imagen;
            $data["id_usuario"]   = $usuario;
        }
        $query = $this->ci->like->insertar($data);

        echo json_encode($query);
    }



}

?>
