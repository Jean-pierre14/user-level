<div class="row justify-content-center">
    <div class="col-md-7 col-sm-10">
        <div class="card card-body">
            <h3>Register new User</h3>
            <?php 
                

                if(isset($_POST['register'])){
                    $name = mysqli_real_escape_string($con, htmlentities(trim($_POST['name'])));
                    $email = mysqli_real_escape_string($con, htmlentities(trim($_POST['email'])));
                    $gender = mysqli_real_escape_string($con, htmlentities(trim($_POST['gender'])));
                    $password = $_POST['password'];

                    if(empty($name)){array_push($errors, "Name field is empty");}
                    if(empty($email)){array_push($errors, "E-mail field is empty");}
                    if(empty($gender)){array_push($errors, "Gender field is empty");}

                    if(count($errors) == 0){
                        
                        $sql = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
                        $row = mysqli_fetch_row($sql);
                        
                        if($username = $row['username']){array_push($errors, "This username is taken");}
                        if($email = $row['email']){array_push($errors, "This email is taken");}

                        if(count($errors) == 0){
                            
                        }

                    }
                }
                require_once "./includes/error.php";
            ?>

            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Enter the name" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="E-mail@example.com"
                            class="form-control">
                    </div>

                </div>

                <div class="form-group my-3">
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>