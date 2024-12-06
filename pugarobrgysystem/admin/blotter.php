<?php
require_once '../conn/conn.php';
include 'layout.php';
// session_start();
?>

<style>
.sidebar a.blotter{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}

.label, .close{
    font-weight: bold;
    color:#00214D;
}
.addblotter, .updateblotter, .deleteblotter{
    color: white;
    background-color: #00214D;
}



.addblotter, .updateblotter, .deleteblotter:hover{
    color: white;
    background-color: #00214D;
}

.table th {
    border-bottom: 1px solid #ddd;
    border-top: none;
    border-left: none;
    border-right: none;
    font-weight:bold;
}

.table td {
    border: none;
    color: #00214D;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
}


</style>
<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
    <div class="navbar-title">
        <h2 class="title fw-bold p-3">Resident's Blotter Reports</h3>
        </div>
        <div class="navbar-info">
            <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>

    <!--ADD BUTTON -->
    <div class="p-5 m-4 float-end">
      <button  data-bs-toggle="modal" data-bs-target="#addblotter" class="addblotter border-0 rounded p-3 shadow fw-bold">+ Report Blotter</button>
  </div>

  <!-- RESIDENT TABLE -->
  <div class="m-4 p-5">
    <table  class=" shadow rounded table mb-3 mt-3"  id="table_id">
        <thead>
            <tr>
                <th>Reference #</th>
                <th>Reporter Name</th>
                <th>Defendant Name</th>
                <th>Incident Type</th>
                <th>Date Reported</th>
                <th>Date Incident</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM blotters";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['ref'] ?></td>
                        <td><?= $row['reporter_name'] ?></td>
                        <td><?= $row['defendant_name'] ?></td>
                        <td><?= $row['incident_type'] ?></td>
                        <td><?= $row['date_time_reported'] ?></td>
                        <td><?= $row['date_time_incident'] ?></td>
                        <td>

                        <?php 
                            $statusColors = [
                              'O' => ['bg' => '#d4edda', 'text' => '#155724', 'status' => 'Open'],
                              'C' => ['bg' => '#f8d7da', 'text' => '#721c24', 'status' => 'Close'],
                            ];

                            if (isset($statusColors[$row['status']])) { 
                              $colors = $statusColors[$row['status']];
                              ?>
                                    <span style="background-color: <?= $colors['bg'] ?>; color: <?= $colors['text'] ?>;" class="shadow-sm p-2 w-100 rounded fw-bold">
                                <?= $colors['status'] ?>
                              </span>
                            <?php } ?>
                            </td>
                        <td class="text-nowrap">
                            <button type="button" id="edit_resident" data-bs-toggle="modal" data-bs-target="#editblotter<?php echo $row['id'] ?>" class="btn p-2 rounded-circle btn-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" id="deletebtn" data-bs-toggle="modal" data-bs-target="#delete_blotter" data-blotter-id="<?php echo $row['id'] ?>" class="btn rounded-circle p-2 btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                    </td>
                </tr>

                <!-- Edit Blotter Modal -->
                <div class="modal fade" id="editblotter<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Edit Blotter Reference: <?php echo $row['ref']; ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="../includes/functions.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="row p-4">

                                    <div class="col-md-4 col-sm-12 mb-5">
                                        <div class="label mt-2">Status</div>
                                        <select name="status" class="form-select mb-3" required>
                                            <!-- Corrected the condition to check for 'O' and 'C' for status -->
                                            <option value="O" <?php if ($row['status'] == 'O') echo 'selected'; ?>>Open</option>
                                            <option value="C" <?php if ($row['status'] == 'C') echo 'selected'; ?>>Close</option>
                                        </select>
                                    </div>

                                    <div class="col-md-8 col-sm-12  mb-5">
                                    </div>




                                        <div class="col-md-4">
                                            <div class="label mt-2">Incident Type</div>
                                            <input type="text" name="incident_type" class="form-control mb-3" value="<?php echo $row['incident_type']; ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="label mt-2">Date & Time Reported</div>
                                            <input type="datetime-local" name="date_time_reported" class="form-control mb-3" value="<?php echo $row['date_time_reported']; ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="label mt-2">Date & Time Incident</div>
                                            <input type="datetime-local" name="date_time_incident" class="form-control mb-3" value="<?php echo $row['date_time_incident']; ?>" required>
                                        </div>
                                    

                                    <div class="col-md-6 mt-5">
                                        <h5>Reporting Person Details</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="label mt-2">Name</div>
                                                <input type="text" name="reporter_name" class="form-control mb-3" value="<?php echo $row['reporter_name']; ?>" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="label mt-2">Birthdate</div>
                                                <input type="date" name="reporter_birthdate" class="form-control mb-3" value="<?php echo $row['reporter_birthdate']; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Civil Status</div>
                                                <select name="reporter_civil_status" class="form-select mb-3" required>
                                                    <option value="Single" <?php if ($row['reporter_civil_status'] == 'Single') echo 'selected'; ?>>Single</option>
                                                    <option value="Married" <?php if ($row['reporter_civil_status'] == 'Married') echo 'selected'; ?>>Married</option>
                                                    <option value="Separated" <?php if ($row['reporter_civil_status'] == 'Separated') echo 'selected'; ?>>Separated</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Gender</div>
                                                <select name="reporter_gender" class="form-select mb-3" required>
                                                    <option value="Male" <?php if ($row['reporter_gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                    <option value="Female" <?php if ($row['reporter_gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Religion</div>
                                                <input type="text" name="reporter_religion" class="form-control mb-3" value="<?php echo $row['reporter_religion']; ?>" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="label mt-2">Purok / Zone</div>
                                                <input type="text" name="reporter_address" class="form-control mb-3" value="<?php echo $row['reporter_address']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-5">
                                        <h5>Defendant Details</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="label mt-2">Name</div>
                                                <input type="text" name="defendant_name" class="form-control mb-3" value="<?php echo $row['defendant_name']; ?>" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="label mt-2">Birthdate</div>
                                                <input type="date" name="defendant_birthdate" class="form-control mb-3" value="<?php echo $row['defendant_birthdate']; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Civil Status</div>
                                                <select name="defendant_civil_status" class="form-select mb-3" required>
                                                    <option value="Single" <?php if ($row['defendant_civil_status'] == 'Single') echo 'selected'; ?>>Single</option>
                                                    <option value="Married" <?php if ($row['defendant_civil_status'] == 'Married') echo 'selected'; ?>>Married</option>
                                                    <option value="Separated" <?php if ($row['defendant_civil_status'] == 'Separated') echo 'selected'; ?>>Separated</option>
                                                    <option value="With Partner" <?php if ($row['defendant_civil_status'] == 'With Partner') echo 'selected'; ?>>With Partner</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Gender</div>
                                                <select name="defendant_gender" class="form-select mb-3" required>
                                                    <option value="Male" <?php if ($row['defendant_gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                    <option value="Female" <?php if ($row['defendant_gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label mt-2">Religion</div>
                                                <input type="text" name="defendant_religion" class="form-control mb-3" value="<?php echo $row['defendant_religion']; ?>" required>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="label mt-2">Purok / Zone</div>
                                                <input type="text" name="defendant_address" class="form-control mb-3" value="<?php echo $row['defendant_address']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="mt-5">Personnel Information</h5>
                            <div class="col-md-6 mt-2">
                                    <div class="label mt-2">Personnel Incharge</div>
                                    <input type="text" name="personnel_name" value="<?php echo $row['personnel_name']; ?>" class="form-control mb-3" required>
                            </div>
                            
                            <div class="col-md-6 mt-2">
                                <div class="label mt-2">Personnel Position</div>
                                <input type="text" name="personnel_position" value="<?php echo $row['personnel_position']; ?>" class="form-control mb-3" required>
                            </div>


                                    <div class="col-md-12 mt-5">
                                    <h5>Narrative</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="w-100" name="narrative" rows="5" required><?php echo $row['narrative']; ?></textarea>
                                        </div>                                
                                    </div>
                                    </div>
                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="updateblotter" class="addblotter border-0 rounded p-2 fw-bold shadow">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
    }
    ?>

</tbody>
</table>
</div>



<!-- ----------MODALS ------------ -->
<!-- Add Resident Modal -->
<div class="modal fade" id="addblotter" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"  aria-hidden="true">
 <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Report Blotter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../includes/functions.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row p-4">
                        <div class="col-md-12">
                            <h5>Primary Details</h5>
                            <div class="row">                     
                                <div class="col-md-4">
                                    <div class="label mt-2">Incident Type</div>
                                    <input type="text" name="incident_type" class="form-control mb-3" required>
                                </div>

                                <div class="col-md-4">
                                    <div class="label mt-2">Date & Time Reported</div>
                                    <input type="datetime-local" name="date_time_reported" class="form-control mb-3" required>
                                </div>

                                <div class="col-md-4">
                                    <div class="label mt-2">Date & Time Incident</div>
                                    <input type="datetime-local" name="date_time_incident" class="form-control mb-3" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <h5>Reporting Person Details</h5>
                            <div class="row">                     
                                <div class="col-md-12">
                                    <div class="label mt-2">Name</div>
                                    <input type="text" name="reporter_name" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="label mt-2">Birthdate</div>
                                    <input type="date" name="reporter_birthdate" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Civil Status</div>
                                    <select name="reporter_civil_status" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Separated">Separated</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Gender</div>
                                    <select name="reporter_gender" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Religion</div>
                                    <input type="text" name="reporter_religion" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="label mt-2">Purok / Zone</div>
                                    <input type="text" name="reporter_address" class="form-control mb-3" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <h5>Defendant Details</h5>
                            <div class="row">                     
                                <div class="col-md-12">
                                    <div class="label mt-2">Name</div>
                                    <input type="text" name="defendant_name" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="label mt-2">Birthdate</div>
                                    <input type="date" name="defendant_birthdate" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Civil Status</div>
                                    <select name="defendant_civil_status" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Separated">Separated</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Gender</div>
                                    <select name="defendant_gender" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="label mt-2">Religion</div>
                                    <input type="text" name="defendant_religion" class="form-control mb-3" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="label mt-2">Purok / Zone</div>
                                    <input type="text" name="defendant_address" class="form-control mb-3" required>
                                </div>
                            </div>
                        </div>

                        
                            <h5 class="mt-5">Personnel Information</h5>
                            <div class="col-md-6 mt-2">
                                    <div class="label mt-2">Personnel Incharge</div>
                                    <input type="text" name="personnel_name" class="form-control mb-3" required>
                            </div>

                            <div class="col-md-6 mt-2">
                                <div class="label mt-2">Personnel Position</div>
                                <input type="text" name="personnel_position" class="form-control mb-3" required>
                            </div>


                        <div class="col-md-12 mt-5">
                            <h5>Narrative</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="w-100" name="narrative" placeholder="Narrative Report.." rows="5"></textarea>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addblotter" class="addblotter border-0 rounded p-2 fw-bold shadow">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Delete Resident Modal -->
<div class="modal fade" id="delete_blotter" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h1 class="modal-title fw-bold p-4 fs-5" id="exampleModalLabel">Delete</h1>
            <form action="../includes/functions.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="blotterdelete-id">
                    <p class="fw-bold text-center">Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="deleteblotter" class="p-2 rounded deleteblotter shadow fw-bold">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
  $(document).ready(function() {
      let table = new DataTable('#table_id');

      $('#edit_resident .close').on('click', function(e){
        e.preventDefault();
        $('#name').val('');
        $('#age').val('');
        $('#gender').val('');
        $('#address').val('');      });

      $('#table_id #deletebtn').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('blotter-id');
        $('#blotterdelete-id').val(id);
    });

  });

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
            location.href = "blotter";
        }
    });
    <?php
    unset($_SESSION['status']);
}
?>
</script>
