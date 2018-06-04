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
            redirect('ordem/produtosincluidos/'.$codigo);
        }else{
            redirect('ordem/produtosincluidos/'.$codigo);
        }
        
    }


    public function finalizar($codigo){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
     
        $dados['produtos_ordem'] = $this->ordensmodel->get_produtos_incluidos($codigo);
        $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);   
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/finalizarordemview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function finalizar_ordem($codigo_ordem){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
        $this->load->model('bancomodel');

        date_default_timezone_set('America/Sao_Paulo');
        $ordem['data_finalizacao'] = Date("Y-m-d");
        $ordem['status'] = 2;

        //select que traz os códigos incluidos na ordem para inserção das quantidades produzidas informadas
        $cod_produtos = $this->ordensmodel->get_cod_produtos_incluidos($codigo_ordem);

        //foreach para rodar e pegar as quantidades digitadas e atualizar todos os itens da ordem
        foreach ($cod_produtos as $key => $value) {

            $codigo_item = $value['codigo_item'];
            $codigo_item_ordem = $value['codigo'];
            $custo_total = $value['custo_total'];
            $qtd_produzida = $this->input->post($value['codigo_item']);
            $qtd_prevista = $value['quantidade_prevista'];

            $baixou_componentes = $this->baixa_estoque_componente($codigo_item, $qtd_prevista);

            $item_ordem['quantidade_produzida'] = $qtd_produzida;
            
            //pega a quantidade atual do estoque das composições
            $qtd_estoque = $this->ordensmodel->quantidade_estoque($codigo_item);

            //calcula a quantidade do estoque da composição
            $produto['quantidade'] = $qtd_estoque + $qtd_produzida;
            
            //atualiza o custo unitário do estoque e da ordem de produção
            $novo_custo_unitario = $custo_total / $qtd_produzida;
            $item_ordem['custo_unitario'] = $novo_custo_unitario;
            $produto['preco_custo'] = $novo_custo_unitario;

            //atualiza os dados no banco
            $result1 = $this->bancomodel->update('produtos', $produto, $codigo_item);
            $result2 = $this->bancomodel->update('itensordemproducao', $item_ordem, $codigo_item_ordem);

            if($result1 == null || $result2 == null){
                break;
                redirect('ordem/8');
            }
        }
        $result = $this->bancomodel->update('ordemproducao',$ordem,$codigo_ordem);

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
        
        $custo_unitario = $this->ordensmodel->custo_uni_composicao($codigo_produto);
        $quantidade = $this->input->post('quantidade');
        
        if($custo_unitario){
            $info['custo_unitario'] = $custo_unitario;
        }else{
            $info['custo_unitario'] = 0;
        }
        
        $info['quantidade_prevista'] = $quantidade;
        $info['codigo_item'] = $codigo_produto;
        $info['numero_ordem'] = $codigo_ordem;
        $info['custo_total'] = $custo_unitario * $quantidade;
        
        $result = $this->bancomodel->insert('itensordemproducao',$info);
        if($result){
            redirect('ordem/produtosincluidos/'.$codigo_ordem.'/9');
        }else{
            redirect('ordem/produtosincluidos/'.$codigo_ordem.'/10');
        }

    }
    
    public function produtosincluidos($codigo,$alert=null){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
     
        $dados['produtos_ordem'] = $this->ordensmodel-> get_produtos_incluidos($codigo);
        $dados['ordem'] = $this->ordensmodel->get_codigo($codigo);   
        
         if($alert != null)
            $dados['alert'] = $this->msg($alert);
     
        
        $this->load->view('usu/includes/topo');
        $this->load->view('usu/includes/menu');
        $this->load->view('usu/ordem/produtosincluidosview',$dados);
        $this->load->view('usu/includes/rodape');
    }

    public function excluir_item($codigo_item, $ordem){
        $this->validar_sessao();
        $this->load->model('bancomodel');

        $result = $this->bancomodel->delete('itensordemproducao',$codigo_item);
        if($result){
            redirect('ordem/produtosincluidos/'.$ordem.'/11');
        }else{
            redirect('ordem/produtosincluidos/'.$ordem.'/12');
        }
    }

    public function baixa_estoque_componente($codigo_composicao, $qtd_prevista){
        $this->validar_sessao();
        $this->load->model('ordensmodel');
        $this->load->model('bancomodel');

        $componentes = $this->ordensmodel->componentes($codigo_composicao);
       
        foreach ($componentes as $key => $value) {
            $qtd_estoque = $this->ordensmodel->quantidade_estoque($value['codigo_produto']);
            if(($qtd_estoque - ($value['quantidade_componente'] * $qtd_prevista)) < 0){
                redirect('ordem/13');
            }else{
            $componente['quantidade'] = $qtd_estoque - ($value['quantidade_componente'] * $qtd_prevista);
            $result = $this->bancomodel->update('produtos', $componente, $value['codigo_produto']);
            }
            if($result == null){
                break;
            }
        }
        return $result;
    }

    public function msg($alert) {
		$str = '';
		if ($alert == 1)
                    $str = 'success- Ordem de produção cadastrada com sucesso!';
		else if ($alert == 2)
                    $str = 'danger-Não foi possível cadastrar a ordem de produção. Por favor, tente novamente!';
		else if ($alert == 3)
                    $str = 'success- Ordem de produção excluída com sucesso!';
		else if ($alert == 4)
                    $str = 'danger-Não foi possível excluir a ordem de produção. Por favor, tente novamente!';
		else if ($alert == 5)
                    $str = 'success- Ordem de produção atualizada com sucesso!';
		else if ($alert == 6)
                    $str = 'danger-Não foi possível atualizar a ordem de produção. Por favor, tente novamente!';
                else if ($alert == 7)
                    $str = 'success-Ordem de produção finalizada com sucesso!';
                else if ($alert == 8)
                    $str = 'danger-Não foi possível finalizar a ordem de produção. Por favor, tente novamente!';
                else if ($alert == 9)
                    $str = 'success-Produto incluído com sucesso!';
                else if ($alert == 10)
                    $str = 'danger-Não foi possível incluir o produto. Por favor, tente novamente!';
                else if ($alert == 11)
                    $str = 'success-Produto removido com sucesso!';
                else if ($alert == 12)
                    $str = 'danger-Não foi possível remover o produto. Por favor, tente novamente!';
                else if ($alert == 13)
                    $str = 'danger-Não foi possível finalizar a ordem de produção. Produto insuficiente no estoque!';
                else
                    $str = null;
		return $str;
	}

}
