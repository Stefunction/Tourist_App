<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $query = "select * from uploads, category";
    $query .= " WHERE uploads.categoryID = category.categoryID";


    $keyword = $_GET["keyword"];      //look for keyword parameter in GET request
    if (isset($keyword)) {
        $query = $query . " and category.categoryName like '%" . $keyword . "%'"; //append filter to SQL query

        $result = $connect->query($query);    //execute SQL query
        header("Content-type: application/json");  //set content-type to JSON
        http_response_code(200);        //OK for retrieval

        foreach ($result as $img)       //iterate through rows in result
        {
            $toReturn[] = $img;       //append to PHP array
        }
        echo json_encode($toReturn);      //return array as JSON-formatted string
    }
    $connect = null;    //Destroy PDO object by removing all references to it
    //This will close the connection to MySQL.
} else {
    http_response_code(400);    //does not support other methods
} //end else
