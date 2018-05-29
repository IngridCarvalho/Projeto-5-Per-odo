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

    public function salvar(){
        $this->validar_sessao();
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('bancomodel');
        $info['descricao'] = $this->input->post('descricao');
        $info['data_emissao'] = Date("Y-m-d"); /*implode('-',array_reverse(explode('/',$this->input->post('emissao')))); */
        $info['status'] = 1;

        $result = $this->bancomodel->insert('ordemproducao',$info);
        if($result){
            redirect('ordem/1');
        }else{
            redirect('ordem/2');
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

    public function componentes($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel');

        $dados['componentes'] = $this->ordensmodel->get_componentes($codigo);
        $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/ordemcomponentesview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluircomponente($codigo_ordem,$codigo_componente){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
        
        $dados['ordem'] = $codigo_ordem;
        $dados['componente'] =  $codigo_componente;   

        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/quantidadecomponenteview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function incluir($codigo_ordem,$codigo_componente){
        $this->validar_sessao();
        $this->load->model('bancomodel');
        $this->load->model('ordensmodel');
        
        // $quantidade_componente = $this->produtosmodel->get_quantidade($codigo_componente);
        $quantidade_ordem = $this->input->post('quantidade');
        
        // if($quantidade_ordem >= $quantidade_produto){
            $info['quantidade_produzida'] = $quantidade_ordem;   
            // $atualizar_estoque['quantidade'] = $quantidade_componente - $quantidade_produto;
            // $this->bancomodel->update('produtos',$atualizar_estoque,$codigo_componente);
        
        // }else{
        //     redirect('produto/8');
        // }
        $info['custo_unitario'] = $this->input->post('custo');
        $info['codigo_item'] = $codigo_componente;
        $info['numero_ordem'] = $codigo_produto;
        
        
        $result = $this->bancomodel->insert('composicao',$info);
        if($result){
            redirect('ordem/9');
        }else{
            redirect('ordem/10');
        }

    }
    
    public function componentesincluidos($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
     
        $dados['ordens'] = $this->ordensmodel-> get_componentes_incluidos($codigo);
        $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);   
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/componentesincluidosview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function excluir_componente($codigo){
        $this->validar_sessao();
        $this->load->model('bancomodel');

        $result = $this->bancomodel->delete('itensordemproducao',$codigo);
        if($result){
            redirect('ordem/11');
        }else{
            redirect('ordem/12');
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
                    $str = 'success-Componente incluído com sucesso!';
        else if ($alert == 10)
                    $str = 'danger-Não foi possível incluir o componente. Por favor, tente novamente!';
        else if ($alert == 11)
                    $str = 'success-Componente excluído com sucesso!';
        else if ($alert == 12)
                    $str = 'danger-Não foi possível excluir o componente. Por favor, tente novamente!';
        else
                    $str = null;
		return $str;
	}

}
