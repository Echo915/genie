<?php require_once "..//includes/head.php";?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div>
        <div id="signup-form" class="mini-form mini-form-active opacity-100 w-50">
            <div class="card">
                <div id="head" class="card-header">
                    <h1 id="title">Sign Up</h1>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="user-username">Username:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                <input class="form-control" type="text" name="user-username" placeholder="I am..." aria-describedby="basic-addon1" required>
                            </div>
                            <label for="user-email">Email:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                                <input class="form-control" type="email" name="user-email" id="user-" placeholder="example@example.com" aria-describedby="basic-addon1" required>
                            </div>
                            <label for="password" class="">Password:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input class="form-control" type="password" name="user-password" id="password" required>
                            </div>
                        </div>
                        <input type="hidden" name="formToken" value="<?php echo generateFormToken(20); ?>">
                        <center><input class="butn" type="submit" name="signup-form" value="Sign up"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>