<?php
/**
 * jobber job board platform - admin panel
 *
 * @author     Lavinia Creivean <links_clm@yahoo.com>
 * @author     Filip C.T.E. <http://www.filipcte.ro> <me@filipcte.ro>
 * @license    You are free to edit and use this work, but it would be nice if you always referenced the original authors ;)
 *             (see license.txt).
 */

	if(!file_exists('config.php')) 
	{
	   die('[index.php] config.php not found');
	}
	
	require_once 'config.php';
	
	$translator = new Translator(LANG_CODE);
	$translations = $translator->getTranslations();
	
	$smarty->assign('translations', $translations);
	
	$flag = 0;
	$js = array();
	if(!isset($_SERVER['HTTP_REFERER'])) {
	   $_SERVER['HTTP_REFERER'] = '';
	}
	
	$job = new Job();
	
	switch($page)
	{
		// home		
		case '':
			#show login page only if the admin is not logged in
			#else show homepage
			if(!isset($_SESSION['AdminId']))
			{
				require_once 'page_login.php';			
			}
			else
			{				
				require_once 'page_home.php';
			}
			$flag = 1;
			break;

		case 'logout':
			$flag = 1;
			if (isset($_SESSION['AdminId']))
			{			
				unset($_SESSION['AdminId']);
				redirect_to(BASE_URL);
				exit;
			}
			break;
			
		case 'home':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_home.php';
			$flag = 1;
			break;

		case 'activate':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_activate.php';
			$flag = 1;
			break;

		case 'deactivate':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_deactivate.php';
			$flag = 1;
			break;

		case 'delete':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_delete.php';
			$flag = 1;
			break;

		case URL_JOB:
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}			
			require_once 'page_job.php';
			$flag = 1;
			break;

		case URL_JOBS:
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_category.php';
			$flag = 1;
			break;

		case 'page-unavailable':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			$html_title = 'Page unavailable / ' . SITE_NAME;
			$template = 'error.tpl';
			$flag = 1;
			break;

		case 'stats':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_stats.php';
			$flag = 1;
			break;

		case 'pages':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_pages.php';
			$flag = 1;
			break;
		case 'categories':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_categories.php';
			$flag = 1;
			break;
		case 'types':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_types.php';
			$flag = 1;
			break;
		case 'password':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_password.php';
			$html_title = 'Change password / ' . SITE_NAME;
			$template = 'password.tpl';
			$flag = 1;
			break;
		case 'links':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_links.php';
			$flag = 1;
			break;
		case 'settings':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_settings.php';
			$flag = 1;
			break;
		case 'edit-post':
			if(!isset($_SESSION['AdminId']))
			{
				redirect_to(BASE_URL);
				exit;
			}
			require_once 'page_edit_post.php';
			$flag = 1;
			break;
		case 'activate-spotlight':
            if(!isset($_SESSION['AdminId']))
            {
                redirect_to(BASE_URL);
                exit;
            }
            require_once 'page_activate_spotlight.php';
            $flag = 1;
            break;
   		case 'deactivate-spotlight':
            if(!isset($_SESSION['AdminId']))
            {
                redirect_to(BASE_URL);
                exit;
            }
            require_once 'page_deactivate_spotlight.php';
            $flag = 1;
            break;
   		case 'cities':
	  		if(!isset($_SESSION['AdminId']))
            {
                redirect_to(BASE_URL);
                exit;
            }
            
   			require_once 'page_cities.php';
   			$flag = 1;
   			$citiesPage = new CitiesPage();
   			$template = $citiesPage->processRequest($id, $extra, $smarty);
   			break;
		case 'checkjob':
		    if(!isset($_SESSION['AdminId']))
            {
                redirect_to(BASE_URL);
                exit;
            }
			$title = isset($_GET['title'])?trim($_GET['title']):'';
		    $desc = isset($_GET['desc'])?trim($_GET['desc']):'';
			$sql  = "SELECT `id` FROM `jobs` WHERE `title` = '$title' AND `description`='$desc'";
			$row  = $db->QueryRow($sql);
			if(isset($row['id'])){
			  echo '1';
			}
			else{
			  echo '0';
			}
			$flag = 1;
            break;		
		case 'jobhits':
		if(!isset($_SESSION['AdminId']))
		{
			redirect_to(BASE_URL);
			exit;
		}
	    $ip = $_SERVER['REMOTE_ADDR'];
	    // update hits table
		$sql = 'INSERT INTO '.DB_PREFIX.'hits (job_id, created_on, ip)
							VALUES (' . $id . ', NOW(), "' . $ip . '")';
		$db->query($sql);
		// update jobs table
		$sql = 'UPDATE '.DB_PREFIX.'jobs SET views_count = views_count + 1
									 WHERE id = ' . $id;
		$db->query($sql);
		echo "<script>self.history.back();</script>";
		break;
		case 'jobapp':
		if(!isset($_SESSION['AdminId']))
		{
			redirect_to(BASE_URL);
			exit;
		}
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $jp = new JobApplication($id);
		$jp->Apply($ip);
		echo "<script>self.history.back();</script>";
		break;
		case 'jobsetting':
		if(!isset($_SESSION['AdminId']))
		{
			redirect_to(BASE_URL);
			exit;
		}
		$flag = 1;
		require_once 'page_jobsetting.php';
		break;
		default: 
			$flag = 0;	
			break;
	}
	// if page not found
	if ($flag == 0)
	{
		redirect_to(BASE_URL . 'page-unavailable/');
	}
	
	// create a JSON string from the translations array, but only for the "js" section
	$smarty->assign('translationsJson', iniSectionsToJSON(array("js" => $translations['js'])));
	
	// get job categories and cities
	$smarty->assign('categories', get_categories());
	$smarty->assign('settings_categories', $jobber_settings->GetSettingsCategories());

	//Add the dynamic URL defitions to SMARTY
	$smarty->assign('URL_JOB', URL_JOB);
	$smarty->assign('URL_JOBS', URL_JOBS);
	$smarty->assign('URL_CITIES', URL_CITIES);
	$smarty->assign('URL_COMPANIES', URL_COMPANIES);
	$smarty->assign('URL_JOBS_IN_CITY', URL_JOBS_IN_CITY);
	$smarty->assign('URL_JOBS_AT_COMPANY', URL_JOBS_AT_COMPANY);
	
	$smarty->assign('THEME', $settings['theme']);
	$smarty->assign('CURRENT_PAGE', $page);
	$smarty->assign('CURRENT_ID', $id);
	$smarty->assign('CURRENT_DIRECTORY', CURRENT_DIRECTORY);
	$smarty->assign('BASE_URL', BASE_URL_ORIG);
	$smarty->assign('BASE_URL_ADMIN', BASE_URL);
	$smarty->assign('HTTP_REFERER', $_SERVER['HTTP_REFERER']);
	if(isset($_SESSION['AdminId']))
		$smarty->assign('isAuthenticated', 1);
	else
		$smarty->assign('isAuthenticated', 0);
	$smarty->assign('js', $js);
	if (isset($template) && $template != '')
		$smarty->display($template);
?>