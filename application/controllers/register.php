<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Login controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/register
	 */
	

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'debug', 'mobile'));
		
		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_register');

		if(!empty($_POST)){
			$this->session->set_userdata('registerData',$_POST);
			$this->Model_register->data = $_POST;
		}
		else{
			$this->Model_register->data = $this->session->userdata('registerData');
			$this->session->set_userdata('registerData',array());
		}

		$this->Model_system->message = $this->session->userdata('message');
		$this->session->set_userdata('message','');

		$this->data['device'] 	= mobileDetect();
					
	}	
	
	public function index()
	{

		$this->data['system'] 		= $this->Model_system;
		$this->data['register'] 	= $this->Model_register;

		$this->load->view('header',$this->data);
		
		$this->load->view('registerForm',$this->data);

		$this->load->view('footer');
		
	}

	public function success()
	{

		$this->data['system'] 		= $this->Model_system;
		$this->data['register'] 	= $this->Model_register;
	
		$this->session->set_userdata('registerData',array());

		$this->load->view('header',$this->data);
				
		$this->load->view('registerSuccess',$this->data);
	
		$this->load->view('footer');
	
	}
	
	public function process()
	{
	
		if($this->Model_register->processRegister($_POST)){
			$this->session->set_userdata('message',$this->Model_register->message);
			redirect(BASE_URI.'/register/success', 'refresh');
			exit();			
		}
		else{
			$this->session->set_userdata('message',$this->Model_register->message);
			redirect(BASE_URI.'/register', 'refresh');
			exit();			
		}
	
	}	
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */