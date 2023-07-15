<?php
    require_once "db.config.php";

    $output = "";
    $errors = array();
    session_start();

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
            $password = md5($password);

            // Pass to database
            $request = "SELECT * users WHERE username = '$username' AND password = '$password'";
            $exe = mysqli_query($con, $request);

            // User validation
            if(mysqli_num_rows($exe)){
                $_SESSION = @mysqli_fetch_array($exe, MYSQLI_ASSOC);
                
                $email = $_SESSION['email'];
                $connected = mysqli_query($con, "UPDATE users SET `status` = 'Online' WHERE email = '$email'");

                if($connected){
                    $_SESSION['login'] = "Auth user";
                    header("Location: index.php");
                }else{
                    array_push($errors, "Network error... please try again...");
                }
            }
        }
    }