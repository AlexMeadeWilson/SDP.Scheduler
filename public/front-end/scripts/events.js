$(document).ready(function()
{
    registerModalListeners();
});

function registerModalListeners() {
    $('#formeventcreate').on('submit', function(e) {
        e.preventDefault();
        var values = {};
        $(this).find('input, textarea, select').each(function(i, field){
            values[field.name] = field.value;
        });

        createEvent({
            title: values.eventTitle,
            start: values.eventstart,
            end: values.eventend
        });
    });
}

function openEventModal(event) {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var title = event.title;

    $('#modaltitle').html("Event Details");
    $('#eventtitle').val(title);
    $('#eventstart').val(start);
    $('#eventend').val(end);
    $('#modaleventcreate').modal();
}

function createEvent(event) {
    $.ajax({
        url: api_host + '/api/events',
        type: "POST",
        data: event,
        success: function()
        {
            $('#calendar').fullCalendar('refetchEvents');
            $('#modaleventcreate').modal('hide');
        }
    })
}


