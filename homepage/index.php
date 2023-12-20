<?php
require_once "..//includes/head.php";
?>

<html lang="en">
<body class="bg-light">
    <div id="overlay" class="overlay">
        <a href="javascript:void(0)" class="closebutn" onclick="closeCurtain('overlay')">&times;</a>
        <div id="overlay-content" class="overlay-content"></div>
    </div>
    <header style="display: none;" id="header" class="header bg-light" style="z-index: 100; position: fixed; width: 100%; left: 0; top: 0;">
        <nav id="navbar" class="navbar navbar-expand-sm" style="z-index: 100;">
            <div class="container-fluid bg-white p-0 overflow-hidden">
                <img src="..//assets/images/genie-logo-transparent.png" alt="logo" class="logo-icon">
                <div class="menu-butn">
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
                                    $table = "tbl_schedule";
                                    $task = new Schedule($connection, $table);
                                    $taskController = new ScheduleController($task);
                                    $all_tasks = $taskController->model->get_all_objects();
                                    $count = count($all_tasks);

                                    if ($count > 0) {
                                        foreach($all_tasks as $current_task) {
                                            $task = $current_task["task"];
                                            $time = strtotime($current_task["time"]);
                                            // $time = (int)$time;
                                            $status = $current_task["status"];

                                            $valid = 0;
                                            $refresh_time = "23:59:59";
                                            $date = date(DATE_ATOM);
                                            $date = mb_substr($date, 0, 10);
                                            $refresh_epoch_time = strtotime($date." ".$refresh_time);
                                            // $refresh_epoch_time = (int)$refresh_epoch_time;

                                            if ($time < $refresh_epoch_time && $time > ($refresh_epoch_time - 86399)) {
                                                ?>
                                                    <div id="task-item" class="task-item">
                                                        <!-- task time -->
                                                        <p class="task-content" style="font-size: 11px; padding: 0 10px;"><?php echo date("d M, Y H:i", $time);?></p>
                                                        <!-- task item  -->
                                                        <h3 class="task-content" style="padding: 10px;"><?php echo $task ?></h3>
                                                    </div>
                                                <?php
                                            }
                                            $valid = 1;
                                        }
                                    } 
                                    
                                    if ($valid === 0) {
                                        echo "No tasks yet!";
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

                    <div class="quote-container mt-3">
                        <?php
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, 'https://zenquotes.io/api/today');
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            $output = curl_exec($curl);
                            curl_close($curl);
                            
                            $data = json_decode($output, true);
                            // $randomIndex = rand(0, count($data) - 1);
                            $todayQuote = $data[0];
                        ?>
                        <!-- urlencode() formats a text in url format -->
                        <p style="white-space: pre-wrap;"><?php echo $todayQuote['q'] . "\n—\n" ?><a target="_blank" href="https://www.google.com/search?q=<?php echo urlencode($todayQuote['a']) ?>" class="text-success quote-author"><small class="fst-itaic"><?php echo $todayQuote['a'] ?></small></a></p>
                    </div>
                </div>
            </div><br><br><br><br>

            <!-- -----------------------------------Routines Section------------------------------------------- -->
            <div class="main-routine-section bg-white rounded-4 shadow p-3 position-relative">
                <small id="routines" class="h1">Routines</small>
                <small onclick="openCurtain('overlay', 'routine')" class="bi bi-person-walking h3 position-absolute add-icon">+</small>
                <div class="routine-container row mt-4 ">
                    <?php
                    $routine_sql = "SELECT * FROM tbl_routine ORDER BY id ASC";
                    $routine_ex = mysqli_query($connection, $routine_sql);

                    while ($routine_row = $routine_ex->fetch_assoc()){ ?>
                        <div class="col-sm-6 p-3">
                            <div class="card">
                                <div class="card-header shadow">
                                    <p class="h6"><?php echo $routine_row["routine_title"] ?>
                                        <span class="action-container ms-3">
                                            <span class="">
                                                <i role="button" class="bi bi-pencil-square text-success"></i>
                                            </span>
                                            <span class="">
                                                <i role="button" class="bi bi-trash-fill text-danger"></i>
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="card-body routine-details">
                                    <ul>
                                        <?php 
                                        $routine_item_sql = "SELECT * FROM tbl_routine_item WHERE routine_id = ".$routine_row['id']; 
                                        $routine_item_ex = mysqli_query($connection, $routine_item_sql);

                                        while ($routine_item_row = $routine_item_ex->fetch_assoc()){ ?>
                                            <li><?php echo $routine_item_row["routine_item_title"]?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
                                        <p class="head h6 ms-3">
                                            <i class="bi bi-book text text-secondary"></i>
                                            <?php echo $title ?>
                                            <span class="action-container ms-3">
                                                <span class="">
                                                    <i role="button" class="bi bi-pencil-square text-success"></i>
                                                </span>
                                                <span class="">
                                                    <i role="button" class="bi bi-trash-fill text-danger"></i>
                                                </span>
                                            </span>
                                        </p>
                                        <div class="routine-item-detail ms-5 p">
                                            <p><?php echo $content ?></p>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>
            </div><br><br><br>
        </div>

        <!--------------------------------- Schedule Form ------------------------------------------>
        <div id="schedule" class="mini-form">
            <div class="card">
                <div id="head" class="card-header">
                    <h1 id="title">New Task</h1>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <p class="fst-italic text-align-center">Keep track of your tasks and give your brain a break!!</p>
                        <div class="form-group">
                            <label for="task">Task:</label>
                            <input class="form-control" type="text" name="task" id="task" placeholder="I want to..." required><br>
                            <label for="time" class="">Due At...</label>
                            <input class="form-control" type="datetime-local" name="time" id="time" required>
                        </div>
                        <input class="form-control" type="hidden" name="formToken" value="<?php echo generateFormToken(20); ?>">
                        <input class="butn" type="submit" name="schedule-form" value="Add">
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------------------------------Routine Form------------------------------------------ -->
        <div id="routine" class="mini-form">
            <div class="card">
                <div id="head" class="card-header">
                    <h1 id="title">+ Routine</h1>
                </div>
                <div>
                    <form id="routine-form" method="POST">
                        <div class="card-body">
                            <style>
                                small {
                                    font-size: x-small;
                                }
                            </style>
                            <p class="fst-italic">Daily routines help you keep consistency and build good habits</p>
                            <div class="form-group">
                                <select id="routines-container" name="routine-group" size="1" style="max-width: 80%;" class="form-control" required>
                                    <option selected disabled>-- Select Routine -- </option>
                                    <?php 
                                    ?>
                                    <option class="routine-title" value="morningRoutine">Morning Routine</option>
                                    <option class="routine-title" value="eveningRoutine">Evening Routine</option>
                                    <option class="routine-title" value="fortune">fortune</option>
                                    <option class="routine-title" value="klabi">klabi</option>
                                    <option class="routine-title" value="echo">echo</option>
                                </select>
                                <div class="input-group">
                                    <i class="bi bi-plus h3 text-primary" role="button" onclick="addRoutine()"></i>
                                    <div class="routine-add">
                                        <input id="routine-add" name="empty" style="display: none; border: 1.5px solid lavender;" class="rounded-1 mt-1" type="text" width="width" placeholder="New Routine">
                                        <!-- <button type="button" class="btn btn-primary">Add</button> -->
                                    </div>
                                </div>
                            
                                   <input name="routine-title" class="form-control" type="text" width="width" placeholder="Enter Routine Task" required><br>
                            </div>
                            <div class="form-group">
                                <small> Everyday</small> <input onclick="check_corresponding_days('day')" id="everyday" type="radio" value="Everyday" name="dayGroup" checked="checked">
                                <small> Weekdays</small> <input onclick="check_corresponding_days('weekday')" id="weekdays" type="radio" value="Weekdays" name="dayGroup">
                                <small> Weekends</small> <input onclick="check_corresponding_days('weekend')" id="weekends" type="radio" value="Weekends" name="dayGroup">
                            </div>
                            <div class="form-group">
                                <small>Mon</small> <input class="day weekday" type="checkbox" name="ass_day[]" value="Mon">
                                <small>Tue</small> <input class="day weekday" type="checkbox" name="ass_day[]" value="Tue">
                                <small>Wed</small> <input class="day weekday" type="checkbox" name="ass_day[]" value="Wed">
                                <small>Thur</small> <input class="day weekday" type="checkbox" name="ass_day[]" value="Thur">
                                <small>Fri</small> <input class="day weekday" type="checkbox" name="ass_day[]" value="Fri">
                                <small>Sat</small> <input class="day weekend" type="checkbox" name="ass_day[]" value="Sat">
                                <small>Sun</small> <input class="day weekend" type="checkbox" name="ass_day[]" value="Sun">
                            </div>
                            <input class="form-control" type="hidden" name="formToken" value="<?php echo generateFormToken(20); ?>">
                            <input class="butn" type="submit" name="routine-form" value="Add" form="routine-form">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ----------------------------------Note Form---------------------------------------------- -->
        <div id="note" class="mini-form">
            <div class="card">
                <div id="head" class="card-header">
                    <h1 id="title">New Note</h1>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <p class="fst-italic">Write down things you'd like to rember later.</p>
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="some text, phone number, etc..." required><br>
                            <!-- <small class="h6">Due Period</small> -->
                            <textarea class="form-control" name="content" placeholder="Enter details..."></textarea>
                        </div>
                        temporal <input class="me-3" checked="checked" type="radio" value="temporal" name="status">
                        permanent <input type="radio" value="permanent" name="status"><br>
                        <input type="hidden" name="formToken" value="<?php echo generateFormToken(20); ?>">
                        <input class="butn" type="submit" name="note-form" value="Add">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="..//assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="..//assets/javascript/script.js"></script>
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