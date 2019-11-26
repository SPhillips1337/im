<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Home controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/home
	 */
	

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'debug', 'mobile', 'image'));

		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_login');
		
		$this->data['login'] 	= $this->Model_login;
		
		if(!$this->Model_login->login){
			$this->Model_system->message = "Your login has expired.";
			$this->session->set_userdata('message',$this->Model_system->message);			
			redirect(BASE_LOGIN_URI.'/login', 'refresh');
		}
		else{
			$this->load->model('Model_user');
		}

		$this->Model_system->message = $this->session->userdata('message');
		$this->session->set_userdata('message','');

		$this->data['device'] 	= mobileDetect();
				
	}	
	
	public function index()
	{

		$this->data['system'] 	= $this->Model_system;
		$this->data['user'] 	= $this->Model_user;
				
		$this->load->view('header',$this->data);

		$this->load->view('home',$this->data);

		$this->load->view('footer');
		
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */