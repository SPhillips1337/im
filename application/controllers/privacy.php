<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy extends CI_Controller {

	/**
	 * User controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/privacy
	 */
	

	public function __construct()
	{
		parent::__construct();
				
		$this->load->helper(array('url', 'debug', 'mobile'));
		
		$this->load->library('session');
		
		$this->load->model('Model_system');

		$this->Model_system->message = $this->session->userdata('message');

		$this->session->set_userdata('message','');

		$this->data['device'] 	= mobileDetect();
				
	}	

	public function index()
	{

		$this->data['system'] 	= $this->Model_system;
				
		$this->load->view('header',$this->data);

		$this->load->view('privacy',$this->data);

		$this->load->view('footer');	
	}	
	
}

/* End of file privacy.php */
/* Location: ./application/controllers/privacy.php */