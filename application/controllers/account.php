<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	/**
	 * Home controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/home
	 */
	

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'debug', 'mobile', 'image'));
			
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

		$this->Model_user->getProfile();
		
		$this->data['system'] 	= $this->Model_system;
		$this->data['user'] 	= $this->Model_user;
				
		$this->load->view('header',$this->data);

		$this->load->view('account',$this->data);

		$this->load->view('footer');
		
	}

	public function edit()
	{
		
		// fetch the user's profile details	
		$this->Model_user->getProfile();

		// fetch all the countries available for the user to choose from
		$this->Model_user->getCountries();

		$this->data['system'] 	= $this->Model_system;
		$this->data['user'] 	= $this->Model_user;
	
		$this->load->view('header',$this->data);
	
		$this->load->view('editAccount',$this->data);
	
		$this->load->view('footer');
	
	}	
	

	public function update()
	{

		if($this->Model_user->save($_POST)){
			$this->session->set_userdata('message',$this->Model_user->message);
			redirect(BASE_URI.'/account/edit', 'refresh');
			exit();			
		}
		else{
			$this->session->set_userdata('message',$this->Model_user->message);
			redirect(BASE_URI.'/account/edit', 'refresh');
			exit();			
		}

	}
		
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */