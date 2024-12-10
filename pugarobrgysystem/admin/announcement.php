<?php
require_once '../conn/conn.php';
include 'layout.php';
// session_start();
?>

<style>
.sidebar a.announcement{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
}

.label, .close{
    font-weight: bold;
    color:#00214D;
}
.addannouncement, .updateannouncement, .deleteannouncement{
    color: white;
    background-color: #00214D;
}



.addannouncement, .updateannouncement, .deleteannouncement:hover{
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
<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
    <div class="navbar-title">
        <h2 class="title fw-bold p-3"> Announcement's Management</h3>
        </div>
        <div class="navbar-info">
            <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>

    <!--ADD BUTTON -->
    <div class="p-5 m-4 float-end">
      <button  data-bs-toggle="modal" data-bs-target="#addannouncement" class="addannouncement border-0 rounded p-3 shadow fw-bold">+ New Announcement</button>
  </div>

  <!-- announcement TABLE -->
  <div class="m-4 p-5">
    <table  class=" shadow bg-white rounded table mb-3 mt-3"  id="table_id">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Announcement for</th>
                <th>Created At</th>
                <th>Last Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM announcement";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?php echo $row['intended'] ? $row['intended'] : "General"; ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td><?= $row['updated_at'] ?></td>
                        <td class="text-nowrap">
                            <button type="button" id="edit_announcement" data-bs-toggle="modal" data-bs-target="#edit_announcement<?php echo $row['id'] ?>" class="btn p-2 rounded-circle btn-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" id="deletebtn" data-bs-toggle="modal" data-bs-target="#delete_announcement" data-announcement-id="<?php echo $row['id'] ?>" class="btn rounded-circle p-2 btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                    </td>
                </tr>

                <!-- Edit announcement Modal -->
                <div class="modal fade" id="edit_announcement<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Edit <?php echo $row['title'] ?></h1>
                            </div>
                            <form action="../includes/functions.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div class="label h6 mt-2">Title</div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <input type="text" name="title" class="form-control mb-3" value="<?php echo $row['title'] ?>" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div class="label h6 mt-2">Description</div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <textarea name="description" class="form-control mb-3" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div class="label h6 mt-2">Announcement For :</div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12">
                                    <select name="intended" id="intended" class="form-select mb-3">
                                        <option value="">General</option>
                                        <option value="4ps"<?php if ($row['intended'] == '4ps') echo 'selected'; ?>>4p's</option>
                                    </select>     
                                </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="p-2 rounded btn-light fw-bold border-0 close shadow" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="updateannouncement" class="rounded p-2 updateannouncement border-0 shadow fw-bold">Save Changes</button>
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
<!-- Add announcement Modal -->
<div class="modal modal-fade" id="addannouncement" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">New announcement</h1>
            </div>
            <form action="../includes/functions.php" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="label h6 mt-2">Title</div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <input type="text" name="title" class="form-control mb-3" value="" required>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="label h6 mt-2">Description</div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <textarea name="description" class="form-control mb-3" required></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="label h6 mt-2">Announcement For :</div>
                        <select name="intended" id="intended" class="form-select mb-3">
                            <option value="">General</option>
                            <option value="4ps">4p's</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addannouncement" class="addannouncement border-0 rounded p-2 fw-bold shadow">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete announcement Modal -->
<div class="modal fade" id="delete_announcement" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h1 class="modal-title fw-bold p-4 fs-5" id="exampleModalLabel">Delete</h1>
            <form action="../includes/functions.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="announcementdelete-id">
                    <p class="fw-bold text-center">Are you sure you want to delete this announcement?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="deleteannouncement" class="p-2 rounded deleteannouncement shadow fw-bold">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
  $(document).ready(function() {
      let table = new DataTable('#table_id');

      $('#edit_announcement .close').on('click', function(e){
        e.preventDefault();
        $('#name').val('');
        $('#age').val('');
        $('#gender').val('');
        $('#address').val('');
        console.log('asds');
    });

      $('#table_id #deletebtn').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('announcement-id');
        $('#announcementdelete-id').val(id);
        console.log(id);
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
            location.href = "announcement";
        }
    });
    <?php
    unset($_SESSION['status']);
}
?>
</script>
