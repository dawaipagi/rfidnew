<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registration extends CI_Controller {
	
	private $table=array('css'=>'jarvis_autoload_css','js'=>'jarvis_autoload_js','config'=>'configuration','wm_pegawai'=>'wm_pegawai','wm_jjoperasi'=>'wm_jjoperasi','wm_peg_sert'=>'wm_peg_sert','wm_jto'=>'wm_jto','mst_wilop'=>'mst_wilop','wm_lokasi'=>'wm_lokasi','wm_unitstasiun'=>'wm_unitstasiun','wm_excel'=>'wm_excel','wm_excel_data'=>'wm_excel_data','jarvis_del_temp'=>'jarvis_del_temp','wm_peg_sert_pdf'=>'wm_peg_sert_pdf');
	private $view=array('jarvis_vw_user'=>'jarvis_vw_user','wm_vw_peg_sert'=>'wm_vw_peg_sert','wm_vw_pegawai'=>'wm_vw_pegawai','wm_vw_peg_sert_pdf'=>'wm_vw_peg_sert_pdf');
	private $fieldOrder=array('id'=>'id','order_hint'=>'order_hint','p_id'=>'p_id','jjo_code'=>'jjo_code','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','pid'=>'pid','quee_no'=>'quee_no');
	private $fieldOrderType=array('asc'=>'asc','desc'=>'desc');
	private $searchField=array('filename'=>'filename','username'=>'username','p_name'=>'p_name','jjo_name'=>'jjo_name','jto_name'=>'jto_name','nama_wilop'=>'nama_wilop','loc_name'=>'loc_name','nama_unitstasiun'=>'nama_unitstasiun','data'=>'data','nama'=>'nama','file'=>'file');
	private $changeParams=array('1'=>'INSERT','2'=>'UPDATE','3'=>'DELETE','4'=>'LOGIN','5'=>'LOGOUT','6'=>'INSERT_BATCH');
	private $pk=array('id'=>'id','p_id'=>'p_id','jto_id'=>'jto_id','kd_wilop'=>'kd_wilop','loc_code'=>'loc_code','kd_unitstasiun'=>'kd_unitstasiun','pid'=>'pid');
	
	public function enter($subPage='',$dataID='',$params=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Daftar Registrasi';
			$data['permission']='Enter-Registration';
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
			
			if($subPage=='search'){
				if(strlen(jarvis_post('nilai_pencarian')) >= 3){
					$limit=' order by id desc';
				}else{
					$limit=' order by id desc limit 50';
				}
			}else{
				$limit=' order by id desc limit 50';
			}
			
			if($session_data['ref_group_user']=='J3'){
				$whereUID=" and uid='".$sessionID."'";
			}else{
				$whereUID="";
			}
				$whereHead="where id > 0 and reg_no like'%REG%'".$whereUID;
				$whereSerOP=(jarvis_post('ser_op')!='' ? " and ser_op='".jarvis_post('ser_op')."'" : '');
				$whereStatus=(jarvis_post('status_data_id')!='' ? " and status_data_id='".jarvis_post('status_data_id')."'" : '');
				$whereDate=(jarvis_post('ser_tglakhir')!='' ? " and ser_tglakhir > ".jarvis_convert_field(jarvis_post('ser_tglakhir'),'jarvisDateV2') : '');
				$whereKey=(strlen(jarvis_post('nilai_pencarian')) >= 3 ? jarvis_post('nilai_pencarian')!='' ? " and ser_no like '%".jarvis_post('nilai_pencarian')."' or ser_no like '".jarvis_post('nilai_pencarian')."%' or ser_no like '%".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."' or p_name like '".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."' or p_nip like '".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."%'" : '' : '');
			
			/*START REGISTRATION DATA*/
			$data['dataReg']=jarvis_query_block("select * from ".$this->view['wm_vw_peg_sert']." ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey.$limit);
			/*END REGISTRATION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage or $subPage=='search'){
				jarvis_load_view('registration/enter',$data);
			}else{
				/*START RANK DATA*/
				$data['dataRank']=jarvis_get_data($this->searchField['jjo_name'],$this->table['wm_jjoperasi'],$this->fieldOrder['jjo_code'],$this->fieldOrderType['asc']);
				/*END RANK DATA*/
				
				/*START POSITION*/	
				$params_position=array('jto_flag'=>0);
				$data['positionData']=jarvis_layout_setting($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc'],$params_position);
				/*END POSITION*/
				
				/*START OPERATION AREA*/	
				$data['operationData']=jarvis_get_data($this->searchField['nama_wilop'],$this->table['mst_wilop'],$this->fieldOrder['kd_wilop'],$this->fieldOrderType['asc']);
				/*END OPERATION AREA*/

				/*START LOCATION*/	
				$data['locationData']=jarvis_get_data($this->searchField['loc_name'],$this->table['wm_lokasi'],$this->fieldOrder['loc_code'],$this->fieldOrderType['asc']);
				/*END LOCATION*/
				
				/*START STATION*/	
				$data['stationData']=jarvis_get_data($this->searchField['nama_unitstasiun'],$this->table['wm_unitstasiun'],$this->fieldOrder['kd_unitstasiun'],$this->fieldOrderType['asc']);
				/*END STATION*/
				
				/*START CARD STATUS*/
				$data['cardStatus'] = jarvis_call_parameter('status_kartu');
				/*END CARD STATUS*/
				if($subPage=='add'){
					$data['key_action']='add';
					$this->form_validation->set_rules('p_name', 'Emp Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('p_plzbirth', 'Emp Birthplace', 'trim|xss_clean');
					$this->form_validation->set_rules('p_birthdate', 'Emp Birthdate', 'trim|required|xss_clean');
					$this->form_validation->set_rules('pd_jabto', 'Emp Rank', 'trim|required|xss_clean');
					$this->form_validation->set_rules('p_nip', 'NIP', 'trim|xss_clean|max_length[20]');
					$this->form_validation->set_rules('ser_op', 'Position Name', 'required');
					$this->form_validation->set_rules('ser_wo', 'Operation Area', 'required');
					$this->form_validation->set_rules('ser_lok', 'Location', 'required');
					$this->form_validation->set_rules('ser_unit', 'Statiun Unit', 'required');					
					$this->form_validation->set_rules('ser_code', 'Ser Code', 'trim');					
					if($this->form_validation->run() == FALSE){
						jarvis_load_view('registration/enterForm',$data);
					}else{
						/*START UPLOAD AVATAR*/
							$config['upload_path'] = jarvis_call_configuration('savedPhoto');
							$config['allowed_types'] = jarvis_call_configuration('allowedTypePhoto');
							$config['file_name'] = substr(jarvis_post('p_name'),0,10).str_replace('-','',jarvis_convert_field(jarvis_post('p_birthdate'),'jarvisDateV2'));
							$config['max_size']	= jarvis_call_configuration('maxSizePhoto');
							$config['max_width']  = jarvis_call_configuration('maxWidthPhoto');
							$config['max_height']  = jarvis_call_configuration('maxHeightPhoto');
							$this->upload->initialize($config);			
						/*END UPLOAD AVATAR*/
						if(!$this->upload->do_upload('p_image')){
							$data['errorAvatar']=$this->upload->display_errors('<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>');
							jarvis_load_view('registration/enterForm',$data);
						}else{
							$avatarData=$this->upload->data();
							$data_insert_emp = array(
								'p_name'=>jarvis_post('p_name'),
								'p_plzbirth'=>jarvis_post('p_plzbirth'),
								'p_birthdate'=>(jarvis_post('p_birthdate')!='' ? jarvis_convert_field(jarvis_post('p_birthdate'),'jarvisDateV2') : ''),
								'pd_jabto'=>jarvis_post('pd_jabto'),
								'p_nip'=>jarvis_post('p_nip'),
								'status_data_id'=>'58',
								'p_image'=>$avatarData['file_name']
							);
							$insertEmp=jarvis_process_block($this->changeParams[1],$this->table['wm_pegawai'],$data_insert_emp,$sessionID);
							$getLastEmp=jarvis_query_block("select * from ".$this->table['wm_pegawai']." order by p_id desc limit 1");
							foreach($getLastEmp->result_array() as $lastEmp){
								$getNoReg=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['quee_no'],$this->fieldOrderType['desc'],'',array('date_created'=>date('Y-m-d')));
								$noReg=($getNoReg['results']==0 ? $getNoReg['results']+1 : jarvis_echo($getNoReg,'quee_no')+1);
								$lenNoReg=strlen(jarvis_call_configuration('defNoReg'))-strlen($noReg);								
								$data_insert_cert = array(
									'ser_op'=>jarvis_post('ser_op'),
									'ser_wo'=>jarvis_post('ser_wo'),
									'ser_lok'=>jarvis_post('ser_lok'),
									'ser_unit'=>jarvis_post('ser_unit'),
									'ser_jenis'=>'5',
									'ser_jangkut'=>'4',
									'ser_jgerak'=>'3',
									'ser_jarlay'=>'4',
									'ser_jalur'=>'5',
									'ser_no'=>jarvis_post('ser_code').'.'.jarvis_call_configuration('defReg').".".date('Ymd').'-'.substr(jarvis_call_configuration('defNoReg'),0,$lenNoReg).$noReg,
									'reg_no'=>jarvis_post('ser_code').'.'.jarvis_call_configuration('defReg').".".date('Ymd').'-'.substr(jarvis_call_configuration('defNoReg'),0,$lenNoReg).$noReg,
									'quee_no'=>$noReg,
									'ser_status'=>'50',
									'uid'=>$sessionID,
									'pid'=>$lastEmp['p_id']
								);
								$insertCert=jarvis_process_block($this->changeParams[1],$this->table['wm_peg_sert'],$data_insert_cert,$sessionID);
							}
							if(jarvis_post('addedOne')=='added_one'){
								redirect('registration/enter/add');
							}else{
								redirect('registration/enter');
							}
						}
					}
				}elseif($subPage=='edit'){
					$data['key_action']='edit';
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['dataRegEdit']=$result;
					$x=explode('.',jarvis_echo($result,'ser_no'));
					$i=0;
					foreach($x as $y){
						$i++;
						if($i>1){
							$z[]=$y;
						}
					}
					$data['serCode']=$x[0];
					$data['serNo']=implode('.',$z);
					if($result['results']==1){
						$this->form_validation->set_rules('p_name', 'Emp Name', 'trim|required|xss_clean');
						$this->form_validation->set_rules('p_plzbirth', 'Emp Birthplace', 'trim|xss_clean');
						$this->form_validation->set_rules('p_birthdate', 'Emp Birthdate', 'trim|required|xss_clean');
						$this->form_validation->set_rules('pd_jabto', 'Emp Rank', 'trim|required|xss_clean');
						$this->form_validation->set_rules('p_nip', 'NIP', 'trim|xss_clean|max_length[20]');
						$this->form_validation->set_rules('ser_op', 'Position Name', 'required');
						$this->form_validation->set_rules('ser_wo', 'Operation Area', 'required');
						$this->form_validation->set_rules('ser_lok', 'Location', 'required');
						$this->form_validation->set_rules('ser_unit', 'Statiun Unit', 'required');					
						$this->form_validation->set_rules('ser_code', 'Ser Code', 'trim');
						if($this->form_validation->run() == FALSE){
							jarvis_load_view('registration/enterForm',$data);
						}else{
							/*START UPLOAD AVATAR*/
								$config['upload_path'] = jarvis_call_configuration('savedPhoto');
								$config['allowed_types'] = jarvis_call_configuration('allowedTypePhoto');
								$config['file_name'] = substr(jarvis_post('p_name'),0,10).str_replace('-','',jarvis_convert_field(jarvis_post('p_birthdate'),'jarvisDateV2'));
								$config['max_size']	= jarvis_call_configuration('maxSizePhoto');
								$config['max_width']  = jarvis_call_configuration('maxWidthPhoto');
								$config['max_height']  = jarvis_call_configuration('maxHeightPhoto');
								$this->upload->initialize($config);			
							/*END UPLOAD AVATAR*/
							if(empty($_FILES['p_image']['name'])){
								$data_upd_emp = array(
									'p_name'=>jarvis_post('p_name'),
									'p_plzbirth'=>jarvis_post('p_plzbirth'),
									'p_birthdate'=>(jarvis_post('p_birthdate')!='' ? jarvis_convert_field(jarvis_post('p_birthdate'),'jarvisDateV2') : ''),
									'pd_jabto'=>jarvis_post('pd_jabto'),
									'p_nip'=>jarvis_post('p_nip')
								);
								$updateEmp=jarvis_process_block($this->changeParams[2],$this->table['wm_pegawai'],$data_upd_emp,$sessionID,$this->pk['p_id'],jarvis_echo($result,'pid'));
								$nextTrip=true;
							}else{
								if(!$this->upload->do_upload('p_image')){
									$data['errorAvatar']=$this->upload->display_errors('<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>');
									jarvis_load_view('registration/enterForm',$data);
									$nextTrip=false;
								}else{
									$avatarData=$this->upload->data();
									delete_prof_pic(jarvis_echo($result,'p_image'));
									$data_upd_emp = array(
										'p_name'=>jarvis_post('p_name'),
										'p_plzbirth'=>jarvis_post('p_plzbirth'),
										'p_birthdate'=>(jarvis_post('p_birthdate')!='' ? jarvis_convert_field(jarvis_post('p_birthdate'),'jarvisDateV2') : ''),
										'pd_jabto'=>jarvis_post('pd_jabto'),
										'p_nip'=>jarvis_post('p_nip'),
										'p_image'=>$avatarData['file_name']
									);
									$updateEmp=jarvis_process_block($this->changeParams[2],$this->table['wm_pegawai'],$data_upd_emp,$sessionID,$this->pk['p_id'],jarvis_echo($result,'pid'));									
									$nextTrip=true;
								}
							}
							if($nextTrip==true){
								$data_upd_cert = array(
									'ser_op'=>jarvis_post('ser_op'),
									'ser_wo'=>jarvis_post('ser_wo'),
									'ser_lok'=>jarvis_post('ser_lok'),
									'ser_unit'=>jarvis_post('ser_unit'),
									'ser_no'=>str_replace(jarvis_post('ser_code_old'),jarvis_post('ser_code'),jarvis_post('reg_no_old')),
									'reg_no'=>str_replace(jarvis_post('ser_code_old'),jarvis_post('ser_code'),jarvis_post('reg_no_old')),
								);
								$updateCert=jarvis_process_block($this->changeParams[2],$this->table['wm_peg_sert'],$data_upd_cert,$sessionID,$this->pk['id'],jarvis_echo($result,'Id'));
								if(jarvis_post('addedOne')=='added_one'){
									redirect('registration/enter/add');
								}else{
									redirect('registration/enter');
								}
							}
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='detail'){
					$data['key_action']='detail';
					$dataID=jarvis_decode(uri_segment(4));
					$result=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					$data['dataRegEdit']=$result;
					$data['dataPdfSert'] = jarvis_get_data($this->searchField['file'],$this->view['wm_vw_peg_sert_pdf'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('peg_id'=>$dataID));
					$x=explode('.',jarvis_echo($result,'ser_no'));
					$i=0;
					foreach($x as $y){
						$i++;
						if($i>1){
							$z[]=$y;
						}
					}
					$data['serCode']=$x[0];
					$data['serNo']=implode('.',$z);
					if($result['results']==1){
						jarvis_load_view('registration/enterForm',$data);
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='revisi'){
					/*START DATA STATUS*/
					$data['dataStatus'] = jarvis_call_parameter('status_data');
					/*END DATA STATUS*/
					$data['key_action']='revisi';
					$dataID=uri_segment(4);
					$result=jarvis_get_data($this->searchField['data'],$this->table['jarvis_del_temp'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
					if($result['results']==1){
						$nextTrip=false;
						$this->form_validation->set_rules('status_data_id', 'Emp Name', 'xss_clean');
						if($this->form_validation->run() == FALSE){
							jarvis_load_view('registration/enterForm',$data);
						}else{
							$idEmpExp=explode(',',jarvis_echo($result,'data'));
							foreach($idEmpExp as $idEmp){
								$data_upd_emp = array(
									'status_data_id'=>jarvis_post('status_data_id')
								);
								$updateEmp=jarvis_process_block($this->changeParams[2],$this->table['wm_pegawai'],$data_upd_emp,$sessionID,$this->pk['p_id'],$idEmp);									
							}
							$nextTrip=true;
							if($nextTrip==true){
								$delCert=jarvis_process_block($this->changeParams[3],$this->table['jarvis_del_temp'],'',$sessionID,'id',$dataID);
								redirect('registration/enter');
							}
						}
					}else{
						jarvis_load_view('404/page');
					}
				}elseif($subPage=='upload_pdf'){
					$data['urlAlert'] = 'registration/enter/upload_pdf/'.uri_segment(4);
					$data['msgAlert'] = 'Pdf successfully uploaded';
					$data['errorPdf']= '';
					$dataID=jarvis_decode(uri_segment(4));
					if(!$params){
						$result = $result=jarvis_get_data($this->searchField['p_name'],$this->view['wm_vw_peg_sert'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$dataID));
						$data['key_action'] = 'upload_pdf';
						$data['dataPdf'] = $result;
						$data['dataPdfSert'] = jarvis_get_data($this->searchField['file'],$this->view['wm_vw_peg_sert_pdf'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('peg_id'=>$dataID));
						if($result['results']==1){
							/*START UPLOAD PDF*/
								$config['upload_path'] = jarvis_call_configuration('savedPdf');
								$config['allowed_types'] = jarvis_call_configuration('allowedTypePdf');
								$config['file_name'] = substr(jarvis_echo($result,'p_name'),0,10).time();
								$this->upload->initialize($config);			
							/*END UPLOAD PDF*/
							if(!$this->upload->do_upload('file')){
								$data['errorPdf']=$this->upload->display_errors('<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>');
								jarvis_load_view('registration/enterPdf',$data);
							}else{
								$pdfData=$this->upload->data();
								$data_insert = array(
									'peg_id'=>$this->input->post('peg_id'),
									'file'=>$pdfData['file_name']
								);
								jarvis_process_block($this->changeParams[1],$this->table['wm_peg_sert_pdf'],$data_insert,$sessionID);
								redirect('registration/enter/upload_pdf/'.jarvis_encode($this->input->post('peg_id')));
							}
						}else{
							jarvis_load_view('404/page');
						}
					}else{
						$params=jarvis_decode(uri_segment(5));
						$jsonDec=json_decode($params,true);
						if($jsonDec['type']=='delete'){
							$getPdfs = $result=jarvis_get_data($this->searchField['file'],$this->table['wm_peg_sert_pdf'],$this->fieldOrder['id'],$this->fieldOrderType['asc'],'',array('id'=>$jsonDec['params']));
							foreach($getPdfs['data'] as $pdfDat){
								delete_pdf_file($pdfDat['file']);
								jarvis_process_block($this->changeParams[3],$this->table['wm_peg_sert_pdf'],'',$sessionID,$this->pk['id'],$jsonDec['params']);
								redirect('registration/enter/upload_pdf/'.jarvis_encode($dataID));
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
	public function import($upload=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'import','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'import','active'=>'true'));
			$data['page_title']='Import Excel';
			$data['permission']='Import-Excel';
			$data['html_class']='';
			$data['errorExcel']='';
			$data['userData']=$session_data;
			$data['key_action']='add';
			$data['urlAlert'] = 'registration/import';
			$data['msgAlert'] = 'Data berhasil di import';
			
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
				/*START UPLOAD EXCEL*/
					$config['upload_path'] = jarvis_call_configuration('savedExcel');
					$config['allowed_types'] = jarvis_call_configuration('allowedTypeExcel');
					$config['file_name'] = jarvis_call_configuration('defaultNameExcel').time();
					$this->upload->initialize($config);			
				/*END UPLOAD EXCEL*/
				if(!$this->upload->do_upload('excel_input')){
					$data['errorExcel']=$this->upload->display_errors('<div class="alert alert-danger alert-dismissable" style="margin-top:3px;"><i class="fa fa-ban"></i>','</div>');
					jarvis_load_view('registration/import',$data);
				}else{
					$excelData=$this->upload->data();
					$dataFile = array(
						'file'=>$excelData['file_name']
					);
					$insertFile=jarvis_process_block($this->changeParams[1],$this->table['wm_excel'],$dataFile,$sessionID);					
					
					/*START READ EXCEL FILE*/
					$excelFileName=jarvis_call_configuration('savedExcel').$excelData['file_name'];
					$inputFileType = PHPExcel_IOFactory::load($excelFileName);
					/*END READ EXCEL FILE*/
					
					/*START GET WORKSHEET DIMENSIONS*/
					$sheet = $inputFileType->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();
					/*END GET WORKSHEET DIMENSIONS*/
					
					/*START EMPTY DATA BY IP AND UID*/
						jarvis_query_block("DELETE FROM ".$this->table['wm_excel_data']." where ip='".$_SERVER['REMOTE_ADDR']."' and user_id='".get_data_user('id')."'");
					/*END EMPTY DATA BY IP AND UID*/
					//	Loop through each row of the worksheet in turn
					for ($row = 2; $row <= $highestRow; $row++) { 
						//  Read a row of data into an array                 
						$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
						$dataExcel=array(
							"nama"=>$rowData[0][0],
							"tp_lahir"=>$rowData[0][1],
							"tg_lahir"=>jarvis_unix_date($rowData[0][2]),
							"tingkat"=>$rowData[0][3],
							"jabatan"=>$rowData[0][4],
							"nip"=>$rowData[0][5],
							"wilop"=>$rowData[0][6],
							"lokasi"=>$rowData[0][7],
							"unit"=>$rowData[0][8],
							"ser_no"=>$rowData[0][9],
							"tg_berlaku"=>jarvis_unix_date($rowData[0][10]),
							"tg_berakhir"=>jarvis_unix_date($rowData[0][11]),
							"status_kartu"=>'BARU',
							"status_data_id"=>'58',
							"ip"=>$_SERVER['REMOTE_ADDR'],
							"user_id"=>get_data_user('id')
						);
						$insertFileData=jarvis_process_block($this->changeParams[1],$this->table['wm_excel_data'],$dataExcel,$sessionID);
					}
					//jarvis_load_view('alert/page',$data);
					redirect('registration/excel');
				}
			}else{
				jarvis_load_view('registration/import',$data);
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function excel(){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Excel';
			$data['permission']='Enter-Registration';
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
			
			/*START EXCEL DATA*/
			$params_excel=array('ip'=>$_SERVER['REMOTE_ADDR'],'user_id'=>$sessionID);
			$data['dataExcel']=jarvis_get_data($this->searchField['nama'],$this->table['wm_excel_data'],$this->fieldOrder['id'],$this->fieldOrderType['asc']);
			/*END EXCEL DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			jarvis_load_view('registration/excel',$data);
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function search($do=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Search';
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
				$getRegis=jarvis_query_block("select * from wm_vw_peg_sert ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey);
				$data['showSearch']=json_encode(array('query'=>"select * from wm_vw_peg_sert ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey,'result'=>$getRegis->num_rows()));
			}
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			jarvis_load_view('registration/search',$data);
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function sertification($subPage='',$dataID='',$params=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Sertifikasi';
			$data['permission']='Sertifikasi';
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
			
			if($subPage=='search'){
				if(strlen(jarvis_post('nilai_pencarian')) >= 3){
					$limit=' order by id desc';
				}else{
					$limit=' order by id desc limit 50';
				}
			}else{
				$limit=' order by id desc limit 50';
			}
			
			if($session_data['ref_group_user']=='J3'){
				$whereUID=" and uid='".$sessionID."'";
			}else{
				$whereUID="";
			}
				$whereHead="where id > 0 and reg_no not like'%REG%'".$whereUID;
				$whereSerOP=(jarvis_post('ser_op')!='' ? " and ser_op='".jarvis_post('ser_op')."'" : '');
				$whereStatus=(jarvis_post('status_data_id')!='' ? " and status_data_id='".jarvis_post('status_data_id')."'" : '');
				$whereDate=(jarvis_post('ser_tglakhir')!='' ? " and ser_tglakhir > ".jarvis_convert_field(jarvis_post('ser_tglakhir'),'jarvisDateV2') : '');
				$whereKey=(strlen(jarvis_post('nilai_pencarian')) >= 3 ? jarvis_post('nilai_pencarian')!='' ? " and ser_no like '%".jarvis_post('nilai_pencarian')."' or ser_no like '".jarvis_post('nilai_pencarian')."%' or ser_no like '%".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."' or p_name like '".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."' or p_nip like '".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."%'" : '' : '');
			
			/*START REGISTRATION DATA*/
			$data['dataReg']=jarvis_query_block("select * from ".$this->view['wm_vw_peg_sert']." ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey.$limit);
			/*END REGISTRATION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage or $subPage=='search'){
				jarvis_load_view('registration/sertification',$data);
			}else{
				/*START RANK DATA*/
				$data['dataRank']=jarvis_get_data($this->searchField['jjo_name'],$this->table['wm_jjoperasi'],$this->fieldOrder['jjo_code'],$this->fieldOrderType['asc']);
				/*END RANK DATA*/
				
				/*START POSITION*/	
				$params_position=array('jto_flag'=>0);
				$data['positionData']=jarvis_layout_setting($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc'],$params_position);
				/*END POSITION*/
				
				/*START OPERATION AREA*/	
				$data['operationData']=jarvis_get_data($this->searchField['nama_wilop'],$this->table['mst_wilop'],$this->fieldOrder['kd_wilop'],$this->fieldOrderType['asc']);
				/*END OPERATION AREA*/

				/*START LOCATION*/	
				$data['locationData']=jarvis_get_data($this->searchField['loc_name'],$this->table['wm_lokasi'],$this->fieldOrder['loc_code'],$this->fieldOrderType['asc']);
				/*END LOCATION*/
				
				/*START STATION*/	
				$data['stationData']=jarvis_get_data($this->searchField['nama_unitstasiun'],$this->table['wm_unitstasiun'],$this->fieldOrder['kd_unitstasiun'],$this->fieldOrderType['asc']);
				/*END STATION*/
				
				/*START CARD STATUS*/
				$data['cardStatus'] = jarvis_call_parameter('status_kartu');
				/*END CARD STATUS*/				
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
	public function all_data($subPage='',$dataID='',$params=''){
		$session_data = $this->session->userdata('logged_in');
		if($session_data and $session_data['on_screen']=='yes'){
			$sessionID=$session_data['id'];
			jarvis_check_activity($sessionID);
			$data['css']=jarvis_call_css_js($this->searchField['filename'],$this->table['css'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['js']=jarvis_call_css_js($this->searchField['filename'],$this->table['js'],$this->fieldOrder['order_hint'],$this->fieldOrderType['asc'],array('menu'=>'employee','active'=>'true'));
			$data['page_title']='Semua Data';
			$data['permission']='All-Data';
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
			
			if($subPage=='search'){
				if(strlen(jarvis_post('nilai_pencarian')) >= 3){
					$limit=' order by id desc';
				}else{
					$limit=' order by id desc limit 50';
				}
			}else{
				$limit=' order by id desc limit 50';
			}
			if($session_data['ref_group_user']=='J3'){
				$whereUID=" and uid='".$sessionID."'";
			}else{
				$whereUID="";
			}
				$whereHead="where id > 0".$whereUID;
				$whereSerOP=(jarvis_post('ser_op')!='' ? " and ser_op='".jarvis_post('ser_op')."'" : '');
				$whereStatus=(jarvis_post('status_data_id')!='' ? " and status_data_id='".jarvis_post('status_data_id')."'" : '');
				$whereDate=(jarvis_post('ser_tglakhir')!='' ? " and ser_tglakhir > ".jarvis_convert_field(jarvis_post('ser_tglakhir'),'jarvisDateV2') : '');
				$whereKey=(strlen(jarvis_post('nilai_pencarian')) >= 3 ? jarvis_post('nilai_pencarian')!='' ? " and ser_no like '%".jarvis_post('nilai_pencarian')."' or ser_no like '".jarvis_post('nilai_pencarian')."%' or ser_no like '%".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."' or p_name like '".jarvis_post('nilai_pencarian')."%' or p_name like '%".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."' or p_nip like '".jarvis_post('nilai_pencarian')."%' or p_nip like '%".jarvis_post('nilai_pencarian')."%'" : '' : '');
			
			/*START REGISTRATION DATA*/
			$data['dataReg']=jarvis_query_block("select * from ".$this->view['wm_vw_peg_sert']." ".$whereHead.$whereSerOP.$whereStatus.$whereDate.$whereKey.$limit);
			/*END REGISTRATION DATA*/
			
			jarvis_load_view('header',$data);
			jarvis_load_view('navigation',$data);
			jarvis_load_view('sidebar',$data);
			if(!$subPage or $subPage=='search'){
				jarvis_load_view('registration/all_data',$data);
			}else{
				/*START RANK DATA*/
				$data['dataRank']=jarvis_get_data($this->searchField['jjo_name'],$this->table['wm_jjoperasi'],$this->fieldOrder['jjo_code'],$this->fieldOrderType['asc']);
				/*END RANK DATA*/
				
				/*START POSITION*/	
				$params_position=array('jto_flag'=>0);
				$data['positionData']=jarvis_layout_setting($this->searchField['jto_name'],$this->table['wm_jto'],$this->fieldOrder['jto_id'],$this->fieldOrderType['asc'],$params_position);
				/*END POSITION*/
				
				/*START OPERATION AREA*/	
				$data['operationData']=jarvis_get_data($this->searchField['nama_wilop'],$this->table['mst_wilop'],$this->fieldOrder['kd_wilop'],$this->fieldOrderType['asc']);
				/*END OPERATION AREA*/

				/*START LOCATION*/	
				$data['locationData']=jarvis_get_data($this->searchField['loc_name'],$this->table['wm_lokasi'],$this->fieldOrder['loc_code'],$this->fieldOrderType['asc']);
				/*END LOCATION*/
				
				/*START STATION*/	
				$data['stationData']=jarvis_get_data($this->searchField['nama_unitstasiun'],$this->table['wm_unitstasiun'],$this->fieldOrder['kd_unitstasiun'],$this->fieldOrderType['asc']);
				/*END STATION*/
				
				/*START CARD STATUS*/
				$data['cardStatus'] = jarvis_call_parameter('status_kartu');
				/*END CARD STATUS*/				
			}
			jarvis_load_view('footer',$data);
		}elseif($session_data and $session_data['on_screen']=='no'){
			redirect('lock_screen');
		}else{
			redirect('login');
		}
	}
}

/* End of file registration.php */
/* Location: ./application/controllers/registration.php */
