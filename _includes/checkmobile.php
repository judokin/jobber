<?php



class checkmobile  {


	/**
	 *
	 */
	function __construct() {
//        if(!session_id()){
//        	session_start();
//        }
		//TODO - Insert your code here
	}
	public function check() {
	    global $_G;
	    $mobile = array();
	    static $mobilebrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
	                'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
	                'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
	                'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
	                'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
	                'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
	                'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
	    
	    if(isset($_SERVER['HTTP_USER_AGENT'])){
	      $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	      if(($v = $this->dstrpos($useragent, $mobilebrowser_list, true))) {
	        $_G['mobile'] = $v;
	        return true;
	      }
		    $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
		    if($this->dstrpos($useragent, $brower)) return false;
		 
		    $_G['mobile'] = 'unknown';
		}
	    else{
		    if($_GET['mobile'] === 'yes') {
		        return true;
		    } else {
		        return false;
		    }
	    }
	}
	public function dstrpos($string, &$arr, $returnvalue = false) {
	    if(empty($string)) return false;
	    foreach((array)$arr as $v) {
	        if(strpos($string, $v) !== false) {
	            $return = $returnvalue ? $v : true;
	            return $return;
	        }
	    }
	    return false;
	}
}


?>