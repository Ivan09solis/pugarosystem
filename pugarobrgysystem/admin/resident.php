<?php
require_once '../conn/conn.php';
include 'layout.php';
// session_start();
?>

<style>
  .sidebar a.resident{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
  }

  .label, .close{
    font-weight: bold;
    color:#00214D;
  }
  .addresident, .updateresident, .deleteresident{
    color: white;
    background-color: #00214D;
  }



.addresident, .updateresident, .deleteresident:hover{
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

body {
        background-image: url('../includes/logo/bg3.gif');
        background-size: cover;      
        background-position: center;  
        background-repeat: no-repeat; 
        height: 100vh;               
        margin: 0;                
    }


</style>

<!-- Delete Resident Modal -->
<div class="modal fade" id="delete_resident" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h1 class="modal-title fw-bold p-4 fs-5" id="exampleModalLabel">Delete</h1>
            <form action="../includes/functions.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="residentdelete-id">
                    <p class="fw-bold text-center">Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="deleteresident" class="p-2 rounded deleteresident shadow fw-bold">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
    <div class="navbar-title">
        <h2 class="title fw-bold p-3"> Resident's Management</h3>
    </div>
    <div class="navbar-info">
        <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
</div>

<!--ADD BUTTON -->
<div class="p-5 m-4 float-end">
  <button  data-bs-toggle="modal" data-bs-target="#addresident" class="addresident border-0 rounded p-3 shadow fw-bold">+ New Resident</button>
</div>

<!-- RESIDENT TABLE -->
<div class="m-4 p-5">
    <table  class=" shadow bg-white rounded table mb-3 mt-3"  id="table_id">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Civil Status</th>
                <th>PWD</th>
                <th>Senior Citizen</th>
                <th>4P's</th>
                <th>Voter</th>
                <th>Voter's ID</th>
                <th>Religion</th>
                <th>Zone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
$sql = "SELECT * FROM resident";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['bdate'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['civilstatus'] ?></td>
            <td><?= $row['pwd'] ?></td>
            <td><?= $row['senior_citizen'] ?></td>
            <td><?= $row['4ps'] ?></td>
            <td><?= $row['voter'] ?></td>
            <td><?= $row['voterid'] ?></td>
            <td><?= $row['religion'] ?></td>
            <td><?= $row['address'] ?></td>
            <td class="text-nowrap">
                    <button type="button" id="edit_resident" data-bs-toggle="modal" data-bs-target="#edit_resident<?php echo $row['id'] ?>" class="btn p-2 rounded-circle btn-primary">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" id="deletebtn" data-bs-toggle="modal" data-bs-target="#delete_resident" data-resident-id="<?php echo $row['id'] ?>" class="btn rounded-circle p-2 btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>

                </form>
            </td>
        </tr>

        <!-- Edit Resident Modal -->
        <div class="modal fade" id="edit_resident<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Edit <?php echo $row['name'] ?></h1>
                    </div>
                    <form action="../includes/functions.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            
                            <div class="row">
                                <!-- Fullname -->
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Fullname</div>
                                    <input type="text" name="name" class="form-control mb-3" value="<?php echo $row['name'] ?>" placeholder="Enter Name" >
                                </div>

                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Voter's ID</div>
                                    <input type="number" id="voterid" name="voterid" class="form-control mb-3" value="<?php echo $row['voterid'] ?>" placeholder="12 Digits" required oninput="limitVoterIdLength(this)" />
                                </div>

                                <!-- Birthdate -->
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Birthdate</div>
                                    <input type="date" name="bdate" class="form-control mb-3" value="<?php echo $row['bdate'] ?>" required>
                                </div>

                                <!-- Civil Status -->
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Civil Status</div>
                                    <select name="civilstatus" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="single" <?php if ($row['civilstatus'] == 'single') echo 'selected'; ?>>Single</option>
                                        <option value="married" <?php if ($row['civilstatus'] == 'married') echo 'selected'; ?>>Married</option>
                                        <option value="separated" <?php if ($row['civilstatus'] == 'separated') echo 'selected'; ?>>Separated</option>
                                    </select>
                                </div>

                                <!-- Physical Status -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Physical Status</div>
                                    <select name="pwd" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Normal" <?php if ($row['pwd'] == 'Normal') echo 'selected'; ?>>Normal</option>
                                        <option value="PWD" <?php if ($row['pwd'] == 'PWD') echo 'selected'; ?>>PWD</option>
                                    </select>
                                </div>

                                <!-- Age Status -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Age Status</div>
                                    <select name="senior_citizen" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="MINOR" <?php if ($row['senior_citizen'] == 'MINOR') echo 'selected'; ?>>Minor (17 Below)</option>
                                        <option value="Adult" <?php if ($row['senior_citizen'] == 'Adult') echo 'selected'; ?>>Adult (18-59)</option>
                                        <option value="Senior Citizen" <?php if ($row['senior_citizen'] == 'Senior Citizen') echo 'selected'; ?>>Senior Citizen (60 Above)</option>
                                    </select>
                                </div>

                                <!-- Welfare Status -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Welfare Status</div>
                                    <select name="4ps" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Non-beneficiary" <?php if ($row['4ps'] == 'Non-beneficiary') echo 'selected'; ?>>Non-beneficiary</option>
                                        <option value="4P'S" <?php if ($row['4ps'] == "4P'S") echo 'selected'; ?>>4Ps</option>
                                        <option value="Tupad" <?php if ($row['4ps'] == 'Tupad') echo 'selected'; ?>>Tupad</option>
                                    </select>
                                </div>

                                <!-- Voter Status -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Voter Status</div>
                                    <select name="voter" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Voter" <?php if ($row['voter'] == 'Voter') echo 'selected'; ?>>Voter</option>
                                        <option value="Non-voter" <?php if ($row['voter'] == 'Non-voter') echo 'selected'; ?>>Non-voter</option>
                                    </select>
                                </div>


                                <!-- Religion -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Religion</div>
                                    <input type="text" name="religion" class="form-control mb-3" value="<?php echo $row['religion'] ?>" placeholder="Enter Religion" required>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Gender</div>
                                    <select name="gender" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="label h6 mt-2">Zone</div>
                                    <select name="address" id="" class="form-select mb-3" required>
                                        <option value="">Select--</option>
                                        <option value="Zone-1"<?php if ($row['address'] == 'Zone-1') echo 'selected'; ?>>Zone 1</option>
                                        <option value="Zone-2"<?php if ($row['address'] == 'Zone-2') echo 'selected'; ?>>Zone 2</option>
                                        <option value="Zone-3"<?php if ($row['address'] == 'Zone-3') echo 'selected'; ?>>Zone 3</option>
                                        <option value="Zone-4"<?php if ($row['address'] == 'Zone-4') echo 'selected'; ?>>Zone 4</option>
                                        <option value="Zone-5"<?php if ($row['address'] == 'Zone-5') echo 'selected'; ?>>Zone 5</option>
                                        <option value="Zone-6"<?php if ($row['address'] == 'Zone-6') echo 'selected'; ?>>Zone 6</option>
                                        <option value="Zone-7"<?php if ($row['address'] == 'Zone-7') echo 'selected'; ?>>Zone 7</option>
                                    </select>
                             </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="updateresident" class="addresident border-0 rounded p-2 fw-bold shadow">Save Changes</button>
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
  <div class="modal fade" id="addresident" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">New Resident</h1>
                </div>
                <form action="../includes/functions.php" method="POST"  enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="label h6 mt-2">Fullname</div>
                                <input type="text" name="name" class="form-control mb-3" placeholder="Enter Name" required>
                            </div>

                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="label h6 mt-2">Voter's ID</div>
                                <input type="number" id="voterid" name="voterid" class="form-control mb-3" placeholder="12 Digits" oninput="limitVoterIdLength(this)" />
                            </div>
                        
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="label h6 mt-2">Birthdate</div>
                                <input type="date"  name="bdate" class="form-control mb-3"  required>
                            </div>

                        
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="label h6 mt-2">Civil Status</div>
                                <select name="civilstatus" id="civilstatus" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="separated">Separated</option>
                                </select>
                            </div>


                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Physical Status</div>
                                <select name="pwd" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="Normal">Normal</option>
                                    <option value="PWD">PWD</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Age Status</div>
                                <select name="senior_citizen" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="MINOR">Minor (17 Below)</option>
                                    <option value="Adult">Adult (18-59)</option>
                                    <option value="Senior Citizen">Senior Citizen (60 Above)</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Welfare status</div>
                                <select name="4ps" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="Non-beneficiary">Non-beneficiary</option>
                                    <option value="4P'S">4P's</option>
                                    <option value="Tupad">Tupad</option>
                                </select>
                            </div>


                            
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Voter Status</div>
                                <select name="voter" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="Voter">Voter</option>
                                    <option value="Non-voter">Non-voter</option>
                                </select>
                            </div>

                        
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Religion</div>
                                <input type="text"  name="religion" class="form-control mb-3" placeholder="Enter Religion" required>
                            </div>



                        
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="label h6 mt-2">Gender</div>
                                <select name="gender" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                          
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="label h6 mt-2">Zone</div>
                                <select name="address" id="" class="form-select mb-3" required>
                                    <option value="">Select--</option>
                                    <option value="Zone-1">Zone 1</option>
                                    <option value="Zone-2">Zone 2</option>
                                    <option value="Zone-3">Zone 3</option>
                                    <option value="Zone-4">Zone 4</option>
                                    <option value="Zone-5">Zone 5</option>
                                    <option value="Zone-6">Zone 6</option>
                                    <option value="Zone-7">Zone 7</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addresident" class="addresident border-0 rounded p-2 fw-bold shadow">Save</button>
                    </div>
                </form>
            </div>
        </div>
  </div>





<script>

function limitVoterIdLength(input) {
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); 
        }

        console.log('dsgdfgdfg');
        
    }

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
        var id = $(this).data('resident-id');
        $('#residentdelete-id').val(id);
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
                    location.href = "resident";
                }
            });
    <?php
        unset($_SESSION['status']);
    }
    ?>
</script>
