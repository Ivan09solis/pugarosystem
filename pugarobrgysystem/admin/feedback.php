<?php
require_once '../conn/conn.php';
include 'layout.php';

$sql = "SELECT  a.created_at, a.id, a.user_id, a.feedback, b.fname, b.mname, b.lname, b.profile  FROM feedback a INNER JOIN user b ON a.user_id = b.user_id ORDER BY `id` DESC";
$feedbacks = mysqli_query($conn, $sql);
?>

<style>
.sidebar a.feedback{
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
        <h2 class="title fw-bold p-3"> Feedback & Suggestions</h3>
        </div>
        <div class="navbar-info">
            <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class=" mt-5">
       <div class="row m-5 ">
        <div class="col">
            <h6 class="fw-bold">Feedback Messages</h6>
            <?php if (mysqli_num_rows($feedbacks) > 0) {
                while ($row = $feedbacks->fetch_assoc()) { ?>

                    <div class="info_section bg-white shadow mt-3 rounded p-3 mb-4">
                        <div class="event_header">
                            <div class="d-flex align-items-center mb-2 w-100">
                                <img src="../includes/uploads/<?= $row['profile']; ?>" style="border: 2px solid #0dcaf0;" class="rounded-circle p-1 img-fluid" height="40" width="40"> 

                                <div class="ms-2 flex-grow-1">
                                    <h5 class="mb-0"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></h5>
                                    <span class="text-muted">
                                        <i class="fa-solid fa-earth-asia"></i> <?= date('F j, Y | g:i A', strtotime($row['created_at'])); ?>
                                    </span>
                                </div>

                                <button name="get_id" id="get_id" data-bs-toggle="modal" data-bs-target="#deletemessages"
                                data-message-id="<?= $row['id']; ?>" class="btn float-end btn-transparent text-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>


                            <!-- Modal for Deleting Message -->
                            <div class="modal fade" id="deletemessages" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteEventLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <h1 class="modal-title fw-bold p-4 fs-5" id="deleteEventLabel">Delete Message</h1>
                                        <form action="../includes/functions.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id">
                                                <p class="fw-bold text-center">Are you sure you want to delete This Feedback?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="deletefeedback" id="deletefeedback" class="p-2 bg-danger btn text-light rounded shadow fw-bold">Yes, Delete it</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <p class="mt-3 text-muted"><?= $row['feedback'] ?></p>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
</div>
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
            timer: 3000, 
            timerProgressBar: true, 
        });
        <?php
        unset($_SESSION['status']);
    }
    ?>

    $(document).on('click', '#get_id', function (e) {
        e.preventDefault();
        var id = $(this).data('message-id');
        $('#id').val(id);
    });
</script>