<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    
    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('usu/acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('bd/usuariosmodel');

        $dados['usuarios'] = $this->usuariosmodel->get_usuario();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/usuarios/usuariosview',$dados);
            $this->load->view('usu/includes/rodape');
    }

    public function msg($alert) {
		$str = '';
		if ($alert == 1)
                    $str = 'success- Usuário cadastrado com sucesso!';
		else if ($alert == 2)
                    $str = 'danger-Não foi possível cadastrar o usuário. Por favor, tente novamente!';
		else if ($alert == 3)
                    $str = 'success- Usuário removido com sucesso!';
		else if ($alert == 4)
                    $str = 'danger-Não foi possível remover a usuário. Por favor, tente novamente!';
		else if ($alert == 5)
                    $str = 'success- Usuário atualizado com sucesso!';
		else if ($alert == 6)
                    $str = 'danger-Não foi possível atualizar o usuário. Por favor, tente novamente!';
		else
                    $str = null;
		return $str;
	}
}