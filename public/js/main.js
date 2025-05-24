document.addEventListener('DOMContentLoaded', () => {
    fetch('backend/read_events.php')
        .then(res => res.json())
        .then(events => {
            const list = document.getElementById('eventList');
            list.innerHTML = '';
            events.forEach(event => {
                const li = document.createElement('li');
                li.textContent = `${event.title} - ${event.event_date} @ ${event.location}`;
                list.appendChild(li);
            });
        });
});

const toggleThemeButton = document.querySelector("#toggle-theme");
if (toggleThemeButton) {
    toggleThemeButton.addEventListener("click", () => {
        document.body.classList.toggle("dark");
    });
}

fetch('backend/read_events.php')
    .then(response => response.json())
    .then(events => {
        events.forEach(event => {
            const eventElement = document.createElement('div');
            eventElement.innerHTML = `
                <h3>${event.title}</h3>
                <p>Date: ${event.event_date}</p>
                <p>Location: ${event.location}</p>
                <p>Remaining Spots: ${event.capacity}</p>
            `;
            document.getElementById('eventsContainer').appendChild(eventElement);
        });
    });
