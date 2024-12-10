<?php
session_start();
require_once '../conn/conn.php';
require_once '../includes/include.php';
$message = "";
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $captcha = $_POST['captcha'];
    $generatedCaptcha = $_POST['generated-captcha'];

    if ($captcha !== $generatedCaptcha) {
        $message = 'CAPTCHA verification failed. Please try again.';
    }
    else {

            $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
            $result = mysqli_query($conn, $sql);

            if($result->num_rows > 0){
                $row = mysqli_fetch_assoc($result);
                if($row['isVerified']) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['fullname'] = $row['fname']." ".$row['mname']." ".$row['lname'];
                    $_SESSION['user'] = $row;

                    header("location:home.php");
                }
                else {
                    $message = "Your account is not yet verified.";

                }
            }
            else {
                $message = "Incorrect Password.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Login</title>
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

    input[type="email"], input[type="password"], input[type="text"] {
        width: 100%;
        height: 40px;
        padding: 7px;
        margin: 5px 0;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 10px;
    }

    .login {
        color: white; 
        text-decoration: none; 
        background-color: #00214D;  
        border-radius: 5px;   
        width: 100%;
        height: 40px;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
        box-sizing: border-box; 
    }

    .login:hover{
       color: white; 
       text-decoration: none; 
       background-color: #00214D;  
   }

   .full-height {
    z-index:2;
    position: relative;
  
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
    clip-path: polygon(0% 0%, 35% 0, 53% 50%, 35% 100%, 0% 100%);
    background-color: #00214D;
    top: 0;   
}

.clip2 {
    z-index: 0;
    position: fixed; 
    height: 100vh;
    width: 100%;
    clip-path: polygon(0% 0%, 40% 0, 55% 50%, 40% 100%, 0% 100%);
    background-color: #55D1FF;
    top: 0;   
}




.preview{
    height: 50px;
    letter-spacing: 8px;

}

.btn-transparent {
    background-color: transparent;
    border: none;
}
.btn-transparent:focus, .btn-transparent:active {
    outline: none;
    box-shadow: none;
}

.refresh{
    background-color: #00214D;
}
a{
    text-decoration: none;
    color: #00214D;  
}
a:hover{
    color: #00214D;  
}

h2 {
        color: white !important;
    }

@media (max-width: 1136px) {
    .clip, .clip2 {
        display: none;  
    }

    h2 {
        color: #00214D !important;
    }
}




</style>

</head>
<body>
    <div class="clip"></div>
    <div class="clip2"></div>

    <div class="container-fluid d-flex align-items-center justify-content-center full-height">
        <div class="container vh-100 d-flex align-items-center justify-content-center">
            <div class="row h-100 w-100 p-5">
                <div class="col-lg-7 col-md-12 col-sm-12 d-flex align-items-center">
                    <div>
                        <center>
                            <img src="../includes/logo/logo.gif" height="150" width="150" class="shadow-lg rounded-circle">
                        </center>
                        <h2 class="fw-bold mt-3 text-center mb-3">
                            PUGARO MANAGEMENT SYSTEM
                        </h2>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 d-flex align-items-center justify-content-center">
                    <div class="card p-4 rounded mb-5 opacity-75">
                        <h3 class="fw-bold p-3 mb-4" style="border-left: 3px solid #00214D; border-radius: 3px; color: black;">
                                RESIDENCE'S LOGIN
                            </h3>
                            <?php
                            if (isset($_GET['success']) == TRUE) {
                                ?>
                                <div class="alert alert-success text-center fw-bold">
                                    <?= @$_GET['success']; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <?php if($message) { ?>
                                <div class="alert alert-danger text-center" id="error-message"> <?php echo $message ?></div>
                            <?php } ?>
                            <form action='' class="w-100 fw-bold" method="POST">
                                <div class="form-group mb-3">
                                    <label for="username" class="fw-bold" style="color: black;">EMAIL :</label>
                                    <input type="email" id="email" name="email" placeholder="Juandelecruz@gmail.com" class="form-control fw-bold shadow mb-4" required>
                                </div>

                                <div class="form-group fw-bold" >
                                    <label for="password" class="fw-bold" style="color: black;">PASSWORD :</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control fw-bold shadow" required>
                                    <input type="checkbox" class="mb-4 fw-bold p-2" onclick="myFunction()">Show Password
                                </div>

                                <div class="form-group mb-3">
                                    <label for="captcha" class="fw-bold mb-1">CAPTCHA :</label>
                                    <div class="preview w-100 rounded shadow text-center p-2 mb-1"><p class="text-center p-2 fw-bold"></p></div>
                                    <div class="captcha-form d-flex">
                                        <input type="text" placeholder="Enter Captcha" id="captcha" name="captcha" class="form-control fw-bold shadow d-inline-block w-100" required>
                                        <button type="button"  class=" btn p-2 btn-transparent"><i class="refresh text-light fw-bold p-3 rounded-circle shadow fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <input type="hidden" id="generated-captcha" name="generated-captcha">
                                <center>
                                    <input type="submit" name="login" class="btn login shadow fw-bold" value="LOGIN ACCOUNT">
                                </form>
                                <div class="btn btn-light w-100  mt-2 shadow-lg p-3"><a href="../admin/login.php" class="h6 fw-bold">ADMINISTRATOR LOGIN</a></div>

                                <div class="mt-4 h6 text-dark">Don't have account ? <a href="register.php"><b>Register</b></a></div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
                            </div>
                            </body>

    <script>
        
            // GENERATE CAPTCHA
            function generateCaptcha() {
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                var captcha = '';
                for (var i = 0; i < 6; i++) {
                    captcha += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                $('.preview p').text(captcha);
                $('#generated-captcha').val(captcha);
            }


            $(document).ready(function() {
                generateCaptcha();
            // REFRESH CATCHA
            $('.refresh').on('click', function(){
                generateCaptcha();
            })



        });
    </script>
</body>
</html>