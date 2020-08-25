<?php
function PageMain() {
	global $TMPL;
	
	$resultSettings = mysql_fetch_row(mysql_query(getSettings($querySettings)));
	
	$time = time()+86400;
	$exp_time = time()-86400;
	
	$TMPL['loginForm'] = '
	<form action="/index.php?a=admin" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br /><br />
	<input type="submit" value="Log In" name="login"/>
	</form>
	<div class="addurlSmall">Note: The password is case-sensitive.</div>';
	
	if(isset($_POST['login'])) {
		header("Location: /index.php?a=admin");
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		setcookie("adminUser", $username, $time);
		setcookie("adminPass", $password, $time);
				
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['adminUser']), mysql_real_escape_string($_COOKIE['adminPass']));
	} elseif(isset($_COOKIE['adminUser']) && isset($_COOKIE['adminPass'])) { 
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['adminUser']), mysql_real_escape_string($_COOKIE['adminPass']));
	
		if(mysql_fetch_row(mysql_query($query))) {
			$TMPL['success'] = '<div class="neutral">Welcome <strong>'.$_COOKIE['adminUser'].'</strong>, <a href="/index.php?a=admin&logout=1">Log Out</a> - <a href="'.$resultSettings[1].'">Home</a></div>';
			$TMPL['loginForm'] = '';
			
			$TMPL_old = $TMPL; $TMPL = array();
			$skin = new skin('admin/ads'); $ads = '';
			$query = 'SELECT ad1,ad2,ad3 from settings';
			$result = mysql_query($query);
			if(isset($_POST['ads1']) || isset($_POST['ads2']) || isset($_POST['ads3'])) {
				$query = 'UPDATE `settings` SET ad1 = \''.$_POST['ads1'].'\', ad2 = \''.$_POST['ads2'].'\', ad3 = \''.$_POST['ads3'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			while($TMPL = mysql_fetch_assoc($result)) {	
				$ads .= $skin->make();
			}
			
			$skin = new skin('admin/title'); $title = '';
				
			$TMPL['currentTitle'] = $resultSettings[0];
			
			if(isset($_POST['title'])) {
				$query = 'UPDATE `settings` SET title = \''.$_POST['title'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$siteTitle .= $skin->make();
			
			$skin = new skin('admin/appid'); $appId = '';
			
			$TMPL['CurrentAppId'] = $resultSettings[2];
			
			if(isset($_POST['appid'])) {
				$query = 'UPDATE `settings` SET app = \''.$_POST['appid'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$appId .= $skin->make();
			
			$skin = new skin('admin/url'); $url = '';
				
			$TMPL['currentUrl'] = $resultSettings[1];
			
			if(isset($_POST['url'])) {
				$query = 'UPDATE `settings` SET url = \''.$_POST['url'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$url .= $skin->make();
						
			$skin = new skin('admin/password'); $password = '';
			if(isset($_POST['pwd'])) {
				$pwd = md5($_POST['pwd']);
				$query = 'UPDATE `admin` SET password = \''.$pwd.'\' WHERE username = \''.$_COOKIE['adminUser'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$password .= $skin->make();
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['ads'] = $ads;
			$TMPL['url'] = $url;
			$TMPL['password'] = $password;
			$TMPL['siteTitle'] = $siteTitle;
			$TMPL['appId'] = $appId;
			
			if(isset($_GET['logout']) == 1) {
				setcookie('adminUser', '', $exp_time);
				setcookie('adminPass', '', $exp_time);
				header("Location: /index.php?a=admin");
				}
			} else { 
			$TMPL['error'] = '<div class="error">Invalid username or password. Remember that the password is case-sensitive.</div>';
			unset($_COOKIE['adminUser']);
			unset($_COOKIE['adminPass']);
		}			
	}
	
	$TMPL['title'] = 'Admin - '.$resultSettings[0].'';

	$skin = new skin('admin/content');
	return $skin->make();
}
?>