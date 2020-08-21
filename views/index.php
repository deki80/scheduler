<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule A Meeting</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="/views/media/css/style.css">
</head>
<body>

<!-- Container -->
<div class="container">
    <!-- Input -->
    <div class="input-container" id="input-container">
        <h1>Schedule A Meeting</h1>
        <form class="form" id="scheduleForm" action="/schedule" method="post">
            <label for="title">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name..." min="2" required>
            <label for="phone">Phone <small>Format: 064-111-1234</small></label>
            <input type="tel" id="phone" name="phone" placeholder="Phone number..." pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email address..." required>
            <label for="date-picker">Select a Date</label>
            <input type="date" id="date-picker" name="date" required>
            <label for="time-picker">Select Time <small>Format: hh:mm PM</small></label>
            <input type="time" id="time-picker" name="time" required>
            <input type="hidden" name="honeypot">
            <input type="hidden" name="start" id="event-start">
            <input type="hidden" name="end" id="event-end">
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Complete -->
    <div class="complete" id="complete" hidden>
        <h1 class="complete-title">Countdown Complete!</h1>
        <h1 id="complete-info"></h1>
        <button id="complete-button">NEW COUNTDOWN</button>
    </div>
</div>
<!-- Script -->
<script src="/views/media/js/script.js"></script>
</body>
</html>
