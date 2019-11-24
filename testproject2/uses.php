<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title> Проверка доменов</title>
    </head>
<?php
    require_once 'connect.php'; // вставляю файл с настройками подключения к базе
    
    $link = mysqli_connect($host, $dbuser, $dbpass, $dbname); //Подключаюсь  к базе
     

    $query =  "SELECT substring(email,LOCATE ('@',email),LENGTH (email)) as domain, count(substring(email,LOCATE('@',email),LENGTH  (email))) as counter  from email group by  domain order by counter DESC" ;
    // делаю запрос включающий валидность, группировку и сортировку
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); //обрабатываю запрос на php 
        if(mysqli_num_rows($result) > 0)
          {
          
            while($row = mysqli_fetch_assoc($result)) {  // в цикле перебираю результат обработки запроса
    
                echo  " " . $row["domain"]. " " .$row["counter"]. "<br>"; // вывожу на экран резульат
                
            }
        }
    mysqli_close($link); // закрываю дискотеку!
?>
