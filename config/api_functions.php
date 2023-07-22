<?php
    require_once "./db.config.php";
    
    function GetData(){
        global $con;
        $output = array();

        $sql = mysqli_query($con, "SELECT * FROM stock");
        
        $data = array();
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }
        return $data;
    }

    function getDataById($id){
        global $con;
        $id = mysqli_real_escape_string($con, $id);
        $query = "SELECT * FROM stock WHERE id_stock = '$id'";
        $result = mysqli_query($con, $query);
        $oneData = mysqli_fetch_assoc($result);

        return $oneData;
    }

    function getUsers(){
        global $con;
        $users = array();

        $sql = mysqli_query($con, "SELECT * FROM users");
        while($row = mysqli_fetch_assoc($sql)){
            $users[] = $row;
        }
        return $users;
    }

    function getUserById($id){
        global $con;

        $id = mysqli_real_escape_string($con, htmlentities(trim($id)));
        $sql = mysqli_query($con, "SELECT * FROM users WHERE id_user = '$id'");
        $user = mysqli_fetch_assoc($sql);

        return $user;
    }