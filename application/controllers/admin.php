<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','wm_jjoperasi'=>'wm_jjoperasi','wm_jto'=>'wm_jto','mst_wilop'=>'mst_wilop','wm_lokasi'=>'wm_lokasi','wm_unitstasiun'=>'wm_unitstasiun','wm_jsertifikat'=>'wm_jsertifikat','wm_angkutan'=>'wm_angkutan','wm_jalur'=>'wm_jalur','wm_playan'=>'wm_playan','wm_pgerak'=>'wm_pgerak');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint','jjo_code'=>'jjo_code','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','js_code'=>'js_code','ja_code'=>'ja_code','kj_code'=>'kj_code','jpel_code'=>'jpel_code','jp_code'=>'jp_code');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username','jjo_name'=>'jjo_name','jto_name'=>'jto_name','nama_wilop'=>'nama_wilop','loc_name'=>'loc_name','nama_unitstasiun'=>'nama_unitstasiun','js_name'=>'js_name','ja_name'=>'ja_name','kj_name'=>'kj_name','jpel_name'=>'jpel_name','jp_name'=>'jp_name');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT','6'=>'INSERT_BATCH');
	private $pk=array('id'=>'id','jjo_code'=>'jjo_code','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','js_code'=>'js_code','ja_code'=>'ja_code','kj_code'=>'kj_code','jpel_code'=>'jpel_code','jp_code'=>'jp_code');
	
	function __construct(){
		parent::__construct();
	}
	public function manageRank($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Tingkat';
			$data['permission']='Rank';
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
			
			/*START RANK DATA*/
			$data['dataRank']=jarvis_get_data($this->searchField['jjo_name'],$this->table['wm_jjoperasi'],$this->fieldOrder['jjo_code'],$this->fieldOrderType['asc']);
			/*END RANK DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/rank',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('jjo_name', 'Rank Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/rankForm',$data);
					}else{
						$data_insert = array(
							'jjo_name'=>$this->input->post('jjo_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_jjoperasi'],$data_insert,$sessionID);
						redirect('admin/manageRank');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['jjo_name'],$this->table['wm_jjoperasi'],$this->fieldOrder['jjo_code'],$this->fieldOrderType['asc'],'',array('jjo_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataRankEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('jjo_name', 'Rank Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/rankForm',$data);
						}else{
							$data_update = array(
								'jjo_name'=>$this->input->post('jjo_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_jjoperasi'],$data_update,$sessionID,$this->pk['jjo_code'],$dataID);
							redirect('admin/manageRank');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_jjoperasi'],'',$sessionID,$this->pk['jjo_code'],$dataID);
					redirect('admin/manageRank');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function managePosition($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Jabatan';
			$data['permission']='Position';
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
			
			/*START DATA FLAG*/
			$data['flag'] = jarvis_call_parameter('flag');
			/*END DATA FLAG*/
			
			/*START POSITION DATA*/
			$data['dataPosition']=jarvis_get_data($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc']);
			/*END POSITION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/position',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('jto_name', 'Position Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('jto_code', 'Position Code', 'trim|required|max_length[3]|xss_clean');
					$this->form_validation->set_rules('jto_cetak', 'Position Description', 'trim|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/positionForm',$data);
					}else{
						$data_insert = array(
							'jto_name'=>$this->input->post('jto_name'),
							'jto_code'=>$this->input->post('jto_code'),
							'jto_cetak'=>$this->input->post('jto_cetak')
							//'jto_flag'=>$this->input->post('jto_flag')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_jto'],$data_insert,$sessionID);
						redirect('admin/managePosition');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc'],'',array('jto_id'=>$dataID));
					$data['key_action']='edit';
					$data['dataPositionEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('jto_name', 'Position Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules('jto_code', 'Position Code', 'trim|required|max_length[3]|xss_clean');
						$this->form_validation->set_rules('jto_cetak', 'Position Description', 'trim|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/positionForm',$data);
						}else{
							$data_update = array(
								'jto_name'=>$this->input->post('jto_name'),
								'jto_code'=>$this->input->post('jto_code'),
								'jto_cetak'=>$this->input->post('jto_cetak')
								//'jto_flag'=>$this->input->post('jto_flag')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_jto'],$data_update,$sessionID,$this->pk['jto_id'],$dataID);
							redirect('admin/managePosition');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_jto'],'',$sessionID,$this->pk['jto_id'],$dataID);
					redirect('admin/managePosition');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageOA($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Wilayah Operasi';
			$data['permission']='Operation Area';
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
			
			/*START OA DATA*/
			$data['dataOA']=jarvis_get_data($this->searchField['nama_wilop'],$this->table['mst_wilop'],$this->fieldOrder['kd_wilop'],$this->fieldOrderType['asc']);
			/*END IA DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/oa',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('nama_wilop', 'OA Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/oaForm',$data);
					}else{
						$data_insert = array(
							'nama_wilop'=>$this->input->post('nama_wilop')
						);
						jarvis_process_block($this->changeParams[1],$this->table['mst_wilop'],$data_insert,$sessionID);
						redirect('admin/manageOA');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['nama_wilop'],$this->table['mst_wilop'],$this->fieldOrder['kd_wilop'],$this->fieldOrderType['asc'],'',array('kd_wilop'=>$dataID));
					$data['key_action']='edit';
					$data['dataOaEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('nama_wilop', 'OA Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/oaForm',$data);
						}else{
							$data_update = array(
								'nama_wilop'=>$this->input->post('nama_wilop')
							);
							jarvis_process_block($this->changeParams[2],$this->table['mst_wilop'],$data_update,$sessionID,$this->pk['kd_wilop'],$dataID);
							redirect('admin/manageOA');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['mst_wilop'],'',$sessionID,$this->pk['kd_wilop'],$dataID);
					redirect('admin/manageOA');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageLoc($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Lokasi';
			$data['permission']='Location';
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
			
			/*START LOCATION DATA*/
			$data['dataLoc']=jarvis_get_data($this->searchField['loc_name'],$this->table['wm_lokasi'],$this->fieldOrder['loc_code'],$this->fieldOrderType['asc']);
			/*END LOCATION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/location',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('loc_name', 'Location Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/locationForm',$data);
					}else{
						$data_insert = array(
							'loc_name'=>$this->input->post('loc_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_lokasi'],$data_insert,$sessionID);
						redirect('admin/manageLoc');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['loc_name'],$this->table['wm_lokasi'],$this->fieldOrder['loc_code'],$this->fieldOrderType['asc'],'',array('loc_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataLocEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('loc_name', 'Location Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/locationForm',$data);
						}else{
							$data_update = array(
								'loc_name'=>$this->input->post('loc_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_lokasi'],$data_update,$sessionID,$this->pk['loc_code'],$dataID);
							redirect('admin/manageLoc');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_lokasi'],'',$sessionID,$this->pk['loc_code'],$dataID);
					redirect('admin/manageLoc');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageSU($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Stasiun';
			$data['permission']='Station Unit';
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
			
			/*START STATION UNIT DATA*/
			$data['dataSU']=jarvis_get_data($this->searchField['nama_unitstasiun'],$this->table['wm_unitstasiun'],$this->fieldOrder['kd_unitstasiun'],$this->fieldOrderType['asc']);
			/*END STATION UNIT DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/station',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('nama_unitstasiun', 'Station Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/stationForm',$data);
					}else{
						$data_insert = array(
							'nama_unitstasiun'=>$this->input->post('nama_unitstasiun')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_unitstasiun'],$data_insert,$sessionID);
						redirect('admin/manageSU');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['nama_unitstasiun'],$this->table['wm_unitstasiun'],$this->fieldOrder['kd_unitstasiun'],$this->fieldOrderType['asc'],'',array('kd_unitstasiun'=>$dataID));
					$data['key_action']='edit';
					$data['dataSUEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('nama_unitstasiun', 'Station Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/stationForm',$data);
						}else{
							$data_update = array(
								'nama_unitstasiun'=>$this->input->post('nama_unitstasiun')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_unitstasiun'],$data_update,$sessionID,$this->pk['kd_unitstasiun'],$dataID);
							redirect('admin/manageSU');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_unitstasiun'],'',$sessionID,$this->pk['kd_unitstasiun'],$dataID);
					redirect('admin/manageSU');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageCT($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Sertifikat';
			$data['permission']='Certificate';
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
			
			/*START CERTIFICATE DATA*/
			$data['dataCT']=jarvis_get_data($this->searchField['js_name'],$this->table['wm_jsertifikat'],$this->fieldOrder['js_code'],$this->fieldOrderType['asc']);
			/*END CERTIFICATE DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/certificate',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('js_name', 'Certificate Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/certificateForm',$data);
					}else{
						$data_insert = array(
							'js_name'=>$this->input->post('js_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_jsertifikat'],$data_insert,$sessionID);
						redirect('admin/manageCT');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['js_name'],$this->table['wm_jsertifikat'],$this->fieldOrder['js_code'],$this->fieldOrderType['asc'],'',array('js_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataCTEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('js_name', 'Certificate Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/certificateForm',$data);
						}else{
							$data_update = array(
								'js_name'=>$this->input->post('js_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_jsertifikat'],$data_update,$sessionID,$this->pk['js_code'],$dataID);
							redirect('admin/manageCT');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_jsertifikat'],'',$sessionID,$this->pk['js_code'],$dataID);
					redirect('admin/manageCT');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageTP($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Transportasi';
			$data['permission']='Transportation';
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
			
			/*START TRANSPORTATION DATA*/
			$data['dataTP']=jarvis_get_data($this->searchField['ja_name'],$this->table['wm_angkutan'],$this->fieldOrder['ja_code'],$this->fieldOrderType['asc']);
			/*END TRANSPORTATION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/transportation',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('ja_name', 'Transportation Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/transportationForm',$data);
					}else{
						$data_insert = array(
							'ja_name'=>$this->input->post('ja_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_angkutan'],$data_insert,$sessionID);
						redirect('admin/manageTP');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['ja_name'],$this->table['wm_angkutan'],$this->fieldOrder['ja_code'],$this->fieldOrderType['asc'],'',array('ja_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataTPEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('ja_name', 'Transportation Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/transportationForm',$data);
						}else{
							$data_update = array(
								'ja_name'=>$this->input->post('ja_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_angkutan'],$data_update,$sessionID,$this->pk['ja_code'],$dataID);
							redirect('admin/manageTP');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_angkutan'],'',$sessionID,$this->pk['ja_code'],$dataID);
					redirect('admin/manageTP');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageLane($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Jalur';
			$data['permission']='Lane';
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
			
			/*START LANE DATA*/
			$data['dataLane']=jarvis_get_data($this->searchField['kj_name'],$this->table['wm_jalur'],$this->fieldOrder['kj_code'],$this->fieldOrderType['asc']);
			/*END LANE DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/lane',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('kj_name', 'Lane Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/laneForm',$data);
					}else{
						$data_insert = array(
							'kj_name'=>$this->input->post('kj_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_jalur'],$data_insert,$sessionID);
						redirect('admin/manageLane');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['kj_name'],$this->table['wm_jalur'],$this->fieldOrder['kj_code'],$this->fieldOrderType['asc'],'',array('kj_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataLaneEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('kj_name', 'Lane Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/laneForm',$data);
						}else{
							$data_update = array(
								'kj_name'=>$this->input->post('kj_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_jalur'],$data_update,$sessionID,$this->pk['kj_code'],$dataID);
							redirect('admin/manageLane');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_jalur'],'',$sessionID,$this->pk['kj_code'],$dataID);
					redirect('admin/manageLane');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageServ($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Pelayanan';
			$data['permission']='Services';
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
			
			/*START SERVICES DATA*/
			$data['dataServ']=jarvis_get_data($this->searchField['jpel_name'],$this->table['wm_playan'],$this->fieldOrder['jpel_code'],$this->fieldOrderType['asc']);
			/*END SERVICES DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/service',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('jpel_name', 'Service Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/serviceForm',$data);
					}else{
						$data_insert = array(
							'jpel_name'=>$this->input->post('jpel_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_playan'],$data_insert,$sessionID);
						redirect('admin/manageServ');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['jpel_name'],$this->table['wm_playan'],$this->fieldOrder['jpel_code'],$this->fieldOrderType['asc'],'',array('jpel_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataServEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('jpel_name', 'Service Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/serviceForm',$data);
						}else{
							$data_update = array(
								'jpel_name'=>$this->input->post('jpel_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_playan'],$data_update,$sessionID,$this->pk['jpel_code'],$dataID);
							redirect('admin/manageServ');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_playan'],'',$sessionID,$this->pk['jpel_code'],$dataID);
					redirect('admin/manageServ');
				}
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function manageLoco($subPage='',$dataID=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'admin','active'=>'true'));
			$data['page_title']='Lokomotif';
			$data['permission']='Locomotive';
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
			
			/*START LOCOMOTIVE DATA*/
			$data['dataLoco']=jarvis_get_data($this->searchField['jp_name'],$this->table['wm_pgerak'],$this->fieldOrder['jp_code'],$this->fieldOrderType['asc']);
			/*END LOCOMOTIVE DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage){
				jarvis_load_view('admin/views/loco',$data);
			}else{
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('jp_name', 'Loco Name', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('admin/views/locoForm',$data);
					}else{
						$data_insert = array(
							'jp_name'=>$this->input->post('jp_name')
						);
						jarvis_process_block($this->changeParams[1],$this->table['wm_pgerak'],$data_insert,$sessionID);
						redirect('admin/manageLoco');
					}	
				}elseif($subPage=='edit'){
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['jp_name'],$this->table['wm_pgerak'],$this->fieldOrder['jp_code'],$this->fieldOrderType['asc'],'',array('jp_code'=>$dataID));
					$data['key_action']='edit';
					$data['dataLocoEdit']=$result;
					if($result['results']==1){
						$this->form_validation->set_rules('jp_name', 'Loco Name', 'trim|required|xss_clean');
						if($this->form_validation->run() == FALSE){	
							jarvis_load_view('admin/views/locoForm',$data);
						}else{
							$data_update = array(
								'jp_name'=>$this->input->post('jp_name')
							);
							jarvis_process_block($this->changeParams[2],$this->table['wm_pgerak'],$data_update,$sessionID,$this->pk['jp_code'],$dataID);
							redirect('admin/manageLoco');
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='delete'){
					$dataID=jarvis_decode(uri_segment(4));
					jarvis_process_block($this->changeParams[3],$this->table['wm_pgerak'],'',$sessionID,$this->pk['jp_code'],$dataID);
					redirect('admin/manageLoco');
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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
