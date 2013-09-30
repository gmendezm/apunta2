<?php

class Login extends CI_Model {

//Tablas en la base de datos
    private $contacto = 'contacto';

//Constructor de la Clase
    function __construct() {
        parent::__construct();
    }

    /*
     * Consulta el usuario, si la contraseña y el usuario coinciden
     * retorna todos los datos del usuario.
     * Si no hy coincidencia retorna NULL.
     */

    function existe_usuario($username, $password) {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get($this->contacto);

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return NULL;
        }
    }

}
?>