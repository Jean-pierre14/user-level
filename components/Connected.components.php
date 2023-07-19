<?php
    function Connected(){
        global $con, $output;

        $output = '';

        $sql = mysqli_query($con, "SELECT username, id_user, `status` FROM users WHERE `status` = 'active' ORDER BY id_user DESC LIMIT 5");

        if(@mysqli_num_rows($sql) > 0){
            $output .= '<div class="list-group list-group-flush">';
            while($row = mysqli_fetch_array($sql)){
                $output .= '<a href="users.php?user='.$row['id_user'].'" class="d-flex justify-content-between align-items-center list-group-item">
                    <span>'.$row['username'].'</span>
                    <span class="badge badge-primary">'.$row['status'].'</span>
                </a>';
            }
            $output .= '</div>';
        }else{$output = '<p class="alert alert-warning">No one is connected</p>';}
        echo $output;
    }

    Connected();