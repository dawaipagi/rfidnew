<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	
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
	public function index(){
		$this->load->helper(array('captcha'));
		$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['site_title'] = 'Jarvis';
		$data['page_title'] = 'Log in';
		$data['html_class'] = 'loginBG';
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		if($this->form_validation->run() == true && $this->input->post('secutity_code') == $this->session->userdata('mycaptcha')){
			redirect('dashboard');
		}else{
			/*CAPTCHA*/
			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				//'img_width'	 => '320',
				'font_path'	=> './system/fonts/texb.ttf',
				'img_height' => 50,
				'border' => 0, 
				'expiration' => 7200
			);
			$cap = create_captcha($vals); 
			$data['image'] = $cap['image']; 
			$this->session->set_userdata('mycaptcha', $cap['word']);
			/*CAPTCHA*/
			$this->load->view('header',$data);
			$this->load->view('login/login',$data);
			$this->load->view('footer',$data);
			
			/*$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
			$userIp=$this->input->ip_address();
			//$userIp='118.96.90.225';
			$secret='6LcZmRATAAAAAFVC-le3hbqNoNSvnlPZkMkT0X7T';
			$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
			$response = $this->curl->simple_get($url);
			$status= json_decode($response, true);
			if($status['success']=='true'){
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('flashSuccess', 'Sorry Google Recaptcha Unsuccessful!!');
				$this->load->view('header',$data);
				$this->load->view('login/login',$data);
				$this->load->view('footer',$data);
			}*/
			
		}
	}
	public function check_database($password){
		$username = $this->input->post('username');
		$result = jarvis_get_data($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('username'=>$username,'password'=>md5($password)));
		if($result['results']==1){
			$sess_array = array();
			foreach($result['data'] as $row){
				if($row['banned']=='true'){
					$this->form_validation->set_message('check_database', 'Username is banned');
					return FALSE;
				}else{
					$sess_array = array(
						'id' => $row['id'],
						'username' => $row['username'],
						'name' => $row['name'],
						'email' => $row['email'],
						'phone_number' => $row['phone_number'],
						'address' => $row['address'],
						'avatar' => $row['avatar'],
						'is_online' => 'Online',
						'ref_group_user' => $row['ref_group_user'],
						'created' => $row['c_created'],
						'group' => $row['group'],
						'on_screen' => 'yes'
					);
					$id = $row['id'];
					date_default_timezone_set("Asia/Bangkok");
					$data = array(
						'last_activity'=>date("Y-m-d H:i:s"),
						'last_time_activity'=>time()*1000,
						'last_login'=>date("Y-m-d H:i:s"),
						'is_online'=>'true',
					);
					jarvis_process_block($this->changeParams[4],$this->table['jarvis_user'],$data,$id,$this->pk['id'],$id);
					$this->session->set_userdata('logged_in', $sess_array);	
				}		
			}
			return TRUE;
		}
		else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return FALSE;
		}
	}

	public function daftar_baru(){
		$this->load->helper(array('captcha'));
		$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['site_title'] = 'Jarvis';
		$data['page_title'] = 'Log in';
		$data['html_class'] = 'loginBG';

		// 	/*CAPTCHA*/
			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				//'img_width'	 => '320',
				'font_path'	=> './system/fonts/texb.ttf',
				'img_height' => 50,
				'border' => 0, 
				'expiration' => 7200
			);
			$cap = create_captcha($vals); 
			$data['image'] = $cap['image']; 
			$this->session->set_userdata('mycaptcha', $cap['word']);
			/*CAPTCHA*/
			$this->load->view('header',$data);
			$this->load->view('login/daftar_baru',$data);
			$this->load->view('footer',$data);
					
		// }
	}

// Request Form
	function add_daftar_baru(){

	$avatare = $_POST['username'].".jpg";
		$data = array(
			'name'				=> $_POST['name'],
			'email'				=> $_POST['email'],
			'phone_number'		=> $_POST['phone_number'],
			'address'			=> $_POST['address'],
			'username'			=> $_POST['username'],
			'password'			=> md5($_POST['password']),
			'avatar'			=> $avatare,
			'ref_group_user'	=> $_POST['ref_group_user'],
			'c_created'			=> date('Y-m-d h:i:s')
			);
		$this->db->insert('jarvis_user', $data);



		$config = array();
		$config['useragent']    = "CodeIgniter";
		$config['mailpath']     = "/usr/bin/sendmail";
		$config['protocol']     = "smtp";
		$config['smtp_host']    = "localhost";
		$config['smtp_port']	= "25";
		$config['mailtype'] 	= 'html';
		$config['charset']  	= 'utf-8';
		$config['newline']  	= "\r\n";
		$config['wordwrap'] 	= TRUE;
		 
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		 
		$mail = $this->email;
		 
		$mail->from('admin@aplikasiwebbase.com', 'KEMENTERIAN PERHUBUNGAN - DIREKTORAT JENDERAL PERKERETAAPIAN');

		$email = $this->db->get('jarvis_user')->row();
		$mail->to($email->email);

		$mail->subject('Verifikasi Email www.siskomka.com - '.' '.$_POST['name']);


		$isi = "Silahkan Klik Kode Verifikasi berikut ini : <br>".base_url()."/".$_POST['username']."/".md5($_POST['password'])."<br>Username : ".$_POST['username']."<br>Password : ".$_POST['password']."<br><br><b>Terimakasih</b>";


		$mail->message($isi);
		 
		$mail->send();
		 
		// echo $mail->print_debugger();
// die();
	redirect('login/sukses_daftar');
	}

		function sukses_daftar(){
		$this->load->helper(array('captcha'));
		$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['site_title'] = 'Jarvis';
		$data['page_title'] = 'Log in';
		$data['html_class'] = 'loginBG';

			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				//'img_width'	 => '320',
				'font_path'	=> './system/fonts/texb.ttf',
				'img_height' => 50,
				'border' => 0, 
				'expiration' => 7200
			);
			$cap = create_captcha($vals); 
			$data['image'] = $cap['image']; 
			$this->session->set_userdata('mycaptcha', $cap['word']);
			/*CAPTCHA*/
			$this->load->view('header',$data);
			$this->load->view('login/sukses_daftar',$data);
			$this->load->view('footer',$data);
	}


	function verifikasi_email(){

		$user = $this->uri->segment(3); 
		$pass = $this->uri->segment(4); 

		// echo "User:".$user;
		// echo "Pass:".$pass;	

		$data=array(
			'verifikasi' => 1
			);

		$this->db->where("username", $user);
		$this->db->where("password", $pass);

		$this->db->update("jarvis_user", $data);
		
		redirect('login/sukses_verifikasi_email');
	}

	function sukses_verifikasi_email(){
		$this->load->helper(array('captcha'));
		$data['css'] = jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['js'] = jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'login','active'=>'true'));
		$data['site_title'] = 'Jarvis';
		$data['page_title'] = 'Log in';
		$data['html_class'] = 'loginBG';

			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 => base_url().'captcha/',
				//'img_width'	 => '320',
				'font_path'	=> './system/fonts/texb.ttf',
				'img_height' => 50,
				'border' => 0, 
				'expiration' => 7200
			);
			$cap = create_captcha($vals); 
			$data['image'] = $cap['image']; 
			$this->session->set_userdata('mycaptcha', $cap['word']);
			/*CAPTCHA*/
			$this->load->view('header',$data);
			$this->load->view('login/sukses_verifikasi_email',$data);
			$this->load->view('footer',$data);
	}



}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
