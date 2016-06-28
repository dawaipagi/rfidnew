<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Maintenance extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','jarvis_module'=>'jarvis_module','jarvis_group_user'=>'jarvis_group_user','jarvis_user'=>'jarvis_user','jarvis_menu'=>'jarvis_menu','jarvis_parameter'=>'jarvis_parameter','jarvis_menu_matrix'=>'jarvis_menu_matrix','jarvis_menu_matrix_perm'=>'jarvis_menu_matrix_perm');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user','jarvis_vw_menu'=>'jarvis_vw_menu','jarvis_vw_menu_matrix'=>'jarvis_vw_menu_matrix','jarvis_vw_menu_matrix_perm'=>'jarvis_vw_menu_matrix_perm');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username','name'=>'name','label'=>'label','module'=>'module','group'=>'group','menu'=>'menu','parameter'=>'parameter','url'=>'url');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT','6'=>'INSERT_BATCH');
	private $pk=array('id'=>'id','matrix_id'=>'matrix_id');
	
	function __construct(){
		parent::__construct();
	}
	public function manageUser($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'user','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'user','active'=>'true'));
			$data['page_title']='User';
			$data['permission']='User';
			$data['html_class']='';
			$data['errorAvatar']='';
			$data['userData']=$session_data;
			
			/*START SIDEBAR MENU*/
			$params_sidebar=array('ref_group_user'=>$session_data['ref_group_user']);
			$data['sidebar']=jarvis_sidebar('jarvis_vw_menu','order_hint','asc',$params_sidebar);
			/*END SIDEBAR MENU*/			
			
			/*START LAYOUT SETTING*/	
			$params_layout=array('id'=>$sessionID);
			$data['layout']=jarvis_layout_setting($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],$params_layout);
			/*END LAYOUT SETTING*/
			
			/*START GROUP USER*/
			if(get_data_user('ref_group_user')=='J1'){
				$paramUG='';
			}else{
				$paramUG=array('show'=>'true');
			}
			$data['groupUser']=jarvis_get_data($this->searchField['group'],$this->table['jarvis_group_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',$paramUG);
			/*END GROUP USER*/
			
			/*START DATA USER*/
			if(get_data_user('ref_group_user')=='J1'){
				$params_user=array('id !='=>$sessionID);
			}else{
				$params_user=array('id !='=>$sessionID,'show_group'=>'true');
			}
			$data['dataUser']=jarvis_get_data($this->searchField['name'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',$params_user);
			/*END DATA USER*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('maintenance/views/user',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique['.$this->view['jarvis_vw_user'].'.username]');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[passwordconf]|md5');
					$this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|xss_clean');
					$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique['.$this->view['jarvis_vw_user'].'.email]');
					
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('maintenance/views/userForm',$data);
					}else{
						$data_insert = array(
							'username'=>$this->input->post('username'),
							'password'=>$this->input->post('password'),
							'name'=>$this->input->post('name'),
							'email'=>$this->input->post('email'),
							'ref_group_user'=>$this->input->post('ref_group_user')
						);
						jarvis_process_block($this->changeParams[1],$this->table['jarvis_user'],$data_insert,$sessionID);
						redirect('maintenance/manageUser');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action']='edit';
					$data['dataUserEdit']=$result;
					if($result['results']==1){
						$isUniqueUsername = '|is_unique['.$this->view['jarvis_vw_user'].'.username]';
						$isUniqueEmail = '|is_unique['.$this->view['jarvis_vw_user'].'.email]'; 
						if($this->input->post('username')==jarvis_echo($result,'username')){
							$isUniqueUsername = '';
						}
						if($this->input->post('email')==jarvis_echo($result,'email')){
							$isUniqueEmail = '';
						}
						$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean'.$isUniqueUsername);
						$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email'.$isUniqueEmail);
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/userForm',$data);
						}else{
							$data_update = array(
								'username'=>$this->input->post('username'),
								'name'=>$this->input->post('name'),
								'email'=>$this->input->post('email'),
								'ref_group_user'=>$this->input->post('ref_group_user')
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageUser');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='changePassword'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action'] = 'changePassword';
					$data['dataUserCP']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[passwordconf]|md5');
						$this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/userForm',$data);
						}else{
							$data_update = array(
								'password'=>$this->input->post('password')
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageUser');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='banned'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					if(jarvis_echo($result,'banned')=='true') {$statusUser='false';} else {$statusUser='true';}
					$data_update = array(
						'banned'=>$statusUser
					);
					jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageUser');
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['jarvis_user'],'',$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageUser');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageModule($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['page_title'] = 'Module';
			$data['permission'] = 'Module';
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
			
			/*START DATA MODULE*/
			$data['dataModule'] = jarvis_get_data($this->searchField['module'],$this->table['jarvis_module'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END DATA MODULE*/			
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar');
			
			if(!$subPage){
				jarvis_load_view('maintenance/views/module',$data);
			}else{
				if($subPage=='add'){
					$data['key_action'] = 'add';
					$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean|is_unique['.$this->table['jarvis_module'].'.'.$this->pk['id'].']');
					$this->form_validation->set_rules('module', 'Module', 'trim|required|xss_clean');
					$this->form_validation->set_rules('desc', 'Description', 'trim|xss_clean');
					if($this->form_validation->run() == FALSE){	
						jarvis_load_view('maintenance/views/moduleForm',$data);
					}else{
						$data_insert = array(
							'id'=>$this->input->post('id'),
							'module'=>$this->input->post('module'),
							'desc'=>$this->input->post('desc')
						);
						jarvis_process_block($this->changeParams[1],$this->table['jarvis_module'],$data_insert,$sessionID);
						redirect('maintenance/manageModule');
					}
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result = jarvis_get_data($this->searchField['module'],$this->table['jarvis_module'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action'] = 'edit';
					$data['dataModuleEdit'] = $result;
					if($result['results']==1){
						$this->form_validation->set_rules('module', 'Module', 'trim|required|xss_clean');
						$this->form_validation->set_rules('desc', 'Description', 'trim|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/moduleForm',$data);
						}else{
							$data_update = array(
								'module'=>$this->input->post('module'),
								'desc'=>$this->input->post('desc')
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_module'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageModule');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['jarvis_module'],'',$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageModule');		
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageMenu($subPage='',$dataID='',$params=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['page_title'] = 'Menu';
			$data['permission'] = 'Menu';
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
			
			/*START DATA MENU*/
			$data['dataMenu'] = jarvis_get_data($this->searchField['label'],$this->table['jarvis_menu'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END DATA MENU*/
			
			/*START DATA MODULE*/
			$data['dataModule'] = jarvis_get_data($this->searchField['module'],$this->table['jarvis_module'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END DATA MODULE*/
			
			/*START DATA ICON*/
			$data['iconPack'] = jarvis_call_parameter('menu_icon');
			/*END DATA ICON*/			
			
			/*START GROUP USER*/
			$data['groupUser']=jarvis_get_data($this->searchField['group'],$this->table['jarvis_group_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END GROUP USER*/
			
			/*START DATA PID*/
			$data['dataPID'] = jarvis_get_data($this->searchField['menu'],$this->table['jarvis_menu'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('pid'=>0));
			/*END DATA PID*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar');
			if(!$subPage){
				jarvis_load_view('maintenance/views/menu',$data);
			}else{
				/*START BG DASHBOARD*/
				$data['bgDash'] = jarvis_call_parameter('bg_dashboard');
				/*END BG DASHBOARD*/
				/*START ICON DASHBOARD*/
				$data['iconDash'] = jarvis_call_parameter('icon_dashboard');
				/*END ICON DASHBOARD*/
				if($subPage=='add'){
					$data['key_action'] = 'add';
					$this->form_validation->set_rules('menu', 'Menu', 'trim|required|xss_clean|is_unique['.$this->table['jarvis_menu'].'.menu]');
					$this->form_validation->set_rules('label', 'Label', 'trim|required|xss_clean');
					$this->form_validation->set_rules('order_hint', 'Menu Order', 'trim|required|xss_clean');
					$this->form_validation->set_rules('desc', 'Description', 'trim|xss_clean');
					if($this->form_validation->run() == FALSE){	
						jarvis_load_view('maintenance/views/menuForm',$data);
					}else{
						$data_insert = array(
							'menu'=>$this->input->post('menu'),
							'label'=>$this->input->post('label'),
							'order_hint'=>$this->input->post('order_hint'),
							'icon'=>$this->input->post('icon'),
							'ref_module'=>$this->input->post('ref_module'),
							'pid'=>$this->input->post('pid'),
							'desc'=>$this->input->post('desc'),
							'dashboard'=>jarvis_encode(json_encode(array('bg'=>$this->input->post('bgDash'),'icon'=>$this->input->post('iconDash'))))
						);
						jarvis_process_block($this->changeParams[1],$this->table['jarvis_menu'],$data_insert,$sessionID);
						redirect('maintenance/manageMenu');
					}
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result = jarvis_get_data($this->searchField['menu'],$this->table['jarvis_menu'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action'] = 'edit';
					$data['dataMenuEdit'] = $result;
					if($result['results']==1){
						$isUniqueMenu = '|is_unique['.$this->table['jarvis_menu'].'.menu]';
						if($this->input->post('menu')==jarvis_echo($result,'menu')){
							$isUniqueMenu = '';
						}
						$this->form_validation->set_rules('menu', 'Menu', 'trim|required|xss_clean'.$isUniqueMenu);
						$this->form_validation->set_rules('label', 'Label', 'trim|required|xss_clean');
						$this->form_validation->set_rules('order_hint', 'Menu Order', 'trim|required|xss_clean');
						$this->form_validation->set_rules('desc', 'Description', 'trim|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/menuForm',$data);
						}else{
							$data_update = array(
								'menu'=>$this->input->post('menu'),
								'label'=>$this->input->post('label'),
								'order_hint'=>$this->input->post('order_hint'),
								'icon'=>$this->input->post('icon'),
								'ref_module'=>$this->input->post('ref_module'),
								'pid'=>$this->input->post('pid'),
								'desc'=>$this->input->post('desc'),
								'dashboard'=>jarvis_encode(json_encode(array('bg'=>$this->input->post('bgDash'),'icon'=>$this->input->post('iconDash'))))
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_menu'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageMenu');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['jarvis_menu'],'',$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageMenu');
				}elseif($subPage=='matrix'){
					$dataID=jarvis_decode(uri_segment(4));
					if(!$params){
						$result = jarvis_get_data($this->searchField['menu'],$this->table['jarvis_menu'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
						$data['key_action'] = 'matrix';
						$data['dataMS'] = $result;
						$data['dataMenuMatrix'] = jarvis_get_data($this->searchField['menu'],$this->view['jarvis_vw_menu_matrix'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('menu_id'=>$dataID));
						$data['actionLabel'] = jarvis_call_parameter('action_label');
						if($result['results']==1){
							$this->form_validation->set_rules('url', 'Url', 'trim|xss_clean');
							if($this->form_validation->run() == FALSE){	
								jarvis_load_view('maintenance/views/menuMatrix',$data);
							}else{
								$data_insert = array(
									'menu_id'=>$this->input->post('menu_id'),
									'action_label_id'=>$this->input->post('action_label_id'),
									'url'=>$this->input->post('url'),
									'confirm_box'=>$this->input->post('confirm_box')
								);
								jarvis_process_block($this->changeParams[1],$this->table['jarvis_menu_matrix'],$data_insert,$sessionID);
								redirect('maintenance/manageMenu/matrix/'.jarvis_encode($this->input->post('menu_id')));
							}
						}else{
							jarvis_load_view('404/page');
						}
					}else{
						$params=jarvis_decode(uri_segment(5));
						$jsonDec=json_decode($params,true);
						if($jsonDec['type']=='delete'){
							jarvis_process_block($this->changeParams[3],$this->table['jarvis_menu_matrix'],'',$sessionID,$this->pk['id'],$jsonDec['params']);
							redirect('maintenance/manageMenu/matrix/'.jarvis_encode($dataID));
						}elseif($jsonDec['type']=='permission'){
							$data['key_action'] = 'permission';
							$resMatrix = jarvis_get_data($this->searchField['menu'],$this->view['jarvis_vw_menu_matrix'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$jsonDec['params']));
							$data['dataMenuMatrixGet'] = $resMatrix;
							$data['dataMenuMatrixPerm'] = jarvis_get_data($this->searchField['url'],$this->view['jarvis_vw_menu_matrix_perm'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('matrix_id'=>$jsonDec['params']));
							$this->form_validation->set_rules('matrix_id', 'MatrixID', 'trim|xss_clean');
							if($this->form_validation->run() == FALSE){
								jarvis_load_view('maintenance/views/menuMatrixPerm',$data);
							}else{
								$delPerm=jarvis_process_block($this->changeParams[3],$this->table['jarvis_menu_matrix_perm'],'',$sessionID,$this->pk['matrix_id'],$jsonDec['params']);
								$dataPerm=array();
								foreach($resMatrix['data'] as $matrix){
									// PERMISSION CHECK
									$atCek=$this->input->post('permissionTo');
									$asToCek=count($atCek);
									for($x=0; $x<$asToCek; $x++){
										$dataPerm[]=array('matrix_id'=>$matrix['id'],'group_user_id'=>$atCek[$x]);
									}
								}
								$insertPerm=jarvis_process_block($this->changeParams[6],$this->table['jarvis_menu_matrix_perm'],$dataPerm,$sessionID);	
								redirect('maintenance/manageMenu/matrix/'.jarvis_encode($dataID));
							}
						}else{
							jarvis_load_view('404/page');
						}
					}
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageParameter($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['page_title'] = 'Parameter';
			$data['permission'] = 'Parameter';
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
			
			/*START PARAMETER*/
			$data['dataParameter']=jarvis_get_data($this->searchField['parameter'],$this->table['jarvis_parameter'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END PARAMETER*/
			
			/*START PARAMETER STATUS*/
			$data['statusParameter']=jarvis_call_parameter('status');
			/*END PARAMETER STATUS*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar');
			if(!$subPage){
				jarvis_load_view('maintenance/views/parameter',$data);
			}else{
				if($subPage=='add'){
					$data['key_action'] = 'add';
					$this->form_validation->set_rules('category_parameter', 'Category', 'trim|required|xss_clean');
					$this->form_validation->set_rules('parameter', 'Parameter', 'trim|required|xss_clean');
					$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){	
						jarvis_load_view('maintenance/views/parameterForm',$data);
					}else{
						$data_insert = array(
							'category_parameter'=>$this->input->post('category_parameter'),
							'parameter'=>$this->input->post('parameter'),
							'status'=>$this->input->post('status')
						);
						jarvis_process_block($this->changeParams[1],$this->table['jarvis_parameter'],$data_insert,$sessionID);
						redirect('maintenance/manageParameter');
					}
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result = jarvis_get_data($this->searchField['parameter'],$this->table['jarvis_parameter'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action'] = 'edit';
					$data['dataParameterEdit'] = $result;
					if($result['results']==1){
						$this->form_validation->set_rules('category_parameter', 'Category', 'trim|required|xss_clean');
						$this->form_validation->set_rules('parameter', 'Parameter', 'trim|required|xss_clean');
						$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/parameterForm',$data);
						}else{
							$data_update = array(
								'category_parameter'=>$this->input->post('category_parameter'),
								'parameter'=>$this->input->post('parameter'),
								'status'=>$this->input->post('status')							
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_parameter'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageParameter');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['jarvis_parameter'],'',$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageParameter');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageUG($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'module','active'=>'true'));
			$data['page_title'] = 'User-Group';
			$data['permission'] = 'User-Group';
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
			
			/*START USER GROUP*/
			$data['dataGroup']=jarvis_get_data($this->searchField['group'],$this->table['jarvis_group_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END USER GROUP*/
			
			/*START PARAMETER AVATAR*/
			$data['avatarParameter']=jarvis_call_parameter('avatar');
			/*END PARAMETER AVATAR*/
			
			/*START PARAMETER STATUS*/
			$data['statusParameter']=jarvis_call_parameter('status');
			/*END PARAMETER STATUS*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar');
			if(!$subPage){
				jarvis_load_view('maintenance/views/usergroup',$data);
			}else{
				if($subPage=='add'){
					$data['key_action'] = 'add';
					$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean|max_length[5]|is_unique['.$this->table['jarvis_group_user'].'.id]');
					$this->form_validation->set_rules('group', 'Group Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('avatar', 'Avatar', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){	
						jarvis_load_view('maintenance/views/usergroupForm',$data);
					}else{
						$data_insert = array(
							'id'=>$this->input->post('id'),
							'group'=>$this->input->post('group'),
							'avatar'=>$this->input->post('avatar'),
							'show'=>$this->input->post('show')
						);
						jarvis_process_block($this->changeParams[1],$this->table['jarvis_group_user'],$data_insert,$sessionID);
						redirect('maintenance/manageUG');
					}
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result = jarvis_get_data($this->searchField['group'],$this->table['jarvis_group_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['key_action'] = 'edit';
					$data['dataGroupEdit'] = $result;
					if($result['results']==1){
						$this->form_validation->set_rules('group', 'Group Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules('avatar', 'Avatar', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('maintenance/views/usergroupForm',$data);
						}else{
							$data_update = array(
								'group'=>$this->input->post('group'),
								'avatar'=>$this->input->post('avatar'),							
								'show'=>$this->input->post('show')							
							);
							jarvis_process_block($this->changeParams[2],$this->table['jarvis_group_user'],$data_update,$sessionID,$this->pk['id'],$dataID);
							redirect('maintenance/manageUG');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['jarvis_group_user'],'',$sessionID,$this->pk['id'],$dataID);
					redirect('maintenance/manageUG');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
}

/* End of file Maintenance.php */
/* Location: ./application/controllers/Maintenance.php */
