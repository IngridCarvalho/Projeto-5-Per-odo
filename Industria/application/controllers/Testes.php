<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
	$this->load->library('unit_test');
    }
    
    /* FUNÇÃO PARA LOGAR*/
    public function logar($input_cpf,$input_senha){
        $this->load->model('acessomodel');
       
        $cpf = $input_cpf;
        $senha = md5($input_senha);
        $usuario = $this->acessomodel->logar($cpf,$senha);


        if(count($usuario) === 1){
            return TRUE;
        }else{
            return FALSE;
        }    

    }
    
    /*============================*/
    
    /* FUNÇÔES PARA FINALIZAÇÃO DA ORDEM DE PRODUÇÃO*/
    
    public function finalizar_ordem($codigo_ordem,$qtd){
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
            $qtd_produzida = $qtd;
            $qtd_prevista = $value['quantidade_prevista'];
            
            if($qtd_produzida <= 0){
                return FALSE;
            }

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
                return FALSE;
            }
        }
        $result = $this->bancomodel->update('ordemproducao',$ordem,$codigo_ordem);

        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
     public function baixa_estoque_componente($codigo_composicao, $qtd_prevista){
        $this->load->model('ordensmodel');
        $this->load->model('bancomodel');

        $componentes = $this->ordensmodel->componentes($codigo_composicao);
       
        foreach ($componentes as $key => $value) {
            $qtd_estoque = $this->ordensmodel->quantidade_estoque($value['codigo_produto']);
            $componente['quantidade'] = $qtd_estoque - ($value['quantidade_componente'] * $qtd_prevista);
            $result = $this->bancomodel->update('produtos', $componente, $value['codigo_produto']);
            if($result == null){
                break;
            }
        }
        return $result;
    }
    
    /* ================================ */
    
    /* FUNÇÕES DE PRODUTOS*/
    
    public function qtd_estoque($codigo_ordem,$qtd){
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
            $qtd_produzida = $qtd;
            $qtd_prevista = $value['quantidade_prevista'];
            
            if($qtd_produzida <= 0){
                return FALSE;
            }

            $baixou_componentes = $this->baixa_estoque_componente($codigo_item, $qtd_prevista);

            $item_ordem['quantidade_produzida'] = $qtd_produzida;
        }
    }

    
   /*========================*/

    	
    public function index()
    {
        echo "TESTES UNITÁRIOS DE LOGIN";
        $test = $this->logar('09365640679','br280190');
        $expected_result = TRUE;
        $test_name = "Teste Unitário de login com usuário correto";
        echo $this->unit->run($test,$expected_result,$test_name);
        
        $test = $this->logar('09365640679','280190');
        $expected_result = TRUE;
        $test_name = "Teste Unitário de login com usuário incorreto";
        echo $this->unit->run($test,$expected_result,$test_name);
        
        echo "TESTES UNITÁRIOS ORDEM DE PRODUÇÃO";
        $test = $this->finalizar_ordem(8,1);
        $expected_result = TRUE;
        $test_name = "Teste Unitário de finalização de ordem de produção correto";
        echo $this->unit->run($test,$expected_result,$test_name);
        
        $test = $this->finalizar_ordem(8,0);
        $expected_result = TRUE;
        $test_name = "Teste Unitário de finalização de ordem de produção incorreto";
        $notes = 'Erro caso a quantidade produzida seja zero';
        echo $this->unit->run($test,$expected_result,$test_name,$notes);
        
//        echo "TESTES UNITÁRIOS PRODUTOS";
//        $test = $this->salvar_produto(1,'teste_uni',111,5,6,2);
//        $expected_result = 111;
//        $test_name = "Teste Unitário ver se o produto correto foi adicionado ao estoque";
//        echo $this->unit->run($test,$expected_result,$test_name);
            
    }
}
