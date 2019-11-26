<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Login controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/
	 *	- or -  
	 * 		http://pip.buzz/login
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'debug', 'mobile'));

		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_login');

		$this->data['login'] 	= $this->Model_login;
				
		$this->Model_system->message = $this->session->userdata('message');
		$this->session->set_userdata('message','');
		
		$this->data['device'] 	= mobileDetect();
		
	}	
	
	public function index()
	{

		if($this->Model_login->login){
			redirect(BASE_URI.'/home', 'refresh');
		}
		else{
			
			$this->data['system'] 	= $this->Model_system;
			$this->data['login'] 	= $this->Model_login;

			$this->load->view('header',$this->data);		
			$this->load->view('loginForm',$this->data);
			$this->load->view('footer');
			
		}
	
	}

	public function process()
	{
		
		if($this->Model_login->processLogin($_POST)){
			$this->session->set_userdata('message',$this->Model_login->message);
			redirect(BASE_URI.'/home', 'refresh');
			exit();
		}
		else{
			$this->session->set_userdata('message',$this->Model_login->message);
			redirect(BASE_URI.'/login', 'refresh');
			exit();		
		}
		
	}	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */