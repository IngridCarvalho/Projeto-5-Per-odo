<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordensmodel extends CI_Model {

    public function get_ordem() {
        $this->db->order_by('numero','CRESC');
		$result = $this->db->get('ordemproducao')->result();
        return $result;
    }

    public function get_status() {
		$result = $this->db->get('status_ordem')->result();
		return $result;
	}
        
    public function get_produtos($numero){
        $this->db->where('numero',$numero);
        $result = $this->db->get('ordemproducao')->result();
        return $result;
    }

 }