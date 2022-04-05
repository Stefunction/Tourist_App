<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $query = "select * from uploads, category";
    $query .= " WHERE uploads.categoryID = category.categoryID";


    $keyword = $_GET["keyword"];      //Get the keyword parameter from the GET request

    if (isset($keyword)) {             // If the keyword is set

        $query = $query . " and category.categoryName like '%" . $keyword . "%'";   //complete SQL query by appending

        $result = $connect->query($query);              //Carry out SQL query
        header("Content-type: application/json");       //set content-type to JSON
        http_response_code(200);                        //signal OK for retrieval

        foreach ($result as $img)       //iterate through the rows fetched from the result
        {
            $toReturn[] = $img;          //append this to a PHP array
        }
        echo json_encode($toReturn);      //return array as JSON-formatted string
    }
    $connect = null;    //Destroy PDO object by removing all references to it

} else {
    http_response_code(400);    //signal does not support other methods
}
