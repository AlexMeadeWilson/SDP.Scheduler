$(document).ready(function()
{
    registerModalListeners();
});

function registerModalListeners()
{
    getFormEventCreate().on('submit', function(e) {
        e.preventDefault();
        var values = {};
        $(this).find('input, textarea, select').each(function(i, field){
            values[field.name] = field.value;
        });

        createEvent({
            status: values.eventstatus,
            title: values.eventtitle,
            start: values.eventstart,
            end: values.eventend,
            description: values.eventdescription,
            contact: values.eventcontact,
            site: values.eventsite,
            technician: values.eventtechnician,
        });
    });

    getFormEventEdit().on('submit', function(e) {
        e.preventDefault();
        var values = {};
        $(this).find('input, textarea, select').each(function(i, field){
            values[field.name] = field.value;
        });

        updateEvent({
            status: values.eventstatus,
            title: values.eventtitle,
            start: values.eventstart,
            end: values.eventend,
            description: values.eventdescription,
            contact: values.eventcontact,
            site: values.eventsite,
            technician: values.eventtechnician,
        });
    });
}

function createEventModal(event) {
    var id = event.id;
    var status = event.status;
    var title = event.title;
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var description = event.description;
    var contact = event.contact;
    var site = event.site;
    var technician = event.technician;

    getModalTitle().html("Create New Job");
    getEventId().val(id);
    getEventStatus().val(status);
    getEventTitle().val(title);
    getEventStart().val(start);
    getEventEnd().val(end);
    getEventDescription().val(description);
    getEventContact().val(contact);
    getEventSite().val(site);
    getEventTechnician().val(technician);
    getModalEventCreate().modal();
}

function updateEventModal(event) {
    var id = event.id;
    var status = event.status;
    var title = event.title;
    var start = event.start;
    var end = event.end;
    var description = event.description;
    var contact = event.contact;
    var site = event.site;
    var technician = event.technician;

    getModalTitle().html("Update Job Details");
    getEventId().val(id);
    getEventStatus().val(status);
    getEventTitle().val(title);
    getEventStart().val(start);
    getEventEnd().val(end);
    getEventDescription().val(description);
    getEventContact().val(contact);
    getEventSite().val(site);
    getEventTechnician().val(technician);
    getModalEventEdit().modal();
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
        }
    })
}

function updateEvent(event) {
    $.ajax({
        url: api_host + "/api/events/" + event.id,
        type: "POST",
        data: event,
        success: function()
        {
            getCalendar().fullCalendar('refetchEvents');
            getModalEventEdit().modal('hide');
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
                getModalEventEdit().modal('hide');
            }
        })
    }
}


