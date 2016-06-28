<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','wm_pegawai'=>'wm_pegawai','wm_jjoperasi'=>'wm_jjoperasi','wm_peg_sert'=>'wm_peg_sert','wm_jto'=>'wm_jto','mst_wilop'=>'mst_wilop','wm_lokasi'=>'wm_lokasi','wm_unitstasiun'=>'wm_unitstasiun','wm_excel'=>'wm_excel','wm_excel_data'=>'wm_excel_data','jarvis_del_temp'=>'jarvis_del_temp');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user','wm_vw_peg_sert'=>'wm_vw_peg_sert','wm_vw_pegawai'=>'wm_vw_pegawai');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint','p_id'=>'p_id','jjo_code'=>'jjo_code','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','pid'=>'pid');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username','p_name'=>'p_name','jjo_name'=>'jjo_name','jto_name'=>'jto_name','nama_wilop'=>'nama_wilop','loc_name'=>'loc_name','nama_unitstasiun'=>'nama_unitstasiun','data'=>'data','nama'=>'nama');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT','6'=>'INSERT_BATCH');
	private $pk=array('id'=>'id','p_id'=>'p_id','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','pid'=>'pid');
	
	function __construct(){
		parent::__construct();
	}
	public function registration($do=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Laporan Registrasi';
			$data['permission']='advanced-search';
			$data['html_class']='';
			$data['errorAvatar']='';
			$data['userData']=$session_data;
			$data['key_action']='search';
			
			/*START SIDEBAR MENU*/
			$params_sidebar=array('ref_group_user'=>$session_data['ref_group_user']);
			$data['sidebar']=jarvis_sidebar('jarvis_vw_menu','order_hint','asc',$params_sidebar);
			/*END SIDEBAR MENU*/			
			
			/*START LAYOUT SETTING*/	
			$params_layout=array('id'=>$sessionID);
			$data['layout']=jarvis_layout_setting($this->searchField['username'],$this->view['jarvis_vw_user'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],$params_layout);
			/*END LAYOUT SETTING*/
			
			/*START POSITION*/	
			$params_position=array('jto_flag'=>0);
			$data['positionData']=jarvis_layout_setting($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc'],$params_position);
			/*END POSITION*/
			
			/*START DATA STATUS*/
			$data['dataStatus'] = jarvis_call_parameter('status_data');
			/*END DATA STATUS*/
			
			if($do){
				/*$findArr=array(
					'ser_op'=>jarvis_post('ser_op'),
					'status_data_id'=>jarvis_post('status_data_id'),
					'ser_tglakhir >'=>(jarvis_post('ser_tglakhir')!='' ? jarvis_convert_field(jarvis_post('ser_tglakhir'),'jarvisDateV2') : ''),
					'p_name'=>jarvis_post('p_name'),
					'ser_no'=>jarvis_post('ser_no'),
				);
				$getRegis=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['pid'],$this->fieldOrderType['asc'],'',array_filter($findArr));
				$data['showSearch']=json_encode(array('query'=>array_filter($findArr),'result'=>$getRegis['results']));*/
				$whereHead="where id > 0";
				$whereSerOP=(jarvis_post('ser_op')!='' ? " and ser_op='".jarvis_post('ser_op')."'" : '');
				$whereStatus=(jarvis_post('status_data_id')!='' ? " and status_data_id='".jarvis_post('status_data_id')."'" : '');
				$whereDate=(jarvis_post('ser_tglakhir')!='' ? " and ser_tglakhir > ".jarvis_convert_field(jarvis_post('ser_tglakhir'),'jarvisDateV2') : '');
				$whereKey=(jarvis_post('nilai_pencarian')!='' ? " and ser_no like '%".jarvis_post('nilai_pencarian')."' or ser_no like '".jarvis_post('nilai_pencarian')."%' or ser_no like '%".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."' or p_name like '".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."' or p_nip like '".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."%'" : '');
				$getRegis=jarvis_query_block("select * from ".$this->view['wm_vw_peg_sert']." ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey);
				$data['showSearch']=json_encode(array('query'=>"select * from ".$this->view['wm_vw_peg_sert']." ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey,'result'=>$getRegis->num_rows()));
			}
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			jarvis_load_view('report/registration',$data);
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function print_pdf($keyword){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$keyDec=jarvis_decode($keyword);
			$keyDecode=json_decode($keyDec,true);
			define('TITLE','Laporan Registrasi Sertifikasi');
			define('SUB_TITLE','KEMENTERIAN PERHUBUNGAN DIREKTORAT JENDERAL PERKERETAAPIAN');
			define('LOGO','DISHUB.png');
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    	 
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Aldian');
			$pdf->SetTitle('Laporan Registrasi');
			$pdf->SetSubject('Laporan Registrasi');	 
			// set default header data
			//$pdf->SetHeaderData(LOGO, '9', TITLE, SUB_TITLE, array(0,64,255), array(0,64,128));
			$pdf->SetHeaderData('', '', TITLE, SUB_TITLE, array(0,64,255), array(0,64,128));
			$pdf->setFooterData(array(0,64,0), array(0,64,128)); 
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 	 
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    	 
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 	 
			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  	 
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}   	 
			// set default font subsetting mode
			$pdf->setFontSubsetting(true);   	 
			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$pdf->SetFont('dejavusans', '', 12, '', true);   	 
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage(); 	 
			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    	 
			// Set some content to print
			$html = '<table width="100%" cellpadding="2" cellspacing="2">
					<tr>
						<td style="border:1px black solid; font-weight:bold;" width="5%">ID</td>
						<td style="border:1px black solid; font-weight:bold;" width="50%">Nama</td>
						<td style="border:1px black solid; font-weight:bold;" width="30%">No.Sertifikat</td>
						<td style="border:1px black solid; font-weight:bold;" width="15%">Status</td>
					</tr>
				';
			//$getRegis=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['pid'],$this->fieldOrderType['asc'],'',$keyDecode);
			$getRegis=jarvis_query_block($keyDecode);
			//foreach($getRegis['data'] as $item){
			foreach($getRegis->result_array() as $item){
				$html .='<tr>
					<td style="border:1px black solid;">'.$item['Id'].'</td>
					<td style="border:1px black solid;">'.$item['p_name'].'</td>
					<td style="border:1px black solid;">'.$item['ser_no'].'</td>
					<td style="border:1px black solid;">'.$item['status_data_name'].'</td>
				</tr>';
			}
			$html .='</table>';
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('laporan_registrasi.pdf', 'I'); 
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */
