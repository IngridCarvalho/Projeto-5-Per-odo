<?php
class SampleTest extends PHPUnit_Framework_TestCase
{
    
    protected $CI;
    
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        parent::__construct();
        $this->CI = &get_instance();
    }


   public function testeLogar(){
        $this->CI->load->model('testemodel');
        
        $cpf = '09365640679';
        $senha = md5('br280190');
        
       $this->assertTrue($this->CI->testemodel->logar($cpf,$senha));


    }
    
    public function testeRelatorio(){
        $this->CI->load->model('relatoriosmodel');
        
        $data_inicio = new DateTime('2018-08-03');
        $data_fim = new DateTime('2018-08-06');
        
        $this->assertTrue($data_inicio < $data_fim);
        
    }
    
    
}