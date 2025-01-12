<?php
// Connect to DB
include('dbconnect.php');
include('function.php');

if(isset($_POST['saveuser'])){
    $fid = validate($_POST['fid']);
    $fic = validate($_POST['fic']);
    $ffname = validate($_POST['ffname']);
    $flname = validate($_POST['flname']);
    $fpwd = validate($_POST['fpwd']);
    $fphone = validate($_POST['fphone']);
    $femail = validate($_POST['femail']);
    $fadd = validate($_POST['fadd']);
    $fposition = validate($_POST['fposition']);
    $ftype = validate($_POST['ftype']);

    if($fid != '' || $fic != '' || $ffname != '' || $flname != '' || $fpwd != '' || $fphone != '' || $femail != '' || $fadd != '' || $fposition != '' || $ftype != ''){
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO tb_user(user_id, user_ic, user_pwd, u_fName, u_lName, user_phone, user_email, user_address, user_position, type_id)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $fid, $fic, $fpwd, $ffname, $flname, $fphone, $femail, $fadd, $fposition, $ftype);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            if($result){
                redirect('user.php', 'Staff/Admin added successfully');
            } else {
                redirect('user.php', 'Something went wrong');
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Prepare statement failed
            redirect('user.php', 'Error preparing statement');
        }
    } else {
        redirect('user-create.php', 'Please fill all the input fields');
    }
}

// Close DB Connection
mysqli_close($con);

// Redirect to the next page
header('Location:user.php');

?>