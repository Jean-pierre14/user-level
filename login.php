<?php 
    require_once "./includes/header.php";
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            <div class="card card-body">
                <h3>Login</h3>
                <?php 
                    require_once "./config/action.php";
                    require_once "./includes/error.php";
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-block btn-primary">Log in</button>
                    </div>
                </form>
                <p>I don't have an <a href="registration.php">account</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once "./includes/footer.php";?>