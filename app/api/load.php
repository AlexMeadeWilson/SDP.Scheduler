<?php
// load.php
///$app->get('/api/load', function ($request, $response, $args)
//{
    require_once('../../private/connect.php');
    $data = array();
    $query = "SELECT * FROM events ORDER BY id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach($result as $row)
    {
        $data[] = array(
            'id' => $row["id"],
            'title' => $row["title"],
            'start' => $row["start_event"],
            'end' => $row["end_event"]
        );
    }
    echo json_encode($data);
    //$response->getBody()->write("<p>This is load.php");
    //return $response;
//});
?>