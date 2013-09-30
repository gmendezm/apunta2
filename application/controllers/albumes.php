<?php

/*
  Document   : albumes
  Created on : 17/06/2013, 10:49:38 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */
?>

<?php

class Albumes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
    }

    /*
     * Inserta un album
     */

    function insertar_album() {

        $id_sitios_interes = $this->input->post('id_sitios_interes');
        $nombre_album = $this->input->post('nombre_album');
        
        $datos_album = array(
            'id_sitios_interes' => $id_sitios_interes,
            'nombre_album' => $nombre_album,
        );

        $this->load->Model('Album', 'model_Album', 'default');
        $id_album = $this->model_Album->insertar_album($datos_album);

        echo json_encode(array('id_album' => $id_album));
    }

    /*
     * Edita un album
     */

    function editar_album() {

        $id_album = $this->input->post('id_album');
        $id_sitios_interes = $this->input->post('id_sitios_interes');
        $nombre_album = $this->input->post('nombre_album');

        $datos_album = array(
            'id_sitios_interes' => $id_sitios_interes,
            'nombre_album' => $nombre_album,
        );

        $this->load->Model('Album', 'model_Album', 'default');
        $resultado = $this->model_Album->editar_album($id_album, $datos_album);

        if ($resultado) {

            echo json_encode(array('resultado' => 'editadoExito'));
        } else {

            echo json_encode(array('resultado' => 'editadoFracaso'));
        }
    }

    /*
     * Obtine todos los album de un sitio
     */

    function obtener_albumes() {

        $id_sitios_interes = $this->input->post('id_sitios_interes');
        
        $this->load->Model('Album', 'model_Album', 'default');
        $query = $this->model_Album->obtener_albumes($id_sitios_interes);

        if ($query === NULL) {
            return NULL;
        } else {

            $albumes;

            foreach ($query->result() as $album) {

                $albumes[] = array(
                    'id_album' => $album->id_album,
                    'id_sitios_interes' => $album->id_sitios_interes,
                    'nombre_album' => $album->nombre_album,
                );
            }
            echo json_encode($albumes);
        }
    }

    /*
     * Elimina un album
     */

    function eliminar_album() {

        $id_album = $this->input->post('id_album');

        $this->load->Model('Album', 'model_Album', 'default');
        $resultado = $this->model_Album->eliminar_album($id_album);

        if ($resultado) {

            echo json_encode(array('resultado' => 'eliminadoExito'));
        } else {
            echo json_encode(array('resultado' => 'eliminadoFracaso'));
        }
    }

}
?>
