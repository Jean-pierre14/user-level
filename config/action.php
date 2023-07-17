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
            $request = "SELECT * users WHERE username = '$username' AND `password` = '$password'";
            $exe = mysqli_query($con, $request);

            if(mysqli_num_rows($exe) == 1){
                
                $_SESSION = @mysqli_fetch_row($exe);
                $_SESSION['login'] = "auth user";
                $_SESSION['id'] = (int)$_SESSION['id'];

                header("Location: index.php");
            }else{
                array_push($errors, "Username or password is incorrect");
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

    function updateStatusAndRedirect($user_email, $new_status) {
        global $con;
        $query = "UPDATE users SET `status` = '$new_status' WHERE email = $user_email";
        $exe = mysqli_query($con, $query);

        if($exe){
            $_SESSION = mysqli_fetch_array($exe, MYSQLI_ASSOC);
            $_SESSION['login'] = "Auth user";
            header("Location: index.php");   
        }
        
        exit;
    } 