<?php 
    require_once "./includes/header.php";
    require_once "./includes/projectName.php";
    require_once "./includes/navbar.php";
?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body shadow-md">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter the product name"
                                class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Quantity" min="0" require
                                class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unity price</label>
                            <input type="number" name="unity_price" id="unity_price" placeholder="unite price"
                                class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="sell_price">Selling price</label>
                            <input type="number" name="selling_price" id="selling_price" placeholder="Selling price"
                                class="form-control" />
                        </div>
                        <div class="form-group my-3">
                            <button type="submit" class="btn btn-primary btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-body shadow-md">
                    <form action="" method="post">
                        <input type="search" name="search" id="search" placeholder="Search..." class="form-control">
                    </form>
                    <div id="results" class="my-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Unite Price</th>
                                    <th>Selling Price</th>
                                    <th>Shop</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jordan</td>
                                    <td>23</td>
                                    <td>15000</td>
                                    <td>25000</td>
                                    <td>
                                        progress bar
                                    </td>
                                    <td>
                                        <div class="btn-sm btn-group">
                                            <button class="btn-sm btn-info btn">Edit</button>
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jordan</td>
                                    <td>23</td>
                                    <td>15000</td>
                                    <td>25000</td>
                                    <td>
                                        progress bar
                                    </td>
                                    <td>
                                        <div class="btn-sm btn-group">
                                            <button class="btn-sm btn-info btn">Edit</button>
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jordan</td>
                                    <td>23</td>
                                    <td>15000</td>
                                    <td>25000</td>
                                    <td>
                                        progress bar
                                    </td>
                                    <td>
                                        <div class="btn-sm btn-group">
                                            <button class="btn-sm btn-info btn">Edit</button>
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jordan</td>
                                    <td>23</td>
                                    <td>15000</td>
                                    <td>25000</td>
                                    <td>
                                        progress bar
                                    </td>
                                    <td>
                                        <div class="btn-sm btn-group">
                                            <button class="btn-sm btn-info btn">Edit</button>
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jordan</td>
                                    <td>23</td>
                                    <td>15000</td>
                                    <td>25000</td>
                                    <td>
                                        progress bar
                                    </td>
                                    <td>
                                        <div class="btn-sm btn-group">
                                            <button class="btn-sm btn-info btn">Edit</button>
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php require_once "./includes/footer.php";?>