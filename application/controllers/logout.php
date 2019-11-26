<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * Logout controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/logout
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
		$this->Model_login->logout();
		
		$this->session->set_userdata('message',$this->Model_login->message);
		redirect(BASE_URI.'/login', 'refresh');		
		
	}

}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */