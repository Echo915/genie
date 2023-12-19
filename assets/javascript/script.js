// ------------------------------------------- Functions and Classes -------------------------------------------------
function activate (elmnt) {
    var headers = document.getElementsByClassName("nav-btn");
    for(i = 0; i < headers.length; i++) {
        headers[i].classList.remove("active");
    }

    elmnt.classList.add("active");
}

// Gets random integers b/n 0 and 255 to create random rgb colors 
function get_random_color(diminish=1) {
  var red = Math.floor(Math.random() * 256); // Random red
  var green = Math.floor(Math.random() * 256); // Random green
  var blue = Math.floor(Math.random() * 256); // Random blue

  var random_color = `rgba(${red}, ${green}, ${blue}, ${diminish})`;
  return random_color;
}

// Toggles display of overlay/curtain 
function openCurtain(curtain, form) {
  document.getElementById(curtain).style.width = "100%";
  current_form = document.getElementById(form);
  current_form.classList.add("mini-form-active");
  setTimeout(() => {
    current_form.style.zIndex = "150";
    current_form.style.opacity = "1";
  }, 200);
}

function closeCurtain(curtain) {
  var forms = document.querySelectorAll(".mini-form");
  forms.forEach((form) => {
    form.classList.remove("mini-form-activate");
    form.style.zIndex = "0";
    form.style.opacity = "0";
  })
  setTimeout(() => {
    document.getElementById(curtain).style.width = "0";
  }, 400);
}

// Toggle menu display
function toggle_menu_display() {
  var menu = document.getElementById("menu");
  if (menu.style.display === "block") {
    menu.style.display = "none";
  } else {
    menu.style.display = "block";
  }
}

// Handles Checking and unchecking boxes
function check_boxes(class_name) {
  var checkboxes = document.querySelectorAll(`.${class_name}`);
  for (i = 0; i < checkboxes.length; i++) {
    checkboxes[i].setAttribute("checked", "checked");
  }
}

function uncheck_boxes(class_name) {
  var checkboxes = document.querySelectorAll(`.${class_name}`);
  for (i = 0; i < checkboxes.length; i++) {
    checkboxes[i].removeAttribute("checked");
  }
}

// Handles checking of corresponding days
function check_corresponding_days(class_name) {
  uncheck_boxes("day");
  check_boxes(class_name);
}

// Adds new routine title to choices
function addRoutine() {
  var routine_input = document.getElementById("routine-add");

  if (routine_input.style.display === "none") {
    routine_input.style.display = "block";
  } else {
    var routine_tray = document.getElementById("routines-container");
    routines = Array.from(routine_tray.children); // Converts Node item (routine_tray.children) to array
    var new_routine = routine_input.value;
    
    if (new_routine !== "" && !routines.includes(new_routine)){
      // Creates a new option object and adds it to routine_tray select tag
      var new_option = new Option(new_routine, new_routine);
      routine_tray.add(new_option, undefined);
    }
    
    routine_input.value = "";
    routine_input.style.display = "none";
  }
}





// -------------------------------------------------- Main Code ----------------------------------------------------------

// Update time 
var time_div = document.getElementById("time");
setInterval(() => {
  const current_time = new Date().toLocaleTimeString('en-us', {hour12: false});
  time_div.innerHTML = current_time;  
}, 1000);


// Applies a random color to the background of each item in task_divs list
var task_divs = document.querySelectorAll(".task-item");
var task_content_list = document.querySelectorAll(".task-content");

task_divs.forEach((task) => {
  let random_color = get_random_color(0.4);
  task.style.backgroundColor = random_color;
})

setTimeout(() => {
  task_content_list.forEach((task_content) => {
    task_content.style.opacity = "1";
  })
}, 1000);


// Applies a random color to routine items
var routine_divs = document.querySelectorAll(".routine-details");
routine_divs.forEach((routine_div) => {
  var random_color = get_random_color(0.4);
  routine_div.style.borderTop = `3px outset ${random_color}`
  routine_div.style.backgroundColor = random_color;
});
