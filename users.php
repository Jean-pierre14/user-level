<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
    require_once "./config/action.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Tableau de bord</h2>
                        
                            <?= AllUsers();?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>