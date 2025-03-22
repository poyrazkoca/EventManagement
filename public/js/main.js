document.addEventListener('DOMContentLoaded', function () {
    fetch('backend/read_events.php')
        .then(response => response.json())
        .then(events => {
            let eventList = document.getElementById('eventList');
            events.forEach(event => {
                let li = document.createElement('li');
                li.textContent = `${event.title} - ${event.event_date}`;
                eventList.appendChild(li);
            });
        });
});