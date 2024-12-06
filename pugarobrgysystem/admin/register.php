<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>

    <style>
       body {
            font-family: Cambria, sans-serif;
   
        }

        .full-height {
            height: 100vh;
            position: relative;
            z-index:2;
        }

        .clip{
            position: absolute;
            z-index:0;
            height: 100vh;
            width: 100%;
            clip-path: polygon(50% 0%, 100% 0, 50% 30%, 0 0);
            background-color: #00BFFF;
        }
        form {
            margin: 10px auto;
            width: 450px;
            padding: 20px;
            border-radius: 5px;
            background-color: blur;
        }
        .login {
            color: white; 
            text-decoration: none; 
            background-color: #00BFFF;  
            border-radius: 5px;   
            width: 100%;
            height: 40px;
            padding: 5px;
            border-radius: 5px;
            box-sizing: border-box; 
        }
        .form-label {
            text-decoration: none;
            color: black;
        }
        .login:hover{
        	color: white; 
            text-decoration: none; 
            background-color: #00BFFF;  
        }

        .tag {

        	color: #00BFFF;
        }

    </style>
</head>
<body>
    <div class="clip"></div>
 <div class="container full-height bg-transparent d-flex justify-content-center align-items-center">  
            <div>
            <center>
        			<img src="../includes/logo/logo.gif" height= "100" width="100" class="rounded-circle">
        	    </center>
        		<h1 class="fw-bold text-center mb-3" style="color: black; font-size: 20px; font-family: Cambria, serif;">
                    <span class="tag">P</span>UGARO <span><span class="tag">M</span>ANAGEMENT <span class="tag">S</span>YSTEM</span>
                </h1>    
                    <div class="container  bg-transparent  w-50  rounded">
                        <div>
                	       <h3 class="fw-bold p-1" style="border-left: 3px solid #00BFFF; margin-left: 35px; border-radius: 3px; color: black;">Register Account</h2>

                            <form action='' class="w-100 shadow" method="POST">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-3">
                                            <input type="text" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Firstname</label>
                                            </div>
                                        </div>   

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-3">
                                            <input type="text" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Middlename</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="text" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Lastname</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="text" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Address</label>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="number" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Contact</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="date" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Birthdate</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="text" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Position</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="email" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control mb-4">
                                            <input type="password" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Password</label>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-12 col-12">
                                        <div data-mdb-input-init class="form-outline form-control">
                                            <input type="password" id="form2Example1" class="form-control" required/>
                                            <label class="h5 form-label bg-white" for="form2Example1">Confirm Password</label>
                                        </div>
                                    </div>
                                    <center>
                	   <input type="submit" name="login" class="btn w-50 login fw-bold" style="font-size:15px;" value="REGISTER">
                    </center>
	            </form>
                </div>

            	<div class="text-center">
                	<p>Already have an Account? <a href="index.php" style="text-decoration: none; color: #00BFFF; font-weight: bolder;"> Login</a></p>
            	</div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>