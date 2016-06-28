<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','jarvis_user'=>'jarvis_user');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT');
	private $pk=array('id'=>'id');
	
	function __construct(){
		parent::__construct();
	}
	public function account(){
		$session_data = $this->session->userdata('logged_in');
		if($session_data){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['page_title'] = 'Profile - Account';
			$data['html_class'] = '';
			$data['userData'] = $session_data;
			$data['activeTab'] = 'account';
			$data['key_action'] = 'account';
			$data['urlAlert'] = 'profile/account';
			$data['msgAlert'] = 'Account profile successfully updated';
			
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
			$isUniqueUsername = '|is_unique['.$this->view['jarvis_vw_user'].'.username]';
			$isUniqueEmail = '|is_unique['.$this->view['jarvis_vw_user'].'.email]'; 
			if($this->input->post('username')==get_data_user('username')){
				$isUniqueUsername = '';
			}
			if($this->input->post('email')==get_data_user('email')){
				$isUniqueEmail = '';
			}
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean'.$isUniqueUsername);
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email'.$isUniqueEmail);
			$this->form_validation->set_rules('phone_number', 'Phone number', 'trim|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
			if($this->form_validation->run() == FALSE){	
				jarvis_load_view('profile/page',$data);
			}else{
				$data_update = array(
					'username'=>$this->input->post('username'),
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'phone_number'=>$this->input->post('phone_number'),
					'address'=>$this->input->post('address')
				);
				jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$sessionID);
				jarvis_load_view('alert/page',$data);
			}
			jarvis_load_view('footer',$data);
		}else{
			redirect('login', 'refresh');
		}
	}
	public function avatar($upload=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['page_title'] = 'Profile - Avatar';
			$data['html_class'] = '';
			$data['userData'] = $session_data;
			$data['activeTab'] = 'avatar';
			$data['key_action'] = 'avatar';
			$data['urlAlert'] = 'profile/avatar';
			$data['msgAlert'] = 'Avatar successfully updated';
			$data['errorAvatar']= '';
			
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
			
			if($upload){
				/*START UPLOAD AVATAR*/
					$config['upload_path'] = jarvis_call_configuration('savedAvatar');
					$config['allowed_types'] = jarvis_call_configuration('allowedTypeAvatar');
					$config['file_name'] = jarvis_call_configuration('defaultNameAvatar').$sessionID;
					$config['max_size']	= jarvis_call_configuration('maxSizeAvatar');
					$config['max_width']  = jarvis_call_configuration('maxWidthAvatar');
					$config['max_height']  = jarvis_call_configuration('maxHeightAvatar');
					$this->upload->initialize($config);			
				/*END UPLOAD AVATAR*/
				
				if(!$this->upload->do_upload('avatar')){
					$data['errorAvatar']=$this->upload->display_errors('<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>');
					jarvis_load_view('profile/page',$data);
				}else{
					delete_avatar(get_data_user('avatar'));
					$avatarData=$this->upload->data();
					$data_update = array(
						'avatar'=>$avatarData['file_name']
					);
					jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$sessionID);
					jarvis_load_view('alert/page',$data);
				}
			}else{
				jarvis_load_view('profile/page',$data);
			}
			jarvis_load_view('footer',$data);
		}else{
			redirect('login', 'refresh');
		}
	}
	public function password(){
		$session_data = $this->session->userdata('logged_in');
		if($session_data){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'profile','active'=>'true'));
			$data['page_title'] = 'Profile - Password';
			$data['html_class'] = '';
			$data['userData'] = $session_data;
			$data['activeTab'] = 'password';
			$data['key_action'] = 'password';
			$data['urlAlert'] = 'profile/password';
			$data['msgAlert'] = 'Password successfully updated';
			
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
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[passwordconf]|md5');
			$this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE){	
				jarvis_load_view('profile/page',$data);
			}else{
				$data_update = array(
					'password'=>$this->input->post('password')
				);
				jarvis_process_block($this->changeParams[2],$this->table['jarvis_user'],$data_update,$sessionID,$this->pk['id'],$sessionID);
				jarvis_load_view('alert/page',$data);
			}
			jarvis_load_view('footer',$data);
		}else{
			redirect('login', 'refresh');
		}
	}
}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
