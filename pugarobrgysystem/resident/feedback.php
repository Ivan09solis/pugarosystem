<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';

include('layout.php');

// QUERY FOR USER DETAILS
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
$sql = "SELECT * FROM `user` WHERE `user_id` = $user_id";
$user = mysqli_query($conn, $sql);

?>

<head>
    <title>Feedback & Suggestions</title>
</head>

<style>

.h2{
    color: #00214D;
}

.profile-container {
  text-align: center;
  margin-top: 50px;
}
.profile-pic {
  width: 200px;
  height: 200px;
  object-fit: cover;
  background-color: #f0f0f0;
  margin-bottom: 20px;
}
.file-input {
  display: none;
}
/*.btn {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
}
*/
/*.btn:hover {
  background-color: #45a049;

  }*/
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

    <div class="container p-5">
        <div class="h2 fw-bold  mt-3 mb-5">Account Profile</div>
        <?php if (mysqli_num_rows($user) > 0) {
            while ($row = $user->fetch_assoc()) { ?>

                <div class="row"> 
                    <div class="col-md-5">
                        <div class="profile-container" >
                            <!-- Profile picture -->
                            <center>
                                <div id="profilePicPreview"  class="profile-pic rounded-circle shadow">
                                    <img src="../includes/profile/<?=$row['profile'];?>" alt="Profile Picture" class="shadow  rounded-circle" style="width:200px; height: 200px"  id="profilePic" />
                                </div>

                                <form action="../includes/functions.php" method="POST" enctype="multipart/form-data">

                                  <input type="file" id="fileInput" name="fileInput" class="file-input" accept="image/*">

                                  <button type="button" class="btn btn-info text-light p-3 w-50 m-1 fw-bold" onclick="document.getElementById('fileInput').click();">Change Profile</button>
                                  <br>


                                  <button type="submit" name="svprofile" class="btn btn-light w-50 p-3 fw-bold shadow m-3" id="svprofile">Save</button>
                              </form>
                          </center>
                      </div>
                  </div>
                  <div class="col-md-7">
                      <div class="container">
                        <form method="POST" action="../includes/functions.php" enctype="multipart">                            <div class="row fw-bold">
                            <p class="fw-bold h5 mb-4">Personal Details</p>
                            <div class="col-md-4">
                                <label >Firstname</label>
                                <input type="text" class="form-control p-3 mb-4 " placeholder="Enter your Firstname" name="fname" id="fname" value="<?= $row['fname'];?>">
                            </div>
                            <div class="col-md-4">
                                <label > Middlename</label>
                                <input type="text" class="form-control p-3 mb-4" placeholder="Enter your Middlename" name="mname" id="mname" value="<?= $row['mname'];?>">
                            </div>
                            <div class="col-md-4">
                                <label >Lastname</label>
                                <input class="form-control p-3 mb-4" placeholder="Enter your Lastname" type="text" name="lname" id="lname" value="<?= $row['lname'];?>">
                            </div>


                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                                <select class="form-control p-3 mb-4" name="gender" id="gender">
                                    <option value="">Select Gender---</option>
                                    <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>not to say</option>
                                </select>
                            </div>



                            <div class="col-md-6">
                                <label>Birtdate</label>
                                <input class="form-control p-3 mb-4" type="date" name="bdate" id="bdate" value="<?= $row['bdate'];?>">
                            </div>

                            <div class="col-md-12">
                                <label>Address</label>
                                <input class="form-control p-3 mb-4" placeholder="Enter your Address" type="text" name="address" id="address" value="<?= $row['address'];?>">
                            </div>

                            <div class="col-md-6">
                                <label>Phone #</label>
                                <input class="form-control p-3 mb-4" placeholder="Ente your Contact# " type="text" name="contact" id="contact" value="<?= $row['contact'];?>">
                            </div>


                            <div class="col-md-6">
                                <label >Email</label>
                                <input class="form-control p-3 mb-4" placeholder="Enter your Email" type="text" name="email" id="email" value="<?= $row['email'];?>">
                            </div>

                            <hr class="mt-5 mb-5">

                            <span class="h5 fw-bold mb-3"><input type="checkbox" name="checked" id="checked"> Change Password</span>

                            <div class="col-md-6">
                                <label >Password</label>
                                <input class="form-control p-3 mb-4 pass" type="password" placeholder="**********" name="password" id="password" disabled>
                            </div>

                            <div class="col-md-6">
                                <label >Confirm Password</label>
                                <input class="form-control p-3 mb-4 pass" type="password" placeholder="**********" name="conpassword" id="conpassword" disabled>
                            </div>

                            <center>
                                <button type="submit" name="svchanges" id="svchanges" class="btn btn-info text-light p-3 m-5 w-50 fw-bold">Save Changes</button>
                            </center>
                        </div>
                    <?php } } ?>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<?php include('footer.php') ?>

<script>

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

$(document).ready(function() {

    $('#checked').on('click', function() {
        var status = $(this).prop('checked') ? false : true;  
        $('.pass').prop('disabled', status);

        if (status) {
            $('.pass').val(''); 
            $('.pass').removeClass('is-invalid , is-valid');
            $('#svchanges').attr('disabled', false);
        }
        else{
            $('#svchanges').attr('disabled', true);
        }
    });

    $('#conpassword').on('keyup blur', function() {

        if ($(this).val() !== $('#password').val()) {
            $(this).removeClass('is-valid').addClass('is-invalid');
            $('#svchanges').attr('disabled', true);
        }
        else if($(this).val() === ""){
            $(this).removeClass('is-invalid');
            $('#svchanges').attr('disabled', true);

        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $('#svchanges').attr('disabled', false);

        }
    });

});
document.addEventListener('DOMContentLoaded', function() {

   document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profilePic').src = e.target.result;
      };
      reader.readAsDataURL(file);
  }
});

   document.getElementById('updateProfileBtn').addEventListener('click', function() {
      alert('Profile updated!');
  });
});

</script>