<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';

include 'layout.php';
$date = date('Y-m-d');
$user_id = $_SESSION['user_id'];

// QUERY FOR PENDING LIST
$sql = "SELECT * FROM `forms` WHERE `user` = $user_id AND `status` = 'Pending' order by `form_id` DESC";
$pending = mysqli_query($conn, $sql);


// QUERY FOR CANCEL MODAL
if (isset($_POST['cancelbtn'])) {
    $data = $_POST['cancelbtn'];
    echo $data;
    $sql = "SELECT * FROM `forms` WHERE `form_id` = $data";
    $cancel = mysqli_query($conn, $sql);
    if ($cancel->num_rows > 0) {
        $item = $cancel->fetch_assoc();
    }
}

// QUERY FOR ACCEPTED LIST
$sql = "SELECT * FROM `forms` WHERE `user` = $user_id AND `status` = 'Accepted' order by `form_id` DESC";
$accepted = mysqli_query($conn, $sql);

// QUERY FOR DECLINED LIST
$sql = "SELECT * FROM `forms` WHERE `user` = $user_id AND `status` = 'Declined' order by `form_id` DESC";
$declined = mysqli_query($conn, $sql);

// QUERY FOR CANCELLED LIST
$sql = "SELECT * FROM `forms` WHERE `user` = $user_id AND `status` = 'Cancelled' order by `form_id` DESC";
$cancelled = mysqli_query($conn, $sql);


// QUERY FOR CANCELLED LIST
$sql = "SELECT * FROM `forms` WHERE `user` = $user_id order by `form_id` DESC";
$all = mysqli_query($conn, $sql);





?>


<head>
    <title>File Request</title>
</head>

<style type="text/css">
.navbar a.forms{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}

h2, h1, .h4 , .date, .nav-link{
    color: #00214D;
}

.nav-link:hover, label{
    color: #00214D;
}


.newreq:hover, .clearance{
    background-color: #00214D;
    color: white;
}

.list {
    background-color: #00214D;
    color: white;
}

.nav-pills .nav-link.active {
    background-color: #00214D;
    color: #fff;
}

.nav-pills .nav-link {
    background-color: white;
    color: #00214D;
    width: 150px;
}

.card {
    border-radius: 15px;
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

<script type="text/javascript">

    <?php
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            ?>
            Swal.fire({
                toast: true, 
                position: 'top-end', 
                icon: "<?php echo $_SESSION['status_code'] ?>",
                title: "<?php echo $_SESSION['status'] ?>",
                text: "<?php echo $_SESSION['message'] ?>",
                showConfirmButton: false, 
                timer: 5000, 
                timerProgressBar: true, 
            });
            <?php
            unset($_SESSION['status']);
        }
    ?>



$(document).ready(function() {

    $('#table').DataTable({
        responsive: true,
        dom: 'lBfrtip',//Blfrtip
        colReorder: true,
        iDisplayLength: 25,
        lengthMenu: [25, 50, 75, 100, 500],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false ,
        buttons: [
        'excel'
        ],
        order: [[0, "desc"]]
    });


    
    $('#tabledeclined').DataTable({
        responsive: true,
        dom: 'lBfrtip',//Blfrtip
        colReorder: true,
        iDisplayLength: 25,
        lengthMenu: [25, 50, 75, 100, 500],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false ,
        buttons: [
        'excel'
        ],
        order: [[0, "desc"]]
    });


    $('#tablecancelled').DataTable({
        responsive: true,
        dom: 'lBfrtip',//Blfrtip
        colReorder: true,
        iDisplayLength: 25,
        lengthMenu: [25, 50, 75, 100, 500],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false ,
        buttons: [
        'excel'
        ],
        order: [[0, "desc"]]
    });
    

    $('#tableall').DataTable({
        responsive: true,
        dom: 'lBfrtip',//Blfrtip
        colReorder: true,
        iDisplayLength: 25,
        lengthMenu: [25, 50, 75, 100, 500],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false ,
        buttons: [
        'excel'
        ],
        order: [[0, "desc"]]
    });
    
});


</script>

