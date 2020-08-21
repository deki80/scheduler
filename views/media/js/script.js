/* Get form elements */

const formElement = document.getElementById('scheduleForm');
const dateElement = document.getElementById('date-picker');
const timeElement = document.getElementById('time-picker');

/* Set min value for Date Time */
const todayArr = new Date().toISOString().split('T');
const today = todayArr[0];
const time = todayArr[1];
dateElement.setAttribute('min', today);
timeElement.setAttribute('min', time);


function formSubmited(e) {
    e.preventDefault();
}

/* Event listener */
formElement.addEventListener('submit', formSubmited);