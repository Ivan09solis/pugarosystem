<?php
include_once '../conn/conn.php';

session_start();

//Residents Management---------------------------------------------------------------------------------------------------------------------------------------------------------

// Add Resident
if (isset($_POST['addresident'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $voterid = mysqli_real_escape_string($conn, $_POST['voterid']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $senior_citizen = mysqli_real_escape_string($conn, $_POST['senior_citizen']);
    $welfare = mysqli_real_escape_string($conn, $_POST['4ps']);
    $voter = mysqli_real_escape_string($conn, $_POST['voter']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Check if the name already exists
    $check_sql = "SELECT * FROM `resident` WHERE `name` = '$name' OR `voterid` =  $voterid";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Name already exists
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record already exists.";
        header("location:../admin/resident.php");
    } else {
        $sql = "INSERT INTO resident (`id`, `name`,`voterid`, `bdate`, `civilstatus`, `religion`, `gender`, `address`,`pwd`,`senior_citizen`,`4ps`,`voter`,  `created_at`, `updated_at`) VALUES (NULL, '$name', '$voterid', '$bdate', '$civilstatus', '$religion', '$gender', '$address', '$pwd', '$senior_citizen', '$welfare','$voter', now(), now())";
        $result = mysqli_query($conn, $sql);        

        if ($result != TRUE) {
            $_SESSION['status'] = "Adding Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Fail to add Resident.";
            header("location:../admin/resident.php");
        } else {
            $_SESSION['status'] = "Successfully added.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Resident added.";
            header("location:../admin/resident.php");
        }
    }
}


//UPDATE RESIDENT
if (isset($_POST['updateresident'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']); 
    $voterid = mysqli_real_escape_string($conn, $_POST['voterid']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $senior_citizen = mysqli_real_escape_string($conn, $_POST['senior_citizen']);
    $welfare = mysqli_real_escape_string($conn, $_POST['4ps']);
    $voter = mysqli_real_escape_string($conn, $_POST['voter']);

    $check_sql = "SELECT * FROM resident WHERE `name` = '$name' AND `id` != $id";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['status'] = "Updating Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Name already exists.";
        header("location:../admin/resident.php");
    } else {
        $sql = "UPDATE `resident` 
                SET `name` = '$name', 
                    `voterid` = '$voterid',
                    `bdate` = '$bdate', 
                    `civilstatus` = '$civilstatus', 
                    `religion` = '$religion', 
                    `gender` = '$gender', 
                    `address` = '$address', 
                    `pwd` = '$pwd', 
                    `senior_citizen` = '$senior_citizen', 
                    `4ps` = '$welfare', 
                    `voter` = '$voter', 
                    `updated_at` = NOW() 
                WHERE `id` = $id";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $_SESSION['status'] = "Update Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Record update failed.";
            header("location:../admin/resident.php");
        } else {
            $_SESSION['status'] = "Successfully Updated.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Resident updated successfully.";
            header("location:../admin/resident.php");
        }
    }
}



// Delete Risedent
if(isset($_POST['deleteresident'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `resident` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't add.";
        header("location:../admin/resident.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../admin/resident.php");

    }
}


// BLOTTER ------------------------------------------------------------------------------------------------------------------
// ADD BLOTTER
if (isset($_POST['addblotter'])) {
    // Sanitize and escape the input data
    $incident_type = mysqli_real_escape_string($conn, $_POST['incident_type']);
    $date_time_reported = mysqli_real_escape_string($conn, $_POST['date_time_reported']);
    $date_time_incident = mysqli_real_escape_string($conn, $_POST['date_time_incident']);
    
    // Reporting person details
    $reporter_name = mysqli_real_escape_string($conn, $_POST['reporter_name']);
    $reporter_birthdate = mysqli_real_escape_string($conn, $_POST['reporter_birthdate']);
    $reporter_civil_status = mysqli_real_escape_string($conn, $_POST['reporter_civil_status']);
    $reporter_gender = mysqli_real_escape_string($conn, $_POST['reporter_gender']);
    $reporter_religion = mysqli_real_escape_string($conn, $_POST['reporter_religion']);
    $reporter_address = mysqli_real_escape_string($conn, $_POST['reporter_address']);
    
    // Defendant details
    $defendant_name = mysqli_real_escape_string($conn, $_POST['defendant_name']);
    $defendant_birthdate = mysqli_real_escape_string($conn, $_POST['defendant_birthdate']);
    $defendant_civil_status = mysqli_real_escape_string($conn, $_POST['defendant_civil_status']);
    $defendant_gender = mysqli_real_escape_string($conn, $_POST['defendant_gender']);
    $defendant_religion = mysqli_real_escape_string($conn, $_POST['defendant_religion']);
    $defendant_address = mysqli_real_escape_string($conn, $_POST['defendant_address']);
    
    // PERSONNEL INFO
    $personnel_name = mysqli_real_escape_string($conn, $_POST['personnel_name']);
    $personnel_position = mysqli_real_escape_string($conn, $_POST['personnel_position']);


    // Narrative
    $narrative = mysqli_real_escape_string($conn, $_POST['narrative']);

    $ref = uniqid();

    
    $check_sql = "SELECT * FROM blotters WHERE `incident_type` = '$incident_type' AND `date_time_reported` = '$date_time_reported'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Incident report already exists.";
        header("location:../admin/blotters.php");
    } else {
        $sql = "INSERT INTO blotters 
                (`ref`, `incident_type`, `date_time_reported`, `date_time_incident`, 
                `reporter_name`, `reporter_birthdate`, `reporter_civil_status`, 
                `reporter_gender`, `reporter_religion`, `reporter_address`, 
                `defendant_name`, `defendant_birthdate`, `defendant_civil_status`, 
                `defendant_gender`, `defendant_religion`, `defendant_address`, `personnel_name`, `personnel_position`,  `narrative`, `created_at`, `updated_at`) 
                VALUES 
                ('$ref','$incident_type', '$date_time_reported', '$date_time_incident', 
                '$reporter_name', '$reporter_birthdate', '$reporter_civil_status', 
                '$reporter_gender', '$reporter_religion', '$reporter_address', 
                '$defendant_name', '$defendant_birthdate', '$defendant_civil_status', 
                '$defendant_gender', '$defendant_religion', '$defendant_address', '$personnel_name', '$personnel_position', '$narrative', now(), now())";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Successfully added
            $_SESSION['status'] = "Successfully added.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Incident report added.";
            header("location:../admin/blotter.php");
        } else {
            // Failed to add
            $_SESSION['status'] = "Adding Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Failed to add incident report.";
            header("location:../admin/blotter.php");
        }
    }
}

// UPDATE BLOTTER
if (isset($_POST['updateblotter'])) {
    // Sanitize and escape the input data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $incident_type = mysqli_real_escape_string($conn, $_POST['incident_type']);
    $date_time_reported = mysqli_real_escape_string($conn, $_POST['date_time_reported']);
    $date_time_incident = mysqli_real_escape_string($conn, $_POST['date_time_incident']);
    
    // Reporting person details
    $reporter_name = mysqli_real_escape_string($conn, $_POST['reporter_name']);
    $reporter_birthdate = mysqli_real_escape_string($conn, $_POST['reporter_birthdate']);
    $reporter_civil_status = mysqli_real_escape_string($conn, $_POST['reporter_civil_status']);
    $reporter_gender = mysqli_real_escape_string($conn, $_POST['reporter_gender']);
    $reporter_religion = mysqli_real_escape_string($conn, $_POST['reporter_religion']);
    $reporter_address = mysqli_real_escape_string($conn, $_POST['reporter_address']);
    
    // Defendant details
    $defendant_name = mysqli_real_escape_string($conn, $_POST['defendant_name']);
    $defendant_birthdate = mysqli_real_escape_string($conn, $_POST['defendant_birthdate']);
    $defendant_civil_status = mysqli_real_escape_string($conn, $_POST['defendant_civil_status']);
    $defendant_gender = mysqli_real_escape_string($conn, $_POST['defendant_gender']);
    $defendant_religion = mysqli_real_escape_string($conn, $_POST['defendant_religion']);
    $defendant_address = mysqli_real_escape_string($conn, $_POST['defendant_address']);
    
    // PERSONNEL INFO
    $personnel_name = mysqli_real_escape_string($conn, $_POST['personnel_name']);
    $personnel_position = mysqli_real_escape_string($conn, $_POST['personnel_position']);

    // Narrative
    $narrative = mysqli_real_escape_string($conn, $_POST['narrative']);
    
    // Update the blotter in the database
    $update_sql = "UPDATE blotters SET 
                   `status` = '$status', 
                   `incident_type` = '$incident_type', 
                   `date_time_reported` = '$date_time_reported', 
                   `date_time_incident` = '$date_time_incident',
                   `reporter_name` = '$reporter_name', 
                   `reporter_birthdate` = '$reporter_birthdate',
                   `reporter_civil_status` = '$reporter_civil_status', 
                   `reporter_gender` = '$reporter_gender',
                   `reporter_religion` = '$reporter_religion', 
                   `reporter_address` = '$reporter_address',
                   `defendant_name` = '$defendant_name', 
                   `defendant_birthdate` = '$defendant_birthdate',
                   `defendant_civil_status` = '$defendant_civil_status', 
                   `defendant_gender` = '$defendant_gender',
                   `defendant_religion` = '$defendant_religion', 
                   `defendant_address` = '$defendant_address',
                   `personnel_name` = '$personnel_name',
                   `personnel_position` = '$personnel_position',
                   `narrative` = '$narrative', 
                   `updated_at` = now()
                   WHERE `id` = '$id'";
    
    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        // Successfully updated
        $_SESSION['status'] = "Successfully updated.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Incident report updated.";
        header("location:../admin/blotter.php");
    } else {
        // Failed to update
        $_SESSION['status'] = "Update Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Failed to update incident report.";
        header("location:../admin/blotter.php");
    }
}


// Delete BLOTTER
if(isset($_POST['deleteblotter'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `blotters` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Deleting Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't delete.";
        header("location:../admin/blotter.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../admin/blotter.php");

    }
}




// ANNOUNCEMENT----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Add Announcement
if (isset($_POST['addannouncement'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $intended = mysqli_real_escape_string($conn, $_POST['intended']);
    

    // Check if the name already exists
    $check_sql = "SELECT * FROM announcement WHERE `title` = '$title'";
    $check_result = mysqli_query($conn, $check_sql);



    if (mysqli_num_rows($check_result) > 0) {
        // Title already exists
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Title already exists.";
        header("location:../admin/announcement.php");
    } else {
        $sql = "INSERT INTO announcement (`id`, `title`, `description`, `intended`,`created_at`, `updated_at`) VALUES (NULL, '$title', '$description','$intended', now(), now())";
        $result = mysqli_query($conn, $sql);        

        if ($result != TRUE) {
            $_SESSION['status'] = "Adding Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Fail to add Announcement.";
            header("location:../admin/announcement.php");
        } else {

            $user4ps = "SELECT * FROM `user` WHERE `Is4ps` = 1";
            $MAYRESULT = mysqli_query($conn, $user4ps);     

            if ($MAYRESULT && $intended !== "") {
                require_once('../sendmail.php');
                while ($row = mysqli_fetch_assoc($MAYRESULT)) {
                    $a = "Pugaro Management System";
                    $b = "<html><body><p>Hi mam/sir " . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . ". <b>NOTIFICATION : </b> A new announcement regarding 4P's: $title, $description</p></body></html>";
                    $c = $row['email'];
                    $d = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
                    setData($a, $b, $c, $d);
                }
            }


            $_SESSION['status'] = "Successfully added.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Announcement added.";
            header("location:../admin/announcement.php");
        }
    }
}

//UPDATE Announcement
if (isset($_POST['updateannouncement'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $intended = mysqli_real_escape_string($conn, $_POST['intended']);

        // Check if the name already exists
    $check_sql = "SELECT * FROM announcement WHERE `title` = '$title' AND `id` != $id";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
            // Name already exists
        $_SESSION['status'] = "Updating Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Name already exists.";
        header("location:../admin/announcement.php");
    } else {

        $sql = "UPDATE `announcement` SET `title` = '$title', `description` = '$description',  `intended` = '$intended', `updated_at` = now() WHERE `id` = $id";
        $result = mysqli_query($conn, $sql);


        if ($result != TRUE) {
            $_SESSION['status'] = "Updating Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Record didn't update.";
            header("location:../admin/announcement.php");


        } 
        else if($result == TRUE){

            $user4ps = "SELECT * FROM `user` WHERE `Is4ps` = 1";
            $MAYRESULT = mysqli_query($conn, $user4ps);     

            if ($MAYRESULT && $intended !== "") {
                require_once('../sendmail.php');
                while ($row = mysqli_fetch_assoc($MAYRESULT)) {
                    $a = "Pugaro Management System";
                    $b = "<html><body><p>Hi mam/sir " . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . ". <b>NOTIFICATION : </b> A new announcement regarding 4P's: $title, $description</p></body></html>";
                    $c = $row['email'];
                    $d = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
                    setData($a, $b, $c, $d);
                }
            }


            $_SESSION['status'] = "Successfully Updated.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Updated Successful.";
            header("location:../admin/announcement.php");

        }
    }
}


// Delete Announcement
if(isset($_POST['deleteannouncement'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `announcement` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't add.";
        header("location:../admin/announcement.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../admin/announcement.php");

    }
}


// EVENT--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Add event
if (isset($_POST['addevent'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $eventdate = mysqli_real_escape_string($conn, $_POST['eventdate']);
    $from = mysqli_real_escape_string($conn, $_POST['from']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);

    
    $_FILES['img']['name'] ? $img = $_FILES['img']['name'] : $img = 'logo.gif';
    $img_folder = '../includes/uploads/' . $img;

    // Check if the title already exists
    $check_sql = "SELECT 1 FROM event WHERE `title` = '$title'";
    if (mysqli_num_rows(mysqli_query($conn, $check_sql)) > 0) {
        // Title already exists
        $_SESSION['status'] = "Adding Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Title already exists.";
    }
    elseif (move_uploaded_file($_FILES['img']['tmp_name'], $img_folder)) {
        // Insert the event details into the database, including the image filename
        $sql = "INSERT INTO event (`title`, `description`, `venue`, `eventdate`, `from`, `to`, `img`, `created_at`, `updated_at`) 
        VALUES ('$title', '$description', '$venue', '$eventdate', '$from', '$to', '$img', now(), now())";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "Successfully added.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Event added.";
        } else {
            $_SESSION['status'] = "Adding Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Failed to add event.";
        }
    } else {
        // Image upload failed
        $_SESSION['status'] = "Image Upload Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Failed to upload image.";
    }

    header("location:../admin/event.php");
}



//UPDATE Event
if (isset($_POST['updateevent'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $eventdate = mysqli_real_escape_string($conn, $_POST['eventdate']);
    $from = mysqli_real_escape_string($conn, $_POST['from']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);



// Check if the name already exists
    $check_sql = "SELECT * FROM event WHERE `title` = '$title' AND `id` != '$id'";
    if (mysqli_num_rows(mysqli_query($conn, $check_sql)) > 0) {
        $_SESSION['status'] = "Updating Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Name already exists.";
    } else {
        $sql = "UPDATE `event` SET `title` = '$title', `description` = '$description', `venue` = '$venue', 
        `eventdate` = '$eventdate', `from` = '$from', `to` = '$to', `updated_at` = now() WHERE `id` = $id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "Successfully updated.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Event updated.";
        } else {
            $_SESSION['status'] = "Updating Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Failed to update event.";
        }
    }
    
    header("location:../admin/event.php");
}

// UPDATE EVENT IMAGE
if (isset($_POST['updateimg_identifier']) && $_POST['updateimg_identifier'] === 'updateimg_identifier') {
    $id = $_POST['imgid'];
    $img = $_FILES['imgupdate']['name'];
    
    if ($img) {
        $target_dir = '../includes/uploads/';
        $target_file = $target_dir . basename($img);
        if (move_uploaded_file($_FILES['imgupdate']['tmp_name'], $target_file)) {
            $sql = "UPDATE `event` SET `img`='$img' `created_at` = now() WHERE `id` = '$id'";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['status'] = "Successfully updated.";
                $_SESSION['status_code'] = "success";
                $_SESSION['message'] = "Event updated.";
            } else {
                $_SESSION['status'] = "Updating Failed.";
                $_SESSION['status_code'] = "error";
                $_SESSION['message'] = "Failed to update event.";
            }
        } else {
            $_SESSION['status'] = "File upload failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Failed to upload image.";
        }
    } else {
        $_SESSION['status'] = "No file selected.";
        $_SESSION['status_code'] = "warning";
        $_SESSION['message'] = "Please select an image.";
    }

    header("Location: ../admin/event.php");
}




// Delete event
if(isset($_POST['deleteevent'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `event` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Deleting Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't Delete.";
        header("location:../admin/event.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../admin/event.php");

    }
}





// ____________________________________________________ADMIN SIDE REQUESTFORM_______________________________________________


// UPDATE ACCEPT REQUEST
if (isset($_POST['acceptrequest'])) {
    $id = mysqli_real_escape_string($conn, $_POST['req_id']);
    $status = 'Accepted';


    // Check if the request exist
    $check_sql = "SELECT * FROM forms WHERE `form_id` = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    while ($row = $check_result->fetch_assoc()) {
        $user_id = $row['user'];

    }

    $check_user = "SELECT * FROM user WHERE `user_id` = '$user_id'";
    $getuser = mysqli_query($conn, $check_user);

    require_once('../sendmail.php');
    while ($row = $getuser->fetch_assoc()) {
        $a = "Pugaro Management System";
       $b = "<html><body><p>Hi mam/sir " . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . ". <b>NOTIFICATION : </b>Your Request form is ready to pick up at the Barangay Hall.</p></body></html>";
        $c = $row['email'];
        $d = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
        
        setData($a, $b, $c, $d);
    }



        $sql = "UPDATE `forms` SET `status` = '$status' , `updated_at` = now() WHERE `form_id` = $id";
        $result = mysqli_query($conn, $sql);


        if ($result != TRUE) {
            $_SESSION['status'] = "Fail to accept.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Request didn't accept.";


        } 
        else if($result == TRUE){
            


            $_SESSION['status'] = "Request Accepted successfully.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Accepted successful.";

        }

        $location = mysqli_real_escape_string($conn, $_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location'])  : mysqli_real_escape_string($conn, $_POST['location2'])  ;
        header("location:../admin/$location");

}


// UPDATE COMPLETED REQUEST
if (isset($_POST['completedrequest'])) {

    $id = mysqli_real_escape_string($conn, $_POST['req_id']);
    $status = 'Completed';


        $sql = "UPDATE `forms` SET `status` = '$status' , `updated_at` = now() WHERE `form_id` = $id";
        $result = mysqli_query($conn, $sql);


        if ($result != TRUE) {
            $_SESSION['status'] = "Fail to update.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Request didn't update to completed.";
            header("location:../admin/application.php");
        } 

        else if($result == TRUE){
            $_SESSION['status'] = "Request Completed successfully.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Completed successful.";
            header("location:../admin/application.php");

        }
}


// UPDATE DECLINE REQUEST
if (isset($_POST['declinerequest'])) {
    $id = mysqli_real_escape_string($conn, $_POST['req_id']);
    $status = 'Declined';
    // echo $id;
    // Check if the request exist
    $check_sql = "SELECT * FROM forms WHERE `form_id` = '$id'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        $sql = "UPDATE `forms` SET `status` = '$status' , `updated_at` = now() WHERE `form_id` = $id";
        $result = mysqli_query($conn, $sql);


        if ($result != TRUE) {
            $_SESSION['status'] = "Fail to decline.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Request didn't decline.";


        } 
        else if($result == TRUE){
            $_SESSION['status'] = "Request Declined successfully.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Declined successful.";

        }

        $location = mysqli_real_escape_string($conn, $_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location'])  : mysqli_real_escape_string($conn, $_POST['location2'])  ;
        header("location:../admin/$location");
        // echo $location;
    }
}


// FEEDBACK----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Delete FEEDBACK
if(isset($_POST['deletefeedback'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `feedback` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Deleting Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't Delete.";
        header("location:../admin/feedback.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../admin/feedback.php");

    }
}




// ______________________________________________RESIDENTR REQUEST CLEARANCE______________________________________________________________________

    // Request Clearance
if(isset($_POST['newrequest'])){
    $formtype = mysqli_real_escape_string($conn, $_POST['formtype']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $bdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user = $_SESSION['user_id'];
    $status = 'Pending';
    $ref = uniqid(12);




    
    $fullname = $fname.' '.$mname.' '.$lname;

    $checkblotter = "SELECT * FROM `blotters` WHERE `defendant_name` LIKE '%$fullname%'";
    $tama = mysqli_query($conn, $checkblotter);

    if (mysqli_num_rows($tama) > 0) {
            $_SESSION['status'] = "Blotter Record Dectected.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Your name has a blotter record in our database.";
            header("location:../resident/forms.php");
   
    }
    else {


        $sql = "INSERT INTO forms (`form_id`, `ref` , `formtype`, `purpose`, `fname`, `mname`, `lname` , `bdate`, `age`, `address`, `user`, `status`, `created_at`, `updated_at`) VALUES (NULL, '$ref' ,'$formtype' , '$purpose' , '$fname' , '$mname' , '$lname' , '$bdate' , '$age', '$address', '$user' , '$status',  now(), now())";
        $result = mysqli_query($conn, $sql);

        if ($result != TRUE) {
            $_SESSION['status'] = "Adding Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Fail to apply request.";
            header("location:../resident/forms.php");
        } else {
            $_SESSION['status'] = "Request completed successfully. $fullname ";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Request was successful.";
            header("Location: ../resident/forms.php");
        }

    }
 
}


// UPDATE CANCEL REQUEST
if (isset($_POST['cancelrequest'])) {
    $id = mysqli_real_escape_string($conn, $_POST['req_id']);
    $status = 'Cancelled';
    echo $id;
    // Check if the request exist
    $check_sql = "SELECT * FROM forms WHERE `form_id` = '$id'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        $sql = "UPDATE `forms` SET `status` = '$status' , `updated_at` = now() WHERE `form_id` = $id";
        $result = mysqli_query($conn, $sql);


        if ($result != TRUE) {
            $_SESSION['status'] = "Updating Failed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Record didn't update.";
            header("location:../resident/forms.php");


        } 
        else if($result == TRUE){
            $_SESSION['status'] = "Status cancelled successfully.";
            $_SESSION['status_code'] = "success";
            $_SESSION['message'] = "Cancellation successful.";
            header("location:../resident/forms.php");

        }
    }
}



// RESIDENT SIDE FORUM----------------------------------------------------------------------------------------------------

// New Message
if (isset($_POST['newmesssage'])) {
    // Sanitize input
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    $user_id = $_SESSION['user_id'];

    // Correct the variable name and fix the SQL syntax
    $sql = "INSERT INTO forum (`id`, `message`, `user_id`, `created_at`, `updated_at`) 
    VALUES (null, '$msg', '$user_id', NOW(), NOW())"; // Fixed variable name ($msg) and added a closing parenthesis

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Message Sent.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Message sent successfully.";
    } else {
        $_SESSION['status'] = "Sending Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Failed to send your message.";
    }

    if ($_SESSION['user_id'] == 1) {
        $location = '../admin/forum.php';
    } else {
        $location = '../resident/forum.php';
    }

    header("Location: " . $location);
}


// Delete Message
if(isset($_POST['deletemessage'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM `forum` WHERE `id` = '$id'";
    $result =mysqli_query($conn, $sql);

    if ($result != TRUE) {
        $_SESSION['status'] = "Deleting Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Record didn't Delete.";
        header("location:../resident/forum.php");


    } 
    else if($result == TRUE){
        $_SESSION['status'] = "Successfully deleted.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Deleted Successful.";
        header("location:../resident/forum.php");

    }
}

// RESIDENT SIDE FEDDBACK----------------------------------------------------------------------------------------------------

// New Message
if (isset($_POST['feedbackbtn'])) {
    // Sanitize input
    $msg = mysqli_real_escape_string($conn, $_POST['feedback']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $user_id = $_SESSION['user_id'];

    // Correct the variable name and fix the SQL syntax
    $sql = "INSERT INTO feedback (`id`, `feedback`, `user_id`, `created_at`, `updated_at`) 
    VALUES (null, '$msg', '$user_id', NOW(), NOW())"; // Fixed variable name ($msg) and added a closing parenthesis

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Message Sent.";
        $_SESSION['status_code'] = "success";
        $_SESSION['message'] = "Message sent successfully.";
    } else {
        $_SESSION['status'] = "Sending Failed.";
        $_SESSION['status_code'] = "error";
        $_SESSION['message'] = "Failed to send your message.";
    }

    header("location:../resident/$location");
}


// RESIDENT SIDE ACCOUNT----------------------------------------------------------------------------------------------------

// New Message
if (isset($_POST['svprofile'])) {



   
    $user_id = $_SESSION['user_id'];

    $check_sql = "SELECT * FROM user WHERE `user_id` = '$user_id'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        $profile = $_FILES['fileInput']['name'];

        if ($profile) {
            $target_dir = '../includes/profile/';
            $target_file = $target_dir . basename($profile);
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $target_file)) {
                $sql = "UPDATE `user` SET `profile` = '$profile' , `updated_at` = now() WHERE `user_id` = $user_id";
                $result = mysqli_query($conn, $sql);

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['status'] = "Profile Updated.";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['message'] = "Profile updated successfully.";
                } else {
                    $_SESSION['status'] = "uploading Failed.";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['message'] = "Failed to update your profile.";
                }

                if ($_SESSION['user_id'] == 1) {
                    $location = '../admin/account.php';
                } else {
                    $location = '../resident/feedback.php';
                }

                header("Location: " . $location);

            }
        }
    }

}


// SAVE CHANGES
if (isset($_POST['svchanges'])) {

    $user_id = $_SESSION['user_id'];
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $conpassword = mysqli_real_escape_string($conn, $_POST['conpassword']);

    if($password){
        if($password === $conpassword){
            $newpassword = md5($password);

            if ($_SESSION['user_id'] == 1) {
              $sql = "UPDATE `user` SET `fname` = '$fname', `contact` = '$phonenum', `email` = '$email', `password` = '$newpassword', `updated_at` = NOW() WHERE `user_id` = $user_id";
          }
          else {
            $sql = "UPDATE `user` SET 
            `fname` = '$fname',  `contact` = '$phonenum', `email` = '$email',  `password` = '$newpassword',  `updated_at` = NOW() WHERE `user_id` = $user_id";
        }
    }
}
else {

    if ($_SESSION['user_id'] == 1) {
        $sql = "UPDATE `user` SET `fname` = '$fname', `contact` = '$phonenum', `email` = '$email', `updated_at` = NOW() WHERE `user_id` = $user_id";

    }
    else{
        $sql = "UPDATE `user` SET  `fname` = '$fname',`contact` = '$phonenum',  `email` = '$email', `updated_at` = NOW() WHERE `user_id` = $user_id";
    }

}

$result = mysqli_query($conn, $sql);

    // Execute the query
if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Profile Updated.";
    $_SESSION['status_code'] = "success";
    $_SESSION['message'] = "Profile updated successfully.";
} else {
    $_SESSION['status'] = "Updating Failed.";
    $_SESSION['status_code'] = "error";
    $_SESSION['message'] = "Failed to update your profile.";
}

if ($_SESSION['user_id'] == 1) {
    $location = '../admin/account.php';
} else {
    $location = '../resident/feedback.php';
}

header("Location: " . $location);

}





?>
