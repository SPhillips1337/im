<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * User controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/user
	 */
	

	public function __construct()
	{
		parent::__construct();
				
		$this->load->helper(array('url', 'debug', 'mobile', 'image'));
		
		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_login');
		$this->load->model('Model_user');
		
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
		redirect(BASE_URI.'/home', 'refresh');
		exit();		
	}	
	
	function checkContactRequests()
	{
		// checks a userId to see if there are any contact requests for it
		$this->Model_user->userId 		= $_POST['userId'];

		if($this->Model_user->checkContactRequests()){
	
			$this->data['system'] 		= $this->Model_system;
			$this->data['user'] 		= $this->Model_user;
			
			$this->load->view('AJAXContactRequestCheckResult',$this->data);
			
		}

	}

	function acceptContactRequest()
	{
		// accepts a contact request between 2 user's
		$this->Model_user->contactRequestId 		= $_POST['contactRequestId'];
	
		if($this->Model_user->acceptContactRequest()){
	
			$this->Model_user->getContactRequest();
			
			$this->data['system'] 		= $this->Model_system;
			$this->data['user'] 		= $this->Model_user;
				
			$this->load->view('AJAXContactAcceptContactSuccess',$this->data);
				
		}
	
	}	

	function declineContactRequest()
	{
		// accepts a contact request between 2 user's
		$this->Model_user->contactRequestId 		= $_POST['contactRequestId'];
	
		if($this->Model_user->declineContactRequest()){
	
			$this->Model_user->getContactRequest();
				
			$this->data['system'] 		= $this->Model_system;
			$this->data['user'] 		= $this->Model_user;
	
			$this->load->view('AJAXContactDeclinedContactSuccess',$this->data);
	
		}
	
	}	
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */