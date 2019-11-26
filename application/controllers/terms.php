<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends CI_Controller {

	/**
	 * User controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/terms
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

		$this->load->view('terms',$this->data);

		$this->load->view('footer');	
	}	
	
}

/* End of file terms.php */
/* Location: ./application/controllers/terms.php */