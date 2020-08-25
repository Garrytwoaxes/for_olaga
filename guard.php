<?php 
   session_start();
         $dbname = "gu";
         $dbuser ="root";
         $dbpasswd = "bujhm27";
         $dbcnt = mysql_connect($dblocation, $dbuser, $dbpasswd);

             if(!$dbcnt)
		{ echo 'No available connect to DataBase';
                 } 
             
             if (!mysql_select_db($dbname, $dbcnt)) {
                 echo 'not available DataBase';
                 } 
		 if ( isset($_POST['login']))
		 {
		   $login=$_POST['login'];
		
		    if ($login == '')
		        {
			 unset($login);
			}
			}
		 if (empty($login) )
		    {
			 exit (" Empty login ");
			}
			
		    mysql_select_db('gu', $dbcnt);
    $result = mysql_query("SELECT * FROM users WHERE login='$login'" , $dbcnt);      
     while($myrow = mysql_fetch_array($result)){
   
      
    if ($myrow['login']==$login) {
 
    $_SESSION['login']=$myrow['login']; 
    $_SESSION['id']=$myrow['id'];
    echo"  <a href='index.php'> Вернуться на главную </a>";
    }
	else {
	exit("Неверный логин") ;}
    
	}

  
		   
		 
               
                 
