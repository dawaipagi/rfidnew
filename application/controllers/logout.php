<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
	
	private $table=array('jarvis_user'=>'jarvis_user');
	private $view=array();
	private $fieldOrder=array('id'=>'id');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array();
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT');
	private $pk=array('id'=>'id');
	
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		$data = array(
			'is_online'=>'false',
		);
		jarvis_process_block($this->changeParams[5],$this->table['jarvis_user'],$data,$sessionID,$this->pk['id'],$sessionID);
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('mycaptcha');
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
