<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	/**
	 * Profile controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/profile
	 */
	

	public function __construct()
	{
		parent::__construct();
				
		$this->load->helper(array('url', 'debug', 'mobile', 'image'));
		
		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_login');
		$this->load->model('Model_profile');
		
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
	
	public function view($userHash)
	{

		$this->Model_profile->userId = $this->Model_user->id;
		
		$this->Model_profile->getUserProfile($userHash);
		
		$this->data['system'] 		= $this->Model_system;
		$this->data['user'] 		= $this->Model_user;
		$this->data['profile'] 		= $this->Model_profile;

		$this->load->view('header',$this->data);

		$this->load->view('viewProfile',$this->data);

		$this->load->view('footer');
		
	}
	
	function addFriend()
	{
		// get our post data and pass it to the profile model
		$this->Model_profile->userId 		= $_POST['userId'];
		$this->Model_profile->profileId 	= $_POST['profileId'];

		$this->Model_profile->addFriend();
		
	}
	
	function checkContactRequestStatus() {
		// get our post data and pass it to the profile model
		$this->Model_profile->userId 		= $_POST['userId'];
		$this->Model_profile->id 	= $_POST['profileId'];
				
		$this->Model_profile->checkContact();
		
		echo $this->Model_profile->contactStatus;
		
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */