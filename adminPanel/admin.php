<?php
    $conn = new PDO("mysql:host=localhost; dbname=school_management_system", 'root', '');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php require "C:/xampp/htdocs/viral/school-system/link.php"; ?>
    <style>
        .sty{
            font-family: verdana;
        }
        .title{
            font-family: verdana;
            margin-top: -0.09px;
            text-align: center;
            background-color: brown;
            color: white;
            font-style: italic;
            padding: 10px;
        }
        .container{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
        }
        .box-std{
            margin-left: 20%;
            margin-top: 5%;
        }
        .btn{
            background-color: rgb(70, 125, 236);
            color: white;
            font-family: verdana;
            margin-bottom: 10px;
            margin-left: 20%;
        }
        #error-std{
            color: brown;
            font-family: verdana;
        }
        .addDivision{
            /* height: 300px;
            width: 100%;
            background-color: #d0c9c9; */
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 12%;
        }
        .divbox{
            margin-left: 20%;
            margin-top: 5%;
        }
        .dropdown-standard{
            margin-left: 20%;
            margin-top: 1.5%;
            height: 30px;
            font-family: verdana;
            width: 20%;
        }
        .title-data{
            text-align: center;
            font-family: verdana;
        }
        .staff-container{
            background-color: #d0c9c9;
            height: 750px;
            width: 75%;
            margin-left: 10%;
        }
        .box{
            height: 30px;
            width: 33%;
            margin-bottom: 15px;
            margin-left: 20%;
        }
        .textArea{
            margin-bottom: 15px;
            margin-left: 20%;
        }
        .dropDown{
            margin-bottom: 15px;
            margin-left: 20%;
            height: 25px;
            width: 24%;
            font-family: verdana;
        }
        .btn-addtaff{
            background-color: rgb(70, 125, 236);
            color: white;
            font-family: verdana;
            margin-left: 20%;
            border: 2px solid rgb(70, 125, 236);
            border-radius: 5px;
            height: 27px;
        }
        .error{
            font-family: verdana;
            color: brown;
        }
        .container_staff_report{
            height: 1000px;
            width: 95%;
            background-color: #d0c9c9;
            margin-left: 2.5%;
        }
        #error-checkStandardDivision{
            font-family: verdana;
            color: brown;
        }
        .complain-container{
            background-color: #d0c9c9;
            height: 1000px;
            width: 75%;
            margin-left: 10%;
        }
        .complainErr{
            color: brown;
            font-family: verdana;
            margin-left: 152px;
            margin-top: 15px;
        }
        .complainCart {
            height: 23%;
            width: 70%;
            background-color: rgb(245, 245, 245);
            font-family: verdana;
            margin-left: 65px;
            margin-top: 37px;
            padding: 20px;
            box-shadow: 5px 10px #888888;
            border-radius: 10px;
        }
        .firstTitle{
            margin: 0 0 10px;
            margin-left: 147px;
            margin-top: 20px;
            font-family: verdana;
        }
        #error-password{
            margin: 0 0 10px;
            margin-left: 147px;
            margin-top: 20px;
            font-family: verdana;
            color: brown;
        }
    </style>
</head>
<body>
<!-- Sidebar all links here -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Admin Panel</h3>
  <a onclick="displaySection('addStandard')" class="w3-bar-item w3-button sty">Add Standard</a>
  <a onclick="displaySection('addDivision')" class="w3-bar-item w3-button sty">Add Division</a>
  <a onclick="displaySection('staff')" class="w3-bar-item w3-button sty">Add Staff</a>
  <a onclick="displaySection('staff_report')" class="w3-bar-item w3-button sty">Staff Report</a>
  <a onclick="displaySection('complain')" class="w3-bar-item w3-button sty">Complain</a>
  <a onclick="displaySection('changePassword')" class="w3-bar-item w3-button sty">Change Password</a>
  <a href="http://localhost/viral/school-system/adminPanel/login-admin.php" class="w3-bar-item w3-button sty">Logout</a>
