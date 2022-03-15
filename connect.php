<?php
    require_once "dbconfig.php";   #getting server details to connect

    #To try create a connection
    try{

       $dataSN = "mysql:host=$dbHost; dbname=$dbName;";
       $connect = new PDO($dataSN, $dbUser, $dbPassword);
       $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
       
    } catch (PDOException $exception) 
    
    {
    echo "<div class='error'>".$exception->getMessage()."</div>";
    }
?>