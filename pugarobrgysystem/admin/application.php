<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';
// session_start();


include 'layout.php';
$date = date('Y-m-d');
// $user_id = $_SESSION['user_id'];

// QUERY FOR PENDING LIST
$sql = "SELECT * FROM `forms` WHERE `status` = 'Pending' order by `form_id` DESC";
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
$sql = "SELECT * FROM `forms` WHERE  `status` = 'Accepted' order by `form_id` DESC";
$accepted = mysqli_query($conn, $sql);

// QUERY FOR DECLINED LIST
$sql = "SELECT * FROM `forms` WHERE  `status` = 'Declined' order by `form_id` DESC";
$declined = mysqli_query($conn, $sql);

// QUERY FOR CANCELLED LIST
$sql = "SELECT * FROM `forms` WHERE  `status` = 'Cancelled' order by `form_id` DESC";
$cancelled = mysqli_query($conn, $sql);


// QUERY FOR CANCELLED LIST
$sql = "SELECT * FROM `forms` order by `form_id` DESC";
$all = mysqli_query($conn, $sql);


?>


<style>
.sidebar a.application{
  color: #00214D;
  background-color: white;
  box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
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

body {
        background-image: url('../includes/logo/bg3.gif');
        background-size: cover;      
        background-position: center;  
        background-repeat: no-repeat; 
        height: 100vh;               
        margin: 0;                
    }
</style>


<script type="text/javascript">
  <?php 
  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    Swal.fire({
        title: "<?php echo $_SESSION['status'] ?>",
        icon: "<?php echo $_SESSION['status_code'] ?>",
        text: "<?php echo $_SESSION['message'] ?>",
        button: "Okay",
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = "application";
        }
    });
    <?php
    unset($_SESSION['status']);
}?>



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



<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
  <div class="navbar-title">
    <h2 class="title fw-bold p-3">Applicant's Management</h3>
    </div>
    <div class="navbar-info">
      <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="m-5">
   <div class=" mt-5">
    <div class="nav  nav-pills" id="nav-tab" role="tablist">
      <button class="nav-link active ms-auto p-3 m-1 shadow rounded fw-bold" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pending</button>
      <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home2-tab" data-bs-toggle="tab" data-bs-target="#nav-home2" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">Accepted</button>
      <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home3-tab" data-bs-toggle="tab" data-bs-target="#nav-home3" type="button" role="tab" aria-controls="nav-home3" aria-selected="false">Declined</button>
      <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home4-tab" data-bs-toggle="tab" data-bs-target="#nav-home4" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">Cancelled</button>
      <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home2-tab" data-bs-toggle="tab" data-bs-target="#nav-home5" type="button" role="tab" aria-controls="nav-home2" aria-selected="false">All</button>
  
    </div>


    <div class="tab-content mb-5" id="nav-tabContent">
      <!-- PENDING LIST -->
      <div class="tab-pane fade show mt-5 active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <h3 class="fw-bold">Pending Status</h2>
         <p class="fw-bold">Recent Request: <?= mysqli_num_rows($pending); ?> items</p>
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
                    <button data-bs-toggle="modal" name="acceptbtn" data-bs-target="#Accept<?= $row['form_id'] ?>" class="btn mb-3 p-2 shadow fw-bold btn-success" style="width: 120px;">
                      <i class="fa-solid fa-circle-check"></i> Accept
                    </button>                                                    
                    <br>
                    <button data-bs-toggle="modal" name="cancelbtn" data-bs-target="#Cancel<?= $row['form_id'] ?>" class="btn p-2 shadow fw-bold btn-danger" style="width: 120px;">
                      <i class="fa-solid fa-circle-xmark"></i> Decline
                    </button>
                  </div>    

                  <!-- VIEW PENDING MODAL -->
                  <div class="modal modal-fade" id="Viewpending<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
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
                              <label class="fw-bold h6 mt-2">Updated At</label>
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

                  <!-- DECLINE PENDING MODAL -->
                  <div class="modal modal-fade" id="Cancel<?= $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Decline File Request</h1>
                        </div>
                        <div class="modal-body p-4">
                          <form action="../includes/functions.php" method="POST">
                           <center>
                             <p class="h5">Are you sure you want to decline this request?</p>
                             <input type="text" name="req_id" value="<?= $row['form_id'] ?>" class="form-control mb-3" hidden required>
                           </center> 
                         </div>
                         <div class="modal-footer">
                          <button type="button" class="rounded p-2 w-25 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">No</button>
                          <button type="submit" name="declinerequest" class="bg-danger text-light border-0 rounded p-2 w-25   fw-bold shadow">Yes</button>
                        </form>
                      </div>
                    </div>
                  </div> 
                </div>  

                <!-- ACCEPT PENDING MODAL -->
                <div class="modal modal-fade" id="Accept<?= $row['form_id'] ?>" tabindex="-2" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Accept File Request</h1>
                      </div>
                      <div class="modal-body p-4">
                        <form action="../includes/functions.php" method="POST">
                         <center>
                          <p class="h5">Are you sure you want to accept this request?</p>
                          <input type="text" name="req_id" value="<?= $row['form_id'] ?>" class="form-control mb-3" hidden required>
                        </center> 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="rounded p-2 w-25 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="acceptrequest" class="bg-success text-light border-0 rounded p-2 w-25   fw-bold shadow">Yes</button>
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

    <!-- ACCEPTED TABLE  -->
    <div class="tab-pane mt-5 fade" id="nav-home2" role="tabpanel" aria-labelledby="nav-accept-tab" tabindex="0">
      <h3 class="fw-bold">Accepted Status</h2>
      <table class="shadow rounded dataTable mt-5 mb-3 mt-3" id="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Reference</th>
            <th>Name</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
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
                <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold text-light shadow-lg m-1" style="background-color: #00214D ;">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </td>
            </tr>
            <!-- VIEW ACCEPTED MODAL -->
            <div class="modal modal-fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
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
                        <label class="fw-bold h6 mt-2">Updated At</label>
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
            <?php $count += 1; }} ?>
          </tbody>
        </table>
      </div>





      <!-- DECLINED TABLE  -->
      <div class="tab-pane mt-5 ade" id="nav-home3" role="tabpanel" aria-labelledby="nav-decline-tab" tabindex="0">
        <h3 class="fw-bold">Declined Status</h2>
            <table class="shadow rounded dataTable mb-3 mt-5" id="tabledeclined">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Reference</th>
                  <th>Name</th>
                  <th>Purpose</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Updated At</th>
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
                      <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold text-light shadow-lg m-1" style="background-color: #00214D ;">
                        <i class="fa-solid fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                  <!-- VIEW ACCEPTED MODAL -->
                  <div class="modal modal-fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
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
                              <label class="fw-bold h6 mt-2">Updated At</label>
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
                  <?php $count += 1; }} ?>
                </tbody>
              </table>
            </div>




        <!-- CANCELED TABLE  -->
        <div class="tab-pane mt-5 fade" id="nav-home4" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
          <h3 class="fw-bold">Cancelled Status</h3>
            <table class="shadow rounded dataTable mb-3 mt-5" id="tablecancelled">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Reference</th>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
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
                        <td><button data-bs-toggle="modal" data-bs-target="#Viewaccept<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold text-light shadow-lg m-1" style="background-color: #00214D ;">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                      </td>
                    </tr>
                    <!-- VIEW ACCEPTED MODAL -->
                    <div class="modal modal-fade" id="Viewaccept<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
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
                                <label class="fw-bold h6 mt-2">Updated At</label>
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
                    <?php $count += 1; }} ?>
                  </tbody>
                </table>
              </div>
           
         


          <!-- ALL TABLE  -->
          <div class="tab-pane mt-5 fade" id="nav-home5" role="tabpanel" aria-labelledby="nav-cancelled-tab" tabindex="0">
            <h3 class="fw-bold">All Request</h3>
                <table class="shadow rounded dataTable mb-3 mt-5" id="tableall">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Reference</th>
                      <th>Name</th>
                      <th>Purpose</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Updated At</th>
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
                          <td><button data-bs-toggle="modal" data-bs-target="#Viewall<?php echo $row['form_id'] ?>" class="btn p-2 rounded-circle fw-bold text-light shadow-lg m-1" style="background-color: #00214D ;">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- VIEW ACCEPTED MODAL -->
                      <div class="modal modal-fade" id="Viewall<?php echo $row['form_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
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
                                  <label class="fw-bold h6 mt-2">Updated At</label>
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
                      <?php $count += 1; }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


            <!-- Add  Modal -->
            <div class="modal modal-fade" id="addlist" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="    true">
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
                          <input type="text" placeholder="Cruz" name="middlename" class="form-control mb-3" required>
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
                          <input type="text" placeholder="Pugaro Manaoag Pangasinan"  name="address" class="form-control mb-3" required>
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
        </body>

