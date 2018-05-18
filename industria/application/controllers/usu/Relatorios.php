<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('usu/acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('bd/relatoriosmodel');

        //$dados['ordens'] = $this->relatoriosmodel->get_ordem();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/relatorios/custodeproducaoview');
            $this->load->view('usu/includes/rodape');
    }

    public function msg($alert) {
		$str = '';
		if ($alert == 1)
                    $str = 'success- Ordem de produção cadastrada com sucesso!';
		else if ($alert == 2)
                    $str = 'danger-Não foi possível cadastrar a ordem de produção. Por favor, tente novamente!';
		else if ($alert == 3)
                    $str = 'success- Ordem de produção removida com sucesso!';
		else if ($alert == 4)
                    $str = 'danger-Não foi possível remover a ordem de produção. Por favor, tente novamente!';
		else if ($alert == 5)
                    $str = 'success- Ordem de produção atualizada com sucesso!';
		else if ($alert == 6)
                    $str = 'danger-Não foi possível atualizar a ordem de produção. Por favor, tente novamente!';
        else if ($alert == 7)
                    $str = 'success-Componente incluído com sucesso!';
        else if ($alert == 8)
                    $str = 'danger-Não foi possível incluir o componente. Por favor, tente novamente!';
        else
                    $str = null;
		return $str;
	}


}