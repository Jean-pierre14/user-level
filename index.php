<?php require_once "./includes/header.php";?>

    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="text-center">Dashboard</h1>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <!-- Place des éléments du menu de navigation ici -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <!-- Ajoutez d'autres liens de navigation ici -->
            </ul>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Widget 1</h2>
                            <!-- Place le contenu du widget 1 ici -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Widget 2</h2>
                            <!-- Place le contenu du widget 2 ici -->
                        </div>
                    </div>
                </div>
                <!-- Ajoutez d'autres widgets ici -->
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
                                    <!-- Ajoutez d'autres lignes du tableau ici -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    

    <?php require_once "./includes/footer.php";?>