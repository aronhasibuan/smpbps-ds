import './bootstrap';
import 'flowbite';

import {Calendar, dateFnsLocalizer} from 'react-big-calendar';
import format from 'date-fns/format';
import parse from 'date-fns/parse';
import startOfWeek from 'date-fns/startOfWeek';
import getDay from 'date-fns/getDay';
import 'react-big-calendar/lib/css/react-big-calendar.css';
import {useState, useEffect} from 'react';

import { createRoot } from 'react-dom/client';
import 'react-datepicker/dist/react-datepicker.css';
import id from 'date-fns/locale/id'

const locales = {
  'id': id,
};

const localizer = dateFnsLocalizer({
  format,
  parse,
  startOfWeek: () => startOfWeek(new Date(), { weekStartsOn: 1, locale: id }),
  getDay,
  locales,
});

const formats = {
  eventTimeRangeFormat: () => '', 
  agendaTimeFormat: () => '',     
  dayHeaderFormat: (date, culture, localizer) => localizer.format(date, 'dd MMMM yyyy', culture),
  dayRangeHeaderFormat: ({ start, end }, culture, localizer) =>
    localizer.format(start, 'dd MMM', culture) + ' – ' + localizer.format(end, 'dd MMM', culture),
};

const App = () => {
  const [events, setEvents] = useState([]);
  
  useEffect(() => {
    fetch('/api/tasks/calendar')
      .then(res => res.json())
      .then(data => {
        const formatted = data.map(ev => ({
          ...ev,
          start: new Date(ev.start),
          end: new Date(ev.end),
        }));
        setEvents(formatted);
      });
  }, []);

  return(
    <div className='App'>
      <Calendar
        localizer={localizer}
        events={events}
        startAccessor="start"
        endAccessor="end"
        style={{ height: 500, margin: "50px" }}
        views={['month', 'week', 'day']}
        formats={formats}
      />
    </div>
  );
}

createRoot(document.getElementById('app')).render(<App />);