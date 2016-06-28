<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Layout_setting extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','jarvis_user'=>'jarvis_user');
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
		$sessionID=$session_data['id'];
		$params_layout=array('id'=>$sessionID);
		echo json_encode(jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',$params_layout));
	}
	public function setting($key=''){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		if($key=='layout_page'){
			$data_update=array('layout_page'=>$_POST['layout_page']);
			jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$sessionID);
		}elseif($key=='skin_page'){
			$data_update=array('skin_page'=>$_POST['skin_page']);
			jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$sessionID);
		}
	}
}

/* End of file layout_setting.php */
/* Location: ./application/controllers/layout_setting.php */
