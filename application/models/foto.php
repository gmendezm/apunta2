<?php

/*
  Document   : foto
  Created on : 20/06/2013, 07:27:21 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */
?>

<?php

class Foto extends CI_Model {

//Tablas en la base de datos
    private $foto = 'fotos';

//Constructor de la Clase
    function __construct() {

        parent::__construct();
    }

    /*
     * Inserta un album
     */
    function insertar_foto($datos) {

        $this->db->insert($this->foto, $datos);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();;
        } else {
            return -1;
        }
    }

    /*
     * Obtiene todos llas fotos 
     */
    function obtener_fotos($id_album) {
     
        $this->db->where('id_album', $id_album);
        $query = $this->db->get($this->foto);

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return NULL;
        }
    }
    
    /*
     * Elimina un albun
     */
    function eliminar_foto($id_foto) {
        
         $this->db->where('id_foto', $id_foto);
        $this->db->delete($this->foto);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    /*
     * Elimina un albun
     */
    function aprobar_fotos($id_foto) {
        
         $this->db->where('id_foto', $id_foto);
        $this->db->update($this->foto, array('estado' => 1));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
