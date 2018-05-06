<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        return true;
    }

    public function index($alert = null){
        if($this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        $dados = null;
        if($alert != null){
            $dados['alert'] = $this->msg($alert);
        }
        $this->load->view('usu/loginview',$dados);
    }


    public function pagina(){
        if($this->validar_sessao()){
            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/includes/rodape');
        }else{
            redirect('usu/acesso');
        }
    }

    public function logar(){
        $this->load->model('acessomodel');

        $cpf = $this->input->post('cpf');
        $senha = md5($this->input->post('senha'));
        $usuario = $this->acessomodel->logar($cpf,$senha);

        if(count($usuario) === 1){
            $dados['nome'] = $usuario[0]->nome;
            $dados['LOGADO'] = TRUE;

            $this->session->set_userdata($dados);
            redirect('');
        }else{
            redirect('acesso/index/2');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('usu/loginview');
    }

   
    public function msg($alert){
        $str = '';
        if($alert == 1){
            $str = 'success - Login realizado com sucesso!';
        }elseif($alert == 2){
            $str = 'danger - Não foi possível realizar o login. Verifique o email e a senha e tente novamente!';
        }else{
            $str = null;
        }
        return $str;
    }
}

