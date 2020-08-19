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
        <form class="form" id="countdownForm" action="/schedule" method="post">
            <label for="title">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name...">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" placeholder="Phone number...">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Your email address...">
            <label for="date-picker">Select a Date</label>
            <input type="date" id="date-picker" name="date">
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
<script src="script.js"></script>
</body>
</html>
