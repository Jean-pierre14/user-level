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
                
                
                $new_status = 'active';
                $query = "UPDATE users SET `status` = '$new_status' WHERE email = '$email'";
                $exe = mysqli_query($con, $query);

                if($exe){
                    session_start();
                    $_SESSION = @mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $_SESSION['login'] = "Auth user";
                
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

    function ValidationFields(){

    }

    if(isset($_POST['btnSave'])){

        $id_user = mysqli_real_escape_string($con, htmlentities(trim($_POST['id_user'])));
        $name = mysqli_real_escape_string($con, htmlentities(trim($_POST['name'])));
        $quantity = mysqli_real_escape_string($con, htmlentities(trim($_POST['quantity'])));
        $unity_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['unity_price'])));
        $selling_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['selling_price'])));

        if(empty($id_user)){header("Location: login.php");}
        if(empty($name)){array_push($errors, "Name is empty");}
        if(empty($quantity)){array_push($errors, "Quantity is empty");}
        if(empty($unity_price)){array_push($errors, "unity price is empty");}
        if(empty($selling_price)){array_push($errors, "Selling price is empty");}

        if(count($errors) == 0){

            $checkProduct = mysqli_query($con, "SELECT nom FROM stock WHERE nom = '$name'");
            if(mysqli_num_rows($checkProduct) > 0){
                $sql = mysqli_query($con, "UPDATE stock SET id_user = $id_user, nombre = $quantity, prix_unitaire = $unity_price, prix_de_vente = $selling_price WHERE nom = '$name'");
                if($sql) {
                    header("Location: stock.php");
                }else{
                    array_push($errors, "SQL UPDATE ERROR");
                }
            }else{
                $sql = mysqli_query($con, "INSERT INTO `stock` (`id_stock`, `id_user`, `nom`, `prix_unitaire`, `nombre`, `prix_de_vente`, `created_at`) VALUES (NULL, $id_user, '$name', '$unity_price', '$quantity', '$selling_price', current_timestamp())");
            
                if($sql){
                    header("Location: stock.php");
                }else{
                    array_push($errors, "SQL queries");
                }
            }
            
        }
    }
    

    if(isset($_POST['action'])){
        if($_POST['action'] == 'postStock'){
            
            $id_user = mysqli_real_escape_string($con, htmlentities(trim($_POST['id_user'])));
            $name = mysqli_real_escape_string($con, htmlentities(trim($_POST['name'])));
            $quantity = mysqli_real_escape_string($con, htmlentities(trim($_POST['quantity'])));
            $unity_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['unity_price'])));
            $selling_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['selling_price'])));

            if(empty($id_user)){$output = "User Id is empty"; array_push($errors, "Error");}
            if(empty($name)){$output = "Name is blank"; array_push($errors, "Error");}
            if(empty($quantity)){$output = "Quantity is empty"; array_push($errors, "Error");}
            if(empty($unity_price)){$output = "Price is empty"; array_push($errors, "Error");}
            if(empty($selling_price)){$output = "Selling price is empty"; array_push($errors, "Error");}

            if(count($errors) == 0){

                $checkProduct = mysqli_query($con, "SELECT nom FROM stock WHERE nom = '$name'");
                if(mysqli_num_rows($checkProduct) > 0){
                    $sql = mysqli_query($con, "UPDATE stock SET id_user = $id_user, nombre = $quantity, prix_unitaire = $unity_price, prix_de_vente = $selling_price WHERE nom = '$name'");
                    
                    if($sql) {
                        $output = "success";
                    }else{
                        $output = "SQL UPDATE ERROR";
                    }
                }else{
                    $sql = mysqli_query($con, "INSERT INTO `stock` (`id_stock`, `id_user`, `nom`, `prix_unitaire`, `nombre`, `prix_de_vente`, `created_at`) VALUES (NULL, $id_user, '$name', '$unity_price', '$quantity', '$selling_price', current_timestamp())");
                
                    if($sql){
                        $output = 'success';
                    }else{
                        $output = 'Error SQL';
                    }
                }
            }
            print $output;
        }
        if($_POST['action'] == 'fetch'){
            $sql = mysqli_query($con, "SELECT * FROM stock ORDER BY id_stock DESC");

            if(@mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_array($sql)){
                    $output .= '
                    <div class="contentBox red">
                        <div>
                            <span>Name</span>
                            <small>'.$row['nom'].'</small>
                        </div>
                        <div>
                            <span>Prix unitaire</span>
                            <small>'.$row['prix_unitaire'].'</small>
                        </div>
                        <div>
                            <span>Prix de vente</span>
                            <small>'.$row['prix_de_vente'].'</small>
                        </div>
                        <div class="last">
                            <div class="btn-group">
                            <a href="stock.php?get='.$row['id_stock'].'" class="btn btn-sm btn-primary">Edit</a>
                            <a href="stock.php?delete='.$row['id_stock'].'" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                        </div>
                    ';
                }
                
            }else{
                $output = '<p class="alert alert-warning">You don\'t have data</p>';
            }
            print $output;
        }

        if($_POST['action'] == 'update'){

            $id_user = mysqli_real_escape_string($con, htmlentities(trim($_POST['id_user'])));
            $name = mysqli_real_escape_string($con, htmlentities(trim($_POST['name'])));
            $quantity = mysqli_real_escape_string($con, htmlentities(trim($_POST['quantity'])));
            $unity_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['unity_price'])));
            $selling_price = mysqli_real_escape_string($con, htmlentities(trim($_POST['selling_price'])));

            if(empty($id_user)){header("Location: login.php");}
            if(empty($name)){array_push($errors, "Name is empty");}
            if(empty($quantity)){array_push($errors, "Quantity is empty");}
            if(empty($unity_price)){array_push($errors, "unity price is empty");}
            if(empty($selling_price)){array_push($errors, "Selling price is empty");}
            
            print "success";
            
        }

        if($_POST['action'] == 'search'){
            $txt = mysqli_real_escape_string($con, htmlentities(trim($_POST['search'])));
            $sql = mysqli_query($con, "SELECT * FROM stock WHERE (nom LIKE '%$txt%' || prix_unitaire LIKE '%$txt%')");

            if(@mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_array($sql)){
                    $output .= '
                    <div class="contentBox red">
                        <div>
                            <span>Name</span>
                            <small>'.$row['nom'].'</small>
                        </div>
                        <div>
                            <span>Prix unitaire</span>
                            <small>'.$row['prix_unitaire'].'</small>
                        </div>
                        <div>
                            <span>Prix de vente</span>
                            <small>'.$row['prix_de_vente'].'</small>
                        </div>
                        <div class="last">
                            <div class="btn-group">
                            <a href="stock.php?get='.$row['id_stock'].'" class="btn btn-sm btn-primary">Edit</a>
                            <a href="stock.php?delete='.$row['id_stock'].'" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                        </div>
                    ';
                }
            }else{
                $output = '<p class="alert alert-danger">There is not data found</p>';
            }
            print $output;
        }
    }

    if(isset($_GET['get'])){
        $id = mysqli_real_escape_string($con, htmlentities(trim($_GET['get'])));

        if(empty($id)){
            header("Location: stock.php");
        }else{
            $sql = mysqli_query($con, "SELECT * FROM stock WHERE id_stock = $id");
            if(@mysqli_num_rows($sql) == 1){
                $row = mysqli_fetch_assoc($sql);

                $name = $row['nom'];
                $unity_price = $row['prix_unitaire'];
                $selling_price = $row['prix_de_vente'];
                $quantity = $row['nombre'];
                
                $userId = $_SESSION['id_user'];
            }else{
                header("Location: stock.php");
            }
        }
    }