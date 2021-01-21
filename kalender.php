<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Festlplaner</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <link href="css/mobiscroll.javascript.min.css" rel="stylesheet" />
    <script src="js/mobiscroll.javascript.min.js"></script>

</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <div class="logo">
                        <a href="index.php">Festlplaner</a>
                    </div>
                </header>



                <!--ab hier Code einfügen-->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">

                                            <div id="demo-add-delete-event"></div>

                                            <div id="demo-add-popup">
                                                <div class="mbsc-form-group">
                                                    <label>
                                                        Title
                                                        <input mbsc-input id="event-title">
                                                    </label>
                                                    <label>
                                                        Description
                                                        <textarea mbsc-textarea id="event-desc"></textarea>
                                                    </label>
                                                </div>
                                                <div class="mbsc-form-group">
                                                    <label for="event-all-day">
                                                        All-day
                                                        <input mbsc-switch id="event-all-day" type="checkbox" />
                                                    </label>
                                                    <label for="start-input">
                                                        Starts
                                                        <input mbsc-input id="start-input" />
                                                    </label>
                                                    <label for="end-input">
                                                        Ends
                                                        <input mbsc-input id="end-input" />
                                                    </label>
                                                    <div id="event-date"></div>
                                                    <label>
                                                        Show as busy
                                                        <input id="event-status-busy" mbsc-segmented type="radio" name="event-status" value="busy">
                                                    </label>
                                                    <label>
                                                        Show as free
                                                        <input id="event-status-free" mbsc-segmented type="radio" name="event-status" value="free">
                                                    </label>
                                                    <div class="mbsc-button-group">
                                                        <button class="mbsc-button-block" id="event-delete" mbsc-button data-color="danger" data-variant="outline">Delete event</button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--bis hier Code einfügen-->
            </div>
        </div>

        <?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>

    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeDe,
            theme: 'ios',
            themeVariant: 'light',
            dragToCreate: true,
            dragToMove: true,
            dragToResize: true

        });

        var calendar,
            popup,
            range,
            oldEvent,
            showArrow,
            tempID = 5,
            tempEvent = {},
            deleteEvent,
            restoreEvent,
            titleInput = document.getElementById('event-title'),
            descriptionTextarea = document.getElementById('event-desc'),
            allDaySwitch = document.getElementById('event-all-day'),
            freeSegmented = document.getElementById('event-status-free'),
            busySegmented = document.getElementById('event-status-busy'),
            deleteButton = document.getElementById('event-delete'),
            now = new Date(),
            myData = [{
                    id: 1,
                    start: new Date(now.getFullYear(), now.getMonth(), 8, 13),
                    end: new Date(now.getFullYear(), now.getMonth(), 8, 13, 30),
                    title: 'Schularbeit',
                    color: '#26c57d'
                },

            ];

        function createAddPopup(elm) {
            // hide delete button inside add popup
            deleteButton.style.display = 'none';

            deleteEvent = true;
            restoreEvent = false;

            // set popup header text and buttons for adding
            popup.setOptions({
                headerText: 'New event',
                buttons: [
                    'cancel',
                    {
                        text: 'Add',
                        keyCode: 'enter',
                        handler: function() {
                            calendar.updateEvent(tempEvent);
                            deleteEvent = false;
                            popup.close();
                        },
                        cssClass: 'mbsc-popup-button-primary'
                    }
                ]
            });

            // fill popup with a new event data
            mobiscroll.getInst(titleInput).value = tempEvent.title;
            mobiscroll.getInst(descriptionTextarea).value = '';
            mobiscroll.getInst(allDaySwitch).checked = false;
            range.setVal([tempEvent.start, tempEvent.end]);
            mobiscroll.getInst(busySegmented).checked = true;

            // set anchor for the popup
            popup.setOptions({
                anchor: elm,
                showArrow: true
            });

            popup.open();
            // show popup arrow
            showArrow = true;
        }

        function createEditPopup(args) {
            var ev = args.event;
            // show delete button inside edit popup
            deleteButton.style.display = 'block';

            deleteEvent = false;
            restoreEvent = true;

            // set popup header text and buttons for editing
            popup.setOptions({
                headerText: 'Edit event',
                buttons: [
                    'cancel',
                    {
                        text: 'Save',
                        keyCode: 'enter',
                        handler: function() {
                            var date = range.getVal();
                            // update event with the new properties on save button click
                            calendar.updateEvent({
                                id: ev.id,
                                title: titleInput.value,
                                description: descriptionTextarea.value,
                                allDay: mobiscroll.getInst(allDaySwitch).checked,
                                start: date[0],
                                end: date[1],
                                free: mobiscroll.getInst(freeSegmented).checked,
                                color: ev.color,
                            });
                            restoreEvent = false;
                            popup.close();
                        },
                        cssClass: 'mbsc-popup-button-primary'
                    }
                ]
            });

            // fill popup with the selected event data
            mobiscroll.getInst(titleInput).value = ev.title || '';
            mobiscroll.getInst(descriptionTextarea).value = ev.description || '';
            mobiscroll.getInst(allDaySwitch).checked = ev.allDay || false;;
            range.setVal([ev.start, ev.end]);

            if (ev.free) {
                mobiscroll.getInst(freeSegmented).checked = true;
            } else {
                mobiscroll.getInst(busySegmented).checked = true;
            }

            // change range settings based on the allDay
            calendar.setOptions({
                controls: ev.allDay ? ['calendar'] : ['calendar', 'time']
            });

            // set anchor for the popup
            popup.setOptions({
                anchor: args.domEvent.currentTarget,
                showArrow: true
            });
            popup.open();
            // we want to show the popup's arrow at this point
            showArrow = true;
        }

        function positionPopup() {
            // show or hide popup arrow
            if (showArrow) {
                showArrow = false;
            } else {
                popup.setOptions({
                    showArrow: false
                });
            }
        }

        calendar = mobiscroll.eventcalendar('#demo-add-delete-event', {
            view: {
                calendar: {
                    labels: true
                }
            },
            data: myData,
            dragToCreate: true,
            dragToMove: true,
            dragToResize: true,
            onEventClick: function(args) {
                oldEvent = {
                    ...args.event
                };
                tempEvent = args.event;

                if (!popup.isVisible()) {
                    createEditPopup(args);
                }
            },
            onEventCreated: function(args) {
                popup.close();
                // store temporary event
                tempEvent = args.event;
                createAddPopup(args.target);
            },
            onEventDeleted: function() {
                mobiscroll.toast({
                    message: 'Event deleted'
                });
            }
        });

        popup = mobiscroll.popup('#demo-add-popup', {
            width: 400,
            // showOverlay: false,
            display: 'bottom',
            fullScreen: true,
            contentPadding: false,
            cssClass: 'crud-popup',
            onClose: function() {
                if (deleteEvent) {
                    calendar.removeEvent(tempEvent);
                } else if (restoreEvent) {
                    calendar.updateEvent(oldEvent);
                }
            },
            responsive: {
                medium: {
                    display: 'anchored',
                    width: 400,
                    fullScreen: false,
                    touchUi: false
                }
            }
        });

        titleInput.addEventListener('input', function(ev) {
            // update current event's title
            tempEvent.title = ev.target.value;
            // update current event in calendar
            calendar.updateEvent(tempEvent);
        });

        descriptionTextarea.addEventListener('change', function(ev) {
            // update current event's title
            tempEvent.description = ev.target.value;
        });

        allDaySwitch.addEventListener('change', function() {
            var checked = this.checked
            // change range settings based on the allDay
            range.setOptions({
                controls: checked ? ['calendar'] : ['calendar', 'time']
            });

            // update current event's allDay property
            tempEvent.allDay = checked;

            // update current event in calendar
            calendar.updateEvent(tempEvent);

            showArrow = false;

            positionPopup();
        });

        range = mobiscroll.datepicker('#event-date', {
            controls: ['calendar', 'time'],
            select: 'range',
            startInput: '#start-input',
            endInput: '#end-input',
            showRangeLabels: false,
            display: 'bubble',
            touchUi: false,
            dateWheels: '|DDD MMM D|',
            mode: 'datetime',
            onChange: function(args) {
                var date = args.value;
                // update event's start date
                tempEvent.start = date[0];
                tempEvent.end = date[1];

                // update current event in calendar
                calendar.updateEvent(tempEvent);

                // navigate the calendar to the correct view
                calendar.navigate(date[0]);

                showArrow = false;

                positionPopup();
            }
        });

        document.querySelectorAll('input[name=event-status]').forEach(function(elm) {
            elm.addEventListener('change', function() {
                // update current event's free property
                tempEvent.free = mobiscroll.getInst(freeSegmented).checked;
            });
        });

        deleteButton.addEventListener('click', function() {
            // delete current event on button click
            calendar.removeEvent(oldEvent);
            popup.close();

            mobiscroll.toast({
                message: 'Event deleted'
            });
        });
    </script>
</body>

</html>
