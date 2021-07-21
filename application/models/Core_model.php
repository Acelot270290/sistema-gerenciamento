<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_model {

	public function get all($tabela = NULL , $condicao = NULL){
		
		if ($tabela) {

			if(is_array($condicao){

				$this->db->where($condicao);

			}
			return $this->db->get($tabela)->result();

		}else{

			return FALSE;
		}
		public function get_by_id($tabela = NULL, $condicao = NULL){
			
			if($tabela && is_array($condicao)){

				$this-db-where($condicao);
				$this->db->limit(1);

				return $this->db-get($tabela)->row();
			}else{
				return FALSE;
			}
		}
		public function insert ($tabela = NULL, $data = NULL, $get_lasta_id = NULL){

			if($tabela && is_array($data)){

				$this->db->insert($tabela, $data);

				if($get_lasta_id){

					$this=>session->set_userdata('last_id', $this->db->insert_id());

				}

				if(this->db->affected_rows() > 0){

					this->session->set_flashdata('Sucesso', 'Dados Salvos com Sucesso')

				}else{

					this->session->set_flashdata('ERRO', 'Erros em salva os dados')


				}

			}

		}

		public function insert ($tabela = NULL, $data = NULL, $condicao = NULL){

			if($tabela && is_array($data) && is_array($condicao)){

				if($this->db->update($tabela, $data, $condicao));{

					this->session->set_flashdata('Sucesso', 'Dados Salvos com Sucesso');


				}else{

					this->session->set_flashdata('ERRO', 'Erro ao atualizar os dados');
				}


			}else{

				return FALSE;
			}

		

		}
		public function delete ($tabela = NULL, $data = NULL){

			$thi->db->db_debug = FALSE;

			if($tabela && is_array($condicao)){

				$status = $this->db->delete($tabela, $condicao);

				$erro = $this->db->erro();

				if(!$status){

					foreach ($$erro as $code) {
						if($code == 1451){


							$this->session->set_flashdata('Erro','Esse registro naso poderar ser excluido, pois está sendo utilizado em outra tabela');

						}
					}

				}else{
							$this->session->set_flashdata('Deletado com Sucesso','Registro excluido com Sucesso');

				}

			$thi->db->db_debug = TRUE;


			}else{

				return FALSE;


		}
	}
	
}
