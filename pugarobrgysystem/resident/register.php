<?php
    session_start();
    require_once '../conn/conn.php';
    require_once '../includes/include.php';
    $message = "";
    $success = '';
    $float = false;
    $otpmessage = "";
    $resend = false;
    $_SESSION['modalshow'] = false;
    require_once('../sendmail.php');


    if (isset($_POST['register'])) {


        $password = md5($_POST['password']);
        $conf_password = md5($_POST['confpassword']);

        // CHECK IF PASSWORD AND CONFIRM PASSWORD MATCHED
        if ($password != $conf_password) {
            $_SESSION['status'] = "Password didn't matched";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Please try again your password".
            $float = true;
        
        } 


        $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['mname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $birthdate = $_POST['bdate'];
        // $address = mysqli_real_escape_string($conn, $_POST['address']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $voterid = mysqli_real_escape_string($conn, $_POST['voterid']);
        $profile = "default.jpg"; //DEFAULT PROFILE


        // GET VARIABLE FOR OTP
        $_SESSION['firstname'] = $firstname;
        $_SESSION['middlename'] = $middlename;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['regemail'] = $email;



        // GENERATE OTP NUMBER
        $vkey = mt_rand(100000, 999999); 
        $_SESSION['vkey'] = $vkey;



        // CHECK IF VOTER'S ID EXIST
        $sql_voterid = "SELECT * FROM `resident` WHERE voterid = $voterid";
        $check_voterid = mysqli_query($conn, $sql_voterid);
        



        // IF VOTERS ID DIDNT MATCH ANY
        if (mysqli_num_rows($check_voterid) == 0) {
            $_SESSION['status'] = "Invalid Voter's ID";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Your Voter's ID doesn't exist."; 
            $float = true;
        
        }
        

        // IF VOTERS ID MATCHED
        else {
            
            $row = mysqli_fetch_assoc($check_voterid);
            $Is4ps = $row['4ps'] === "4P'S" ? 1 : 0; //IF 4PS || NOT 

            // CHECK IF EMAIL EXIST AND VERIFIED
            $sql_email = "SELECT email FROM `user` WHERE email = '$email' AND isVerified = 1";
            $check = mysqli_query($conn, $sql_email);
            


            // CHECK IF EMAIL ALREADY EXIST
            if ($check->num_rows > 0) {
                $_SESSION['status'] = "Email already exist";
                $_SESSION['status_code'] = "error";
                $_SESSION['message'] = "This email already exist and verified.";
                $float = true;

            } 
            //  SEND OTP THROUGH EMAIL
            else {
                
                // INSERT TO DATABASE USER CREDENTIAL
                $sql1 = "INSERT INTO user (`user_id`,`password`,`fname`,`mname`, `lname`, `gender`, `bdate`, `contact`, `email`,`vkey`,`profile`,`Is4ps`) VALUES (NULL, '$password','$firstname', '$middlename', '$lastname', '$gender', '$birthdate', '$contact', '$email', '$vkey', '$profile','$Is4ps')";
                $run = mysqli_query($conn, $sql1);

                
                if ($run) {
                    $_SESSION['modalshow'] = true; // SESSION FOR MODAL MODAL
                    $success = "Your code was sent to you via email " . $email . "";
                    $_SESSION['verefymessage'] = $success;


                    $a = "Pugaro Management System"; 
                    $b = "<html><body><p>Hi mam/sir $firstname $middlename $lastname. Good day! Thanks for registering your account in Pugaro Management. Your OTP code is $vkey </a></p></body></html>";
                    $c = $email;
                    $d = $firstname . " " . $middlename . " " . $lastname;

                    setData($a, $b, $c, $d); //


                }
            }
        }
    }


    if (isset($_POST['verify'])) {
        $num1 = mysqli_real_escape_string($conn, $_POST['num1']);
        $num2 = mysqli_real_escape_string($conn, $_POST['num2']);
        $num3 = mysqli_real_escape_string($conn, $_POST['num3']);
        $num4 = mysqli_real_escape_string($conn, $_POST['num4']);
        $num5 = mysqli_real_escape_string($conn, $_POST['num5']);
        $num6 = mysqli_real_escape_string($conn, $_POST['num6']);
        $otp= $num1 . $num2 . $num3 . $num4 . $num5 . $num6;

        if(intval($otp) === intval( $_SESSION['vkey'] )){ 

                $code = $_SESSION['vkey'];
                $sql = "SELECT isVerified, vkey FROM user WHERE isVerified = 0 AND vkey =
                '$code' LIMIT 1";
                $result = mysqli_query($conn, $sql);

                unset($_SESSION['verefymessage']);
                unset($_SESSION['vkey']);
                unset($_SESSION['modalshow']);
                unset($_SESSION['firstname']);
                unset($_SESSION['middlename']);
                unset($_SESSION['lastname']);
                unset($_SESSION['regemail']);

                if ($result != false && $result->num_rows > 0) {
                    $updateQuery = "UPDATE user SET isVerified = 1 WHERE vkey = '$code' LIMIT 1";
                    $update_query = mysqli_query($conn, $updateQuery);
            
                    if ($update_query) {
                        header('location:../resident/login?success=Your Account Has been Verified');
                    } else {
                        echo "Error";
                    }
                }
       
           header('location:../resident/login?success=Your Account Has been Verified');
            ?>
    <?php }
        else {  
            $_SESSION['modalshow'] = true;
            $otpmessage = "The OTP you entered does not match" ?>
            <script>
            var otpModal = new bootstrap.Modal(document.getElementById('otpmodal'));
            otpModal.show();
        </script>
        <?php
        }
    }


    if (isset($_POST['resend_otp'])) {
        $_SESSION['modalshow'] = true;
        $resend = true;
        $vkey = mt_rand(100000, 999999);  
        $_SESSION['vkey'] = $vkey;  
        $email = $_SESSION['regemail'];
        $firstname = $_SESSION['firstname'];
        $middlename = $_SESSION['middlename'];
        $lastname = $_SESSION['lastname'];
    
        $email = mysqli_real_escape_string($conn, $email);
    
        $updateotp = "UPDATE `user` 
                      SET `vkey` = '$vkey', `updated_at` = NOW() 
                      WHERE `email` = '$email' AND `isVerified` = 0";
    
        $check = mysqli_query($conn, $updateotp);
    
        $a = "Pugaro Management System"; 
        $b = "<html><body><p>Hi $firstname $middlename $lastname, Good day! Thanks for registering your account in Pugaro Management. Your OTP code is $vkey.</p></body></html>";  // Email body
        $c = $email;  
        $d = "$firstname $middlename $lastname"; 
        setData($a, $b, $c, $d);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../includes/css/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <title>Register</title>
    <script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>

    <style>


        form {
            border-radius: 5px;
            background-color: blur;
        }


        .register {
            color: white; 
            text-decoration: none; 
            background-color: #00214D;  
            border-radius: 5px;   
            width: 100%;
            border-radius: 5px;
        }

        .register:hover{
        	color: white; 
            text-decoration: none; 
            background-color: #00214D;  
        }

        .full-height {
            z-index:2;
            position: relative;
        }
        .tag {

        	color: #00214D;
        }

        .center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
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




    .clip {
        z-index: 1;
        position: fixed;  
        height: 100vh;
        width: 100%;
        clip-path: polygon(0% 0%, 30% 0, 45% 50%, 35% 100%, 0% 100%);
        background-color: #00214D;
        top: 0;   
    }

    .clip2 {
        z-index: 0;
        position: fixed; 
        height: 100vh;
        width: 100%;
        clip-path: polygon(0% 0%, 35% 0, 47% 50%, 40% 100%, 0% 100%);
        background-color: #55D1FF;
        top: 0;   
    }


        .formlogin {
            position: absolute;
            z-index: 4;
            top: 15%;
            left:50%;
        }

        .logo {
            position: absolute;
            z-index: 4;
            top: 30%;
            right:50%;
            bottom: 50%;;

            height:200px;
        }



        a{
            text-decoration: none;
            color: #00214D;  
        }
        a:hover{
            color: #00214D;  
        }
        .title {
        color: white !important;
    }

    @media (max-width: 1136px) {
        .clip, .clip2 {
            display: none;  
        }

        .title {
            color: #00214D !important;
        }
    }


        
  

    </style>

</head>
<body>


    <div class="clip"></div>
    <div class="clip2"></div>


    <div class="container-fluid d-flex align-items-center justify-content-center full-height">
        <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
            <div class="row h-100 w-100 p-5">
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex align-items-center justify-content-center">
                    <div>
                        <center>
                            <img src="../includes/logo/logo.gif" height="150" width="150" class="shadow-lg rounded-circle">
                        </center>
                        <h2 class="fw-bold title mt-3 text-center mb-3">
                            PUGARO MANAGEMENT SYSTEM
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12  d-flex align-items-center justify-content-center">
                    <div class="card p-4 rounded mb-5 w-100 opacity-75">
                        <h3 class="fw-bold p-3 mb-4" style="border-left: 3px solid #00214D; border-radius: 3px; color: black;">
                            REGISTER ACCOUNT
                        </h3>
                        
                        <?php if($message) { ?>
                        <div class="alert alert-danger text-center" id="error-message"> <?php echo $message ?></div>
                        <?php } ?>
                        <form action='' class="w-100 fw-bold" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">FIRST NAME :</label>
                                    <input type="text" id="fname" name="fname" placeholder="Juan" class="form-control p-3  shadow mb-4" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">MIDDLE NAME :</label>
                                    <input type="text" id="mname" name="mname" placeholder="Cruz" class="form-control p-3 shadow mb-4" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">LAST NAME :</label>
                                    <input type="text" id="lname" name="lname" placeholder=" Dele Cruz" class="form-control p-3  shadow mb-4" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gender" class="mt-1 fw-bold" style="color: black;">GENDER :</label>
                                    <select id="gender" name="gender" class="form-control p-3 shadow mb-4" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">BIRTHDATE :</label>
                                    <input type="date" id="bdate" name="bdate"  class="form-control p-3  shadow mb-4" required>
                                </div>
                            </div>


                            <!-- <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">ADDRESS :</label>
                                    <input type="text" id="address" name="address" placeholder="Pugaro Manaoag Pangasinan" class="form-control  p-3 shadow mb-4" required>
                                </div>
                            </div> -->


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">CONTACT NO. :</label>
                                    <input type="number" id="contact" name="contact" placeholder="09123456789"  min=0 class="form-control p-3 shadow mb-4" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">EMAIL :</label>
                                    <input type="email" id="email" name="email" placeholder="Juandelecruz@gmail.com" class="form-control p-3  shadow mb-4" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="username" class="mt-1 fw-bold" style="color: black;">VOTER ID :</label>
                                    <input type="number" id="voterid" name="voterid" class="form-control p-3 shadow mb-4" placeholder="12 Digits" required oninput="limitVoterIdLength(this)" />
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group fw-bold" >
                                    <label for="password" class="mt-1 fw-bold" style="color: black;">PASSWORD :</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control p-3  shadow" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group fw-bold" >
                                    <label for="password" class="mt-1 fw-bold" style="color: black;">CONFIRM PASSWORD :</label>
                                    <input type="password" id="confpassword" name="confpassword" placeholder="Confirm Password" class="form-control p-3  shadow" required>
                                </div>
                            </div>
                        </div>
                        <center>
                            <input type="submit" name="register" class="btn register mt-5 p-3 shadow-lg fw-bold" value="REGISTER ACCOUNT">
                        </form>
                            <div class="mt-4 h6 text-dark">Already have account ? <a href="login.php"><b>Login</b></a></div>
                        </center>
                        </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal modal-fade" id="otpmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="deleteEventLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <h1 class="modal-title fw-bold p-4 fs-5" id="deleteEventLabel">OTP VERIFICATION</h1>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
                                <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                                    <div class="card-body p-5 text-center">
                                    <?php if($otpmessage) { ?>
                                        <div class="alert alert-danger text-center" id="error-message"> <?php echo $otpmessage ?></div>
                                    <?php } ?>
                                        <h4>Verify</h4>
                                        <p class="h6"><?php echo  $_SESSION['verefymessage']; ?></p>
                                        <div class="otp-field mb-4">
                                            <form method="POST">
                                                <input type="number" name="num1" maxlength="1" />
                                                <input type="number" name="num2"  maxlength="1" disabled />
                                                <input type="number" name="num3"  maxlength="1" disabled />
                                                <input type="number" name="num4"  maxlength="1" disabled />
                                                <input type="number" name="num5"  maxlength="1" disabled />
                                                <input type="number" name="num6"  min="0" max="9" step="1" oninput="restrictInput(this)"/>
                                                </div>

                                                <button type="submit" name="verify" class="btn fw-bold verify text-white mb-3" style="background-color: #00214D ;">
                                                Verify
                                                </button>
                                            </form>

                                            <p class="resend h6 text-muted mb-0">
                                                Didn't receive the code? 
                                            </p>
                                            <form method="POST">
                                                <button class="bg-transparent btn border-0 mt-2 shadow h6" type="submit" name="resend_otp">Resend OTP</button>
                                            </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    if ($float) {
    ?>
        <script>
            Swal.fire({
                title: "<?php echo $_SESSION['status'] ?>",
                icon: "<?php echo $_SESSION['status_code'] ?>",
                text: "<?php echo $_SESSION['message'] ?>",
                button: "Okay",
            });
        </script>

    <?php
        unset($_SESSION['status']);
    }
    ?>




<script>

    function limitVoterIdLength(input) {
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); 
        }
    }


  const otpInputs = document.querySelectorAll('.otp-field input');
  otpInputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
      if (e.target.value.length === 1 && index < otpInputs.length - 1) {
        otpInputs[index + 1].disabled = false;
        otpInputs[index + 1].focus();
      }
    });

    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '') {
        if (index > 0) {
          otpInputs[index - 1].disabled = false;
          otpInputs[index - 1].focus();
        }
      }
    });
  });

  function restrictInput(input) {
    const value = input.value;
    if (value.length > 1) {
      input.value = value.slice(0, 1);
    }
  }
</script>
<?php if($_SESSION['modalshow']) { ?>
            <script>
                console.log('dgfffdfhgf');
                
                var otpModal = new bootstrap.Modal(document.getElementById('otpmodal'));
                otpModal.show();
            </script>
            <?php
            $resend = false;
        } ?>

</body>
</html>