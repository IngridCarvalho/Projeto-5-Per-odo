<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{

    public function multiexplode($delimiters,$string) {
   
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    
    
    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('usuariosmodel');

        $dados['usuarios'] = $this->usuariosmodel->get_usuario();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/usuarios/usuariosview',$dados);
            $this->load->view('usu/includes/rodape');
    }

    public function cadastro(){
        $this->validar_sessao();
        $this->load->model('usuariosmodel','usuarios');
        $dados['nivelusuarios']=$this->usuarios->get_nivel();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/usuarios/novousuarioview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function editar($codigo){
        $this->validar_sessao();
        $this->load->model('usuariosmodel','usuarios');
        $dados['usuarios'] = $this->usuarios->get_usuarios($codigo);
        $dados['nivelusuarios']=$this->usuarios->get_nivel();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/usuarios/editarusuarioview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function salvar(){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $info['cpf'] = implode($this->multiexplode(array('.','-'),$this->input->post('cpf')));
        $info['nome'] = $this->input->post('nome');
        $info['sobrenome'] = $this->input->post('sobrenome');
        $info['senha'] = md5($this->input->post('senha'));
        $info['fk_nivel'] = $this->input->post('nivel');

        $result = $this->bancomodel->insert('usuarios',$info);
        if($result){
            redirect('usuarios/1');
        }else{
            redirect('usuarios/2');
        }
        
    }

    public function atualizar(){
        $this->validar_sessao();
        $this->load->model('usuariosmodel');
        $info['nome'] = $this->input->post('nome');
        $info['sobrenome'] = $this->input->post('sobrenome');
        $info['senha'] = md5($this->input->post('senha'));
        $info['fk_nivel'] = $this->input->post('nivel');

        $cpf = $this->input->post('cpf');

        $result = $this->usuariosmodel->update_usuario('usuarios',$info,$cpf);
        if($result){
            redirect('usuarios/5');
        }else{
            redirect('usuarios/6');
        }
        
    }

    public function deletar($cpf){
        $this->validar_sessao();
        $this->load->model('usuariosmodel');

        $result = $this->usuariosmodel->delete_usuario('usuarios',$cpf);
        if($result){
            redirect('usuarios/3');
        }else{
            redirect('usuarios/4');
        }
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
