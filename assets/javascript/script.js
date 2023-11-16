import VanillaCalendar from '@uvarov.frontend/vanilla-calendar';
import '@uvarov.frontend/vanilla-calendar/build/vanilla-calendar.min.css';
import '@uvarov.frontend/vanilla-calendar/build/themes/dark.min.css';


function activate (elmnt) {
    var headers = document.getElementsByClassName("nav-btn");
    for(i = 0; i < headers.length; i++) {
        var current_elmnt = headers[i]
        headers[i].classList.remove("active");
        console.log(headers[i].classList);
        // current_elmnt.classList.remove("active");
    }

    elmnt.classList.add("active");
}

const options = {
    settings: {
      visibility: {
        theme: 'light',
      },
    },
  };
  
  const calendar = new VanillaCalendar('#calendar', options);
  calendar.init();