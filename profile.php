<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row py-5 justify-content-center">
            <div class="col-md-5 my-2">
                <div class="card card-body">
                    <h3>Profile</h3>
                    <p class="d-flex justify-content-between align-items-center">
                        <span>Username:</span>
                        <span><?= $_SESSION['username'];?></span>
                    </p>
                </div>
            </div>

            <div class="col-md-7 my-2">
                <div class="card card-body">
                    <h3>Edit Profile</h3>
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username"
                                    value="<?= $_SESSION['username'];?>" class="form-control">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email"
                                    value="<?= $_SESSION['email'];?>" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="male"
                                        <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'male') ? 'selected' : ''; ?>>
                                        Male</option>
                                    <option value="female"
                                        <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'female') ? 'selected' : ''; ?>>
                                        Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-10 my-2">
                <div class="card card-body">
                    <h3>Password</h3>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>