</div>
<script>
    let i;
    let hideSection = document.getElementsByClassName("section");

    function displaySection(displaysec) {
        for (let i = 0; i < hideSection.length; i++) {
            hideSection[i].style.display = "none";
        }
        document.getElementById(displaysec).style.display = 'block';
    }
</script>
<!-- Page Content -->
<div style="margin-left:25%">
    <!-- This is a start coding of add standard -->
    <div id="addStandard" class="section">
        <h3 class="title">Add Standard</h3>
        <div class="container">
            <form method="post">
                <table>
                    <tr>
                        <p style="margin-bottom: -20px; font-family: verdana;">Please enter the standard.....</p>
                    </tr>
                    <tr>
                        <br>
                        <p id="error-std"></p>
                    </tr>
                    <tr>
                        <input type="number" name="std" class="box-std" placeholder="Add Standard" required>
                    </tr>
                    <tr>
                        <br><br>
                        <button type="submit" class="btn" style="margin-left: 20%;" name="submit-std">Add Standard</button>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST['submit-std'])) {
            $std = $_POST['std'];
            
            if ($std > 12 ) {
            ?>
                <script type="text/javascript">
                    document.getElementById('error-std').textContent = "Please enter standard less than 12";
                </script>
            <?php    
            } else {
                $select = 'SELECT * FROM std WHERE Standard = ?';
                $select_stat = $conn->prepare($select);
                $select_stat->execute([$std]);
                if ($select_stat->rowCount() == 1) {
                ?>
                    <script>document.getElementById("error-std").innerHTML = "Please enter another standard <?php echo $std ?> already stored";</script>
                <?php
                } else {
                    $insert = "INSERT INTO std (Standard) VALUES (?)";
                    $statement = $conn->prepare($insert);

                    if ($statement->execute([$std]) == true) {
                    ?>
                        <script>alert("Standard can inserted successfully");</script>
                    <?php
                    }
                }
            }
        }
    ?>
    <!-- This is a end of coding add standard -->

    <!-- This is a start coding of add division -->
    <div id="addDivision" class="section" style='display: none;'>
        <?php
            $sel = 'SELECT Standard FROM std';
            $run_sel = $conn->prepare($sel);
            $run_sel->execute();
        ?>
        <div class="container-addDivision">
            <h3 class="title">Add Division</h3>
            <div class="addDivision">
            <p id="error-checkStandardDivision"></p>
                <form method="post">
                    <table>
                        <tr>
                            <input type="text" name="divisionName" placeholder="Division Name" class="divbox" required>
                        </tr>
                        <tr>
                            <br>
                            <input type="number" name="seat" placeholder="Seat" class="divbox" style='margin-top: 9px;' required>
                        </tr>
                        <tr>
                            <br>
                            <select name="Standard" class="dropdown-standard" required>
                                <option selected disabled>Standard</option>
                                <?php
                                    if ($run_sel->rowCount() > 0) {
                                        while ($data = $run_sel->fetch()) {
                                        ?>
                                            <option value="<?php echo $data['Standard'] ?>"><?php echo $data['Standard']; ?></option>
                                        <?php
                                        }
                                    }
                                ?>
                            </select>
                        </tr>
                        <tr>
                            <br><br>
                            <button type="submit" name="submit-addDivision" class="btn" style="margin-left: 20%">Add Division</button>
                        </tr>
                        <?php

                            if (isset($_POST['submit-addDivision'])) {
                                $divisionName = $_POST['divisionName'];
                                $seat = $_POST['seat'];
                                $standard = $_POST['Standard'];
                                    
                                // Check standard data available or not
                                $checkStandardDivision = 'SELECT division_name, standard FROM division WHERE division_name like ? AND standard = ?';
                                $statCheckStandardDivision = $conn->prepare($checkStandardDivision);
                                $statCheckStandardDivision->execute([$divisionName, $standard]);

                                if ($statCheckStandardDivision->rowCount() == 0) {

                                    $insert_division = 'INSERT INTO division (division_name, seat, standard, pending_seat) VALUES (?, ?, ?, ?)';
                                    $statInsertDivision = $conn->prepare($insert_division);
                                    
                                    if ($statInsertDivision->execute([$divisionName, $seat, $standard, $seat])) {                                    
                                    ?>
                                        <script>alert("Record insert successfull");</script>
                                    <?php

                                    $connect = mysqli_connect('localhost', 'root', '', 'school_management_system');

                                    $stdaT = "standard".$standard;
                                    $divis = $divisionName;
                                    $tempTable = $stdaT.$divis;
                                    $dt = $tempTable;

                                    $complainTbl = "complain".$dt;

                                    $createTable = "create table $dt (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(20), contact_number varchar(12), email varchar(70), date_of_birth date, address varchar(255), city varchar(15), pincode varchar(10), username varchar(25), student_password varchar(255), student_conform_password varchar(255))";
                                    $run = mysqli_query($connect, $createTable);

                                    // create complain table

                                    $createComplaintbl = "CREATE TABLE $complainTbl (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(15), student_standard integer, student_dvision varchar(10), complain_date date, complain varchar(255))";
                                    $runComplainStu = mysqli_query($connect, $createComplaintbl);

                                    // This is a PDO system

                                    // $createTablePDO = "create table ? (id integer AUTO_INCREMENT, roll_number integer, student_name varchar(20), contact_number varchar(12), email varchar(70), date_of_birth date, address varchar(255), city varchar(15), pincode varchar(10), username varchar(25), student_password varchar(10), student_conform_password varchar(10))";
                                    // $statCreateTablePDO = $conn->prepare($createTablePDO);

                                    // if ($statCreateTablePDO->execute([$dt])) {
                                    //     echo "The query can execute using PDO method";
                                    // } else {
                                    //     echo "The query cannot execute";
                                    // }                                

                                    $tempAttendance = "attendanceBook".$dt;
                                    $attendanceTableName = $tempAttendance;

                                    $createAttendaceTbl = "create table $attendanceTableName(id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(30), attendance varchar(10), attendance_date date)";
                                    $runAttendance = mysqli_query($connect, $createAttendaceTbl);

                                    // $studentresult = "result".$dt;
                                    // $tableRes = $studentresult;
                                    // echo "The result table name is : ".$tableRes;

                                    // echo "The type of stdaT is : ".gettype($stdaT); It returns string type

                                    // if ($stdaT == '1' || $stdaT == '2' || $stdaT == '3' || $stdaT == '4' || $stdaT == '5') {
                                    //     $createResultTable = "create table $tableRes (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(10), username varchar(15), maths varchar(3), gujarati varchar(3), hindi varchar(3), english varchar(3), science varchar(3), drawing varchar(4), total varchar(4), student_percentage varchar(5), gread varchar(3))";
                                    //     $runCreateResultTable = mysqli_query($connect, $createResultTable);
                                    // } else if ($stdaT == '6' || $stdaT == '7') {
                                    //     $createResultTable = "create table $tableRes (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(10), username varchar(15), maths varchar(3), gujarati varchar(3), hindi varchar(3), english varchar(3), science varchar(3), social_science varchar(3), total varchar(4), student_percentage varchar(5), gread varchar(3))";
                                    //     $runCreateResultTable = mysqli_query($connect, $createResultTable);
                                    // } else if ($stdaT == '9' || $stdaT == '8' || $stdaT == '10') {
                                    //     $createResultTable = "create table $tableRes (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(10), username varchar(15), maths varchar(3), gujarati varchar(3), hindi varchar(3), english varchar(3), science varchar(3), social_science varchar(3), sanskrit varchar(3), total varchar(4), student_percentage varchar(5), gread varchar(3))";
                                    //     $runCreateResultTable = mysqli_query($connect, $createResultTable);
                                    // } else {
                                    //     $createResultTable = "create table $tableRes (id integer primary key AUTO_INCREMENT, roll_number integer, student_name varchar(10), username varchar(15), stat varchar(3), gujarati varchar(3), account varchar(3), english varchar(3), science varchar(3), social_science varchar(3), eco varchar(3), ba varchar(3), total varchar(4), student_percentage varchar(5), gread varchar(3))";
                                    //     $runCreateResultTable = mysqli_query($connect, $createResultTable);   
                                    // }
                                }

                            } else {
                            ?>
                                <script>
                                    document.getElementById("error-checkStandardDivision").innerHTML = 'The Standard and Division already exist';
                                </script>
                            <?php
                            }
                                
                        }
                        ?>
                    </table>
                </form>
                <?php
                    $select_data_standard = 'SELECT * FROM division';
                    $statDataDivision = $conn->prepare($select_data_standard);
                    $statDataDivision->execute();
                ?>
                <h3 class="title-data">Stadard data</h3>
                <div class="container">           
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>DIVISION NAME</td>
                                <td>SEAT</td>
                                <td>PENDING SEAT</td>
                                <td>STANDARD</td>
                                <td>OPERATION</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($statDataDivision->rowCount() > 0) {
                                    while ($dataOfDivision = $statDataDivision->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $dataOfDivision['id']; ?></td>
                                            <td><?php echo $dataOfDivision['division_name']; ?></td>
                                            <td><?php echo $dataOfDivision['seat']; ?></td>
                                            <td><?php echo $dataOfDivision['pending_seat']; ?></td>
                                            <td><?php echo $dataOfDivision['standard']; ?></td>
                                            <td><a href="http://localhost/viral/school-system/adminPanel/operation/update.php?idupdate=<?php echo $dataOfDivision['id'];?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            <td><a href="http://localhost/viral/school-system/adminPanel/operation/delete.php?idDelete=<?php echo $dataOfDivision['id'];?>" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- This is a end coding of add divisiom -->

    <!-- This is a start coding of add staff -->
    <div id="staff" class="section" style='display: none;'>
        <h3 class="title">Add Staff</h3>
        <div class="staff-container">
        <!-- The staff data store coding in storestaffdata.php file -->
            <form action='http://localhost/viral/school-system/adminPanel/storestaffdata.php' method="post">
                <table>
                    <tr>
                        <p class='error'><?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; } ?></p>
                    </tr>
                    <tr>
                        <input type="text" name="Name" class="box" placeholder="Name" required style='margin-top: 20px;'>
                    </tr>
                    <tr>
                        <br>
                        <input type="email" name="email" class="box" placeholder="Email" required>
                    </tr>
                    <tr>
                        <br>
                        <input type="number" name="contact_number" class="box" placeholder="Contact Number" required maxlength="10">
                    </tr>
                    <tr>
                        <br>
                        <textarea name="address" cols="50" rows="7" placeholder="Address" required class="textArea"></textarea>
                    </tr>
                    <tr>
                        <br>
                        <select name="qualification" required class="dropDown">
                            <option selected disabled value="">Qualification</option>
                            <option value="BCA">BCA</option>
                            <option value="BSC">BSC</option>
                            <option value="Arts">Arts</option>
                        </select>
                    </tr>
                    <tr>
                        <br>
                        <input type="text" name="city" id="" class="box" placeholder="City" required>
                    </tr>
                    <tr>
                        <br>
                        <input type="number" name="pincode" class="box" placeholder="Pincode" maxlength="6" required>
                    </tr>
                    <tr>
                        <br>
                        <select name="gender" required class="dropDown">
                            <option selected disabled>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </tr>
                    <?php
                    // Fetch data of standard
                        $select_standard = "SELECT standard FROM std";
                        $statSelectStandard = $conn->prepare($select_standard);
                        $statSelectStandard->execute();
                    ?>
                    <tr>
                        <br>
                        <select name="standard" required class="dropDown">
                            <option selected disabled>Standard</option>
                            <?php
                                if ($statSelectStandard->rowCount() > 0) {
                                    while ($standard = $statSelectStandard->fetch()) {
                                    ?>
                                        <option value="<?php echo $standard['standard']; ?>"><?php echo $standard['standard']; ?></option>
                                    <?php
                                    }
                                }
                            ?>
                        </select>
                    </tr>
                    <tr>
                        <br>
                        <input type="text" name="username" class="box" placeholder="Username">
                    </tr>
                    <tr>
                        <br>
                        <input type="password" name="password" class="box" placeholder="Password">
                    </tr>
                    <tr>
                        <br>
                        <input type="password" name="conformPassword" class="box" placeholder="Conform Password">
                    </tr>
                    <tr>
                        <br>
                        <button type="submit" class="btn-addtaff" name="addStaff">Add Staff</button>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- This is a end coding of add staff -->


    <!-- This is a start coding of staff report -->
    <div id="staff_report" class="section" style="display: none">
        <h3 class="title">Staff Report</h3>
        <div class="container_staff_report">
            <table class="table table-striped">
                <thead>
                    <tr style="background-color: white; border: 1px solid #ddd">
                        <td>ID</td>
                        <td>NAME</td>
                        <td>EMAIL</td>
                        <td>CONTACT NUMBER</td>
                        <td>QUALIFICATION</td>
                        <td>CITY</td>
                        <td>PINCODE</td>
                        <td>GENDER</td>
                        <td>STANDARD</td>
                        <td>OPERATION</td>
                    </tr>
                </thead>
                <?php
                    $staff_report = 'SELECT * FROM staff';
                    $stat_staff_report = $conn->prepare($staff_report);
                    $stat_staff_report->execute();
                ?>
                <tbody>
                    <tr>
                        <?php
                            if ($stat_staff_report->rowCount() > 0) {
                                while ($dataOfStaff = $stat_staff_report->fetch()) {
                                ?>
                                    <tr>
                                        <td><?php echo $dataOfStaff['id']; ?></td>
                                        <td><?php echo $dataOfStaff['teacher_name']; ?></td>
                                        <td><?php echo $dataOfStaff['email']; ?></td>
                                        <td><?php echo $dataOfStaff['contact_number']; ?></td>
                                        <td><?php echo $dataOfStaff['qualification'] ?></td>
                                        <td><?php echo $dataOfStaff['city']; ?></td>
                                        <td><?php echo $dataOfStaff['pincode']; ?></td>
                                        <td><?php echo $dataOfStaff['gender']; ?></td>
                                        <td><?php echo $dataOfStaff['standard']; ?></td>
                                        <td><a href="http://localhost/viral/school-system/adminPanel/deleteStaffData.php?idOfDeleteStadd=<?php echo $dataOfStaff['id']; ?>" title="DELETE" target="blanck"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php
                                }
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- This is a end coding of staff report -->

    <!-- This is a starting coding of complain -->
    <div id="complain" class="section" style="display: none;">
        <h3 class="title">Complain</h3>
        <!-- code for fetch data of standard-->
        <?php
            $selectStandardComp = "SELECT * FROM std";
            $statSelectStandardComp = $conn->prepare($selectStandardComp);
            $statSelectStandardComp->execute();
        ?>
        <div class="complain-container">
        <form method="post">
            <select onchange="ShowStd()" id="standardComplain" class="dropDown" style="margin-top: 20px;">
                <option value="" selected disabled>Standard</option>
                <?php
                    while ($dataForStandardComp = $statSelectStandardComp->fetch()) {
                    ?>  
                        <option value="<?php echo $dataForStandardComp['standard'] ?>"><?php echo $dataForStandardComp['standard'] ?></option>
                    <?php
                    }
                ?>
            </select>
            <script>
                function ShowStd() {
                    let standard = document.getElementById("standardComplain").value;
                    location.href="?std="+standard;
                }
            </script>
            <!-- code for standard therow select teacher username -->
            <?php
                if (isset($_GET['std'])) {
                    $std = $_GET['std'];
                    $selectTeacherUsernm = "SELECT * FROM staff WHERE standard = ?";
                    $statselectTeacherUsernm = $conn->prepare($selectTeacherUsernm);
                    // $statselectTeacherUsernm->execute([$std]);

                    if ($statselectTeacherUsernm->execute([$std])) {
                    ?>
                        <br>
                        <select name="teacherUsername" class="dropDown" style="margin-top: 0px;">
                            <option value="" selected disabled>Teacher Username</option>
                            <?php
                                while ($dataOfTeacherUsernm = $statselectTeacherUsernm->fetch()) {
                                ?>
                                    <option value="<?php echo $dataOfTeacherUsernm['username']; ?>"><?php echo $dataOfTeacherUsernm['username']; ?></option>
                                <?php
                                }
                            ?>
                        </select>
                <?php
                    }
                }
                ?><br>
                <input type="submit" value="Show Complain" name="submitTeacherUsername" class="btn" style="margin-left: 152px;">
            </form>
            <?php
                if (isset($_POST['submitTeacherUsername'])) {
                    if (isset($_POST['teacherUsername'])) {
                        $username = $_POST['teacherUsername'];
                        
                        $checkComplainTbl = "complain".$username;

                        $checkComplainQhery = "SELECT * FROM $checkComplainTbl";
                        $statcheckComplainQhery = $conn->prepare($checkComplainQhery);
                        $statcheckComplainQhery->execute();

                        if ($statcheckComplainQhery->rowCount() > 0) {
                            while ($dataComplain = $statcheckComplainQhery->fetch()) {
                            ?>
                                <div class="complainCart">
                                    <p>Username : <?php echo $dataComplain['username']; ?></p>
                                    <p>Standard : <?php echo $dataComplain['standard']; ?></p>
                                    <p>Complain Date : <?php echo $dataComplain['complain_date']; ?></p>
                                    <p>Contact Number : <?php echo $dataComplain['contactNumber']; ?></p>
                                    <p>Complain : <?php echo $dataComplain['complain']; ?></p>
                                    <p><a href="http://localhost/viral/school-system/adminPanel/deleteTeacherComplain.php?idDeleteComplain=<?php echo $dataComplain['id']; ?>&&tableName=<?php echo $checkComplainTbl; ?>"><input type="button" value="Complain Solved" class="btn"></a></p>
                                </div>
                            <?php
                            }
                        } else {
                        ?>
                            <p class="complainErr"><?php echo "No complain available"; ?></p>
                        <?php
                        }
                        
                    }

                }
            ?>
        </div>
    </div>
    <!-- This is a end coding of complain -->
    
    <!-- This is a start coding of change password -->
    <div id="changePassword" class="section" style="display: none;">
        <h3 class="title">Change Password</h3>
        <div class="container">
            <p class="firstTitle">Please enter the password and Conform password.....</p>
            <p id="error-password"></p>
            <form method="post">
                <input type="password" name="password" class="box" placeholder="Password">
                <input type="password" name="conform_password" class="box" placeholder="Conform Password"><br>
                <button type="submit" name="submitPassword" class="btn">Change Password</button>
            </form>
        </div>
        <?php
            if (isset($_POST['submitPassword'])) {
                $password = $_POST['password'];
                $conform_password = $_POST['conform_password'];

                if ($password === $conform_password) {
                    if (strlen($password) >= 3 && strlen($password) <= 8 && strlen($conform_password) >=3 && strlen($conform_password) <= 8) {
                        
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $updatePassword = "UPDATE admin SET password = ?";
                        $statUpdatePassword = $conn->prepare($updatePassword);

                        if ($statUpdatePassword->execute([$password_hash])) {
                        ?>
                            <script>
                                alert("Password can change successfully..........");
                            </script>
                        <?php
                        }

                    } else {
                    ?>
                        <script>
                            document.getElementById('error-password').innerHTML = "***Please enter the password greter than 2 and less than 9";
                        </script>
                    <?php
                    }
                } else {
                ?>
                    <script>
                        document.getElementById('error-password').innerHTML = "***Please enter same password and conform password";
                    </script>
                <?php
                }
            }
        ?>
    </div>
    <!-- This is a end coding of change password -->
</div>
</body>
</html>