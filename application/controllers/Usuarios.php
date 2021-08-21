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

	public function add(){

			$this->form_validation->set_rules('first_name', 'Primeiro Nome','trim|required');
			$this->form_validation->set_rules('last_name', 'Sobrenome','trim|required');
			$this->form_validation->set_rules('email', 'email','trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('username', 'Nome de Usuário','trim|is_unique[users.username]');
			$this->form_validation->set_rules('password','Senha','min_length[5]|max_length[255]');
			$this->form_validation->set_rules('confirm_password','Confirma Senha', 'matches[password]');

			if($this->form_validation->run()){


				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
				$email = $this->security->xss_clean($this->input->post('email'));
				$addtional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'active' => $this->input->post('active'),
				);
				$group = array($this->input->post('perfil_usuario'));

				$addtional_data = $this->security->xss_clean($addtional_data);
				$group = $this->security->xss_clean($group);

				 /*'<prev>';
				print_r($username);
				print_r($password);
				print_r($email);
				print_r($addtional_data);
				exit();*/

				
				if($this->ion_auth->register($username, $email,$password, $addtional_data, $group)){
					$this->session->set_flashdata('sucesso','Dados salvos com sucesso');

				}else{
				
					$this->session->set_flashdata('erro','Erro ao salvar os Dados');
					
				}
				redirect('usuarios');				

			}else{
				//Erro na Validação
				
			$data = array(
					'titulo'=> 'Cadastrar Usuário',
			);
				
		$this->load->view('layout/header', $data);
		$this->load->view('usuarios/add');
		$this->load->view('layout/footer'); 
			}
			
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

	public function del($usuario_id = NULL){

		if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){

			$this->session->set_flashdata('erro', 'Usuário não encontrado');
			redirect('usuarios');
		}

		if($this->ion_auth->is_admin($usuario_id)){
			$this->session->set_flashdata('erro', 'O administrador não pode ser excluido');
			redirect('usuarios');

		}
		
		if($this->ion_auth->delete_user($usuario_id)){

			$this->session->set_flashdata('sucesso', 'Usuário Excluido com sucesso!');
			redirect('usuarios');
			

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

