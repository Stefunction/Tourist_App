<?php

require "connect.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
            Compose SQL query and execute it.

            If there is an error in the query, the result is a false.

            If the query is successful, result will be a PDOStatement object.
        */

$query = "select * from uploads";        //compose SQL query as a string

$keyword = $_GET["keyword"];      //look for keyword parameter in GET request
if (isset($keyword))
    $query = $query . " where dvd.title like '%" . $keyword . "%'"; //append filter to SQL query

$result = $connect->query($query);    //execute SQL query
header("Content-type: application/json");  //set content-type to JSON
http_response_code(200);        //OK for retrieval

foreach ($result as $img)       //iterate through rows in result
{
    $toReturn[] = $img;       //append to PHP array
}
echo json_encode($toReturn);      //return array as JSON-formatted string

$pdo = null;    //Destroy PDO object by removing all references to it
    //This will close the connection to MySQL.
// } else {
//     http_response_code(400);    //does not support other methods
// } //end else
