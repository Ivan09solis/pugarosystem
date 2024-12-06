<?php

session_start();
require_once '../includes/include.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {
  font-family: "Lato", sans-serif;
}

.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #00214D;
  overflow-x: hidden;
}

.sidebar a.active {
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}


  .logout, .title{
        text-decoration: none;
        color: #00214D;   
    }


.sidebar a {
  color: white;
  text-decoration: none;
  font-size: 15px;
  display: block;
  margin: 2px;
  padding: 7px;
  border-bottom-right-radius: 10px;
  border-top-left-radius: 10px;
}

.sidebar a:hover {
  color: #00214D;
  background-color: white;

}


#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}

#sidebar{
    width: 275px;
}

#main{
    margin-left: 275px;
}

</style>
</head>
<body>

<div id="sidebar" class="sidebar shadow-lg">
    <div class="mt-2 p-3  fw-bold ">
        <div>
            <center>
            <img src="../includes/logo/logo.gif" class="rounded-circle m-2" height="120px" width="120px" alt="">
            <h4 class="text-light fw-bold mb-4">Pugaro Management System</h5>
            </center>

        </div>
        <a href="home.php" class="home m-2 nav-link"><i class="fa-solid fa-gauge"></i>&nbsp;&nbsp; Dashboard</a>
        <a href="resident.php" class="resident m-2 nav-link "><i class="fa-solid fa-users"></i>&nbsp;&nbsp; Residents</a>
        <a href="blotter.php" class="blotter m-2 nav-link "><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp; Blotters</a>
        <a href="announcement.php" class="announcement m-2 nav-link "><i class="fa-solid fa-scroll"></i>&nbsp;&nbsp; Announcements</a>
        <a href="event.php" class="events m-2 nav-link "><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp; Barangay Events</a>
        <a href="application.php" class="application m-2 nav-link "><i class="fa-solid fa-folder"></i>&nbsp;&nbsp; Documents Request</a>
        <a href="forum.php" class="forum m-2 nav-link "><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp; Community Forums</a>
        <a href="feedback.php" class="feedback m-2 nav-link "><i class="fa-solid fa-comment"></i>&nbsp;&nbsp; Feedback & Suggestions</a>
        <a href="account.php" class="m-2 account"><i class="fa-solid fa-user"></i>&nbsp;&nbsp; Account</a>
        <a href="logout.php" class="m-2"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp; Logout</a>
    </div>
    </div>

<div id="main">
        <div id="page-content">
           
