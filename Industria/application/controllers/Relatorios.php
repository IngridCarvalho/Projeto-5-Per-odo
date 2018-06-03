<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        return true;
    }

    public function index(){
        $this->validar_sessao();
        $this->load->model('relatoriosmodel');

        $data_inicio = $this->input->post('data_inicial');
        $data_fim = $this->input->post('data_final');

        $dados['relatorio_custo'] = $this->relatoriosmodel->relatorio_itens_produzidos_custo($data_inicio, $data_fim);
        
            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/relatorios/custodeproducaoview', $dados);
            $this->load->view('usu/includes/rodape');
    }
}