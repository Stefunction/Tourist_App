<?php
    require_once "dbconfig.php";   #getting server details to connect

    #To try create a connection
    try{

       $dataSN = "mysql:dbhost=$dbHost; dbname=$dbName;";
       $connect = new PDO($dataSN, $dbUser, $dbPassword);
       $connect -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
       echo "success";  #connects to DB
    }catch (PDOException $exception) 
    {

    echo "<div class='error'>".$exception->getMessage()."</div>";

    }
?>