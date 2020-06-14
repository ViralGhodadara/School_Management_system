<?php

    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    $division = $_SESSION['division'];
    $standard = $_SESSION['stdandard'];

    $checkSeat = "SELECT seat FROM division WHERE division_name LIKE ? AND standard LIKE ?";
    $statCheckSeat = $conn->prepare($checkSeat);
    $statCheckSeat->execute([$division, $standard]);

    $seatValue = $statCheckSeat->fetch();

    $seat = $seatValue['seat'];

    $_SESSION['btnDisable'] = $seat;

    // echo "Starting seat value : ".$seat;
    $_SESSION['pendingSeat'] = $seat;
    $pending = $seat;

    if (isset($_POST['submit-addStudent'])) {
        $rollNumber = $_POST['roll_no'];
        $studentName = $_POST['student_name'];
        $contactNumber = $_POST['contact_number'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conformPassword = $_POST['conform_password'];

        if (strlen($contactNumber) == 10) {
            if (strlen($pincode) == 6) {
                if (strlen($password) >= 3 && strlen($password) <= 8 && strlen($conformPassword) >= 3 && strlen($conformPassword) <= 8) {
                    // Check Username students table available or not

                    $checkUsernameStudents = "SELECT username FROM student WHERE username LIKE ?";
                    $statcheckUsernameStudents = $conn->prepare($checkUsernameStudents);
                    $statcheckUsernameStudents->execute([$username]);

                    if ($statcheckUsernameStudents->rowCount() == 0) {
                        if ($password === $conformPassword) {
                            $passHash = password_hash($password, PASSWORD_BCRYPT);
                            $conformPasswordHash = password_hash($conformPassword, PASSWORD_BCRYPT);
    
                            $tblName = $_SESSION['tableInsertname'];
    
                            // Check username available or not
    
                            $checkusername = "SELECT * FROM $tblName WHERE username LIKE ?";
                            $statCheckUsername = $conn->prepare($checkusername);
                            $statCheckUsername->execute([$username]);
    
                            if ($statCheckUsername->rowCount() == 0) { //The username not available
                                $insertStudentDetail = "INSERT INTO $tblName (roll_number, student_name, contact_number, email, date_of_birth, address, city, pincode, username, student_password, student_conform_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $statInsertStudentDetail = $conn->prepare($insertStudentDetail);
    
                                $insertStudents = "INSERT INTO students (roll_number, student_name, contact_number, email, date_of_birth, address, city, pincode, username, student_password, student_conform_password, student_standard, student_division) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $statInsertStudents = $conn->prepare($insertStudents);
                                $statInsertStudents->execute([$rollNumber, $studentName, $contactNumber, $email, $date_of_birth, $address, $city, $pincode, $username, $passHash, $conformPasswordHash, $_SESSION['stdandard'], $_SESSION['division']]);
    
                                // $division = $_SESSION['division'];
                                // $standard = $_SESSION['stdandard'];
    
                                // $checkSeat = "SELECT seat FROM division WHERE division_name LIKE ? AND standard LIKE ?";
                                // $statCheckSeat = $conn->prepare($checkSeat);
                                // $statCheckSeat->execute([$division, $standard]);
    
                                // $seatValue = $statCheckSeat->fetch();
    
                                // $seat = $seatValue['seat'];
                                // $pending = $seat;
    
                                if ($statInsertStudentDetail->execute([$rollNumber, $studentName, $contactNumber, $email, $date_of_birth, $address, $city, $pincode, $username, $passHash, $conformPasswordHash])) {
                                    $division = $_SESSION['division'];
                                    $standard = $_SESSION['stdandard'];
    
                                    $pending = $seat - 1;
    
                                    // echo "<br><br>Update thaya pela sending value : ".$pending;
                                    // echo "<br><br>This is a division : ".$division;
                                    // echo "<br><br>This is a standard : ".$standard;
                                        
                                    $updateSeat = "UPDATE division SET seat = ? WHERE division_name = ? AND standard = ?";
                                    $statUpdateSeat = $conn->prepare($updateSeat);
                                    // $statUpdateSeat->execute([$pending, $division, $standard]);
    
                                    if ($statUpdateSeat->execute([$pending, $division, $standard]) == true) {
                                            
                                        $_SESSION['pendingSeat'] = $pending;    
                                        
                                        // echo "<br><br>This is a session of pending seat = ".$_SESSION['pendingSeat'];
                                    } else {
                                        // echo "Query cannot run";
                                    }
        
                                    // // $_SESSION['seat'] = $st;
                                    // $_SESSION['pendingSeat'] = $pending;    
                                    
                                    // echo $_SESSION['pendingSeat'];
                                    
                                ?>
                                    <script>
                                        alert("Student detail can inserted successfully");
                                        window.location.replace("http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php");
                                    </script>
                                <?php
                                }
                            } else {
                                $_SESSION['error-addStudent'] = "Username already exist please try another username";
                                header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
                            }
                    } else {
                        $_SESSION['error-addStudent'] = "Username already exist from another standards please try another username";
                        header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
                    }
                    
                    } else {
                        $_SESSION['error-addStudent'] = "Please enter the same password";
                        header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
                    }
                } else {
                    $_SESSION['error-addStudent'] = "Please enter the password and conform password greter than 3 and less than 9";
                    header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');    
                }
            } else {
                $_SESSION['error-addStudent'] = "Please enter the valid pincode";
                header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
            }
        } else {
            $_SESSION['error-addStudent'] = "Please enter the valid contact number";
            header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
        }
    }
?>