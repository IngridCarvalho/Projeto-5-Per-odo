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
        
    public function get_produtos($codigo){
        $this->db->where('codigo',$codigo);
        $result = $this->db->get('produtos')->result();
        return $result;
    }

    public function get_codigo($codigo){
        $this->db->where('codigo',$codigo);
        $result = $this->db->get('produtos')->result();
        return $result;
    }

     public function get_componentes($codigo){
         $this->db->order_by('codigo','CRESC');
         $this->db->where('codigo !=', $codigo);
         $produto = $this->db->get('produtos')->result();
         return $produto;
     }


    //public function get_componentes($codigo){
    //    $this->db->order_by('produtos.codigo','CRESC');
    //    $this->db->join('composicao','composicao.codigo_produto = produtos.codigo','right');
    //    $this->db->where('composicao.codigo_composicao !=', $codigo);
    //    $produto = $this->db->get('produtos')->result();
    //    return $produto;
    //}

    public function get_componentes_incluidos($codigo){
        $this->db->order_by('produtos.codigo','CRESC');
        $this->db->select('composicao.codigo_produto');
        $this->db->select('produtos.nome');
        $this->db->select('composicao.quantidade_componente');
        $this->db->join('composicao','composicao.codigo_produto = produtos.codigo','inner');
        $this->db->where('composicao.codigo_composicao =', $codigo);
        $produto = $this->db->get('produtos')->result();
        return $produto;
    }
    public function get_quantidade($codigo){
        $this->db->select('quantidade');
        $this->db->where('codigo',$codigo);
        $query = $this->db->get('produtos');
        $result = $query->row();
        return $result;
    }
    
    public function get_qtd_componente($composicao, $componente){
        $this->db->where('codigo_composicao = ', $composicao, ' and codigo_produto = ', $componente);
        $result = $this->db->get('composicao')->result();
        return $result;
    }
    
    public function lista_componentes($codigo){
        $this->db->select('composicao.codigo_produto');
        $this->db->where('composicao.codigo_composicao =', $codigo);
        $componentes = $this->db->get('composicao')->result_array();
        
        $componentesIncluidos = [];
            foreach ($componentes as $key => $value) {
                $componentesIncluidos[] = $value["codigo_produto"];
            }
         
        if($componentesIncluidos){
            $this->db->order_by('codigo','CRESC');
            $this->db->where('codigo !=', $codigo);
            $this->db->where_not_in('produtos.codigo', $componentesIncluidos);
            $produtos = $this->db->get('produtos')->result();
        }else{
            $this->db->order_by('codigo','CRESC');
            $this->db->where('codigo !=', $codigo);
            $produtos = $this->db->get('produtos')->result();
        }
        
        return $produtos;
    }

    public function delete($tabela, $codigo) {
        $this->db->where('codigo_produto', $codigo);
	$result = $this->db->delete($tabela);
	return $result;
    }

    // public function delete_all($produto,$composicao,$codigo){
    //     $tabelas = array('composicao','produtos');
        
    //         $this->db->where('composicao.codigo_composicao',$codigo);
    //         $this->db->where('produto.codigo',$codigo);  
    //         return $this->db->delete($tabelas);  
    
    // }
  
        
	
//	public function get_noticia_slug($slug) {
//		$this->db->join('tipos', 'cod_tipo = tipos_cod_tipo', 'inner');
//		$this->db->where('slug_noticia', $slug);
//		$result = $this->db->get('noticias')->result();
//		return $result;
//	}
	
}