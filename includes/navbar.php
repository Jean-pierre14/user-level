<?php 
    session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark  sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if ($_SERVER['SCRIPT_NAME'] === '/user-level/index.php') echo 'active'; ?>">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SERVER['SCRIPT_NAME'] === '/user-level/profile.php') echo 'active'; ?>"
                        href="profile.php">Profile</a>
                </li>
                <?php if($_SESSION['user_level'] == 'admin'):?>
                <li class="nav-item <?php if ($_SERVER['PHP_SELF'] === '/user-level/stock.php') echo 'active'; ?>">
                    <a class="nav-link" href="stock.php">Stock</a>
                </li>
                <?php endif;?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>