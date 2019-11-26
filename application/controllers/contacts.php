<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

	/**
	 * Contacts controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/contacts
	 */
	

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'debug', 'mobile','image'));

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

		$this->Model_user->getAcceptedContacts();
		
		$this->data['system'] 		= $this->Model_system;
		$this->data['user'] 		= $this->Model_user;

		$this->load->view('header',$this->data);

		$this->load->view('contacts',$this->data);

		$this->load->view('footer');
		
	}
	
	
	function AJAXConfirmRemoveRequest()
	{
		// checks a userId to see if there are any contact requests for it
		$this->Model_user->contactId 		= $_REQUEST['contactId'];
		
		if($this->Model_user->getContactDetails()){
			
			$this->data['system'] 		= $this->Model_system;
			$this->data['user'] 		= $this->Model_user;
					
			$this->load->view('AJAXConfirmRemoveRequest',$this->data);
			
		}

	}
	
	function AJAXContactRemove()
	{
		// accepts a contact request between 2 user's
		$this->Model_user->contactId 		= $_POST['contactId'];
		
		$this->Model_user->getContactDetails();
			
		if($this->Model_user->removeContact()){

			$this->data['system'] 		= $this->Model_system;
			$this->data['user'] 		= $this->Model_user;
	
			$this->load->view('AJAXRemoveContactSuccess',$this->data);
	
		}
	
	}	
	
}

/* End of file contacts.php */
/* Location: ./application/controllers/contacts.php */