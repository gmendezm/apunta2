<?php

/*
  Document   : usuarios
  Created on : 08/06/2013, 11:37:19 AM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */
?>
<?php

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('Usuario');
    }

    function index() {
        $this->consultar();
    }

    function login() {

        $usuario = $this->input->post("usuario");
        $contrasenna = $this->input->post("contrasenna");

        $query = $this->ci->Usuario->login($usuario, $contrasenna);

        if ($query === NULL) {

            echo json_encode(array('resultado' => 'noEncontrado'));
            return;
        } else {

            $row = $query->result();

            $usuario = array(
                'id_usuario' => $row[0]->id_usuario,
                'usuario' => $row[0]->usuario,
                'contrasenna' => $row[0]->contrasenna,
                'correo' => $row[0]->correo,
                'tipo' => $row[0]->tipo,
                'resultado' => 'siEncontrado',
            );

            echo json_encode($usuario);
            return;
        }
    }

}
?>
