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
    
    public function update_2($tabela, $data, $composicao, $codigo) {
        $this->db->where('codigo_composicao = ', $composicao, ' and codigo_produto = ', $codigo);
	$result = $this->db->update($tabela, $data);
	return $result;
    }
	
    public function delete($tabela, $codigo) {
        $this->db->where('codigo', $codigo);
	$result = $this->db->delete($tabela);
	return $result;
    }
    
    function insert_id($tabela, $data) {
        $this->db->insert($tabela, $data);
        return $this->db->insert_id();
    }
}