let container_calendar = document.querySelector(".container_calendar");
let toggleBtn = document.querySelector('.toggle-btn');

dycalendar.draw({
    target: '#dycalendar',
    dayformat: 'full',
    type: 'month',
    monthformat: 'full',
    highlighttoday: true,
    prevnextbutton: 'show'
});

toggleBtn.onclick = () => {
    container_calendar.classList.toggle('dark');
    document.body.classList.toggle('background-dark');
};
