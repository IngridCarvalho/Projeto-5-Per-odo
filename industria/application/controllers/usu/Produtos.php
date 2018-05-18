<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('usu/acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('bd/produtosmodel');

        $dados['produtos'] = $this->produtosmodel->get_produto();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/produtos/produtosview',$dados);
            $this->load->view('usu/includes/rodape');
    }

    public function cadastro(){
        $this->validar_sessao();
        $this->load->model('bd/produtosmodel','produtos');
        $dados['tipoproduto']=$this->produtos->get_tipo();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/novoprodutoview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function editar($nome){
        $this->validar_sessao();
        $this->load->model('bd/produtosmodel','produtos');
        $dados['produtos'] = $this->produtos->get_produtos($nome);
        $dados['tipoproduto']=$this->produtos->get_tipo();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/editarprodutoview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function salvar(){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');
        $info['codigo'] = $this->input->post('codigo');
        $info['nome'] = $this->input->post('nome');
        $info['quantidade'] = $this->input->post('quantidade');
        $info['preco_custo'] = $this->input->post('custo');
        $info['preco_venda'] = $this->input->post('venda');
        $info['tipo_produto'] = $this->input->post('tipo');

        $result = $this->bancomodel->insert('produtos',$info);
        if($result){
            redirect('usu/produtos/1');
        }else{
            redirect('usu/produtos/2');
        }
    }

    public function atualizar(){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');
        $info['codigo'] = $this->input->post('codigo');
        $info['nome'] = $this->input->post('nome');
        $info['quantidade'] = $this->input->post('quantidade');
        $info['preco_custo'] = $this->input->post('custo');
        $info['preco_venda'] = $this->input->post('venda');
        $info['tipo_produto'] = $this->input->post('tipo');

        $id = $this->input->post('id');

        $result = $this->bancomodel->update('produtos',$info,$id);
        if($result){
            redirect('usu/produtos/5');
        }else{
            redirect('usu/produtos/6');
        }
        
    }

    public function deletar($id){
        $this->validar_sessao();
        $this->load->model('bd/bancomodel');

        $result = $this->bancomodel->delete('produtos',$id);
        if($result){
            redirect('usu/produtos/3');
        }else{
            redirect('usu/produtos/4');
        }
    }

    public function componentes(){
        $this->validar_sessao();
        $this->load->model('bd/produtosmodel');

        $dados['produtos'] = $this->produtosmodel->get_componentes();
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/componentesview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluir(){
        $this->validar_sessao();
        $this->load->model('bd/produtosmodel');
        $info['codigo_produto'] = $this->input->post('componente');
        $info['quantidade_componente'] = $this->input->post('componente');
    }

    public function msg($alert) {
		$str = '';
		if ($alert == 1)
                    $str = 'success- Produto cadastrado com sucesso!';
		else if ($alert == 2)
                    $str = 'danger-Não foi possível cadastrar o produto. Por favor, tente novamente!';
		else if ($alert == 3)
                    $str = 'success- Produto removido com sucesso!';
		else if ($alert == 4)
                    $str = 'danger-Não foi possível remover o produto. Por favor, tente novamente!';
		else if ($alert == 5)
                    $str = 'success- Produto atualizado com sucesso!';
		else if ($alert == 6)
                    $str = 'danger-Não foi possível atualizar o produto. Por favor, tente novamente!';
        else if ($alert == 7)
                    $str = 'success-Componente incluído com sucesso!';
        else if ($alert == 8)
                    $str = 'danger-Não foi possível incluir o componente. Por favor, tente novamente!';
        else
                    $str = null;
		return $str;
	}


}