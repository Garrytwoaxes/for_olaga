<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title> Проверка доменов</title>
    </head>
<?php
    require_once 'connect.php';
    
    $link = mysqli_connect($host, $dbuser, $dbpass, $dbname);
     

    $query =  "SELECT substring(email,LOCATE ('@',email),LENGTH (email)) as domain, count(substring(email,LOCATE('@',email),LENGTH  (email))) as counter  from email group by  domain order by counter DESC" ;
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if(mysqli_num_rows($result) > 0)
          {
          
            while($row = mysqli_fetch_assoc($result)) {  
    
                echo  " " . $row["domain"]. " " .$row["counter"]. "<br>"; 
                
            }
        }
    mysqli_close($link);
?>