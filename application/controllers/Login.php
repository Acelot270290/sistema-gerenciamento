<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
public function index(){

	/*
	[email] => alan.diniz@ucp.br 
	[password] => Acelot.270290 ) */

	$identity = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));
    $remember = FALSE; // remember the user

	if($this->ion_auth->login($identity, $password, $remember)){
		redirect('home');
	}else{
		$this->session->set_flashdata('erro','Verifique o seu email ou senha');
		$this->load->view('layout/header');
		$this->load->view('login/index');
		$this->load->view('layout/footer');
	
		}


	}
}
