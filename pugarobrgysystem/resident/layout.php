<?php
session_start();
require_once '../includes/include.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 1) {
    header("location:login.php");
}

?>

<style type="text/css">
.navbar{
height: 100px;
background-color: #00214D;
}

.navbar a {
  color: white;
  text-decoration: none;
  font-size: 12px;
  display: block;
    padding: 7px;
  border-bottom-right-radius: 10px;
  border-top-left-radius: 10px;
}

.navbar a:hover {
  color: #00214D;
  background-color: white;

}


.navbar-collapse {
    background-color: #00214D; 
}
/*
.navbar-nav .nav-link {
    color: #ffffff; /* Adjust link color if needed */
}
*/
.navbar-nav .nav-link:hover {
    background-color: #00214D; /* Optional: Add hover effect */
}

</style>


     

<nav class="navbar sticky-top  navbar-expand-lg p-3 shadow-lg">
    <!-- <div class="container"> -->
        <img src="../includes/logo/logo.gif" class="rounded-circle p-2" height="60" width="60" margin="5">
            <h3 class="text-light">Pugaro Management System</h3>
        <button class="navbar-toggler bg-light text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4 home" href="home.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4 forms" href="forms.php"><i class="fa-solid fa-folder-open"></i>&nbsp;Forms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4 announcement" href="announcements.php"><i class="fa-solid fa-bullhorn"></i>&nbsp;Updates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4 forum" href="forum.php"><i class="fa-solid fa-sitemap"></i>&nbsp;Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4" href="feedback.php"><i class="fa-solid fa-user"></i>&nbsp;Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold me-4" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </li>
            </ul>
        <!-- </div> -->
    </div>
</nav>





