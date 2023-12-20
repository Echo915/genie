<?php require_once "..//includes/head.php";?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div>
        <div id="login-form" class="mini-form mini-form-active opacity-100 w-50">
            <div class="card">
                <div id="head" class="card-header">
                    <h1 id="title">Log In</h1>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="user-email">Email:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                                <input class="form-control" type="email" name="user-email" placeholder="example@example.com" aria-describedby="basic-addon1" required>
                            </div>
                            <label for="password" class="">Password:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input class="form-control" type="password" name="user-password" id="password" required>
                            </div>
                        </div>
                        <div id="error-msg" style="display: none;">
                            <p class="text-danger">Incorrect Username or Password!</p>
                        </div>
                        <input type="hidden" name="formToken" value="<?php echo generateFormToken(20); ?>">
                        <a href="#" class="fst-italic text-decoration-none mb-3">forgot password</a><br>
                        <small>New to genie? <a href="signup.php" class="h6">click here</a> to sign up.</small>
                        <center><input class="butn" type="submit" name="login-form" value="Log in"></center>
                        <script>document.getElementById('error-msg').style.display = 'block';</script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>