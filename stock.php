<?php require_once "./includes/header.php";?>

<header class="bg-dark text-white py-3">
    <div class="container">
        <h1 class="text-center">Dashboard</h1>
    </div>
</header>

<?php require_once "./includes/navbar.php";?>

<main class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">All users</h2>
                        <p class="d-flex justify-content-between align-items-center">
                            <span>Nombre:</span>
                            <span>123345</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Male</h2>
                        <p class="d-flex justify-content-between align-items-center">
                            <span>Nombre:</span>
                            <span>123345</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Female</h2>
                        <p class="d-flex justify-content-between align-items-center">
                            <span>Nombre:</span>
                            <span class="badge badge-primary">123345</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Tableau de bord</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td>Actif</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td>Inactif</td>
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