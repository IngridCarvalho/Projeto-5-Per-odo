<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariosmodel extends CI_Model {

        public function get_usuario() {
                $this->db->order_by('nome','CRESC');
		$usuario = $this->db->get('usuarios')->result();
                return $usuario;
               
        }
        
        public function get_nivel() {
		$result = $this->db->get('nivelusuarios')->result();
		return $result;
	}
        
        public function get_usuarios($nome){
            $this->db->where('nome',$nome);
            $result = $this->db->get('usuarios')->result();
            return $result;
        }

        public function delete_usuario($tabela, $cpf) {
                $this->db->where('cpf', $cpf);
                $result = $this->db->delete($tabela);
                return $result;
        }

        public function update_usuario($tabela, $data, $cpf) {
                $this->db->where('cpf', $cpf);
                $result = $this->db->update($tabela, $data);
                return $result;
            }
}