<div>
    <style>
        #calendar-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #19647E;
        }

        #calendar {
            background-color: #19647E;
            margin: 10px auto;
            padding: 10px 10px 60px 10px;
            max-width: 1100px;
            height: 700px;
            border: none;
        }

        .fc-theme-standard .fc-scrollgrid {
            border: none !important;
        }

        .fc-theme-standard td:last-child,
        .fc-theme-standard th:last-child {
            border-right: none !important;
        }

        .fc-col-header-cell {
            background-color: #44A33D;
            height: 50px;
            border: 1px solid black !important;
        }

        .fc-col-header-cell:first-child {
            border-radius: 10px 0 0 0;
        }

        .fc-col-header-cell:last-child {
            border-radius: 0 10px 0 0;
        }

        .fc-daygrid-day {
            background-color: snow;
        }

        .fc-theme-standard td th {
            border: none;
        }
    </style>


    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales/fr.js'></script>
    <script>
        document.addEventListener('livewire:load', function() {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                locale: 'fr',
                headerToolbar: {
                    start: 'prev',
                    center: 'title',
                    end: 'next'
                },
                events: JSON.parse('@json($articles)'),
                eventClick: function(info) {
                    window.location.href = "{{ route('articles.show', ['article' => ':id']) }}".replace(':id', info.event.id);
                }
            });
            calendar.render();
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    @endpush
</div>