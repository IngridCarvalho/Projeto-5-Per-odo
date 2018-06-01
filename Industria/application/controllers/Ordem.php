<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordem extends CI_Controller{

    public function validar_sessao(){
        if(!$this->session->userdata('LOGADO')){
            redirect('acesso');
        }
        return true;
    }

    public function index($alert=null){
        $this->validar_sessao();
        $this->load->model('ordensmodel');

        $dados['ordens'] = $this->ordensmodel->get_ordem();
        if($alert != null)
            $dados['alert'] = $this->msg($alert);

            $this->load->view('usu/includes/topo');
            $this->load->view('usu/includes/menu');
            $this->load->view('usu/ordem/ordemview',$dados);
            $this->load->view('usu/includes/rodape');
    }

    public function novaordem(){
        $this->validar_sessao();
        $this->load->model('ordensmodel','ordem');
        $dados['ordem']=$this->ordem->get_ordem();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/novaordemview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function editar($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel','ordens');
        $dados['ordens'] = $this->ordens->get_ordens($codigo);
        $dados['status']=$this->ordens->get_status();

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/editarordemview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function proximo(){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $info['descricao'] = $this->input->post('descricao');
        $info['data_emissao'] = $this->input->post('dataInicio'); /*implode('-',array_reverse(explode('/',$this->input->post('emissao')))); */
        $info['status'] = 1;

        $id_ordem = $this->bancomodel->insert_id('ordemproducao',$info);
        if($result){
            redirect('ordem/produtosincluidos/'.$id_ordem);
        }else{
            redirect('ordem/produtosincluidos/'.$id_ordem);
        }
    }

    public function atualizar(){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $info['descricao'] = $this->input->post('descricao');
       
        $codigo = $this->input->post('codigo');

        $result = $this->bancomodel->update('ordemproducao',$info,$codigo);
        if($result){
            redirect('ordem/5');
        }else{
            redirect('ordem/6');
        }
        
    }


    public function finalizar($codigo){
        $this->validar_sessao();
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('bancomodel');
        $info['data_finalizacao'] = Date("Y-m-d");
        $info['status'] = 2;

   //     $result = $this->bancomodel->insert('ordemproducao',$info);
        $result = $this->bancomodel->update('ordemproducao',$info,$codigo);

        if($result){
            redirect('ordem/7');
        }else{
            redirect('ordem/8');
        }
    }

    public function deletar($codigo){
        $this->validar_sessao();
        $this->load->model('bancomodel');

        $result = $this->bancomodel->delete('ordemproducao',$codigo);
        if($result){
            redirect('ordem/3');
        }else{
            redirect('ordem/4');
        }
    }

    public function produtos($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel');

        $dados['produtos'] = $this->ordensmodel->get_produtos();
    //    $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);
        $dados['codigo_ordem'] = $codigo;
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/ordemprodutosview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluirprodutos($codigo_ordem, $codigo_produto){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
        
        $dados['ordem'] = $codigo_ordem;
        $dados['produto'] =  $codigo_produto;   

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/quantidadeprodutoview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluir($codigo_ordem,$codigo_produto){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $this->load->model('ordensmodel');
        
        $info['quantidade_produzida'] = $this->input->post('quantidade');
        $info['custo_unitario'] = $this->ordensmodel->custo_uni_composicao($codigo_produto);
        $info['codigo_item'] = $codigo_produto;
        $info['numero_ordem'] = $codigo_ordem;
        
        
        $result = $this->bancomodel->insert('itensordemproducao',$info);
        if($result){
            redirect('ordem/produtosincluidos/'.$codigo_ordem);
        }else{
            redirect('ordem/produtosincluidos/'.$codigo_ordem);
        }

    }
    
    public function produtosincluidos($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
     
        $dados['produtos_ordem'] = $this->ordensmodel-> get_produtos_incluidos($codigo);
        $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);   
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/produtosincluidosview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function excluir_item($codigo){
        $this->validar_sessao();
        $this->load->model('bancomodel');

        $result = $this->bancomodel->delete('itensordemproducao',$codigo);
        if($result){
            redirect('ordem/produtosincluidos/'.$codigo);
        }else{
            redirect('ordem/produtosincluidos/'.$codigo);
        }
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
                    $str = 'success-Ordem de produção finalizado com sucesso!';
        else if ($alert == 8)
                    $str = 'danger-Não foi possível finalizar a ordem de produção. Por favor, tente novamente!';
        else if ($alert == 9)
                    $str = 'success-Item incluído com sucesso!';
        else if ($alert == 10)
                    $str = 'danger-Não foi possível incluir o item. Por favor, tente novamente!';
        else if ($alert == 11)
                    $str = 'success-Item excluído com sucesso!';
        else if ($alert == 12)
                    $str = 'danger-Não foi possível excluir o item. Por favor, tente novamente!';
        else
                    $str = null;
		return $str;
	}

}
