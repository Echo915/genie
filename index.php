<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>genie</title>
    <!-- <meta http-equiv="refresh" content="0; url=index.php"> -->
    <link rel="icon" type="image/png" href="assets/images/genie-logo-transparent.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap-icons-1.11.1/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Calendar plugin -->
    <!-- Plugin CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar/build/vanilla-calendar.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar/build/themes/light.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar/build/themes/dark.min.css" rel="stylesheet">
    <!-- Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar/build/vanilla-calendar.min.js" defer></script>
</head>
<body class="bg-light">
    <div id="overlay" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeCurtain('overlay')">&times;</a>
        <div id="overlay-content" class="overlay-content"></div>
    </div>
    <header id="header" class="header bg-light" style="z-index: 100; position: fixed; width: 100%; left: 0; top: 0;">
        <nav id="navbar" class="navbar navbar-expand-sm" style="z-index: 100;">
            <div class="container-fluid bg-white p-0 overflow-hidden">
                <img src="assets/images/genie-logo-transparent.png" alt="logo" class="logo-icon">
                <div class="menu-btn">
                    <i class="bi bi-chevron-down h6" onclick="toggle_menu_display()"></i>
                </div>
                <div id="menu">
                    <ul class="nav-btn-container navbar-nav p-0 m-0 shadow-sm">
                        <li class="nav-item">
                            <a href="#schedules" onclick="activate(this)" class="btn active nav-btn border-0">Schedules</a>
                        </li>
                        <li class="nav-item">
                            <a href="#routines" onclick="activate(this)" class="btn nav-btn border-0">Routines</a>
                        </li>
                        <li class="nav-item">
                            <a href="#notes" onclick="activate(this)" class="btn nav-btn border-0">Notes</a>
                        </li>
                    </ul>
                </div>        
            </div>
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="input-group ms-5">
                            <input class="searchbar form-control rounded-5 shadow-sm" type="text" placeholder="search...">
                            <button class="btn border-0">
                                <i class="bi bi-search text-primary"></i>
                            </button>
                        </div>
                    </li> 
                </ul>
            </div>
        </nav>
    </header>
    <main style="margin-top: 80px;">
        <?php 
            $connection = mysqli_connect("localhost", "root", "") or die(mysqli_error()); // Connects to database 
            $db_select = mysqli_select_db($connection, "genie"); // Selects database
        ?>
        <div class="main-page container mt-3">
            <!-- -----------------------------------Schedules Section------------------------------------------- -->
            <div class="row">
                <div class="schedule-pane col">
                    <div class="schedule-contents bg-white shadow rounded-4 p-3">
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <small id="schedules" class="h1">My Schedule</small>
                            </div>
                            <div style="text-align: right;" class="col">
                                <small onclick="openCurtain('overlay', 'schedule')" class="add-task h3 bi bi-calendar2-plus"></small>
                            </div>
                        </div>
                        <div id="schedule-container">
                            <p>
                                <i class="bi bi-sun text-primary"></i> Morning Routine
                            </p>
                            <div id="schedule-list">
                                <?php 
                                    $sql = "SELECT * FROM tbl_schedule";
                                    $execution = mysqli_query($connection, $sql);

                                    // Checks if execution was successful
                                    if ($execution == true) {
                                        // Gets all the data in a database
                                        $schedule_rows_count = mysqli_num_rows($execution);

                                        // Checks if there is data in the database or not
                                        if ($schedule_rows_count > 0) {

                                            // Loops through all the data in database
                                            while ($schedule_row = mysqli_fetch_assoc($execution)) {
                                                $task = $schedule_row["task"];
                                                $time = $schedule_row["time"];

                                                ?>
                                                    <div id="task-item" class="task-item">
                                                        <!-- task time -->
                                                        <p class="task-content" style="font-size: 11px; padding: 0 10px;"><?php echo $time ?></p>
                                                        <!-- task item  -->
                                                        <h3 class="task-content" style="padding: 10px;"><?php echo $task ?></h3>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <p>
                                <i class="bi bi-moon-fill text-primary"></i> Evening Routine
                            </p>
                        </div>
                    </div>
                </div>
                <div id="calendar-container" class="col-sm-4 position-relative">
                    <div id="calendar" class="shadow-sm position-sticky"></div>
                    <div class="p-3">
                        <p class="h1" id="time"></p>
                    </div>
                </div>
            </div><br><br><br><br>

            <!-- -----------------------------------Routines Section------------------------------------------- -->
            <div class="main-routine-section bg-white rounded-4 shadow p-3 position-relative">
                <small id="routines" class="h1">Routines</small>
                <small onclick="openCurtain('overlay', 'routine')" class="bi bi-person-walking h3 position-absolute add-icon">+</small>
                <div class="routine-container row ">
                    <span class="routine-item col-sm-6 p-3">
                        <div class="head bg-light shadow">
                            <p class="h6">Some Head</p>
                        </div>
                        <div class="routine-details">
                            <ul class="details py-3">
                                <li>some text</li>
                                <li>some more text</li>
                                <li>Even more text</li>
                            </ul>
                        </div>
                    </span>
                    <span class="routine-item col-sm-6 p-3">
                        <div class="head bg-light shadow">
                            <p>Some Head</p>
                        </div>
                        <div class="routine-details">
                            <ul class="details py-3">
                                <li>some text</li>
                                <li>some more text</li>
                                <li>Even more text</li>
                            </ul>
                        </div>
                    </span>
                    <span class="routine-item col-sm-6 p-3">
                        <div class="head bg-light shadow">
                            <p>Some Head</p>
                        </div>
                        <div class="routine-details">
                            <ul class="details py-3">
                                <li>some text</li>
                                <li>some more text</li>
                                <li>Even more text</li>
                            </ul>
                        </div>
                    </span>
                    <span class="routine-item col-sm-6">
                        <div class="head bg-light shadow">
                            <p>Some Head</p>
                        </div>
                        <div class="details">
                            <ul class="details">
                                <li>some text</li>
                                <li>some more text</li>
                                <li>Even more text</li>
                            </ul>
                        </div>
                    </span>
                </div>
            </div><br><br><br><br>
            <!-- ------------------------------------Notes Section------------------------------------- -->
            <div class="container position-relative p-3 bg-white rounded-4 shadow notes-section" style="min-height: 460px;">
                <small id="notes" class="h1">Notes</small>
                <small onclick="openCurtain('overlay', 'note')" class="bi bi-journal-plus h3 position-absolute add-icon"></small>
                <div class="notes-content mt-4">
                <?php 
                    $sql = "SELECT * FROM tbl_note";
                    $execution = mysqli_query($connection, $sql);

                    // Checks if execution was successful
                    if ($execution == true) {
                        // Gets all the data in a database
                        $note_rows_count = mysqli_num_rows($execution);

                        // Checks if there is data in the database or not
                        if ($note_rows_count > 0) {

                            // Loops through all the note data in database
                            while ($note_row = mysqli_fetch_assoc($execution)) {
                                $title = $note_row["title"];
                                $content = $note_row["content"];

                                ?>
                                    <div class="container mb-4 note-item">
                                        <i class="bi bi-pencil text text-secondary"></i>
                                        <a href="#" class="head h6 ms-3"><?php echo $title ?></a>
                                        <div class="routine-item-detail ms-5 p">
                                            <p><?php echo $content ?></p>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>
                    <div class="container mb-4 note-item">
                        <i class="bi bi-pencil text text-secondary"></i>
                        <a href="#" class="head h6 ms-3">Some item head</a>
                        <div class="routine-item-detail ms-5 p">
                            <p>Replace the placeholder comment with the code for uploading the quote to your website. This could involve sending the quote to a server-side script or directly modifying the DOM of your website. The specific implementation will depend on your website's technology stack and architecture.</p>
                        </div>
                    </div>
                    <div class="container mb-4 note-item">
                        <i class="bi bi-pencil text text-secondary"></i>
                        <a href="#" class="head h6 ms-3">Some item head</a>
                        <div class="routine-item-detail ms-5 p">
                            <p>Replace the placeholder comment with the code for uploading the quote to your website. This could involve sending the quote to a server-side script or directly modifying the DOM of your website. The specific implementation will depend on your website's technology stack and architecture.</p>
                        </div>
                    </div>
                </div>
            </div><br><br><br>
        </div>
        <!--------------------------------- Schedule Form ------------------------------------------>
        <div id="schedule" class="mini-form">
            <div id="body">
                <div id="head">
                    <h1 id="title">New Task</h1>
                </div>
                <div>
                    <form action="index.php" method="POST">
                        <p class="fst-italic">Keep track of your tasks and give your brain a break!!</p>
                        <div>
                            <input class="mb-3" type="text" name="task" placeholder="I want to..." required><br>
                            <small class="h6">Due Period</small>
                            <input type="datetime-local" name="time" required>
                        </div>
                        <input class="btn" type="submit" name="schedule-form" value="Add">
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------------------------------Routine Form------------------------------------------ -->
        <div id="routine" class="mini-form">
            <div id="body">
                <div id="head">
                    <h1 id="title">+ Routine</h1>
                </div>
                <div>
                    <form method="POST">
                        <p class="fst-italic">Daily routines help you keep consistency and buld good habits</p>
                        <div>
                            <input class="mb-3" type="text" placeholder="e.g. walking to class..." required><br>
                            <!-- <small class="h6">Due Period</small> -->
                            <textarea placeholder="Enter details..." required></textarea>
                        </div>
                        <input class="btn" type="submit" name="routine-form" value="Add">
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------------------------------Note Form---------------------------------------------- -->
        <div id="note" class="mini-form">
            <div id="body">
                <div id="head">
                    <h1 id="title">New Note</h1>
                </div>
                <div>
                    <form method="POST">
                        <p class="fst-italic">Write down things you'd like to rember later.</p>
                        <div>
                            <input class="mb-3" type="text" name="title" placeholder="some text, phone number, etc..." required><br>
                            <!-- <small class="h6">Due Period</small> -->
                            <textarea name="content" placeholder="Enter details..."></textarea>
                        </div>
                        <input class="btn" type="submit" name="note-form" value="Add">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/javascript/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const options = {
            settings: {
                visibility: {
                theme: 'light',
                },
            },
            };
            
            const calendar = new VanillaCalendar('#calendar', options);
            calendar.init();
        });
    </script>
</body>
</html>

<?php
    include("forms.php");
?>