<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username','text'=>'text');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT');
	private $pk=array('id'=>'id');
	
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'dashboard','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'dashboard','active'=>'true'));
			$data['page_title'] = 'Dashboard';
			$data['html_class'] = '';
			$data['userData'] = $session_data;
						
			/*START SIDEBAR MENU*/
			$params_sidebar=array('ref_group_user'=>$session_data['ref_group_user']);
			$data['sidebar']=jarvis_sidebar('jarvis_vw_menu','order_hint','asc',$params_sidebar);
			/*END SIDEBAR MENU*/	
			
			/*START LAYOUT SETTING*/	
			$params_layout=array('id'=>$sessionID);
			$data['layout']=jarvis_layout_setting($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],$params_layout);
			/*END LAYOUT SETTING*/	
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			jarvis_load_view('dashboard/page',$data);
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen', 'refresh');
		}else{
			redirect('login', 'refresh');
		}
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