<body>
    <div class="container mt-5">
        <h2 class="fw-bold">Online Application Forms</h2>
        <div class=" mt-5">
            <div class="nav  nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active ms-auto p-3 m-1 shadow rounded fw-bold" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pending</button>
                <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home4-tab" data-bs-toggle="tab" data-bs-target="#nav-home4" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">Cancelled</button>
                <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home3-tab" data-bs-toggle="tab" data-bs-target="#nav-home3" type="button" role="tab" aria-controls="nav-home3" aria-selected="false">Declined</button>
                <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home2-tab" data-bs-toggle="tab" data-bs-target="#nav-home2" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">Accepted</button>
                <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home2-tab" data-bs-toggle="tab" data-bs-target="#nav-home5" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">All</button>
            </div>






            
            <div class="tab-content mt-5 mb-5" id="nav-tabContent">
                <!-- PENDING LIST -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="card mt-3 shadow-lg border-0 p-5 mb-5" >
                        <div class="card-body ">
                            <div class="d-flex justify-content-between">
                                <div class="h3  mb-5">
                                    List of Pending Applications 
                                </div>
                                <div class="h6 date">
                                    <i class="fas fa-calendar-day"></i> <?= date('d M, Y (D)', strtotime($date));  ?>
                                </div>
                            </div>

                            <button  data-bs-toggle="modal" data-bs-target="#addlist" style="background-color: #00214D; color: white;
                            " class="btn fw-bold border-0 p-3 mb-5 shadow newreq"><i class="fa-solid fa-plus"></i> New Request</button>
                            <p class="fw-bold">Latest Transactions: <?= mysqli_num_rows($pending); ?> items</p>
                            <?php if ($pending->num_rows > 0) {
                                while ($row = $pending->fetch_assoc()) {
                                    ?>
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
                                                    <button data-bs-toggle="modal" name="cancelbtn" data-bs-target="#Cancel<?= $row['form_id'] ?>" class="btn p-2 shadow fw-bold btn-warning" style="width: 120px;">
                                                        <i class="fa-solid fa-ban"></i> Cancel
                                                    </button>
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

                            <?php } }
                            else{?> 
                                <p class="text-secondary mt-5 fw-bold h1 text-center opacity-25">Nothing To Show</p>
                            <?php } ?>
                        </div>
                    </div>





                </div>

                <!-- ACCEPTED TABLE  -->
                <div class="tab-pane fade" id="nav-home2" role="tabpanel" aria-labelledby="nav-accept-tab" tabindex="0">
                    <div class="card shadow-lg border-0 p-5 mb-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="h3 mb-5">
                                    List of Accepted Applications 
                                </div>
                                <div class="h6 date">
                                    <i class="fas fa-calendar-day"></i> <?= date('d M, Y (D)', strtotime($date)); ?>
                                </div>
                            </div>
                            <button data-bs-toggle="modal" data-bs-target="#addlist" style="background-color: #00214D; color: white;" class="btn fw-bold border-0 p-3 mb-5 shadow newreq">
                                <i class="fa-solid fa-plus"></i> New Request
                            </button>
                            <table class="shadow rounded dataTable mb-3 mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference</th>
                                        <th>Name</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Last Update</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($accepted) > 0) {
                                        $count = 1;
                                        while ($row = $accepted->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $row['ref'] ?></td>
                                                <td><?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></td>
                                                <td><?= $row['purpose'] ?></td>
                                                <td >
                                                    <span style="background-color: #d4edda; color: #155724;" class=" shadow-sm p-2 m-5  rounded fw-bold">
                                                        <?= $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td><?= $row['updated_at'] ?></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold shadow-lg m-1" style="color: #00214D ;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- VIEW ACCEPTED MODAL -->
                                        <div class="modal fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">View File Request</h1>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 mb-3">
                                                                <label class="fw-bold h6 mb-2 mt-2">Status :</label>
                                                                <span class="alert w-100 rounded alert-success fw-bold p-2 shadow-sm mb-3">
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
                                                                <select name="address" id="" class="form-select mb-3" required>
                                                                    <option value="">Select--</option>
                                                                    <option value="Zone 1"<?php if ($row['address'] == 'Zone 1') echo 'selected'; ?>>Zone 1</option>
                                                                    <option value="Zone 2"<?php if ($row['address'] == 'Zone 2') echo 'selected'; ?>>Zone 2</option>
                                                                    <option value="Zone 3"<?php if ($row['address'] == 'Zone 3') echo 'selected'; ?>>Zone 3</option>
                                                                    <option value="Zone 4"<?php if ($row['address'] == 'Zone 4') echo 'selected'; ?>>Zone 4</option>
                                                                    <option value="Zone 5"<?php if ($row['address'] == 'Zone 5') echo 'selected'; ?>>Zone 5</option>
                                                                    <option value="Zone 6"<?php if ($row['address'] == 'Zone 6') echo 'selected'; ?>>Zone 6</option>
                                                                    <option value="Zone 7"<?php if ($row['address'] == 'Zone 7') echo 'selected'; ?>>Zone 7</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $count += 1; }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                <!-- DECLINED TABLE  -->
                <div class="tab-pane fade" id="nav-home3" role="tabpanel" aria-labelledby="nav-decline-tab" tabindex="0">
                    <div class="card shadow-lg border-0 p-5 mb-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="h3 mb-5">
                                    List of Declined Applications 
                                </div>
                                <div class="h6 date">
                                    <i class="fas fa-calendar-day"></i> <?= date('d M, Y (D)', strtotime($date)); ?>
                                </div>
                            </div>
                            <button data-bs-toggle="modal" data-bs-target="#addlist" style="background-color: #00214D; color: white;" class="btn fw-bold border-0 p-3 mb-5 shadow newreq">
                                <i class="fa-solid fa-plus"></i> New Request
                            </button>
                            <table class="shadow rounded dataTable mb-3 mt-3" id="tabledeclined">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reference</th>
                                        <th>Name</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Last Update</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($declined) > 0) {
                                        $count = 1;
                                        while ($row = $declined->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $row['ref'] ?></td>
                                                <td><?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></td>
                                                <td><?= $row['purpose'] ?></td>
                                                <td >
                                                    <span style="background-color: #f8d7da; color: #721c24;" class=" shadow-sm p-2 m-5 rounded fw-bold">
                                                        <?= $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td><?= $row['updated_at'] ?></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold shadow-lg m-1" style="color: #00214D ;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- VIEW ACCEPTED MODAL -->
                                        <div class="modal fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">View File Request</h1>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 mb-3">
                                                                <label class="fw-bold h6 mb-2 mt-2">Status :</label>
                                                                <span class="alert w-100 rounded alert-danger fw-bold p-2 shadow-sm mb-3">
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
                                                                <select name="address" id="" class="form-select mb-3" required>
                                                                    <option value="">Select--</option>
                                                                    <option value="Zone 1"<?php if ($row['address'] == 'Zone 1') echo 'selected'; ?>>Zone 1</option>
                                                                    <option value="Zone 2"<?php if ($row['address'] == 'Zone 2') echo 'selected'; ?>>Zone 2</option>
                                                                    <option value="Zone 3"<?php if ($row['address'] == 'Zone 3') echo 'selected'; ?>>Zone 3</option>
                                                                    <option value="Zone 4"<?php if ($row['address'] == 'Zone 4') echo 'selected'; ?>>Zone 4</option>
                                                                    <option value="Zone 5"<?php if ($row['address'] == 'Zone 5') echo 'selected'; ?>>Zone 5</option>
                                                                    <option value="Zone 6"<?php if ($row['address'] == 'Zone 6') echo 'selected'; ?>>Zone 6</option>
                                                                    <option value="Zone 7"<?php if ($row['address'] == 'Zone 7') echo 'selected'; ?>>Zone 7</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $count += 1; }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                    <!-- CANCELED TABLE  -->
                    <div class="tab-pane fade" id="nav-home4" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
                        <div class="card shadow-lg border-0 p-5 mb-5">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="h3 mb-5">
                                        List of Cancelled Applications 
                                    </div>
                                    <div class="h6 date">
                                        <i class="fas fa-calendar-day"></i> <?= date('d M, Y (D)', strtotime($date)); ?>
                                    </div>
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#addlist" style="background-color: #00214D; color: white;" class="btn fw-bold border-0 p-3 mb-5 shadow newreq">
                                    <i class="fa-solid fa-plus"></i> New Request
                                </button>
                                <table class="shadow rounded dataTable mb-3 mt-3" id="tablecancelled">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference</th>
                                            <th>Name</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Date Requested</th>
                                            <th>Last Update</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($cancelled) > 0) {
                                            $count = 1;
                                            while ($row = $cancelled->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $row['ref'] ?></td>
                                                    <td><?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></td>
                                                    <td><?= $row['purpose'] ?></td>
                                                    <td class=" w-auto">
                                                        <span style="background-color: #fff3cd; color: #856404;" class=" shadow-sm p-2 m-5 rounded fw-bold">
                                                            <?= $row['status'] ?>
                                                        </span>
                                                    </td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td><?= $row['updated_at'] ?></td>
                                                    <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold  shadow-lg m-1" style="color: #00214D ;">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- VIEW ACCEPTED MODAL -->
                                            <div class="modal fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">View File Request</h1>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-12 mb-3">
                                                                    <label class="fw-bold h6 mb-2 mt-2">Status :</label>
                                                                    <span class="alert w-100 rounded alert-warning fw-bold p-2 shadow-sm mb-3">
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
                                                                    <label class="fw-bold h6 mt-2">Address</label>                                      <select name="address" id="" class="form-select mb-3" required>
                                                                        <option value="">Select--</option>
                                                                        <option value="Zone 1"<?php if ($row['address'] == 'Zone 1') echo 'selected'; ?>>Zone 1</option>
                                                                        <option value="Zone 2"<?php if ($row['address'] == 'Zone 2') echo 'selected'; ?>>Zone 2</option>
                                                                        <option value="Zone 3"<?php if ($row['address'] == 'Zone 3') echo 'selected'; ?>>Zone 3</option>
                                                                        <option value="Zone 4"<?php if ($row['address'] == 'Zone 4') echo 'selected'; ?>>Zone 4</option>
                                                                        <option value="Zone 5"<?php if ($row['address'] == 'Zone 5') echo 'selected'; ?>>Zone 5</option>
                                                                        <option value="Zone 6"<?php if ($row['address'] == 'Zone 6') echo 'selected'; ?>>Zone 6</option>
                                                                        <option value="Zone 7"<?php if ($row['address'] == 'Zone 7') echo 'selected'; ?>>Zone 7</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count += 1; }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                     


                    <!-- CANCELED TABLE  -->
                    <div class="tab-pane fade" id="nav-home5" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
                        <div class="card shadow-lg border-0 p-5 mb-5">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="h3 mb-5">
                                        List of All Applications 
                                    </div>
                                    <div class="h6 date">
                                        <i class="fas fa-calendar-day"></i> <?= date('d M, Y (D)', strtotime($date)); ?>
                                    </div>
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#addlist" style="background-color: #00214D; color: white;" class="btn fw-bold border-0 p-3 mb-5 shadow newreq">
                                    <i class="fa-solid fa-plus"></i> New Request
                                </button>
                                <table class="shadow rounded dataTable mb-3 mt-3" id="tableall">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reference</th>
                                            <th>Name</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Date Requested</th>
                                            <th>Last Update</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($all) > 0) {
                                            $count = 1;
                                            while ($row = $all->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $row['ref'] ?></td>
                                                    <td><?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></td>
                                                    <td><?= $row['purpose'] ?></td>
                                                    <td class="w-auto">
                                                        <?php 
                                                        $statusColors = [
                                                            'Accepted' => ['bg' => '#d4edda', 'text' => '#155724'],
                                                            'Declined' => ['bg' => '#f8d7da', 'text' => '#721c24'],
                                                            'Cancelled' => ['bg' => '#fff3cd', 'text' => '#856404'],
                                                            'Pending' => ['bg' => '#cce5ff', 'text' => '#004085'],
                                                        ];

                                                        if (isset($statusColors[$row['status']])) { 
                                                            $colors = $statusColors[$row['status']];
                                                            ?>
                                                            <span style="background-color: <?= $colors['bg'] ?>; color: <?= $colors['text'] ?>;" class="shadow-sm p-2 w-100 m-5 rounded fw-bold">
                                                                <?= $row['status'] ?>
                                                            </span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td><?= $row['updated_at'] ?></td>
                                                    <td><button data-bs-toggle="modal" data-bs-target="#Viewall<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold shadow-lg m-1" style="color: #00214D ;">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- VIEW ACCEPTED MODAL -->
                                            <div class="modal fade" id="Viewall<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">View File Request</h1>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-12 mb-3">
                                                                    <label class="fw-bold h6 mb-2 mt-2">Status :</label>
                                                                    <?php 
                                                                    $alertClasses = [
                                                                        'Accepted'  => 'alert-success',
                                                                        'Declined'  => 'alert-danger',
                                                                        'Cancelled' => 'alert-warning',
                                                                        'Pending'   => 'alert-primary',
                                                                    ];

                                                                    if (isset($alertClasses[$row['status']])) {
                                                                        $alertClass = $alertClasses[$row['status']];
                                                                        ?>
                                                                        <span class="alert w-100 rounded <?= $alertClass ?> fw-bold p-2 shadow-sm mb-3">
                                                                            <?= $row['status'] ?>
                                                                        </span>
                                                                    <?php } ?>
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
                                                                    <select name="address" id="" class="form-select mb-3" required>
                                                                        <option value="">Select--</option>
                                                                        <option value="Zone 1"<?php if ($row['address'] == 'Zone 1') echo 'selected'; ?>>Zone 1</option>
                                                                        <option value="Zone 2"<?php if ($row['address'] == 'Zone 2') echo 'selected'; ?>>Zone 2</option>
                                                                        <option value="Zone 3"<?php if ($row['address'] == 'Zone 3') echo 'selected'; ?>>Zone 3</option>
                                                                        <option value="Zone 4"<?php if ($row['address'] == 'Zone 4') echo 'selected'; ?>>Zone 4</option>
                                                                        <option value="Zone 5"<?php if ($row['address'] == 'Zone 5') echo 'selected'; ?>>Zone 5</option>
                                                                        <option value="Zone 6"<?php if ($row['address'] == 'Zone 6') echo 'selected'; ?>>Zone 6</option>
                                                                        <option value="Zone 7"<?php if ($row['address'] == 'Zone 7') echo 'selected'; ?>>Zone 7</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count += 1; }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- Add  Modal -->
                        <div class="modal fade" id="addlist" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="    true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">New File Request</h1>
                                    </div>
                                    <form action="../includes/functions.php" method="POST"  enctype="multipart/form-data">
                                      <div class="modal-body p-4">
                                        <div class="row">
                                            <!-- Purpose -->
                                            <div class="col-md-6 col-sm-12">
                                                <label class="fw-bold h6 mt-2">Type of Request</label>
                                                <select name="formtype" class="form-control mb-3" required>
                                                    <option value="" disabled selected>Select a request type</option>
                                                    <option value="Barangay Clearance">Barangay Clearance</option>
                                                    <option value="Certificate of Indigency">Certificate of Indigency</option>
                                                    <option value="Barangay Certificate">Barangay Certificate</option>
                                                    <option value="Barangay First Time Job Seeker">Barangay First Time Job Seeker</option>
                                                    <option value="Certificate of Residency">Certificate of Residency</option>
                                                </select>
                                            </div>
                                            <!-- Purpose -->
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="fw-bold h6   mt-2">Purpose</label>
                                                <input type="text" placeholder="E.g For work requirement" name="purpose" class="form-control mb-3" required>
                                            </div>
                                            <!-- Firstname -->
                                            <div class="col-md-4 col-sm-12 mb-3">
                                                <label class="fw-bold h6 mt-2">Firstname</label>
                                                <input type="text" placeholder="Juan" name="firstname" class="form-control mb-3" required>
                                            </div>
                                            <!-- Middlename -->
                                            <div class="col-md-4 col-sm-12">
                                                <label class="fw-bold h6 mt-2">Middlename</label>
                                                <input type="text" placeholder="Cruz" name="middlename" class="form-control mb-3">
                                            </div>
                                            <!-- Lastname -->
                                            <div class="col-md-4 col-sm-12">
                                                <label class="fw-bold h6 mt-2">Lastname</label>
                                                <input type="text" placeholder="Dela Cruz" name="lastname" class="form-control mb-3" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Birthdate -->
                                            <div class="col-md-6 col-sm-12 mb-3">
                                                <label class="fw-bold h6 mt-2">Birthdate</label>
                                                <input type="date" name="birthdate" class="form-control mb-3" required>
                                            </div>
                                            <!-- Age -->
                                            <div class="col-md-6 col-sm-12">
                                                <label class="fw-bold h6 mt-2">Age</label>
                                                <input type="number" min="1" placeholder="20" name="age" class="form-control mb-3" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Address -->
                                            <div class="col-md-12 col-sm-12 mb-3">
                                                <label class="fw-bold h6 mt-2">Address</label>
                                                <select name="address" id="" class="form-select mb-3" required>
                                                    <option value="">Select--</option>
                                                    <option value="Zone 1">Zone 1</option>
                                                    <option value="Zone 2">Zone 2</option>
                                                    <option value="Zone 3">Zone 3</option>
                                                    <option value="Zone 4">Zone 4</option>
                                                    <option value="Zone 5">Zone 5</option>
                                                    <option value="Zone 6">Zone 6</option>
                                                    <option value="Zone 7">Zone 7</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="rounded p-3 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="newrequest" class="clearance border-0 rounded p-3 fw-bold shadow">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include('footer.php') ?>

