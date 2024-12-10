<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';
include('layout.php'); 
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `forms` WHERE user = $user_id LIMIT 5" ;
$transaction = mysqli_query($conn, $sql);



?>


<head>
    <title>Dashboard</title>
</head>

<style type="text/css">

footer{
    z-index:2;
    width: 100%;
    float: auto;
}
.navbar a.home{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}

body {
    position: relative;
    margin: 0;
    height: 100%; 
    overflow-x: hidden; 
    background-image: url('../includes/logo/bg1.png');
    background-size: cover;    
    background-position: center; 
    background-repeat: no-repeat; 
    background-attachment: fixed; 

}

</style>

<body>

        <div class="container mt-5">
            <div class="h1 fw-bold">Welcome!, <?= $_SESSION['fullname'];?></div>
            <!-- CONTENT -->
            <div class=" mt-5">
                <h3 class="mt-5 fw-bold">Recent Transaction's <i class="fa fa-history" aria-hidden="true"></i></h3>
                <?php if ($transaction->num_rows > 0) {
                    
                    while ($row = $transaction->fetch_assoc()) { ?>
                            <div class="card shadow-sm mt-4 p-3 mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <!-- Left section: Form details -->
                                                <div>
                                                    <h4 class="mb-2"><strong><?= $row['formtype'] ?></strong></h4>
                                                    <p class="mb-1"><strong>Name:</strong> <?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></p>
                                                    <p class="mb-1"><strong>Purpose:</strong> <?= $row['purpose'] ?></p>
                                                    <p class="mb-1"><strong>Date of request:</strong> <?= date('M d, Y (D)', strtotime($row['created_at'])); ?></p>
                                                    <p class="mt-2"><strong>Status: </strong><span style="background-color: #cce5ff; color: #004085;" class=" shadow-sm p-2   rounded fw-bold"><?= $row['status'] ?></span></p>
                                                </div>
                                                <div class="text-end">
                                                    <button data-bs-toggle="modal" data-bs-target="#Viewpending<?php echo $row['form_id'] ?>" class="btn mb-3 p-2 fw-bold shadow" style="width: 120px;">
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </button>
                                                    <br>
                                                    <?php if($row['status'] === "Pending")  { ?>
                                                    <button data-bs-toggle="modal" name="cancelbtn" data-bs-target="#Cancel<?= $row['form_id'] ?>" class="btn p-2 shadow fw-bold btn-warning" style="width: 120px;">
                                                        <i class="fa-solid fa-ban"></i> Cancel
                                                    </button>
                                                    <?php  } ?>
                                                </div>    

                                                <!-- VIEW PENDING MODAL -->
                                                <div class="modal fade" id="Viewpending<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">View File Request</h1>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mb-2 mt-2">Status :</label>
                                                                        <span class="alert w-100 rounded alert-primary fw-bold p-2 shadow-sm mb-3">
                                                                            <?= $row['status'] ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mb-2 mt-2">Reference No. :</label>
                                                                        <span class="alert alert-info fw-bold shadow-sm p-2  mb-3">
                                                                            <?= $row['ref'] ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mt-2">Request Date :</label>
                                                                        <input type="text" name="birthdate" value="<?= date('d M Y', strtotime($row['created_at'])); ?>" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label class="fw-bold h6 mt-2">Last Update</label>
                                                                        <input type="text" min="1" placeholder="20" value="<?= date('M d Y', strtotime($row['updated_at'])); ?>" name="age" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label class="fw-bold h6 mt-2">Type of Request</label>
                                                                        <select name="formtype" class="form-control shadow-sm mb-3" disabled>
                                                                            <option value="" disabled>Select a request type</option>
                                                                            <option value="Barangay Clearance" <?= $row['formtype'] == 'Barangay Clearance' ? 'selected' : '' ?>>Barangay Clearance</option>
                                                                            <option value="Certificate of Indigency" <?= $row['formtype'] == 'Certificate of Indigency' ? 'selected' : '' ?>>Certificate of Indigency</option>
                                                                            <option value="Barangay Certificate" <?= $row['formtype'] == 'Barangay Certificate' ? 'selected' : '' ?>>Barangay Certificate</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mt-2">Purpose</label>
                                                                        <input type="text" placeholder="E.g For work requirement" value="<?= $row['purpose'] ?>" name="purpose" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mt-2">Firstname</label>
                                                                        <input type="text" placeholder="Juan" value="<?= $row['fname'] ?>" name="firstname" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12">
                                                                        <label class="fw-bold h6 mt-2">Middlename</label>
                                                                        <input type="text" placeholder="Cruz" value="<?= $row['mname'] ?>" name="middlename" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12">
                                                                        <label class="fw-bold h6 mt-2">Lastname</label>
                                                                        <input type="text" placeholder="Dela Cruz" value="<?= $row['lname'] ?>" name="lastname" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mt-2">Birthdate</label>
                                                                        <input type="date" name="birthdate" value="<?= $row['bdate'] ?>" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <label class="fw-bold h6 mt-2">Age</label>
                                                                        <input type="number" min="1" placeholder="20" value="<?= $row['age'] ?>" name="age" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 mb-3">
                                                                        <label class="fw-bold h6 mt-2">Address</label>
                                                                        <input type="text" placeholder="Pugaro Manaoag Pangasinan" value="<?= $row['address'] ?>" name="address" class="form-control shadow-sm mb-3" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- CANCEL PENDING MODAL -->
                                                <div class="modal fade" id="Cancel<?= $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Cancel File Request</h1>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form action="../includes/functions.php" method="POST">
                                                                   <center>
                                                                       <p class="h5">Are you sure you want to cancel this request?</p>
                                                                       <input type="text" name="req_id" value="<?= $row['form_id'] ?>" class="form-control mb-3" hidden required>
                                                                   </center> 
                                                               </div>
                                                               <div class="modal-footer">
                                                                <button type="button" class="rounded p-2 w-25 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">No</button>
                                                                <button type="submit" name="cancelrequest" class="bg-warning border-0 rounded p-2 w-25   fw-bold shadow">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php }}  ?>
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