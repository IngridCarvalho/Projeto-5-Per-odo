<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariosmodel extends CI_Model {
	
	
//	public function get_livros($limit = null) {
//		$this->db->join('tipos', 'cod_tipo = tipos_cod_tipo', 'inner');
//		if ($limit != null) {
//			$this->db->limit($limit);
//		}
//		$this->db->order_by('cod_noticia','DESC');
//		$result = $this->db->get('notic')->result();
//		return $result;
//	}
	
	public function get_usuario() {
                $this->db->order_by('nome','CRESC');
		$filme = $this->db->get('usuarios')->result();
                return $filme;
               
        }
        
        public function get_nivel() {
		$result = $this->db->get('nivelusuarios')->result();
		return $result;
	}
        
        public function get_filmes($codigo){
            $this->db->where('codigo',$codigo);
            $result = $this->db->get('filmes')->result();
            return $result;
        }
	
//	public function get_noticia_slug($slug) {
//		$this->db->join('tipos', 'cod_tipo = tipos_cod_tipo', 'inner');
//		$this->db->where('slug_noticia', $slug);
//		$result = $this->db->get('noticias')->result();
//		return $result;
//	}
	
//	public function get_tipos_livros() {
//		$result = $this->db->get('livros')->result();
//		return $result;
//	}
        
        
}