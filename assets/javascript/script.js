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
  setTimeout(() => {
    document.getElementById(form).style.opacity = "1";
  }, 200);
}

function closeCurtain(curtain) {
  var forms = document.querySelectorAll(".mini-form");
  forms.forEach((form) => {
    form.style.opacity = "0";
  })
  setTimeout(() => {
    document.getElementById(curtain).style.width = "0";
  }, 400);
}

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
