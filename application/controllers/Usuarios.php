<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();

		//definir se tem sessão
	}
	public function index() {

		/*$data = array(
			'usuarios' => $this->ion_auth->users()->result(), //Pega todos os usuarios
		);*/

		$this->load->view('layout/header', $data);
		$this->load->view('usuarios/index');
		$this->load->view('layout/footer');

	}

}

