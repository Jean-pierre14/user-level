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