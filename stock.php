<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body shadow-md">
                    <?php 
                        require_once "./config/action.php";
                        require_once "./includes/error.php";
                    ?>
                    <form action="" method="post" id="myFormStock">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'];?>"
                                class="form-control" />

                            <input type="text" name="name" value="<?= (isset($name)) ? $name : ''?>" id="name"
                                placeholder="Enter the product name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" value="<?= (isset($quantity)) ? $quantity : ''?>"
                                id="quantity" placeholder="Quantity" min="0" require class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unity price</label>
                            <input type="number" value="<?= (isset($unity_price)) ? $unity_price : ''?>"
                                name="unity_price" id="unity_price" placeholder="unite price" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="sell_price">Selling price</label>
                            <input type="number" value="<?= (isset($selling_price)) ? $selling_price : ''?>"
                                name="selling_price" id="selling_price" placeholder="Selling price"
                                class="form-control" />
                        </div>
                        <div class="form-group my-3">
                            <?php if(isset($_GET['get'])):?>
                            <button type="submit" name="update" id="update" class="btn btn-warning btn">Update</button>
                            <?php else:?>
                            <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary btn">Save</button>
                            <?php endif;?>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-body shadow-md">
                    <form action="" method="post">
                        <input type="search" name="search" id="search" placeholder="Search..." class="form-control">
                    </form>
                    <div id="results" class="my-3">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>

<script>
const results = document.getElementById("results")

$(document).ready(function() {
    getAll();
})

function getAll() {
    let xhr = new XMLHttpRequest()
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response
                results.innerHTML = data;
            }
        }
    }
    let action = 'fetch';
    let formData = new FormData();
    formData.append("action", action);
    xhr.open("POST", "./config/action.php", true)
    xhr.send(formData)
}
</script>