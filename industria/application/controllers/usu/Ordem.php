<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordem extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('usu/acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('bd/ordensmodel');

        $dados['ordens'] = $this->ordensmodel->get_ordem();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/ordem/ordemview',$dados);
            $this->load->view('usu/includes/rodape');
    }

    public function incluir(){
        $this->validar_sessao();
        $this->load->model('bd/ordensmodel','ordem');
        $dados['ordem']=$this->ordem->get_ordem();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/novaordemview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function editar($numero){
        $this->validar_sessao();
        $this->load->model('bd/ordensmodel','ordens');
        $dados['ordens'] = $this->ordens->get_ordens($numero);
        $dados['status']=$this->ordens->get_status();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/editarordemview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function salvar(){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');
        $info['numero'] = $this->input->post('numero');
        $info['descricao'] = $this->input->post('descricao');
        $info['data_emissao'] = implode('-',array_reverse(explode('/',$this->input->post('emissao'))));
        $info['data_finalizacao'] = implode('-',array_reverse(explode('/',$this->input->post('finalizacao'))));
        $info['status'] = 1;

        $result = $this->bancomodel->insert('ordemproducao',$info);
        if($result){
            redirect('usu/ordem/1');
        }else{
            redirect('usu/ordem/2');
        }
    }

    public function atualizar(){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');
        $info['numero'] = $this->input->post('numero');
        $info['descricao'] = $this->input->post('descricao');
        $info['data_emissao'] = implode('-',array_reverse(explode('/',$this->input->post('emissao'))));
        $info['data_finalizacao'] = implode('-',array_reverse(explode('/',$this->input->post('finalizacao'))));

        $id = $this->input->post('id');

        $result = $this->bancomodel->update('ordemproducao',$info,$id);
        if($result){
            redirect('usu/ordem/5');
        }else{
            redirect('usu/ordem/6');
        }
        
    }

    public function deletar($id){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');

        $result = $this->bancomodel->delete('ordemproducao',$id);
        if($result){
            redirect('usu/ordem/3');
        }else{
            redirect('usu/ordem/4');
        }
    }


    public function componentes(){
        $this->validar_sessao();
        $this->load->model('bd/ordensmodel');

        $dados['componentes'] = $this->ordensmodel->get_componentes();
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/ordemcomponentesview',$dados);
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
