<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';

?>


<head>
    <title>Dashboard</title>
</head>

<style type="text/css">
.navbar a.home{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}
</style>

<body>
    <?php include('layout.php') ?>

    <div class="container mt-5">

        <div class="h1 fw-bold">Hello <?= $_SESSION['email'];?>,</div>


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


        <h2 class="mt-5 fw-bold">Recents's <i class="fa fa-history" aria-hidden="true"></i></h2>



    </div>
</div>

<script>
    function deleteR(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I changed my mind'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("../php/delete_reservation.php", {
                    id: id
                },
                function() {
                    Swal.fire({
                        title: 'Deleted Successfully',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                });
            }
        })
    }
</script>
</body>
<?php include('footer.php') ?>

</html>