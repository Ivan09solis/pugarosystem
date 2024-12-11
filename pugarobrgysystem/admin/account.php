<?php
require_once '../conn/conn.php';
include 'layout.php';

// QUERY FOR USER DETAILS
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
$sql = "SELECT * FROM `user` WHERE `user_id` = $user_id";
$user = mysqli_query($conn, $sql);
?>

<style>
.sidebar a.account{
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.20);
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

        <h2 class="title fw-bold p-3">
        My Account</h3>
        </div>
        <div class="navbar-info">
            <a href="logout.php" class="logout m-3 h3 fw-bold"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class=" mt-5">
     <div class="row mt-6 ">
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

                                  <input type="file" id="fileInput" name="fileInput"  class="file-input" accept="image/*">

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
                            <p class="fw-bold h5 mb-4">Account Details</p>
                            <div class="col-md-12">
                                <label >Name :</label>
                                <input type="text" class="form-control p-3 mb-4 " placeholder="Account Name" name="fname" id="fname" value="<?= $row['fname'];?>" required>
                            </div>


                            <div class="col-md-6">
                                <label>Phone #</label>
                                <input class="form-control p-3 mb-4" placeholder="Contact No. " type="text" name="phonenum" id="phonenum" value="<?= $row['contact'];?>" required>
                            </div>


                            <div class="col-md-6">
                                <label >Email</label>
                                <input class="form-control p-3 mb-4" placeholder="Account Email" type="text" name="email" id="email" value="<?= $row['email'];?>" required>
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

    $('#password, #conpassword').on('keyup blur', function() {
    // Get the values of both password fields
    var passwordVal = $('#password').val();
    var confirmPasswordVal = $('#conpassword').val();
    
    // Check if the confirm password is empty
    if (confirmPasswordVal === '') {
        $('#conpassword').removeClass('is-valid is-invalid');
        $('#svchanges').attr('disabled', true);
    }
    // Check if the password and confirm password do not match
    else if (passwordVal !== confirmPasswordVal) {
        $('#conpassword').removeClass('is-valid').addClass('is-invalid');
        $('#svchanges').attr('disabled', true);
    }
    // Check if the password field is empty
    else if (passwordVal === "") {
        $('#conpassword').removeClass('is-valid is-invalid');
        $('#svchanges').attr('disabled', true);
    } 
    // Password and confirm password match
    else {
        $('#conpassword').removeClass('is-invalid').addClass('is-valid');
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