<?php
$base = file("emails.txt");
$result = array();
$pattern = "|^([a-z0-9_.-]{1,20})@([a-z0-9.-]{1,20}).([a-z]{2,4})|is";
$dad = "@([a-z0-9.-]{1,20}).([a-z]{2,4})|is";
        foreach( array_count_values(($base)) AS $row => $val) {
          if(preg_match($pattern, strtolower($row))) {
            if(preg_match($dad){
    
     echo '<br>'.$dad.' -- -->'.$val; 
            }
    }    
          } 
               //    else echo 'invalid', count($row);
        //}
      
?>