<?php require_once "./includes/header.php";?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-body">
                <h3>Registration</h3>
                <?php
                    require_once "./config/action.php";
                    require_once "./includes/error.php";
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                            name="username" id="username" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                            name="email" id="email" placeholder="Email@gmail.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sex">Sexe</label>
                        <select name="gender" id="sex" class="form-control">
                            <option value=""> -- Select -- </option>
                            <option value="male"
                                <?= (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'selected' : ''; ?>>Male
                            </option>
                            <option value="female"
                                <?= (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'selected' : ''; ?>>
                                Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                            value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>"
                            name="password" id="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="registration" class="btn btn-block btn-primary">Register</button>
                    </div>
                </form>
                <p>I have an <a href="login.php">account</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once "./includes/footer.php";?>