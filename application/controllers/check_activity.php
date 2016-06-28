<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Check_activity extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user');
	private $fieldOrder=array('id'=>'id');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT');
	private $pk=array('id'=>'id');
	
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$session_data = $this->session->userdata('logged_in');
		echo json_encode(jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$session_data['id'])));
	}
}

/* End of file check_activity.php */
/* Location: ./application/controllers/check_activity.php */
