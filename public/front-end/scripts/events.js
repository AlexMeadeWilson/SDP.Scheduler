$(document).ready(function()
{
    registerModalListeners();
});

function registerModalListeners() {
    getFormEventCreate().on('submit', function(e) {
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

    getModalTitle().html("Event Details");
    getEventTitle().val(title);
    getEventStart().val(start);
    getEventEnd().val(end);
    getModalEventCreate().modal();
}

function createEvent(event) {
    $.ajax({
        url: api_host + '/api/events',
        type: "POST",
        data: event,
        success: function()
        {
            getCalendar().fullCalendar('refetchEvents');
            getModalEventCreate().modal('hide');
            // TODO: Add a confirmation modal call here.
        }
    })
}


