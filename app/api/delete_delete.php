<?php
// delete.php
//$app->post('/api/delete', function ($request, $response, $args)
//{    
    if(isset($_POST["id"]))
    {
        require_once('../../private/connect.php');
        $query = "DELETE from events WHERE id=:id";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id' => $_POST['id']
            )
        );
    }    
    //return $response;
//});
?>