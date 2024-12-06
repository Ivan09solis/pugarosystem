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

body {
            background-image: url('../includes/logo/bg1.png');
            background-size: cover;      
            background-position: center;  
            background-repeat: no-repeat; 
            height: 100vh;               
            margin: 0;                
        }

</style>

<body>
    <?php include('layout.php') ?>
        <div class="container mt-5">
            <div class="h1 fw-bold">Hello <?= $_SESSION['email'];?>,</div>
            <!-- CONTENT -->
            <div class=" mt-5">
                <h2 class="mt-5 fw-bold">Recents's <i class="fa fa-history" aria-hidden="true"></i></h2>

                <div class="card round-2 mt-3 mb-3 shadow round" style="border-top: solid #00214D;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <div class="h3">This is title </div>
                            <div class="h6">xcvxcxf</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, soluta eum! Quo amet omnis architecto accusantium eos officiis, corporis atque quia commodi aliquid quod aperiam, excepturi non sed tempore nesciunt!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card round-2 mt-3 mb-3 shadow round" style="border-top: solid #00214D;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <div class="h3">This is title </div>
                            <div class="h6">xcvxcxf</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, soluta eum! Quo amet omnis architecto accusantium eos officiis, corporis atque quia commodi aliquid quod aperiam, excepturi non sed tempore nesciunt!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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