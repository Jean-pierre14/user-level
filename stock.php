<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card my-2 card-body shadow-md">
                    <?php 
                        require_once "./config/action.php";
                        require_once "./includes/error.php";
                    ?>
                    <form action="" method="post" id="myFormStock">
                        <div id="error"></div>
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
                            <button type="submit" name="update" id="updateBtn"
                                class="btn btn-warning btn">Update</button>
                            <?php else:?>
                            <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary btn">Save</button>
                            <?php endif;?>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card my-2 card-body shadow-md">
                    <form action="" method="post" id="searchForm">
                        <input type="search" name="search" id="search" placeholder="Search..." class="form-control">
                    </form>
                </div>
                <div id="results" class="my-3">
                    Loading...
                </div>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>

<script>
const results = document.getElementById("results"),
    form = document.getElementById("myFormStock"),
    btnSave = document.getElementById("btnSave"),
    error = document.getElementById("error"),
    searchForm = document.getElementById("searchForm"),
    editButton = document.querySelector(".editBtn")

editButton.onclick = () => {
    editEvent
}

$(document).ready(function() {
    getAll();
    setTimeout(function() {
        document.getElementById("ErrorMessage").style.display = "none"
    }, 3000)
})

const search = document.getElementById("search")

search.onkeyup = (event) => {
    let txt = event.target.value.trim()
    if (txt != "") {
        results.innerHTML = ''
        let xhr = new XMLHttpRequest()
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response
                    results.innerHTML = data
                }
            }
        }
        let formData = new FormData(searchForm)
        formData.append("action", "search")
        xhr.open("POST", "./config/action.php", true)
        xhr.send(formData)
    } else {
        getAll()
    }
}

form.onsubmit = (event) => {
    event.preventDefault()
}

btnSave.onclick = () => {
    let xhr = new XMLHttpRequest()
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response
                if (data === 'success') {
                    form.reset();
                    error.innerHTML = `<p class="alert alert-success" id="ErrorMessage">Data registered :)</p>`
                    getAll();
                } else {
                    error.innerHTML = `<p class="alert alert-danger" id="ErrorMessage">${data}</p>`
                }
            }
        }
    }
    let formData = new FormData(form),
        action = "postStock";
    formData.append("action", action)
    xhr.open("POST", "./config/action.php", true)
    xhr.send(formData)
}

const btnUpdate = document.getElementById("updateBtn")
btnUpdate.onclick = () => {

    let xhr = new XMLHttpRequest()
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response
                if (data === 'success') {
                    location.href = `stock.php`
                } else {
                    error.innerHTML = `<p class="alert alert-danger" id="ErrorMessage">${data}</p>`;
                }
            }
        }
    }
    let action = 'update'
    let formData = new FormData()
    formData.append("action", action)

    xhr.open("POST", "./config/action.php", true)
    xhr.send(formData)
}

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