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