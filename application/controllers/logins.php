<?php @session_start()?>

<?php

/*
  Document   : Controlador de inicio de sesión para Apunta2
  Created on : 30/09/2013, 01:12:33 PM
  Author     : gmendezm
  Description:

 */

class Logins extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('security');
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->model('Login');
    }

    function index() {
        //$this->consultar();
    }

    /*
     * Carga la vista de la pagina principal, donde el usuario
     * tiene la opcion de selecionar si desea agragar una nueva 
     * solicitud para prestamo del laboratorio o de un activo.
     */

    function entrar() {
		if(isset($_SESSION['username'])){
				echo "Estás conectado: " . $_SESSION['username'];
				echo "<form method='post' action='/apunta2/logins/cerrar_sesion'>";
				echo "<input type='submit' value='cerrar'>";
			echo "</form>";
		}else{
			echo "Bienvenido al sistema de apuntados...!";
			echo "<form method='post' action='/apunta2/logins/iniciar_sesion'>";
				echo "Username: <input type='text' name='username' />"."<br/>";
				echo "Password: <input type='password' name='password' />"."<br/>";
				echo "<input type='submit' value='Ingresar'>";
			echo "</form>";
		}
    }

	function cerrar_sesion(){
		if(isset($_SESSION["username"])){
			unset($_SESSION["username"]); 
			session_destroy();
			echo "Sesión Finalizada<br/>";
			echo "<a href='/apunta2/logins/entrar'>Iniciar Sesión</a>";
		} else{
			echo "No haz iniciado sesión<br/>";
			echo "<a href='/apunta2/logins/entrar'>Iniciar Sesión</a>";
		}
	}

    function iniciar_sesion() {

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $query = $this->ci->Login->existe_usuario($username, $password);

        if ($query === NULL) {

            //echo json_encode(array('resultado' => 'false'));
			
			echo "Este usuario no existe<br/>";
			echo "<a href='/apunta2/logins/entrar'>Iniciar Sesión</a>";

            return;
        } else {

            $row = $query->result();

			$_SESSION["username"]=$username;

            $usuario = array(
                'id_contacto' => $row[0]->id_contacto,
                'username' => $row[0]->username,
                'password' => $row[0]->password,
				'nombre' => $row[0]->nombre,
                'resultado' => 'true',
            );

           // echo json_encode($usuario);
			$this->entrar();
            return;
        }
    }

   

}

?>
