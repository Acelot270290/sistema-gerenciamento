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

			$this->session->set_flashdata('erro','Usuário não Encontrado');
			redirect('usuarios');

		}else{
			//Validação do formulario
			$this->form_validation->set_rules('first_name', 'Primeiro Nome','trim|required');
			$this->form_validation->set_rules('last_name', 'Sobrenome','trim|required');
			$this->form_validation->set_rules('email', 'email','trim|required|valid_email|callback_email_check');
			$this->form_validation->set_rules('username', 'Nome de Usuário','trim|callback_username_check');
			$this->form_validation->set_rules('password','Senha', 'min_length[5]|max_length[255]');
			$this->form_validation->set_rules('confirm_password','Confirma Senha', 'matches[password]');
			
			
			if($this->form_validation->run()){

				$data = elements(
					array(
						'first_name',
						'last_name',
						'email',
						'username',
						'active',
						'password',

					),$this->input->post()

				);

				$data = $this->security->xss_clean($data);
				$password = $this->input->post('password');
				if(!$password){
					unset($data['password']);

				}

				if($this->ion_auth->update($usuario_id, $data,)){
									//Verificar se está passando senha em branco
				/*echo '<prev>';
				print_r($data);
				exit();*/

				$perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();

				$perfil_usuario_post = $this->input->post('perfil_usuario');

				if($perfil_usuario_post != $perfil_usuario_db->id){

					//se for dirferente atualiza o grupo
					$this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
					$this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);

					}

					$this->session->set_flashdata('sucesso', 'Dados salvos com Sucesso');
				}else{
					
					$this->session->set_flashdata('erro', 'Erro ao Salvar');

				}
				redirect('usuarios');
			}else{

				$data = array(
					'titulo'=> 'Editar usuário',
					'usuario'=> $this->ion_auth->user($usuario_id)->row(),
					'perfil_usuario'=> $this->ion_auth->get_users_groups($usuario_id)->row()
				);
				$this->load->view('layout/header', $data);
				$this->load->view('usuarios/edit');
				$this->load->view('layout/footer'); 

			}

		}

	}
	public function email_check($email){

		$usuario_id = $this->input->post('usuario_id');

		if($this->core_model->get_by_id('users', array('email' => $email, 'id !='=> $usuario_id))){

			$this->form_validation->set_message('email_chek','Esse email já existe');

			return FALSE;

		}else{

			return TRUE;

		}
	}
	
	public function username_check($username){

		$usuario_id = $this->input->post('usuario_id');

		if($this->core_model->get_by_id('users', array('username' => $username, 'id !='=> $usuario_id))){

			$this->form_validation->set_message('username_check','Esse Usuário já existe');

			return FALSE;

		}else{

			return TRUE;

		}
	}

}

