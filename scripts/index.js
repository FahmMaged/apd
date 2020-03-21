// For an introduction to the Blank template, see the following documentation:
// http://go.microsoft.com/fwlink/?LinkID=397704
// To debug code on page load in Ripple or on Android devices/emulators: launch your app, set breakpoints, 
// and then run "window.location.reload()" in the JavaScript Console.
var app = {
    // Application Constructor
    initialize: function () {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function () {
        document.addEventListener('deviceready', this.onDeviceReady, false);
        document.addEventListener("pause", this.onPause, false)
    },

    // deviceready Event Handler
    onDeviceReady: function () {
        FastClick.attach(document.body);
        window.ga.startTrackerWithId('UA-119590092-1', 30);
        //window.ga.debugMode();
        app.receivedEvent('deviceready');

        if (device.platform == "Android") {
            window.localStorage.setItem("platform", 2);
            window.ga.setAppVersion('Android v1.0');
            console.log('--ga Version set-- Android');
        } else {
            window.localStorage.setItem("platform", 1);
            window.ga.setAppVersion('iOS v1.0');
        }

        var push = PushNotification.init({
            android: {
                senderID: "588951842530",
                forceShow: "true",
                sound: "true",
                alert: "true",
                //icon: "logo",
                //iconColor: "#5c5c5d"
            },
            browser: {
                pushServiceURL: 'http://push.api.phonegap.com/v1/push'
            },
            ios: {
                senderID: "588951842530",
                gcmSandbox: "false",
                alert: "true",
                badge: "true",
                sound: "true"
            },
            windows: {}
        });

        push.on('registration', function (data) {
            console.log(data.registrationId);
            var deviceToken = data.registrationId;
               // alert(deviceToken);
            window.localStorage.setItem("deviceToken", deviceToken);
        });

        push.on('notification', function (data) {
            thisPlatform = window.localStorage.getItem("platform");
            window.ga.trackEvent('Push Notification', 'Clicked');
        });

        push.on('error', function (e) {
            console.log(e.message);
        });
    },
    onPause: function () {
        if (isStarted) {
            CreateMusicControls();
        }
    },
    // Update DOM on a Received Event
    receivedEvent: function (id) {
        //  var parentElement = document.getElementById(id);
        //  var listeningElement = parentElement.querySelector('.listening');
        // var receivedElement = parentElement.querySelector('.received');

        // listeningElement.setAttribute('style', 'display:none;');
        //receivedElement.setAttribute('style', 'display:block;');

        // alert('Received Event: ' + id);
    },
    onOffline: function () {
        //alert('You went Offline');
    }
};

app.initialize();

function CreateMusicControls () {
    MusicControls.create({
        track: currentSound.title,
        artist: currentSound.user.username,
        cover: currentSound.artwork_url,
        isPlaying: isTrackPlaying,
        dismissable: false,

        // hide previous/next/close buttons:
        hasPrev: sounds.length && currentSoundIndex > 0,
        hasNext: sounds.length && currentSoundIndex < sounds.length,
        hasClose: true,

        // iOS only, optional
        album: '',     // optional, default: ''
        duration: 0, // optional, default: 0
        elapsed: 0, // optional, default: 0
        hasSkipForward: sounds.length && currentSoundIndex > 0, //optional, default: false. true value overrides hasNext.
        hasSkipBackward: sounds.length && currentSoundIndex < sounds.length, //optional, default: false. true value overrides hasPrev.
        skipForwardInterval: 0, //optional. default: 0.
        skipBackwardInterval: 0, //optional. default: 0.
        hasScrubbing: false, //optional. default to false. Enable scrubbing from control center progress bar 

        // Android only, optional
        // text displayed in the status bar when the notification (and the ticker) are updated
        ticker: 'Now playing ' + currentSound.title,
        // All icons default to their built-in android equivalents
        // The supplied drawable name, e.g. 'media_play', is the name of a drawable found under android/res/drawable* folders
        playIcon: 'media_play',
        pauseIcon: 'media_pause',
        prevIcon: 'media_prev',
        nextIcon: 'media_next',
        closeIcon: 'media_close',
        notificationIcon: 'notification'
    }, function () {
        // Start listening for events
        // The plugin will run the events function each time an event is fired
        MusicControls.listen();
        // Register callback
        MusicControls.subscribe(events);

        isStarted = true;
    }, function () {
        console.log('Error creating MusicControls instance');
    });
}

function events(action) {
    const message = JSON.parse(action).message;

    switch (message) {
        case 'music-controls-next':
            widget.next();
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;
        case 'music-controls-previous':
            widget.prev();
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;
        case 'music-controls-pause':
            widget.pause();
            isTrackPlaying = false;
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;
        case 'music-controls-play':
            widget.play();
            isTrackPlaying = true;
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;
        case 'music-controls-destroy':
            MusicControls.destroy(function () {
                isTrackPlaying = isStarted = false;
                widget.pause();
            }, function () {
                console.log('Error stopping music');
            });
            break;

        // External controls (iOS only)
        case 'music-controls-toggle-play-pause':
            // Do something
            break;
        case 'music-controls-seek-to':
            const seekToInSeconds = JSON.parse(action).position;
            MusicControls.updateElapsed({
                elapsed: seekToInSeconds,
                isPlaying: true
            });
            // Do something
            break;
        case 'music-controls-skip-forward':
            widget.next();
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;
        case 'music-controls-skip-backward':
            widget.prev();
            MusicControls.updateIsPlaying(isTrackPlaying);
            break;

        // Headset events (Android only)
        // All media button events are listed below
        case 'music-controls-media-button':
            // Do something
            break;
        case 'music-controls-headset-unplugged':
            // Do something
            break;
        case 'music-controls-headset-plugged':
            // Do something
            break;
        default:
            break;
    }
}
