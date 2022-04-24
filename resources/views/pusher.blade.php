<!DOCTYPE html>


<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var notifications = $('#test');
        var pusher = new Pusher('663f89cd63002cf5ec77', {
            encrypted: true
        });
        var channel = pusher.subscribe('status-liked');
        channel.bind('App\\Events\\StatusLiked', function(data) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `
		  <li class="notification active">
			  <div class="media">
				<div class="media-left">
				  <div class="media-object">
					<img src="https://api.adorable.io/avatars/71/` + avatar + `.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
				  </div>
				</div>
				<div class="media-body">
				  <strong class="notification-title">` + data.message + `</strong>
				  <!--p class="notification-desc">Extra description can go here</p-->
				  <div class="notification-meta">
					<small class="timestamp">about a minute ago</small>
				  </div>
				</div>
			  </div>
		  </li>
		`;
            notifications.html(newNotificationHtml + existingNotifications);


        });
    </script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
    <p id="test"></p>
</body>
