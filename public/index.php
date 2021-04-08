<?php
// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;
// use Slim\Factory\AppFactory;

//require __DIR__ . '/../vendor/autoload.php';

//$app = AppFactory::create();

// require_once('../app/api/load.php');
// require_once('../app/api/insert.php');
// require_once('../app/api/update.php');
// require_once('../app/api/delete.php');

/* GET: Hello World! */
// $app->get('/', function (Request $request, Response $response, $args)
// {
//     $response->getBody()->write("This is index.php");
//     return $response;
// });

/* GET: Hello/{Name} */
// $app->get('/hello/{name}', function ($request, $response, $args)
// {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });

//$app->run();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SlimBiz (Working Title)</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 
        <script>
            $(document).ready(function()
            {
                var calendar = $('#calendar').fullCalendar({
                    editable:true,
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    events: '../app/api/load.php',
                    selectable:true,
                    selectHelper:true,
                    select: function(start, end, allDay)
                    {
                        var title = prompt("Enter Event Title");
                        if(title)
                        {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url:"../app/api/insert.php",
                                type:"POST",
                                data:{title:title, start:start, end:end},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Added Successfully");
                                }
                            })
                        }
                    },
                    editable:true,
                    eventResize:function(event)
                    {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url:"../app/api/update.php",
                            type:"POST",
                            data:{title:title, start:start, end:end, id:id},
                            success:function(){
                                calendar.fullCalendar('refetchEvents');
                                alert('Event Update');
                            }
                        })
                    },
                    eventDrop:function(event)
                    {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url:"../app/api/update.php",
                            type:"POST",
                            data:{title:title, start:start, end:end, id:id},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Updated");
                            }
                        });
                    },
                    eventClick:function(event)
                    {
                        if(confirm("Are you sure you want to remove it?"))
                        {
                            var id = event.id;
                            $.ajax({
                                url:"../app/api/delete.php",
                                type:"POST",
                                data:{id:id},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Event Removed");
                                }
                            })
                        }
                    },
                });
            });
        </script>
    </head>
    <body>
        <br />
        <h2 align="center"><a href="#">SlimBiz (Working Title)</a></h2>
        <br />
        <div class="container">
            <div id="calendar"></div>
        </div>
    </body>
</html>