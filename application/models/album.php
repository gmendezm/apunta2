<?php

/*
  Document   : album
  Created on : 17/06/2013, 10:52:12 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */
?>

<?php

class Album extends CI_Model {

//Tablas en la base de datos
    private $album = 'album';

//Constructor de la Clase
    function __construct() {

        parent::__construct();
    }

    /*
     * Inserta un album
     */
    function insertar_album($datos) {

        $this->db->insert($this->album, $datos);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();;
        } else {
            return -1;
        }
    }
    
    /*
     * Edita un album
     */
    function editar_album($id_abum, $datos) {

        $this->db->where('id_album', $id_abum);
        $this->db->update($this->album, $datos);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Obtiene todos los albumes para un sitio de interez
     */
    function obtener_albumes($id_sitios_interes) {
     
        $this->db->where('id_sitios_interes', $id_sitios_interes);
        $query = $this->db->get($this->album);

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return NULL;
        }
    }
    
    /*
     * Elimina un albun
     */
    function eliminar_album($id_album) {
        
         $this->db->where('id_album', $id_album);
        $this->db->delete($this->album);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
