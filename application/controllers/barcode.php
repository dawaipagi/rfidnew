<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barcode extends CI_Controller { 
	function __construct(){
		parent::__construct();
	}
	function draw($code){
		$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';	
		$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
		$this->zend->load('Zend/Barcode');
		$barcodeOPT = array(
			'text' => $code, 
			'barHeight'=> $height, 
			'factor'=>$width,
		);			
		$renderOPT = array();
		$render = Zend_Barcode::factory('code128', 'image', $barcodeOPT, $renderOPT)->render();
	}
}
