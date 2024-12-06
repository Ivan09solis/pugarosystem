<?php
require_once '../conn/conn.php';
include 'layout.php';

?>

<style>
  .sidebar a.home{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
  }
</style>


<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
    <div class="navbar-title">
        <h2 class="title fw-bold p-3"> Dashboard</h3>
    </div>
    <div class="navbar-info">
        <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
</div>

<!-- CONTENT -->
 <div class=" mt-5">
 <div class="row mt-6 ">
    <div class="col-md-4">
        <div class="card round-2 mb-3 shadow round" style="border-left: solid red;">
            <div class="card-body">
                <div class="d-flex justify-content-between ">
                    <div class="h3">Resident's</div>
                    <div class="h1"><i class="fa-solid fa-users"></i></div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="display-4">
                            1
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="col-md-4">
        <div class="card   round-2 mb-3 shadow  round"style="border-left: solid blue;">
            <div class="card-body">
                <div class="d-flex justify-content-between ">
                    <div class="h3">Events</div>
                    <div class="h1"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="display-4">
                            2
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <div class="col-md-4">
        <div class="card   round-2 mb-3 shadow  round"style="border-left: solid green;">
            <div class="card-body">
                <div class="d-flex justify-content-between ">
                    <div class="h3">Applicants</div>
                    <div class="h1"><i class="fa-solid fa-clipboard-list"></i></div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="display-4">
                            3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
