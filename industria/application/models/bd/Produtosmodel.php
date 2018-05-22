<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produtosmodel extends CI_Model {

    public function get_produto() {
        $this->db->order_by('codigo','CRESC');
		$produto = $this->db->get('produtos')->result();
        return $produto;
    }

    public function get_tipo() {
		$result = $this->db->get('tipoproduto')->result();
		return $result;
	}
        
    public function get_produtos($nome){
        $this->db->where('nome',$nome);
        $result = $this->db->get('produtos')->result();
        return $result;
    }

    public function get_codigo($codigo){
        $this->db->where('codigo',$codigo);
        $result = $this->db->get('produtos')->result();
        return $result;
    }

    public function get_componentes(){
        $this->db->order_by('codigo','CRESC');
        $this->db->where('tipo_produto = 2');
        $produto = $this->db->get('produtos')->result();
        return $produto;
    }

    public function get_componente_codigo(){
        
    }

        
	
//	public function get_noticia_slug($slug) {
//		$this->db->join('tipos', 'cod_tipo = tipos_cod_tipo', 'inner');
//		$this->db->where('slug_noticia', $slug);
//		$result = $this->db->get('noticias')->result();
//		return $result;
//	}
	
}