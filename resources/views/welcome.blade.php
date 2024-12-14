<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
     @vite('resources/css/app.css')
     @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='{{ asset('js/index.global.min.js') }}'></script>
    <script src="{{ asset('js/core/locales-all.global.js') }}"></script>
    <script src="{{ asset('js/core/locales/ko.global.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/moment@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script> -->
    <style>
        .fc-toolbar-title {
            font-size: 2.5rem !important;
            font-weight: 900 !important;
        }
        .fc-day-sun {
            color: #9c0000 !important;
            font-weight: 900 !important;
        }
        .fc-day-sat {
            color: #0000b9 !important;
            font-weight: 900 !important;
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 md:container md:mx-auto">
        <livewire:header />
        <div id='calendar'></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'local',
                locale: 'ko',
                navLinks: true, // can click day/week names to navigate views
                dayMaxEvents: true, // allow "more" link when too many events
                editable: true,
                selectable: true,
                // businessHours: true,
                // dayMaxEvents: true, // allow "more" link when too many events
                expandRows: true,
                slotMinTime: '03:00',
                slotMaxTime: '22:00',
                stickyHeaderDates : true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                titleFormat: { // will produce something like "Tuesday, September 18, 2018"
                    year: 'numeric',
                    month: 'numeric',
                    // day: 'numeric',
                    // weekday: 'long'
                },
                weekends: true,
            })
            calendar.render()
        })
    </script>
</body>
</html>
