<?php
require_once '../conn/conn.php';
include 'layout.php';
// session_start();
?>

<style>
.sidebar a.events {
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.20);
}

.label,
.close {
    font-weight: bold;
    color: #00214D;
}

.addevent,
.updateevent,
.deleteevent {
    color: white;
    background-color: #00214D;
}



.addevent,
.updateevent,
.deleteevent:hover {
    color: white;
    background-color: #00214D;
}

.table th {
    border-bottom: 1px solid #ddd;
    border-top: none;
    border-left: none;
    border-right: none;
    font-weight: bold;
}

.table td {
    border: none;
    color: #00214D;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
}
</style>

        <!-- Delete event Modal -->
        <div class="modal fade" id="delete_event" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <h1 class="modal-title fw-bold p-4 fs-5" id="exampleModalLabel">Delete</h1>
                    <form action="../includes/functions.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="eventdelete-id">
                            <p class="fw-bold text-center">Are you sure you want to delete this event?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow"
                            data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="deleteevent" class="p-2 rounded deleteevent shadow fw-bold">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


<!-- NAVBAR HEADER -->
<div class="navbar shadow rounded">
    <div class="navbar-title">
        <h2 class="title fw-bold p-3"> Barangay Event's Management</h3>
        </div>
        <div class="navbar-info">
            <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>

    <!--ADD BUTTON -->
    <div class="p-5 m-4 float-end">
        <button data-bs-toggle="modal" data-bs-target="#addevent" class="addevent border-0 rounded p-3 shadow fw-bold">+ New
        Event</button>
    </div>

    <!-- event TABLE -->
    <div class="m-4 p-5">
            <table class=" shadow rounded table mb-3 mt-3" id="table_id">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Photo</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Time Start</th>
                        <th>Time End</th>
                        <th>Created At</th>
                        <th>Last Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM event";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['title'] ?></td>
                                <td><img class="rounded-circle shadow" height="50px" width="50px" src="../includes/uploads/<?= $row['img'] ?>"></td>
                                <td><?= $row['venue'] ?></td>
                                <td><?= $row['eventdate'] ?></td>
                                <td><?= date('H:i, a', strtotime($row['from'])); ?></td>
                                <td><?= date('H:i, a', strtotime($row['to'])); ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= $row['updated_at'] ?></td>
                                <td class="text-nowrap">
                                    <button type="button" id="editevent" data-bs-toggle="modal"
                                    data-bs-target="#edit_event<?php echo $row['id'] ?>" data-id="<?= $row['id']; ?>" class="btn p-2 editmodal rounded-circle btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" id="deletebtn" data-bs-toggle="modal" data-bs-target="#delete_event"
                                data-event-id="<?php echo $row['id'] ?>" class="btn rounded-circle p-2 btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                    </td>
                </tr>

                <!-- Edit event Modal -->
                <div class="modal fade edit_event" id="edit_event<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Edit <?php echo $row['title'] ?>
                            </h1>
                        </div>
                        
                        <div class="modal-body">

                            <div class="row p-3">
                                <div class="col-md-5 p-2">
                                    <!-- Image Preview -->
                                    <div class="profile p-2 shadow mb-4 mx-auto">
                                        <img id="img-preview" class="rounded" height="300" width="200" src="../includes/uploads/<?= $row['img'] ?>" alt="Profile" style="width: 100%; object-fit: cover;">
                                    </div>                                    
                                    <!-- Image Upload Form -->

                                    <center>
                                        <form action="../includes/functions.php" method="post" enctype="multipart/form-data" id="upload-form">
                                            <input type="hidden" name="imgid" id="imgid">
                                            <input type="hidden" name="updateimg_identifier" value="updateimg_identifier">
                                            <input type="file" name="imgupdate" id="imgupdate" class="d-none" accept="image/*">
                                            <button type="button" class="btn btn-light p-3 border-0 w-100 shadow-sm fw-bold" id="click_upload">Change Image</button>
                                        </form>                                    
                                    </center>
                                </div>

                                
                                <div class="col-md-7">
                                    <form action="../includes/functions.php" method="POST">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="col-md-12 col-sm-6 col-12">
                                            <div class="label h6">Title</div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <input type="text" name="title" class="form-control mb-3"
                                            value="<?php echo $row['title'] ?>" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="label h6 mt-2">Description</div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <textarea name="description" class="form-control mb-3"
                                            required><?php echo htmlspecialchars($row['description']); ?></textarea>
                                        </div>

                                        <div class="col-md-7 col-sm-6 col-6">
                                            <div class="label h6 mt-2">Venue</div>
                                            <input type="text" name="venue" class="form-control mb-6"
                                            value="<?php echo $row['venue'] ?>" required>
                                        </div>


                                        <div class="col-md-5 col-sm-6 col-6">
                                            <div class="label h6 mt-2">Date</div>
                                            <input type="date" name="eventdate" class="form-control mb-3"
                                            value="<?php echo $row['eventdate'] ?>" required>
                                        </div>


                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="label h6 mt-2">Start Time</div>
                                            <input type="time" name="from" class="form-control mb-3"
                                            value="<?php echo $row['from'] ?>" required>
                                        </div>

                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="label h6 mt-2">End Time</div>
                                            <input type="time" name="to" class="form-control mb-5"
                                            value="<?php echo $row['to'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="p-2 rounded btn-light fw-bold border-0 m-2 close shadow"
                                data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="updateevent"
                                class="rounded p-2 updateevent border-0 shadow fw-bold">Save Changes</button>
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
        <!-- Add event Modal -->
        <div class="modal fade" id="addevent" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">New event</h1>
                    </div>
                    <form action="../includes/functions.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row p-3">
                                <!-- Title Input -->
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="label h6 mt-1">Title</div>
                                    <input type="text" name="title" class="form-control mb-3" required>
                                </div>



                                <!-- Description Input -->
                                <div class="col-md-12 col-sm-12 col-12">
                                <div class="label h6 mt-2">Description</div>
                                <textarea name="description" class="form-control mb-3" required></textarea>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-12 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Upload Image</div>
                                    <input type="file" name="img" class="form-control mb-3" accept="image/*">
                                </div>


                                <!-- Venue Input -->
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="label h6 mt-2">Venue</div>
                                    <input type="text" name="venue" class="form-control mb-3" required>
                                </div>

                            

                                <!-- Date Input -->
                                <div class="col-md-6 col-sm-3 col-3">
                                    <div class="label h6 mt-2">Date</div>
                                    <input type="date" name="eventdate" class="form-control mb-3" required>
                                </div>

                                <!-- Start Time Input -->
                                <div class="col-md-6 col-sm-3 col-3">
                                    <div class="label h6 mt-2">Start Time</div>
                                    <input type="time" name="from" class="form-control mb-3" required>
                                </div>

                                <!-- End Time Input -->
                                <div class="col-md-6 col-sm-3 col-3">
                                    <div class="label h6 mt-2">End Time</div>
                                    <input type="time" name="to" class="form-control mb-3" required>
                                </div>
                            </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="rounded p-2 border-0 bg-light close fw-bold shadow"
                            data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="addevent"
                            class="addevent border-0 rounded  p-2 fw-bold shadow">Save Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





<script>
    $(document).ready(function () {

        var id = '';
        $(document).on('click', '#editevent', function() {
            var itemId = $(this).data('id');
            id = itemId;
        });

        $(document).on('click', '#click_upload', function() {
            $('#imgupdate').click();
            $('#imgid').val(id);        
        });

        $('#imgupdate').on('change', function() {
            if (this.files && this.files.length > 0) { // Check if a file is selected
                $('#upload-form').submit();
            } else {
                console.log('No file selected');
            }
        });



        let table = new DataTable('#table_id');

        $('#edit_event .close').on('click', function (e) {
            e.preventDefault();
            $('#name').val('');
            $('#age').val('');
            $('#gender').val('');
            $('#address').val('');
            console.log('asds');
        });

        $('#table_id #deletebtn').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('event-id');
            $('#eventdelete-id').val(id);
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
                location.href = "event";
            }
        });
        <?php
        unset($_SESSION['status']);
    }
    ?>

</script>