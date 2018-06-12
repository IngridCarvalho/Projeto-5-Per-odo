<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
	$this->load->library('unit_test');
    }

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
    
    public function relatorio($inicio,$fim){
        $this->load->model('relatoriosmodel');
        
        $data_inicio = $inicio;
        $data_fim = $fim;
        
        if($data_inicio > $data_fim){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
	
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
            
        echo "TESTES UNITÁRIOS DE RELATÓRIOS";
        $test = $this->relatorio('04/06/2018','06/06/2018');
        $expected_result = TRUE;
        $test_name = "Teste Unitário de relatório com uma data válida.";
        echo $this->unit->run($test,$expected_result,$test_name);
            
        $test = $this->relatorio('05/06/2018','04/06/2018');
        $expected_result = TRUE;
        $test_name = "Teste Unitário de relatório com uma data inválida.";
        echo $this->unit->run($test,$expected_result,$test_name);
    }
}
