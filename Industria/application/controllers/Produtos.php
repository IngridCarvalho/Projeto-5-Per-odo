<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('produtosmodel');

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
        $this->load->model('produtosmodel','produtos');
        $dados['tipoproduto']=$this->produtos->get_tipo();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/novoprodutoview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function editar($cpf){
        $this->validar_sessao();
        $this->load->model('produtosmodel','produtos');
        $dados['produtos'] = $this->produtos->get_produtos($cpf);
        $dados['tipoproduto']=$this->produtos->get_tipo();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/editarprodutoview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function salvar(){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $info['nome'] = $this->input->post('nome');
        $info['quantidade'] = $this->input->post('quantidade');
        $info['preco_custo'] = $this->input->post('custo');
        $info['preco_venda'] = $this->input->post('venda');
        $info['tipo_produto'] = $this->input->post('tipo');

        $result = $this->bancomodel->insert('produtos',$info);
        if($result){
            redirect('produtos/1');
        }else{
            redirect('produtos/2');
        }
    }

    public function atualizar(){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $info['nome'] = $this->input->post('nome');
        $info['quantidade'] = $this->input->post('quantidade');
        $info['preco_custo'] = $this->input->post('custo');
        $info['preco_venda'] = $this->input->post('venda');
        $info['tipo_produto'] = $this->input->post('tipo');

        $codigo = $this->input->post('codigo');

        $result = $this->bancomodel->update('produtos',$info,$codigo);
        if($result){
            redirect('produtos/5');
        }else{
            redirect('produtos/6');
        }
        
    }

    public function deletar($codigo){
        $this->validar_sessao();
        $this->load->model('bancomodel');

        $result = $this->bancomodel->delete('produtos',$codigo);
        if($result){
            redirect('produtos/3');
        }else{
            redirect('produtos/4');
        }
    }

    public function componentes($codigo){
        $this->validar_sessao();
        $this->load->model('produtosmodel');
     
        $dados['produtos'] = $this->produtosmodel->get_componentes($codigo);
        $dados['produto'] = $this->produtosmodel->get_codigo($codigo);   
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/componentesview',$dados);
        $this->load->view('usu/includes/rodape');
    }

   
    public function incluircomponente($codigo_produto,$codigo_componente){
        $this->validar_sessao();
        $this->load->model('produtosmodel');
        
        $dados['produto'] = $codigo_produto;
        $dados['componente'] =  $codigo_componente;   

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/quantidadecomponenteview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluir($codigo_produto,$codigo_componente){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $this->load->model('produtosmodel');
        
        // $quantidade_componente = $this->produtosmodel->get_quantidade($codigo_componente);
        $quantidade_produto = $this->input->post('quantidade');
        
        // if($quantidade_componente >= $quantidade_produto){
            $info['quantidade_componente'] = $quantidade_produto;   
            // $atualizar_estoque['quantidade'] = $quantidade_componente - $quantidade_produto;
            // $this->bancomodel->update('produtos',$atualizar_estoque,$codigo_componente);
        
        // }else{
        //     redirect('produto/8');
        // }
        $info['codigo_produto'] = $codigo_componente;
        $info['codigo_composicao'] = $codigo_produto;
        
        
        $result = $this->bancomodel->insert('composicao',$info);
        if($result){
            redirect('produtos/7');
        }else{
            redirect('produtos/8');
        }

    }
    
      public function componentesincluidos($codigo){
        $this->validar_sessao();
        $this->load->model('produtosmodel');
     
        $dados['produtos'] = $this->produtosmodel-> get_componentes_incluidos($codigo);
        $dados['produto'] = $this->produtosmodel->get_codigo($codigo);   
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/produtos/componentesincluidosview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function excluir_componente($codigo){
        $this->validar_sessao();
        $this->load->model('produtosmodel');

        $result = $this->produtosmodel->delete('composicao',$codigo);
        if($result){
            redirect('produtos/9');
        }else{
            redirect('produtos/10');
        }
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
        else if ($alert == 9)
                    $str = 'success-Componente excluído com sucesso!';
        else if ($alert == 10)
                    $str = 'danger-Não foi possível excluir o componente. Por favor, tente novamente!';
        else
                    $str = null;
		return $str;
	}


}