<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testemodel extends CI_Model {
	
	public function logar($cpf, $senha) {
		$this->db->where('cpf', $cpf);
		$this->db->where('senha', $senha);
		 
                if($this->db->get('usuarios')->result()){
                    return TRUE;
                }else{
                    return FALSE;
                }
	}
	
}