<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{

	public function __construct(){
		parent::__construct();

		//definir se tem sessão
	}
	public function index() {

		$data = array(

			'titulo' => 'Usuários Cadastrados',

			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css'
			),
			

		'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
			),


			'usuarios' => $this->ion_auth->users()->result() //Pega todos os usuarios
		);

		$this->load->view('layout/header', $data);
		$this->load->view('usuarios/index');
		$this->load->view('layout/footer');
		


	}
	public function edit($usuario_id = NULL){

		if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){
			exit('Usuário não encontrado');
		}else{
			$data = array(
				'titulo'=> 'Editar usuário',
	
				'usuario'=> $this->ion_auth->user($usuario_id)->row(),
				'perfil_usuario'=> $this->ion_auth->get_users_groups($usuario_id)->row()
			);

			/*echo '<prev>';
			print_r($this->input->post());
			exit();*/

			$this->load->view('layout/header', $data);
			$this->load->view('usuarios/edit');
			$this->load->view('layout/footer');
		}

	}

}

