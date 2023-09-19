<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
    require_once "./config/action.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row py-3 m-3 justify-content-center">
            <div class="col-md-4 col-lg-4">
                <div class="box white-bg">
                    <div class="btn-group">
                        <a href="users.php?event=createUser" class="btn btn-lg btn-success">Register</a>
                        <a href="users.php" class="btn btn-lg btn-primary">List of user</a>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($_GET['event'])):
        
            require_once "./includes/registration.php";
            ?>

        <?php else:?>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Tableau de bord</h2>
                        <?= AllUsers();?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

    </div>
</main>



<?php require_once "./includes/footer.php";?>