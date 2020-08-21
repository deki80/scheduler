/* Get form elements */
const formElement = document.getElementById('scheduleForm');
const dateElement = document.getElementById('date-picker');
const timeElement = document.getElementById('time-picker');

/* Set min value for Date Time */
const today = new Date().toISOString().split('T')[0];
dateElement.setAttribute('min', today);


function formSubmited(e) {
    e.preventDefault();
    const dateEntered = dateElement.value;
    const timeEntered = timeElement.value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    const start = document.getElementById('event-start');
    const end = document.getElementById('event-end');

    /* prepare iso start event datetime */
    const eventStart = new Date(dateEntered + ' ' + timeEntered).toISOString();

    /* hardcoded event last - 2 hours from start time */
    const getDate = new Date(dateEntered + ' ' + timeEntered);
    const eventEnd = new Date(getDate.setHours(getDate.getHours() + 2)).toISOString();

    /* set input fields values */
    document.getElementById('event-start').value = eventStart;
    document.getElementById('event-end').value = eventEnd;

    formElement.submit();

}

/* Event listener */
formElement.addEventListener('submit', formSubmited);