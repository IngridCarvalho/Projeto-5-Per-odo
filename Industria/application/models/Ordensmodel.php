<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordensmodel extends CI_Model {

    public function get_ordem() {
        $this->db->order_by('codigo','CRESC');
		$result = $this->db->get('ordemproducao')->result();
        return $result;
    }

    public function get_status() {
		$result = $this->db->get('status_ordem')->result();
		return $result;
	}
        
    public function get_ordens($codigo){
        $this->db->where('codigo',$codigo);
        $result = $this->db->get('ordemproducao')->result();
        return $result;
    }

    public function get_componentes(){
        $this->db->order_by('nome','CRESC');
        $produto = $this->db->get('produtos')->result();
        return $produto;
    }


 }