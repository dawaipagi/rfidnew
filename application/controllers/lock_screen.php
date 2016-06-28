<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lock_screen extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT');
	private $pk=array('1'=>'id');
	
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$session_data = $this->session->userdata('logged_in');
		$sess_array = array(
			'id' => $session_data['id'],
			'username' => $session_data['username'],
			'name' => $session_data['name'],
			'email' => $session_data['email'],
			'phone_number' => $session_data['phone_number'],
			'address' => $session_data['address'],
			'avatar' => $session_data['avatar'],
			'is_online' => 'Online',
			'ref_group_user' => $session_data['ref_group_user'],
			'created' => $session_data['created'],
			'group' => $session_data['group'],
			'on_screen' => 'no'
		);
		$this->session->set_userdata('logged_in',$sess_array);
		if($session_data){
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'lock_screen','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'lock_screen','active'=>'true'));
			$data['site_title'] = 'Jarvis';
			$data['page_title'] = 'Lock Screen';
			$data['html_class'] = 'lockscreen';
			$data['userData'] = $session_data;
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');	
			if($this->form_validation->run() == FALSE){
				$this->load->view('header',$data);
				$this->load->view('lock_screen/page');
				$this->load->view('footer',$data);
			}else{
				//Go to private area
				redirect('dashboard', 'refresh');
			}
		}else{
			redirect('login', 'refresh');
		}
	}
	public function check_database($password){
		$session_data = $this->session->userdata('logged_in');
		$result = jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('username'=>$session_data['username'],'password'=>md5($password)));
		if($result['results']==1){
			$sess_array = array(
				'id' => $session_data['id'],
				'username' => $session_data['username'],
				'name' => $session_data['name'],
				'email' => $session_data['email'],
				'phone_number' => $session_data['phone_number'],
				'address' => $session_data['address'],
				'avatar' => $session_data['avatar'],
				'is_online' => 'Online',
				'ref_group_user' => $session_data['ref_group_user'],
				'created' => $session_data['created'],
				'group' => $session_data['group'],
				'on_screen' => 'yes'
			);
			foreach($result['data'] as $row){
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}else{
			$this->form_validation->set_message('check_database', 'Invalid password');
			return FALSE;
		}
	}
}

/* End of file lock_screen.php */
/* Location: ./application/controllers/lock_screen.php */
