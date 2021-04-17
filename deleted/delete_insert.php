<?php
// insert.php
$app->post('/api/insert/', function ($request, $response, $args)
{
    require_once('../../private/connect.php');

    if(isset($_POST["title"]))
    {
        $query = "INSERT INTO events (title, start_event, end_event) VALUES (:title, :start_event, :end_event)";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':title'  => $_POST['title'],
                ':start_event' => $_POST['start'],
                ':end_event' => $_POST['end']
            )
        );
    }
    return $response;
});
?>