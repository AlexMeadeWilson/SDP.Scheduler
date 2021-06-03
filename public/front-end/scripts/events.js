$(document).ready(function()
{
    // Register the listeners on the DOM
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
        
        // Check if the Job is tagged with 'delete' (lika a captcha)
        if(values.eventdelete.toLowerCase() == 'delete')
        {
            // Delete the Job
            console.log("Action: deleteEvent");
            deleteEvent({
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
            if(values.eventid)
            {
                // If there is an ID - Update the Job
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
                // If there is no ID - Create the Job
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
        }
    });
}

// Function to call the Create Event Modal and populate it.
function createEventModal(event)
{
    // Format the values of the Start and End Date Times.    
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

    // Populate the Modal values.
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

// Function to Create an Event via the API
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

// Function to Update an Event via the API
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

// Function to Delete an Event via the API
function deleteEvent(event) {
    console.log("Calling: /api/events/"+event.id+" DELETE");
    $.ajax({
        url: api_host + "/api/events/" + event.id,
        type:"DELETE",
        success:function()
        {
            console.log("Action: refetchEvents");
            getCalendar().fullCalendar('refetchEvents');
            console.log("Action: modal hide");
            getModalEventCreate().modal('hide');
        }
    })
}



