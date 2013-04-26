<?php
 function cutstr($start,$end,$str){
    $s = strpos($str,$start);
	$e = strpos($str,$end);
	return substr($str,$s+strlen($start),$e-$s-strlen($start));
 }
 function gethref($html){
  preg_match_all("/\/><a[\s\S]*?href=\"([^\"]+)[^>]+>([\s\S]*?)<\/a>/",$html,$match);
  return $match[1];
}
 function gettitle($href){
    $html = file_get_contents($href);
	preg_match("/<h1[\s\S]*?class=\"Terminal-title\"[\s\S]*?>([\s\S]*?)<\/h1>/",$html,$m);
	return $m[1];
 }	
 function getcontent($href){
    $content = array();
	$html = file_get_contents($href);
	preg_match("/<h1[\s\S]*?class=\"Terminal-title\"[\s\S]*?>([\s\S]*?)<\/h1>/",$html,$m);
	$content['title'] = $m[1];
	$m = explode("公司名称：",$html);
	$m = explode("公司性质",$m[1]);
	preg_match("/<a[\s\S]*?href=\"([^\"]+)[^>]+>([\s\S]*?)<\/a>/",$m[0],$match);
	$content['company'] = $match[2];
	$m = explode("公司地址：",$html);
	$m = explode("<",$m[1]);
	$content['address'] = $m[0];
	preg_match("/<dl[\s\S]*?id=\"comp-contact\"[\s\S]*?>([\s\S]*?)<\/dl>/",$html,$match);
	preg_match_all("/<div[\s\S]*?>([\s\S]*?)<\/div>/",$match[1],$match);
	$match = $match[1];
	$content['contact'] = '';
	foreach($match as $k=>$v){
	  $content['contact'] .= trim($v).'<br />';
	}
	preg_match("/<div[\s\S]*?class=\"company-introduction\"[\s\S]*?>([\s\S]*?)<\/div>/",$html,$match);
	$ret = array();
	$desc = cutstr('<!-- SWSStringCutStart -->','<!-- SWSStringCutEnd -->',$html);
	//echo htmlspecialchars($desc);
	//die();
	$ret['title']   = trim($content['title']);
	$ret['company'] = trim($content['company']);
    $ret['description'] = strip_tags(htmltocode(trim($desc)));
    $url     = explode("公司主页：",$content['contact']);	
	$url     = end($url);
	$url     = explode('<',$url);
	$ret['url']     = $url[0];
	$ret['poster_email']   = '1502175890@qq.com';
	return $ret;
  }
  function htmltocode($content){
	$content = str_replace(array("&nbsp;","<br />","<br>"),array(" ","\n","\n"), strtolower($content));
	return $content;
  }
if(isset($_POST['update'])){
  $sql = 'UPDATE `jobs` SET `created_on` = date_add(`created_on`,interval 1 day) where 1';
  $db->query($sql);
  $updataret = '影响了'.$db->affected_rows.'个职位';
  $smarty->assign('updataret',$updataret);
}
else if(isset($_POST['catch'])){
  $url  = isset($_POST['url'])?$_POST['url']:'';
  $res  = getcontent(trim($url));
  if(!session_id()){
    session_start();
  }
  $_SESSION['jobs'] = $res;
  echo "<script>window.location.href=\"edit-post/\"</script>";
  exit();
}
else if(isset($_POST['catchzhaopin'])){
  $cityarray = array(
  '83'=>'538',//上海
  '73'=>'653',//杭州
  '84'=>'宁波',//宁波
  );
  $kw  = isset($_POST['kw'])?$_POST['kw']:'';
  $_SESSION['city_id'] = isset($_POST['city_id'])?$_POST['city_id']:'';
  $_SESSION['category_id'] = isset($_POST['category_id'])?$_POST['category_id']:'';
  $jl = isset($cityarray[$_SESSION['city_id']])?$cityarray[$_SESSION['city_id']]:'';
  $url = "http://sou.zhaopin.com/jobs/searchresult.ashx?jl=$jl&kw=$kw&sm=0&p=1"; 
  $html = file_get_contents($url);
  $res = gethref($html);
  $_SESSION['catchzhaopin'] = $res;
  echo "<script>window.location.href=\"jobsetting?action=catch\"</script>";
  exit();
}
else if(isset($_POST['savecatchzhaopin'])){
  $_SESSION['idarr'] = $_POST['id'];
  echo "<script>window.location.href=\"jobsetting?action=savecatchzhaopin\"</script>";
  exit();
}
else if(isset($_POST['randdate'])){
  if(isset($_POST['date'])&&trim($_POST['date'])!='0'){
    $date = isset($_POST['date'])?$_POST['date']:''; 
  }
  else{
    $date = $_POST['setdate'];
  }
  //echo $date;
  $sql = "SELECT `id` FROM `jobs` WHERE DATE_FORMAT(`created_on`,'%Y-%m-%d') = '$date'";
  $count = 0;
  foreach($db->QueryArray($sql) as $k=>$v){
    $created_on = date("Y-m-d H:i:s",strtotime($date)+rand(0,3600*24));
    $sqlup = "UPDATE `jobs` SET `created_on` = '$created_on' WHERE `id`='$v[id]'";
	//echo $sqlup;
	//echo '<br />';
	$db->query($sqlup);
	++$count;
  }
  $randdateret = '影响' . $count . '个职位';
  $smarty->assign('randdateret',$randdateret);
  //exit();
}
else if(isset($_GET['action'])){
  $action = $_GET['action'];
  if($action == 'catch'){
    //print_r($_SESSION['catchzhaopin']);
	$p = isset($_GET['p'])?$_GET['p']:0;
	if(isset($_SESSION['catchzhaopin'][$p])){
	  $_SESSION['catchzhaopintitle'][$p] = gettitle($_SESSION['catchzhaopin'][$p]);
	  ++$p; 
	  echo "<script>window.location.href=\"jobsetting?action=catch&p=$p\"</script>";
	  exit(0);
	}
	else{
	  echo "<script>window.location.href=\"jobsetting\"</script>";
	  exit(0);
	}
  }
  else if($action == 'savecatchzhaopin'){
    $p = isset($_GET['p'])?$_GET['p']:0;
	if(isset($_SESSION['idarr'][$p])){
	  $url = $_SESSION['catchzhaopin'][$_SESSION['idarr'][$p]];
	  echo 'saving ' . $url; 
	  if(trim($_SESSION['catchzhaopintitle'][$_SESSION['idarr'][$p]])!=''){ //排除空职位
		  $res = getcontent($url);
		  //print_r($res);
		  $data = array('company' => $res['company'],
						'url' => $res['url'],
						'title' => $res['title'],
						'city_id' => $_SESSION['city_id'],
						'category_id' => $_SESSION['category_id'],
						'type_id' => '1',
						'description' => $res['description'],
						'location_outside_ro_where' => '' ,
						'apply' => '1',
						'poster_email' => $res['poster_email'],
						'apply_online' => 1
						);
		  $data['is_temp'] = 0;
		  $data['is_active'] = 1;
		  $data['spotlight'] = 0;	
		  $job = new Job();
		  //print_r($data);
		  if(!checkjob($data['title'],$data['description'])){
		    $job->Create($data);
		  }
	  }
	  ++$p;
	  echo "<script>window.location.href=\"jobsetting?action=savecatchzhaopin&p=$p\"</script>";
	  exit(0);
	}
	else{
	  echo '结束!!!';
	  echo "<script>window.location.href=\"jobsetting\"</script>";
	  exit(0);
	}
  }
}

$template = 'page_jobsetting.tpl';