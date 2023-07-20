<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
    require_once "./config/action.php";
?>

<main class="py-4">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <?= AllUsersCount();?>
            </div>
            <div class="col-lg-4 mb-4">
                <?= AllMale();?>
            </div>
            <div class="col-lg-4 mb-4">
                <?= AllFemale();?>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-md-5 mb-4">
                <div class="card card-body shadow-sm">
                    <h3>Last User</h3>
                    <?php require_once "./components/User.component.php";?>
                </div>
            </div>
            <div class="col-md-7 mb-4">
                <div class="card card-body shadow-sm">
                    <h3>Connected</h3>
                    <?php require_once "./components/Connected.components.php";?>
                </div>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-md-4">
                <?= Admin();?>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>