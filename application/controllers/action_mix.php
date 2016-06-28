<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_mix extends CI_Controller { 
	function __construct(){
		parent::__construct();
	}
	function delete_all(){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		if($session_data and $session_data['on_screen']=='yes'){
			$tabel=$this->input->post('tabelDef');
			$pk=$this->input->post('pk');
			$checkedStr=$this->input->post('checkedVal');
			$cStr=explode(',',$checkedStr);
			foreach($cStr as $str){
				jarvis_process_block('DELETE',$tabel,'',$sessionID,$pk,jarvis_decode($str));
			}
			echo json_encode(array("success"=>"true","message"=>"Delete data success"));
		}else{
			echo json_encode(array("success"=>"false","message"=>"You have not access this command"));
		}
	}
	function delete_register(){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		if($session_data and $session_data['on_screen']=='yes'){
			$id=array();
			$checkedStr=$this->input->post('checkedVal');
			$cStr=explode(',',$checkedStr);
			foreach($cStr as $str){ $id[]=jarvis_decode($str); }
			$idImp=implode(',',$id);
			$getEmp=jarvis_query_block("select * from wm_vw_peg_sert where id in(".$idImp.")");
			foreach($getEmp->result_array() as $emp){			
				$empCount=jarvis_get_nums_data(array('pid'=>$emp['pid']),'wm_peg_sert');
				if($empCount=='1'){
					delete_prof_pic($emp['p_image']);	
					$delEmp=jarvis_process_block('DELETE','wm_pegawai','',$sessionID,'p_id',$emp['pid']);
				}
				$delCert=jarvis_process_block('DELETE','wm_peg_sert','',$sessionID,'id',$emp['Id']);
			}
			echo json_encode(array("success"=>"true","message"=>"Delete data success"));
		}else{
			echo json_encode(array("success"=>"false","message"=>"You have not access this command"));
		}
	}
	function revisi_register(){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		if($session_data and $session_data['on_screen']=='yes'){
			$id=array();
			$checkedStr=$this->input->post('checkedVal');
			$cStr=explode(',',$checkedStr);
			foreach($cStr as $str){ $id[]=jarvis_decode($str); }
			$idImp=implode(',',$id);
			$idData=jarvis_encode(time());
			$getEmp=jarvis_query_block("select * from wm_vw_peg_sert where id in(".$idImp.")");
			foreach($getEmp->result_array() as $emp){	
				$empID[]=$emp['pid'];
			}
			$idArr = array(
				'id'=>$idData,
				'data'=>implode(',',$empID)
			);
			$insertFileData=jarvis_process_block('INSERT','jarvis_del_temp',$idArr,$sessionID);
			echo json_encode(array("success"=>"true","message"=>"Insert data success","url"=>base_url()."registration/enter/revisi/".$idData));
		}else{
			echo json_encode(array("success"=>"false","message"=>"You have not access this command"));
		}
	}
	function proses_excel_data(){
		$session_data = $this->session->userdata('logged_in');
		$sessionID=$session_data['id'];
		if($session_data and $session_data['on_screen']=='yes'){
			$id=array();
			$dataExcel=array();
			$dataEmp=array();
			$dataXls=array();
			$checkedStr=$this->input->post('checkedVal');
			$cStr=explode(',',$checkedStr);
			foreach($cStr as $str){ $id[]=jarvis_decode($str); }
			$idImp=implode(',',$id);
			$idData=jarvis_encode(time());
			$getExcel=jarvis_query_block("select * from wm_excel_data where id in(".$idImp.")");
			foreach($getExcel->result_array() as $excel){	
				$dataExcel[]=array(
					'p_name'=>$excel['nama'],
					'p_plzbirth'=>$excel['tp_lahir'],
					'p_birthdate'=>$excel['tg_lahir'],
					'pd_jabto'=>$excel['tingkat'],
					'p_nip'=>$excel['nip'],
					'status_data_id'=>'58',
					'kode_excel'=>$excel['id']
				);
			}
			$insertWMPeg=jarvis_process_block('INSERT_BATCH','wm_pegawai',$dataExcel,$sessionID);
			$getEmp=jarvis_query_block("select * from wm_pegawai where kode_excel in(".$idImp.")");
			foreach($getEmp->result_array() as $emp){	
				$dataEmp[$emp['kode_excel']]=$emp['p_id'];
			}
			$getXls=jarvis_query_block("select * from wm_excel_data where id in(".$idImp.")");
			foreach($getXls->result_array() as $xls){	
				$serOP=explode('.',$xls['ser_no']);
				$dataXls[]=array(
					'ser_op'=>$serOP[0],
					'ser_wo'=>$xls['wilop'],
					'ser_lok'=>$xls['lokasi'],
					'ser_unit'=>$xls['unit'],
					'ser_jenis'=>'5',
					'ser_jangkut'=>'4',
					'ser_jgerak'=>'3',
					'ser_jarlay'=>'4',
					'ser_jalur'=>'5',
					'ser_no'=>$xls['ser_no'],
					'ser_tglberlaku'=>$xls['tg_berlaku'],
					'ser_tglakhir'=>$xls['tg_berakhir'],
					'pid'=>$dataEmp[$xls['id']]
				);
			}
			$insertWMPegSert=jarvis_process_block('INSERT_BATCH','wm_peg_sert',$dataXls,$sessionID);
			$deleteExcelData=jarvis_query_block("delete from wm_excel_data where id in(".$idImp.")");
			echo json_encode(array("success"=>"true","message"=>"Insert data success","url"=>base_url()."registration/excel"));
		}else{
			echo json_encode(array("success"=>"false","message"=>"You have not access this command"));
		}
	}
	function cek_data(){
		$getEmp=jarvis_query_block("select * from wm_pegawai where kode_excel in(1,2)");
		foreach($getEmp->result_array() as $emp){	
			$dataExcel[$emp['kode_excel']]=$emp['p_id'];
		}
		echo json_encode($dataExcel);
		echo $dataExcel[1];
		$getXls=jarvis_query_block("select * from wm_excel_data where id in(1,2)");
		foreach($getXls->result_array() as $xls){	
			$serOP=explode('.',$xls['ser_no']);
			$dataXls[]=array(
				'ser_op'=>$serOP[0],
				'ser_wo'=>$xls['wilop'],
				'ser_lok'=>$xls['lokasi'],
				'ser_unit'=>$xls['unit'],
				'ser_jenis'=>'5',
				'ser_jangkut'=>'4',
				'ser_jgerak'=>'3',
				'ser_jarlay'=>'4',
				'ser_jalur'=>'5',
				'ser_no'=>$xls['ser_no'],
				'ser_tglberlaku'=>$xls['tg_berlaku'],
				'ser_tglakhir'=>$xls['tg_berakhir'],
				'pid'=>$dataExcel[$xls['id']]
			);
		}
		echo "<br>";
		echo json_encode($dataXls);
	}
}
