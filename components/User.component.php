<?php
    function LastUser(){
        global $con, $output;
        $output = "";
        
        $sql = mysqli_query($con, "SELECT username, id_user FROM users ORDER BY id_user DESC LIMIT 5");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<div class="list-group list-group-flush">';
            while($row = mysqli_fetch_array($sql)){
                $output .= '<a href="users.php?user='.$row['id_user'].'" class="list-group-item">'.$row['username'].'</a>';
            }
            $output .= '</div>';
        }else{
            $output = '<p class="alert alert-danger">You don\'t have data</p>';
        }
        echo $output;
    }

    LastUser();