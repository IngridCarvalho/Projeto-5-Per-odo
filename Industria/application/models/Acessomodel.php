<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AcessoModel extends CI_Model {
	
	public function logar($cpf, $senha) {
		$this->db->where('cpf', $cpf);
		$this->db->where('senha', $senha);
		return $this->db->get('usuarios')->result();
	}
	
}