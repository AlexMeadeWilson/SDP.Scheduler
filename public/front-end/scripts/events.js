$(document).ready(function()
{
    registerModalListeners();
});

function registerModalListeners()
{
    // Listener for the Create Event Form - CREATE Event
    getFormEventCreate().on('submit', function(e) {
        // This prevents the form from submitting to allow conditions be applied.
        e.preventDefault();
        var values = {};
        $(this).find('input, textarea, select').each(function(i, field){
            values[field.name] = field.value;
        });

        if(values.eventid)
        {
            console.log("Action: updateEvent");
            updateEvent({
                id: values.eventid,
                status: values.eventstatus,
                title: values.eventtitle,
                start: values.eventstart,
                end: values.eventend,
                description: values.eventdescription,
                contact: values.eventcontact,
                site: values.eventsite,
                technician: values.eventtechnician,
            });
        }
        else
        {
            console.log("Action: createEvent");
            createEvent({
                // No Id for New Jobs - Auto-incremented
                status: values.eventstatus,
                title: values.eventtitle,
                start: values.eventstart,
                end: values.eventend,
                description: values.eventdescription,
                contact: values.eventcontact,
                site: values.eventsite,
                technician: values.eventtechnician,
            });
        }
        
    });
}

function createEventModal(event) {
    
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

    getModalTitle().html("Job Details");
    getEventId().val(event.id);
    getEventStatus().val(event.status);
    getEventTitle().val(event.title);
    getEventStart().val(start);
    getEventEnd().val(end);
    getEventDescription().val(event.description);
    getEventContact().val(event.contact);
    getEventSite().val(event.site);
    getEventTechnician().val(event.technician);
    console.log("Action: getModalEventCreate().modal()");
    getModalEventCreate().modal();
}

function createEvent(event) {
    console.log("Calling: /api/events POST");
    $.ajax({
        url: api_host + '/api/events',
        type: "POST",
        data: event,
        success: function()
        {
            console.log("Action: refetchEvents");
            getCalendar().fullCalendar('refetchEvents');
            console.log("Action: modal hide");
            getModalEventCreate().modal('hide');
        }
    })
}

function updateEvent(event) {
    console.log("Calling: /api/events/"+event.id+" POST");
    $.ajax({
        url: api_host + '/api/events/' + event.id,
        type: "POST",
        data: event,
        success: function()
        {
            console.log("Action: refetchEvents");
            getCalendar().fullCalendar('refetchEvents');
            console.log("Action: modal hide");
            getModalEventCreate().modal('hide');
        }
    })
}

function deleteEvent(event) {
    if(confirm("Are you sure you want to delete this?"))
    {
        $.ajax({
            url: api_host + "/api/events/" + event.id,
            type:"DELETE",
            success:function()
            {
                getCalendar().fullCalendar('refetchEvents');
                getModalEventCreate().modal('hide');
            }
        })
    }
}


