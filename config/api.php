<?php

    require_once "./api_functions.php";

    header("Content-Type: application/json");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['id'])){
            $user = getDataById($_GET['id']);
            echo json_encode($user);
        }else{
            $users = GetData();
            echo json_encode($users);
        }
    }else{
        http_response_code(405);
        echo json_encode(array("message" => "Method Not allowed"));
    }

    // New endpoint: /users
    if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['endpoint'] === 'users'){
        $users = getUsers();
        echo json_encode($users);
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['endpoint'] === 'users'){

    }elseif($_SERVER['REQUEST_METHOD'] === 'PUT' && $_GET['endpoint'] === 'users'){
        
    }elseif($_SERVER['REQUEST_METHOD'] === 'DELETE' && $_GET['endpoint'] === 'users'){}