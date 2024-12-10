<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';


$sql = "SELECT  a.created_at, a.id, a.user_id, a.message, b.fname, b.mname, b.lname , b.profile FROM forum a INNER JOIN user b ON a.user_id = b.user_id ORDER BY `id` DESC";
$forums = mysqli_query($conn, $sql);


?>

<head>
    <title>Community Forum</title>
</head>

<style>
.navbar a.forum {
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.20);
}

.h2{
    color: #00214D;
}


div.scroll {
    height: 50%;
    overflow: auto;
    text-align: justify;
    padding: 20px;
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
    <?php include('layout.php') ?>




    <div class="container mt-5" style="height: 80vh;">
        <div class="row" style="height: 100%;">
            <div class="h2 fw-bold">Community Forum</div>

            <div class="col-md-4 d-flex flex-column" style="padding: 0;">
                <div class="m-3" style="padding: 10px;">
                    <form action="../includes/functions.php" method="post" enctype="multipart">
                        <label class="h6 fw-bold">Share your thoughts</label>
                        <textarea name="msg" id="msg" class="form-control p-3 fw-bold shadow" placeholder="Write your message here..." rows="4"></textarea>
                        <button type="submit" name="newmesssage"  class="btn p-3 mt-5 fw-bold text-white btn-info w-100" style="border: none;">
                            Send Message <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>




            <div class="col-md-8" style="overflow-y: auto; padding: 10px; height: calc(80vh - 150px);">
                <p class="fw-bold mt-2 mr-5">All Messages</p>
                <?php if (mysqli_num_rows($forums) > 0) {
                    while ($row = $forums->fetch_assoc()) { ?>
                        <div class="p-4 mb-5 bg-white rounded shadow flex-grow-1" style="position: relative;"> <!-- Set position relative for absolute positioning of button -->
                            <div class="info_section">
                                <div class="event_header">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="../includes/uploads/<?= $row['profile']; ?>" style="border: 2px solid #0dcaf0;" class="rounded-circle p-1 img-fluid" height="40" width="40"> 
                                        <div class="ms-2">
                                            <h5 class="mb-0"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></h5>
                                            <span class="text-muted">
                                                <i class="fa-solid fa-earth-asia"></i> <?= date('F j, Y | g:i A', strtotime($row['created_at'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-muted"><?= $row['message'] ?></p>
                                </div>
                                <?php

                                if ($row['user_id'] === $_SESSION['user_id']) { ?>
                                    <button name="get_id" id="get_id" data-bs-toggle="modal" data-bs-target="#deletemessages"
                                    data-message-id="<?= $row['id']; ?>" class="btn btn-transparent text-danger" style="position: absolute; top: 10px; right: 10px;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            <?php } ?>


                            <div class="modal fade" id="deletemessages" tabindex="-1"data-bs-backdrop="static" aria-labelledby="deleteEventLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <h1 class="modal-title fw-bold p-4 fs-5" id="deleteEventLabel">Delete Message</h1>
                                        <form action="../includes/functions.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id">
                                                <p class="fw-bold text-center">Are you sure you want to delete your message?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="rounded border-0 p-2 btn-light fw-bold close shadow" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="deletemessage" id="deletemessage" class="p-2 bg-danger btn text-light rounded shadow fw-bold">Yes, Delete it</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php } 
            }   ?>
        </div>
    </div>
</div>
</body>

<?php include('footer.php') ?>


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