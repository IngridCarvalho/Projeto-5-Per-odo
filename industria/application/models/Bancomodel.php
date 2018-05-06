<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bancomodel extends CI_Model{

    public function insert($tabela, $data) {
        $result = $this->db->insert($tabela, $data);
        return $result;
    }
	
    public function update($tabela, $data, $codigo) {
        $this->db->where('codigo', $codigo);
	$result = $this->db->update($tabela, $data);
	return $result;
    }
	
    public function delete($tabela, $codigo) {
        $this->db->where('codigo', $codigo);
	$result = $this->db->delete($tabela);
	return $result;
    }
}