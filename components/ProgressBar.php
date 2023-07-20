<?php
    function Admin(){
        global $con, $output;
        $output = "";

        $sql = mysqli_query($con, "SELECT COUNT(id_user) AS admin_count FROM users WHERE user_level = 'admin'");
        if(@mysqli_num_rows($sql) == 1){
            $row = mysqli_fetch_array($sql);
            $output = '
            
            ';
        }else{
            $output = '<p class="alert alert-info">There no admin</p>';
        }
        return $output;
    }
?>