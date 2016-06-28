<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

function jarvis_echo($key,$value){
	$ci =& get_instance();
	return $ci->jarvisclassm->jarvis_echo($key,$value);
}
function jarvis_call_configuration($key){
	$ci =& get_instance();
	return $ci->jarvisclassm->jarvis_call_configuration($ci->jarvisclassc,$ci->jarvis,$key);
}
function add_css($css){
	if (is_array($css)) {
		$loadCss = '';
		foreach($css['data'] as $item){ 
			if($item['api']=='false'){$base_url=base_url();}else{$base_url='';}
			$loadCss .= '<!-- '.$item['desc'].' -->';
			$loadCss .= '<link href="'.$base_url.$item['filename'].'" rel="stylesheet" type="text/css" />';
		}
		return $loadCss; 
	}
}
function add_js($js){
	if (is_array($js)) {
		$loadJs ='';
		foreach($js['data'] as $item){ 
			if($item['api']=='false'){$base_url=base_url();}else{$base_url='';}
			$loadJs .= '<!-- '.$item['desc'].' -->';
			$loadJs .= '<script src="'.$base_url.$item['filename'].'"></script>';
		} 
		return $loadJs;
	}
}
function add_sidebar($sidebar) {
	$ci =& get_instance();
	if (is_array($sidebar)) {
		$loadSidebar='';
		foreach($sidebar as $item){ 
			if($item['pid']==0){
				if($item['action_url']=='') { 
					$active=array(strtolower($item['menu'])=>' active'); 
				}else{
					$active=array($item['action_url']=>' active');
				}
				$loadSidebar .= '<li class="'.$item['cls'].(empty($active[$ci->uri->segment(1)]) ? '' : $active[$ci->uri->segment(1)]).'">';
				if($item['action_url']=='') {
					$url = ''; 
				} else { 
					$url = base_url().$item['action_url']; 
				}
					$loadSidebar .= '<a href="'.$url.'">';
						$loadSidebar .= '<i class="fa '.$item['icon'].'"></i>'; 
						$loadSidebar .= '<span>'.$item['label'].'</span>';
						if($item['leaf']==false) { 
							$loadSidebar .= '<i class="fa fa-angle-left pull-right"></i>'; 
						}
					$loadSidebar .= '</a>';
					
					if($item['leaf']==false) {
						$loadSidebar .= '<ul class="'.$item['child-cls'].'">';
							foreach($sidebar as $child){ 
								if($item['id']==$child['pid']){
									$linkExplode=explode('/',$child['action_url']);
									if($ci->uri->segment(2)==$linkExplode[1]){ 
										$active = 'active'; 
									}else{
										$active = ''; 
									}
									$loadSidebar .= '<li class="'.$active.'"><a href="'.base_url().$child['action_url'].'"><i class="fa '.$child['icon'].'"></i> '.$child['label'].'</a></li>';					
								}
							} 
						$loadSidebar .= '</ul>';
					}
				$loadSidebar .= '</li>';
			}
		}
		return $loadSidebar;
	}
}
function uri_segment($segment){
	$ci =& get_instance();
	return $ci->uri->segment($segment);
}
function jarvis_encode($value){
	$ci =& get_instance();
	//return $ci->jarvisclassencrypt->encode($value);
	return $ci->urlcrypt->encode($value);
}
function jarvis_decode($value){
	$ci =& get_instance();
	//return $ci->jarvisclassencrypt->decode($value);
	return $ci->urlcrypt->decode($value);
}
function get_data_user($value){
	$ci =& get_instance();
	$session_data = $ci->session->userdata('logged_in');
	$sessionID=$session_data['id'];
	$params_user=array('id'=>$sessionID);
	$data=$ci->jarvisclassm->json_get_data($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,'username','jarvis_vw_user','id','asc','',$params_user);
	return jarvis_echo($data,$value);
}
function delete_avatar($avatar){
    $files = glob(jarvis_call_configuration('savedAvatar').$avatar);
    foreach($files as $file){
      if(is_file($file))
        unlink($file);
    }   
}
function calculationTimes($time=''){
	return $time == 1 ? '' : 's ago';
}
function calculationTime($time=''){
	switch ($time) {
		// SECOND
		case ($time < 0):
		$result = "Just Now";
		break;
		// SECOND
		case ($time < 60):
		$result = $time." second";
		break;
		// MINUTE
		case ($time < 3600):
		$x=round($time/60);
		$result = $x." minute".calculationTimes($x);
		break;
		// HOURS
		case ($time < 86400):
		$x=round($time/3600);
		$result = $x." hour".calculationTimes($x);
		break;
		// DAYS
		case ($time < 604800):
		$x=round($time/86400);
		$result = $x." day".calculationTimes($x);
		break;
		// WEEK
		case ($time < 2592000):
		$x=round($time/604800);
		$result = $x." week".calculationTimes($x);
		break;
		// MONTH
		case ($time < 31104000):
		$x=round($time/2592000);
		$result = $x." month".calculationTimes($x);
		break;
		// YEAR
		default:
		$x=round($time/31104000);
		$result = $x." year".calculationTimes($x);
		break;
	}
	return $result;
}
function jarvis_call_css_js($searchField,$table,$fieldOrder,$fieldOrderType,$where){
	$ci =& get_instance();
	return $ci->jarvisclassm->json_get_data($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,$searchField,$table,$fieldOrder,$fieldOrderType,'',$where);
}
function jarvis_check_activity($sessionID){
	$ci =& get_instance();
	return $ci->jarvisclassm->jarvis_check_activity($ci->jarvisclassc,$ci->jarvis,$sessionID);
}
function jarvis_sidebar($table,$fieldOrder,$fieldOrderType,$param){
	$ci =& get_instance();
	return $ci->jarvisclassm->json_get_tree_node($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,$table,$fieldOrder,$fieldOrderType,$param);
}
function jarvis_layout_setting($searchField,$view,$fieldOrder,$fieldOrderType,$param){
	$ci =& get_instance();
	return $ci->jarvisclassm->json_get_data($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,$searchField,$view,$fieldOrder,$fieldOrderType,'',$param);
}
function jarvis_load_view($view,$data=''){
	$ci =& get_instance();
	return $ci->load->view($view,$data);
}
function jarvis_call_parameter($key){
	$ci =& get_instance();
	return $ci->jarvisclassm->json_get_data($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,'parameter','jarvis_parameter','id','asc','',array('category_parameter'=>$key,'status'=>'true'));
}
function jarvis_convert_field($value,$type){
	$ci =& get_instance();
	return $ci->jarvisclassc->cvrt_fld($value,$type);
}
function jarvis_process_block($key_params,$tbl,$data,$ref_user,$colname='',$pk='',$not_use_audit=''){
	$ci =& get_instance();
	return $ci->jarvisclassc->jarvis_json_proses_blok($key_params,$ci->jarvis,$tbl,$data,$ref_user,$colname,$pk,$not_use_audit);
}
function jarvis_get_data($search_field,$vw,$order_field,$order_type,$get_limit='',$params_where='',$argsBlock=''){
	$ci =& get_instance();
	return $ci->jarvisclassm->json_get_data($ci->jarvisclassc,$ci->jarvisclassvariable,$ci->jarvis,$search_field,$vw,$order_field,$order_type,$get_limit,$params_where,$argsBlock);
}
function jarvis_query_block($query){
	$ci =& get_instance();
	return $ci->jarvisclassc->query_bloks($ci->jarvis,$query);
}
function jarvis_permission($type,$menu,$params=''){
	$result=array();
	if($type=='add'){
		$getPerm=jarvis_get_data('menu','jarvis_vw_menu_matrix_perm','id','asc','',array('action_label_id'=>'36','menu'=>$menu,'group_user_id'=>get_data_user('ref_group_user')));
		foreach($getPerm['data'] as $permission){
			$result[]='<button type="button" class="btn btn-success btn-sm" onclick=location.href="'.base_url().$permission['url'].'">'.$permission['label'].'</button>';
		}
	}elseif($type=='action'){
		$getPerm=jarvis_query_block("select * from jarvis_vw_menu_matrix_perm where action_label_id not in('36','43') and menu='".$menu."' and group_user_id='".get_data_user('ref_group_user')."'");
		foreach($getPerm->result_array() as $permission){
			if($permission['confirm_box']=='false'){
				$linkAct='<li><a href="'.base_url().str_replace('{PARAMS}',$params['id'],$permission['url']).'">'.$permission['label'].'</a></li>';
			}else{
				if($permission['action_label_id']=='40'){
					$label=($params['banned'] == 'false' ? $permission['label'] : 'Unban');
				}else{
					$label=$permission['label'];
				}
				$linkAct='<li><a style="cursor:pointer" onclick=deleteData("'.base_url().str_replace('{PARAMS}',$params['id'],$permission['url']).'")>'.$label.'</a></li>';
			}
			$result[]=$linkAct;
		}
	}elseif($type=='detailReg'){
		$getPerm=jarvis_get_data('menu','jarvis_vw_menu_matrix_perm','id','asc','',array('action_label_id'=>'57','menu'=>$menu,'group_user_id'=>get_data_user('ref_group_user')));
		foreach($getPerm['data'] as $permission){
			$result[]='<a href="'.base_url().str_replace('{PARAMS}',$params['id'],$permission['url']).'" alt="Detail">'.$params['p_name'].'</a>';
		}
	}elseif($type=='banned'){
		$getPerm=jarvis_get_data('menu','jarvis_vw_menu_matrix_perm','id','asc','',array('action_label_id'=>'40','menu'=>$menu,'group_user_id'=>get_data_user('ref_group_user')));
		foreach($getPerm['data'] as $permission){
			$label=($params['banned'] == 'false' ? $permission['label'] : 'Unban');
			$result[]='<a style="cursor:pointer" onclick=deleteData("'.base_url().str_replace('{PARAMS}',$params['id'],$permission['url']).'")>'.$label.'</a>';
		}
	}/*elseif($type=='deleteAll'){
		$getPerm=jarvis_get_data('menu','jarvis_vw_menu_matrix_perm','id','asc','',array('action_label_id'=>'62','menu'=>$menu,'group_user_id'=>get_data_user('ref_group_user')));
		foreach($getPerm['data'] as $permission){
			$result[]='<button type="button" class="btn btn-success btn-sm" onclick=location.href="'.base_url().$permission['url'].'">'.$permission['label'].'</button>';
		}
	}*/	
	return implode($result);
}
function delete_prof_pic($pp){
    $files = glob(jarvis_call_configuration('savedPhoto').$pp);
    foreach($files as $file){
      if(is_file($file))
        unlink($file);
    }   
}
function jarvis_post($field){
	$ci =& get_instance();
	return $ci->input->post($field);
}
function jarvis_permission_v2($menu,$params=''){
	$result=array();
	$getPerm=jarvis_query_block("select * from jarvis_vw_menu_matrix_perm where action_label_id not in('36','40','43','57') and menu='".$menu."' and group_user_id='".get_data_user('ref_group_user')."'");
	foreach($getPerm->result_array() as $permission){
		if($permission['confirm_box']=='false'){
			if($permission['action_label_id']=='65'){
				$linkAct='<button type="submit" class="btn btn-primary btn-sm" onclick=revisiDataForm("'.base_url().str_replace('{PARAMS}','',$permission['url']).'")>'.$permission['label'].'</button>';
			}else{
				$linkAct='<button type="submit" class="btn btn-primary btn-sm" onclick=updateDataForm("'.base_url().str_replace('{PARAMS}','',$permission['url']).'")>'.$permission['label'].'</button>';
			}
		}else{
			$linkAct='<button type="submit" class="btn btn-danger btn-sm" onclick=deleteDataForm("'.base_url().$permission['url'].'","'.$params['tabel'].'","'.$params['pk'].'","'.$params['redirect'].'")>'.$permission['label'].'</button>';
		}
		$result[]=$linkAct;
	}
	return implode(' ',$result);
}
function jarvis_unix_date($value){
	//return gmdate("Y-m-d H:i:s", ($value - 25569) * 86400);
	return gmdate("Y-m-d", ($value - 25569) * 86400);
}
function jarvis_back_button($keySegs){
	$ci =& get_instance();
	$segs =$ci->uri->segment_array();
	$x=0;
	$segsArr=array();
	foreach ($segs as $segment){
		$x++;
		if($keySegs>=$x){
			$segsArr[]=$segment;
		}
	}	
	return "<button type='button' class='btn btn-success btn-sm' onclick=location.href='".base_url().implode('/',$segsArr)."'>".jarvis_call_configuration('back_button')."</button>";
}
function jarvis_get_nums_data($params_where,$table){
	$ci =& get_instance();
	return $ci->jarvisclassm->getNumsDataIDM($ci->jarvisclassc,$ci->jarvis,$params_where,$table);
}
function add_dashboard($sidebar) {
	$ci =& get_instance();
	if (is_array($sidebar)) {
		$loadSidebar='';
		foreach($sidebar as $item){ 
			if($item['pid']==0){
				if($item['leaf']==false) {
					foreach($sidebar as $child){ 
						if($item['id']==$child['pid']){
							$loadSidebar .= '<div class="col-lg-3 col-xs-6">';
								$loadSidebar .= '<div class="small-box bg-'.jarvis_decode_json(jarvis_decode($child['dashboard']),'bg').'">';
									$loadSidebar .= '<div class="inner"><h4>'.$child['label'].'</h4></div>';
									$loadSidebar .= '<div class="icon"><i style="font-size:50px;" class="ion ion-ios7-'.jarvis_decode_json(jarvis_decode($child['dashboard']),'icon').'-outline"></i></div>';
									$loadSidebar .= '<a class="small-box-footer" href="'.base_url().$child['action_url'].'"><i class="fa fa-arrow-circle-right"></i></a>';					
								$loadSidebar .= '</div>';
							$loadSidebar .= '</div>';
						}
					} 
				}
			}
		}
		return $loadSidebar;
	}
}
function jarvis_decode_json($json,$key){
	$x=json_decode($json,true);
	return $x[$key];
}
function delete_pdf_file($pdf){
    $files = glob(jarvis_call_configuration('savedPdf').$pdf);
    foreach($files as $file){
      if(is_file($file))
        unlink($file);
    }   
}
