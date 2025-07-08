import './bootstrap';
import 'flowbite';
import { Calendar, dateFnsLocalizer } from 'react-big-calendar';
import format from 'date-fns/format';
import parse from 'date-fns/parse';
import startOfWeek from 'date-fns/startOfWeek';
import getDay from 'date-fns/getDay';
import 'react-big-calendar/lib/css/react-big-calendar.css';
import { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import 'react-datepicker/dist/react-datepicker.css';
import id from 'date-fns/locale/id';
import { FiCalendar, FiChevronLeft, FiChevronRight } from 'react-icons/fi';

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

const customStyles = {
  event: (event) => ({
    backgroundColor: event.color || '#3B82F6',
    borderRadius: '6px',
    border: 'none',
    color: 'white',
    padding: '4px 8px',
    fontSize: '0.875rem',
    boxShadow: '0 1px 3px rgba(0,0,0,0.1)',
  }),
};

const App = () => {
  const [events, setEvents] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  
  useEffect(() => {
    setIsLoading(true);
    fetch('/api/tasks/calendar')
      .then(res => res.json())
      .then(data => {
        const formatted = data.map(ev => ({
          ...ev,
          start: new Date(ev.start),
          end: new Date(ev.end),
          color: ev.color || '#3B82F6', // Default blue color
        }));
        setEvents(formatted);
      })
      .catch(err => {
        console.error('Gagal memuat data kalender:', err);
      })
      .finally(() => setIsLoading(false));
  }, []);

  const CustomToolbar = ({ label, onNavigate }) => {
    return (
      <div className="flex items-center justify-between mb-4 p-4 bg-white rounded-lg shadow-sm">
        <div className="flex items-center space-x-2">
          <FiCalendar className="text-blue-600 text-xl" />
          <h2 className="text-xl font-semibold text-gray-800">Kalender Tugas</h2>
        </div>
        <div className="flex items-center space-x-4">
          <button 
            onClick={() => onNavigate('PREV')}
            className="p-2 rounded-full hover:bg-gray-100 transition-colors"
          >
            <FiChevronLeft className="text-gray-600 text-xl" />
          </button>
          <span className="text-lg font-medium text-gray-700">{label}</span>
          <button 
            onClick={() => onNavigate('NEXT')}
            className="p-2 rounded-full hover:bg-gray-100 transition-colors"
          >
            <FiChevronRight className="text-gray-600 text-xl" />
          </button>
          <button 
            onClick={() => onNavigate('TODAY')}
            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm"
          >
            Hari Ini
          </button>
        </div>
      </div>
    );
  };

  const CustomEvent = ({ event }) => {
    return (
      <div className={`p-2 rounded-md text-white ${event.color ? '' : 'bg-blue-500'}`} style={{ backgroundColor: event.color }}>
        <strong>{event.title}</strong>
        {event.desc && <div className="text-xs mt-1">{event.desc}</div>}
      </div>
    );
  };

  return (
    <div className="App p-4 max-w-7xl mx-auto">
      {isLoading ? (
        <div className="flex justify-center items-center h-64">
          <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>
      ) : (
        <Calendar
          localizer={localizer}
          events={events}
          startAccessor="start"
          endAccessor="end"
          style={{ height: '70vh' }}
          views={['month']}
          step={1440}
          timeslots={1}
          formats={formats}
          culture='id'
          components={{
            toolbar: CustomToolbar,
            event: CustomEvent,
          }}
          eventPropGetter={(event) => ({
            style: {
              backgroundColor: event.color,
              borderRadius: '6px',
              border: 'none',
              color: 'white',
            },
          })}
          dayPropGetter={(date) => {
            const isToday = date.toDateString() === new Date().toDateString();
            return {
              style: {
                backgroundColor: isToday ? '#EFF6FF' : 'white',
                borderRight: '1px solid #f3f4f6',
                borderBottom: '1px solid #f3f4f6',
              },
            };
          }}
        />
      )}
    </div>
  );
}

createRoot(document.getElementById('app')).render(<App />);