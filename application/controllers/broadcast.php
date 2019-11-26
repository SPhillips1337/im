<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broadcast extends CI_Controller {

	/**
	 * Broadcast controller.
	 *
	 * Maps to the following URL
	 * 		http://pip.buzz/broadcast
	 */
	

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'debug', 'mobile','image'));

		$this->load->library('session');
		
		$this->load->model('Model_system');
		$this->load->model('Model_login');
		$this->load->model('Model_broadcast');
		
		
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
		
		$broadcastStart = $this->session->userdata('broadcastStart');
		if($broadcastStart!=""&&$broadcastStart>=0){
			$this->Model_broadcast->start = $broadcastStart;
		}

		$this->session->set_userdata('message','');

		$this->data['device'] 	= mobileDetect();
					
	}	
	
	public function index()
	{
		$this->Model_broadcast->start = 0;
		$this->session->set_userdata('broadcastStart', $this->Model_broadcast->start);
		
		$this->Model_broadcast->getBroadcastSummaries();
		
		$this->data['system'] 		= $this->Model_system;
		$this->data['user'] 		= $this->Model_user;
		$this->data['broadcast'] 	= $this->Model_broadcast;

		$this->load->view('header',$this->data);

		$this->load->view('broadcast',$this->data);

		$this->load->view('footer');
		
	}

	public function getTotalBroadcastPosts()
	{
	
		$this->Model_broadcast->countBroadcastSummaries($_POST['date']);

		$this->data['broadcast'] 	= $this->Model_broadcast;
	
		$this->load->view('AJAXBroadcastTotalPostsNum',$this->data);
	
	}	
	
	public function next()
	{

		$start = $this->Model_broadcast->start;
		
		$this->Model_broadcast->start = $start + 5;
		$broadcastStart = $this->Model_broadcast->start;
		
		$this->session->set_userdata('broadcastStart', $broadcastStart);
		
		$this->Model_broadcast->getBroadcastSummaries($_POST['date']);

		$this->data['system'] 		= $this->Model_system;
		$this->data['user'] 		= $this->Model_user;
		$this->data['broadcast'] 	= $this->Model_broadcast;

		$this->load->view('AJAXBroadcastNext',$this->data);

	}
	
	public function create()
	{

		$this->data['system'] 		= $this->Model_system;
		$this->data['user'] 		= $this->Model_user;
		$this->data['broadcast'] 	= $this->Model_broadcast;
	
		$this->load->view('header',$this->data);
	
		$this->load->view('broadcastPost',$this->data);
	
		$this->load->view('footer');
	
	}

	public function save()
	{
	
		if($this->Model_broadcast->save($_POST)){
			$this->session->set_userdata('message',$this->Model_broadcast->message);
			redirect(BASE_URI.'/broadcast', 'refresh');
			exit();
		}
		else{
			$this->session->set_userdata('message',$this->Model_broadcast->message);
			redirect(BASE_URI.'/broadcast', 'refresh');
			exit();
		}
	
	}		
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */