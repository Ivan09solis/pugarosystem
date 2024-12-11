<?php
require_once '../conn/conn.php';
include 'layout.php';

// QUERY FOR PENDING LIST
$sql = "SELECT * FROM `resident`";
$residents = mysqli_query($conn, $sql);

if (mysqli_num_rows($residents) > 0) {
    $count_residents = mysqli_num_rows($residents); 
} 

$sql = "SELECT * FROM `blotters`";
$blotters = mysqli_query($conn, $sql);

if (mysqli_num_rows($blotters) > 0) {
    $count_blotters = mysqli_num_rows($blotters); 
} 

$sql = "SELECT * FROM `forms`";
$forms = mysqli_query($conn, $sql);

if (mysqli_num_rows($forms) > 0) {
    $count_forms = mysqli_num_rows($forms); 
} 

$sql = "SELECT * FROM `forms` LIMIT 5";
$request = mysqli_query($conn, $sql);

?>

<style>
  .sidebar a.home{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
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
 <div class="row mt-6 p-3 ">


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
                            <?= $count_residents ?>                     
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
                        <div class="h3">Blotter's</div>
                        <div class="h1"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="display-4">
                                <?= $count_blotters ?> 
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
                            <?= $count_forms ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" mt-2">
        <h4 class="mt-3 fw-bold">Recents's <i class="fa fa-history" aria-hidden="true"></i></h4>
        <?php if ($request->num_rows > 0) {
          while ($row = $request->fetch_assoc()) {
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
                             <input type="hidden" name="location" class="location" id="location">
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
                          <input type="hidden" name="location2" class="location2" id="location2">
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
 </div>


 <script>
  var pathname = window.location.pathname;  
  var lastSegment = pathname.split('/').pop();  
  $(".location").val(lastSegment); 
  $(".location2").val(lastSegment);  
  
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
            location.href = "home";
        }
    });
    <?php
    unset($_SESSION['status']);
    }?>

</script>