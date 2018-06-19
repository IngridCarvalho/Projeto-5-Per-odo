<?php
class SampleTest extends PHPUnit_Framework_TestCase
{
    
//     protected $CI;
    
//     public function __construct()
//     {
//         // Assign the CodeIgniter super-object
//         parent::__construct();
//         $this->CI = &get_instance();
//     }


//    public function testeLogar(){
//         $this->CI->load->model('testemodel');
        
//         $cpf = '09365640679';
//         $senha = md5('br280190');
        
//        $this->assertTrue($this->CI->testemodel->logar($cpf,$senha));


//     }
    
public function testPushAndPop()
{
  $stack = array();
  $this->assertEquals(0, count($stack));
  array_push($stack, 'foo');
  $this->assertEquals('foo', $stack[count($stack)-1]);
  $this->assertEquals(1, count($stack));
  $this->assertEquals('foo', array_pop($stack));
  $this->assertEquals(0, count($stack));
}

    
    
}