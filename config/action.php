<?php
    require_once "db.config.php";

    $output = "";
    $errors = array();

    // Login action
    if(isset($_POST['login'])){

        // Get variable from our front-end
        $username = mysqli_real_escape_string($con, trim(htmlentities($_POST['username'])));
        $password = mysqli_real_escape_string($con, trim(htmlentities($_POST['password'])));

        // Validation
        if(empty($username)){array_push($errors, "Username is invalid");}
        if(empty($password)){array_push($errors, "Password is invalid");}

        // Second level of validation
        if(count($errors) == 0){
            // Crypt the password
            $pass = md5($password);

            // Pass to database
            $sql = "SELECT * FROM users WHERE (username = '$username' AND `password` = '$pass')";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                die("Query execution failed: " . mysqli_error($con));
            }
            $num_row = mysqli_num_rows($result);

            if($num_row == 1){
                $_SESSION = @mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['login'] = "Auth user";
                
                $new_status = 'active';
                $query = "UPDATE users SET `status` = '$new_status' WHERE email = '$email'";
                $exe = mysqli_query($con, $query);
                if($exe){
                    header("Location: index.php");
                }else{
                    array_push($errors, "Error: SQL");
                }
            }else{
                array_push($errors, "Username or Password is incorrect");
            }
        }
    }

    // Registration
  
    if(isset($_POST['registration'])){
        // Get data from form
        $username = mysqli_real_escape_string($con, trim(htmlentities($_POST['username'])));
        $email = mysqli_real_escape_string($con, trim(htmlentities($_POST['email'])));
        $gender = mysqli_real_escape_string($con, trim(htmlentities($_POST['gender'])));
        $password = mysqli_real_escape_string($con, trim(htmlentities($_POST['password'])));

        // Validation
        if(empty($username)){array_push($errors, "Username is empty");}
        if(empty($email)){array_push($errors, "Email is empty or incorrect");}
        if(empty($gender)){array_push($errors, "Gender is empty");}
        if(empty($password)){array_push($errors, "Password is empty or incorrect");}

        if(count($errors) == 0){

            $password = md5($password);
            
            $sql = "INSERT INTO users(username, email, gender, `password`) VALUES('$username', '$email', '$gender', '$password')";

            $result = mysqli_query($con, $sql);

            if($result){
                header("Location: login.php");
            }
        }
    }

    function AllUsers(){
        global $con;
        global $output;

        $sql = mysqli_query($con, "SELECT * FROM users ORDER BY id_user DESC");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
            while($row = mysqli_fetch_array($sql)){
                $output .= '
                    <tr>
                        <th scope="row">'.$row['id_user'].'</th>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['status'].'</td>
                        <td>
                            <div class="btn btn-group">
                                <button class="btn btn-sm btn-info">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                ';
            }
            $output .= '
            </table>
            </tbody>';
        }else{
            $output .= '<p class="alert alert danger">There is no data</p>';
        }
        return $output;
    }

    function Admin(){
        global $con, $output;
        $output = "";

        $sql = mysqli_query($con, "SELECT SUM(CASE WHEN user_level = 'admin' THEN 1 ELSE 0 END) AS admin_count, COUNT(*) as all_users, (SUM(CASE WHEN user_level = 'normal' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS admin_percentage FROM users");
        
        if(@mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);

            $adminCount = $row['admin_count'];
            $totalUserCount = $row['all_users'];
            $percentage = ($adminCount / $totalUserCount) * 100 ;
            $num_percentage = number_format($percentage, 0);

            $output = '
            <div class="card card-body shadow-sm">
                <h3>Admin</h3>
                <span class="progress">
                    <span class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:'.$num_percentage.'%">'.$num_percentage.'%</span>
                </span>
            </div>
            ';
        }else{
            $output = '<p class="alert alert-info">There no admin</p>';
        }
        return $output;
    }

    function AllUsersCount(){
        global $con, $output;
        $output = "";
        $sql = mysqli_query($con, "SELECT COUNT(*) AS user_count FROM users");

        if(@mysqli_num_rows($sql) == 1){
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $output = '
            <div class="card card-body shadow-sm">
                <h1 class="card-title">All users</h1>

                <span class="mt-3 d-flex justify-content-between align-items-center">
                    <span>Number:</span>
                    <span class="badge badge-primary">'.$row['user_count'].'</span>
                </span>
            </div>
            ';

        }else{$output = '<p class="alert alert-danger">Error SQL code...</p>';}
        return $output;
    }

    function AllMale(){
        global $con, $output;
        $output = "";

        $sql = mysqli_query($con, "SELECT (COUNT(CASE WHEN gender = 'male' THEN 1 END) / COUNT(*)) * 100 AS percentage_male FROM users");

        if(@mysqli_num_rows($sql) == 1){
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $percentage = number_format($row['percentage_male'], 0);

            $output = '
            <div class="card card-body shadow-sm">
                <h1>Male</h1>
                <br/>
                <span class="progress">
                    <span class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:'.$percentage.'%">'.$percentage.'%</span>
                </span>
            </div>
            ';
        }else{$output = '<p class="alert alert-warning">Error of network...</p>';}
        return $output;
    }
    function AllFemale(){
        global $con, $output;
        $output = "";

        $sql = mysqli_query($con, "SELECT (COUNT(CASE WHEN gender = 'female' THEN 1 END) / COUNT(*)) * 100 AS percentage_female FROM users");

        if(@mysqli_num_rows($sql) == 1){
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $percentage = number_format($row['percentage_female'], 0);

            $output = '
            <div class="card card-body shadow-sm">
                <h1>Female</h1>
                <br/>
                <span class="progress">
                    <span class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:'.$percentage.'%">'.$percentage.'%</span>
                </span>
            </div>
            ';
        }else{$output = '<p class="alert alert-warning">Error of network...</p>';}
        return $output;
    }

    