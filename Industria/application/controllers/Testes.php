<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testes extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('unit_test');
	}

    public function logar($a,$b){
        $this->load->model('acessomodel');
       
        $cpf = $a;
        $senha = md5($b);
        $usuario = $this->acessomodel->logar($cpf,$senha);


        if(count($usuario) === 1){
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
        
		$test = $this->logar('09365640679','br28019');
		$expected_result = TRUE;
		$test_name = "Teste Unitário de login com usuário incorreto";
		echo $this->unit->run($test,$expected_result,$test_name);
	}
}
