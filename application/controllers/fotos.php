<?php

/*
  Document   : fotos
  Created on : 20/06/2013, 07:30:00 PM
  Author     : David
  Description:

 */

/*
  TODO customize this sample style
 */
?>

<?php

class Fotos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
    }

    /*
     * Inserta una foto
     */

    function insertar_foto() {

        $id_album = $this->input->post('id_album');
        $foto = $this->input->post('foto');
        $estado = $this->input->post('estado');

        $datos_album = array(
            'id_album' => $id_album,
            'foto' => $foto,
            'estado' => $estado,
        );

        $this->load->Model('Foto', 'model_Foto', 'default');
        $id_foto = $this->model_Foto->insertar_foto($datos_album);

        echo json_encode(array('id_foto' => $id_foto));
    }

    /*
     * Obtine todas las fotos de un album
     */

    function obtener_fotos() {

        $id_album = $this->input->post('id_album');

        $this->load->Model('Foto', 'model_Foto', 'default');
        $query = $this->model_Foto->obtener_fotos($id_album);

        if ($query === NULL) {
            return NULL;
        } else {

            $fotos;

            foreach ($query->result() as $foto) {

                if((int)$foto->estado === 1){
                    $fotos[] = array(
                        'id_foto' => $foto->id_foto,
                        'id_album' => $foto->id_album,
                        'foto' => $foto->foto,
                        'estado' => $foto->estado,
                    );
                }
                
            }
            echo json_encode($fotos);
        }
    }

    /*
     * Obtine todas las fotos de un album sin aprobar
     */

    function obtener_fotos_sin_aprobar() {

        //$id_album = $this->input->post('id_album');
        $id_album = 6;

        $this->load->Model('Foto', 'model_Foto', 'default');
        $query = $this->model_Foto->obtener_fotos($id_album);

        if ($query === NULL) {
            return NULL;
        } else {

            $fotos;

            foreach ($query->result() as $foto) {

                if((int)$foto->estado === 0){
                    $fotos[] = array(
                        'id_foto' => $foto->id_foto,
                        'id_album' => $foto->id_album,
                        'foto' => $foto->foto,
                        'estado' => $foto->estado,
                    );
                }
            }
            echo json_encode($fotos);
        }
    }

    /*
     * Elimina un album
     */

    function eliminar_fotos() {

        $id_foto = $this->input->post('id_foto');
        
        $this->load->Model('Foto', 'model_Foto', 'default');
        $resultado = $this->model_Foto->eliminar_foto($id_foto);

        if ($resultado) {

            echo json_encode(array('resultado' => 'eliminadoExito'));
        } else {
            echo json_encode(array('resultado' => 'eliminadoFracaso'));
        }
    }
    /*
     * Elimina un album
     */

    function aprobar_fotos() {

        //$id_foto = $this->input->post('id_foto');
        $id_foto = 56;
        
        $this->load->Model('Foto', 'model_Foto', 'default');
        $resultado = $this->model_Foto->aprobar_fotos($id_foto);

        if ($resultado) {

            echo json_encode(array('resultado' => 'eliminadoExito'));
        } else {
            echo json_encode(array('resultado' => 'eliminadoFracaso'));
        }
    }

}
?>
