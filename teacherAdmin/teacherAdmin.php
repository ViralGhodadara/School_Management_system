<?php
    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php require "C:/xampp/htdocs/viral/school-system/link.php"; ?>
    <link rel="stylesheet" href="http://localhost/viral/school-system/teacherAdmin/teacheradmincss.css">
    <style>
        .containerAdvanceReport{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .st{
            margin-left: 105px;
            margin-top: 17px;
            padding-top: 17px;
            font-family: verdana;
            font-size: 15px;
        }
        .dro{
            height: 26px;
        }
        .dateStyAdvRe{
            margin-left: 101px;
            margin-top: 14px;
            margin-bottom: 10px;
        }
        .container-advanceReport{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .btn-AdvRe {
            height: 25px;
            background-color: rgb(70, 125, 236);
            color: white;
            margin-left: 13.5%;
            margin-top: 12px;
            width: 100px;
            font-family: verdana;
            border: 2px solid;
            border-radius: 8px;
            border: 2px solid rgb(70, 125, 236);
            margin-bottom: 10px;
        }
        .studentDataTitle{
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            margin-left: 105px;
            color: #e41e1e;
            font-size: 20px;
            margin-top: 10px;
        }
        .UsernmDetail{
            margin-left: 105px;
            margin-top: 0px;
            padding-top: 10px;
            font-family: verdana;
            font-size: 15px;
        }
        .lb {
            font-family: verdana;
            margin-left: 104px;
            margin-top: 11px;
            font-weight: 500;
        }
        .stuMarksheet{
            font-family: verdana;
            margin-left: 104px;
            /* margin-top: 11px; */
            font-weight: 500; 
        }
        .markBox{
            height: 22px;
        }
        .titleForComplain{
            margin-left: 105px;
            margin-top: 0px;
            padding-top: 10px;
            font-family: verdana;
            font-size: 15px;
        }
        .dateBox{
            height: 31px;
            width: 165px;
            font-family: verdana;
            margin-left: 105px;
        }
        .textareaBox{
            font-family: verdana;
            margin-left: 105px;
        }
        .passwordBox{
            margin-left: 13.5%;
            font-family: verdana;
        }
        .errorChangePassword{
            color: brown;
            font-family: verdana;
            margin-left: 13.5%;
            margin-bottom: -18px;
            margin-top: 30px;
        }
        .showComplain-Container {
            background-color: #d0c9c9;
            height: 1000px;
            width: 75%;
            margin-left: 10%;
        }
        .dropDown {
            margin-bottom: 15px;
            margin-left: 20%;
            height: 25px;
            width: 24%;
            font-family: verdana;
        }
        .complainCart {
            height: 25%;
            width: 70%;
            background-color: rgb(245, 245, 245);
            font-family: verdana;
            margin-left: 65px;
            margin-top: 37px;
            padding: 20px;
            box-shadow: 5px 10px #888888;
            border-radius: 10px;
        }
        .complainErr {
            color: brown;
            font-family: verdana;
            margin-left: 152px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div>
        <!-- Sidebar all links here -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
        <h3 class="w3-bar-item">Staff Admin Panel</h3>
        <a onclick="changeSection('Home')" class="w3-bar-item w3-button sty">Home</a>
        <a onclick="changeSection('addStudent')" class="w3-bar-item w3-button sty">Add Student</a>
        <a onclick="changeSection('studentReport')" class="w3-bar-item w3-button sty">Student Report</a>
        <a onclick="changeSection('attendance')" class="w3-bar-item w3-button sty">Attendance</a>
        <a onclick="changeSection('attendenceReport')" class="w3-bar-item w3-button sty">Attendance Report</a>
        <a onclick="changeSection('studentDetail')" class="w3-bar-item w3-button sty">Student Detail</a>
        <a onclick="changeSection('toComplain')" class="w3-bar-item w3-button sty">To Complain</a>
        <a onclick="changeSection('complainMade')" class="w3-bar-item w3-button sty">Complaint made</a>
        <a onclick="changeSection('showComplain')" class="w3-bar-item w3-button sty">Show Complain</a>
        <a onclick="changeSection('changePassword')" class="w3-bar-item w3-button sty">Change Password</a>
        <a href="http://localhost/viral/school-system/" class="w3-bar-item w3-button sty">Logout</a>
        </div>
        <script>
            let i;
            let hideSection = document.getElementsByClassName("section");
            function changeSection(ShowSection) {
                for (let i = 0; i < hideSection.length; i++) {
                    hideSection[i].style.display = 'none';
                }
                document.getElementById(ShowSection).style.display = 'block';
            }
        </script>

        <div style="margin-left: 25%;">
            <!-- This is a Home of Teacher Admin start coding-->
            <div id="Home" class="section">
                <h3 class="title">Home</h3>
                <?php
                    // Fetch Data of the username

                    $select_username_data = 'SELECT * FROM staff WHERE username LIKE ?';
                    $statSelectUsernameData = $conn->prepare($select_username_data);
                    $statSelectUsernameData->execute([$_SESSION['username']]);
                    $dataOfUser = $statSelectUsernameData->fetch();
                ?>
                <div class="containerHome">
                    <p class='para'>Username : <?php echo $dataOfUser['username']; ?></p>
                    <p class='para'>Standard : <?php echo $dataOfUser['standard']; ?></p>
                    <p class='para'>Teacher Name : <?php echo $dataOfUser['teacher_name']; ?></p>
                    <p class='para'>Email : <?php echo $dataOfUser['email']; ?></p>
                    <p class='para'>Contact Number : <?php echo $dataOfUser['contact_number']; ?></p>
                    <p class='para'>Address : <?php echo $dataOfUser['address']; ?></p>
                    <p class='para'>Qualification : <?php echo $dataOfUser['qualification']; ?></p>
                    <p class='para'>City : <?php echo $dataOfUser['city']; ?></p>
                    <p class='para'>Gender : <?php echo $dataOfUser['gender'] ?></p>
                    <a href="http://localhost/viral/school-system/teacherAdmin/updateTeacherData.php?id=<?php echo $dataOfUser['id']; ?>&&odlUsernm=<?php echo $_SESSION['username']; ?>"><button class="btn">EDIT</button></a>
                    
                </div>
            </div>
            <!-- This is a Home of Teacher Admin end coding-->

            <!-- This is a start coding of add student -->
            <div id="addStudent" style="display: none;" class="section">
                <h3 class="title">Add Student</h3>
                <?php
                    $selectDivision = 'SELECT * FROM division WHERE standard = ?';
                    $statSelectDivision = $conn->prepare($selectDivision);
                    $statSelectDivision->execute([$dataOfUser['standard']]);
                ?>
                <div class="addStudent-container">
                    <p class="error"><?php if (isset($_SESSION['error-addStudent'])) { echo $_SESSION['error-addStudent']; } ?></p>
                    <form action="" method="post">
                        <p class="para" name="std">Standard : <?php echo $dataOfUser['standard']; ?></p>
                        <select name="division" class="se-opt" required>
                            <option value="" selected disabled>Division</option>
                            <?php
                                while ($dataDivision = $statSelectDivision->fetch()) {
                                ?>
                                    <option value="<?php echo $dataDivision['division_name']; ?>"><?php echo $dataDivision['division_name']; ?></option>
                                <?php
                                }
                            ?>
                        </select>
                        <button type="submit" name="submit-tableNameValue" class="btn-selectClass">Add</button>
                    </form>
                    <!-- Insert data for table name coding start -->
                    <?php
                        if (isset($_POST['submit-tableNameValue'])) {
                            $std = $dataOfUser['standard'];
                            $divTableValue = $_POST['division'];

                            $tbl = "standard";
                            $stdTableValue = $tbl.$std;
                            $divTableValue = $stdTableValue.$divTableValue;

                            $tableNameInsert = $divTableValue;

                            $_SESSION['tableInsertname'] = $tableNameInsert;
                            $_SESSION['stdandard'] = $std;
                            $_SESSION['division'] = $_POST['division'];

                        }
                    ?>
                    <!-- Insert data for table name coding end -->
                    <table>
                        <form method="post" action="http://localhost/viral/school-system/teacherAdmin/storeStudentInfo.php">
                            <tr>
                                <br>
                                <input type="number" name="roll_no" placeholder="Roll number" class="box" style="margin-top: -9px;" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="text" name="student_name" placeholder="Student Name" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="number" name="contact_number" placeholder="Contact Number" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="email" name="email" placeholder="Email" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="date" name="date_of_birth" placeholder="Date of Birth" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <textarea name="address" cols="35" rows="5" required class="txt-area" placeholder="Address"></textarea>
                            </tr>
                            <tr>
                                <br>
                                <input type="text" name="city" placeholder="City" class="box" required>
                            </tr>
                            <tr>
                                <br>    
                                <input type="text" name="pincode" placeholder="Pincode" class="box" required>
                            </tr>
                            <tr>
                                <br>    
                                <input type="text" name="username" placeholder="Username" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="password" name="password" placeholder="Password" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <input type="password" name="conform_password" placeholder="Conform Password" class="box" required>
                            </tr>
                            <tr>
                                <br>
                                <button type="submit" name="submit-addStudent" class="btn" id="dis">Add Student</button>
                            </tr>
                        </form>
                    </table>
                    <table>
                    <?php
                        if (isset($_SESSION['division']) && isset($_SESSION['stdandard'])){
                            $checkSeat = "SELECT seat, pending_seat FROM division WHERE division_name LIKE ? AND standard LIKE ?";
                            $statCheckSeat = $conn->prepare($checkSeat);
                            $statCheckSeat->execute([$_SESSION['division'], $_SESSION['stdandard']]);
                        
                            // $seatValue = $statCheckSeat->fetch();

                            if ($seatValue = $statCheckSeat->fetch()) {
                                $_SESSION['pendingSeat'] = $seatValue['pending_seat'];
                            }
                        }
                    
                    ?>
                        <?php
                            if ($statCheckSeat->rowCount() > 0) {
                            ?>
                            <tr>
                                <p style="font-family: verdana; color: brown; margin-left: 13.5%;">Pending Seat = <?php if(isset($_SESSION['pendingSeat'])) { echo $_SESSION['pendingSeat']; } ?></p>
                            </tr>
                            <?php
                            }
                        ?>
                    </table>
                    <?php
                        if (isset($_SESSION['pendingSeat'])) {
                            if ($_SESSION['pendingSeat'] == 0 ) {
                            ?>
                                <script>
                                    let btn = document.getElementById("dis");
        
                                    btn.disabled = true;
                                </script>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <!-- This is a end coding of add student -->

            <!-- This is a start coding of student report -->
            <div id="studentReport" style="display: none;" class="section">
                <h3 class="title">Student Report</h3>
                <div class="container-studentReport">
                    <div>
                        <?php
                            $selectDivisionShowData = "SELECT * FROM division WHERE standard = ?";
                            $statSelectDivisionShowData = $conn->prepare($selectDivisionShowData);
                            $statSelectDivisionShowData->execute([$dataOfUser['standard']]);
                        ?>
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <select name="standard" class="se-opt dataStu" required>
                                        <option value="" selected disabled>Standard</option>
                                        <option value="<?php echo $dataOfUser['standard']; ?>"><?php echo $dataOfUser['standard']; ?></option>
                                    </select>
                                </tr>
                                <tr>
                                    <br>
                                    <select name="division" class="se-opt dataStu" required>
                                        <option value="" selected disabled>Division</option>
                                        <?php
                                            while ($dataDivisionShow = $statSelectDivisionShowData->fetch()) {
                                            ?>
                                                <option value="<?php echo $dataDivisionShow['division_name']; ?>"><?php echo $dataDivisionShow['division_name']; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </tr>
                                <tr>
                                    <br>
                                    <button type="submit" name="selectDataStudent" class="btn-selectTableData">Select</button>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if (isset($_POST['selectDataStudent'])) {
                            
                                $standardShowStd = $_POST['standard'];
                                $divisionShowStd = $_POST['division'];
                                $tblName = "standard".$standardShowStd.$divisionShowStd;
                                    
                                $selectStudentData = "SELECT * FROM $tblName";
                                $statSelectStudentData = $conn->prepare($selectStudentData);
                                $statSelectStudentData->execute();
                            }

                        ?>
                    </div>
                    <p id="studentAvailableError" style="font-family: verdana; color: brown;"></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>ROLL NUMBER</td>
                                <td>STUDENT NAME</td>
                                <td>EMAIL</td>
                                <td>CONTACT NUMBER</td>
                                <td>DATE OF BIRTH</td>
                                <td>PINCODE</td>
                                <td>USERNAME</td>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    if (isset($_POST['selectDataStudent'])) {
                                        if ($statSelectStudentData->rowCount() > 0) {
                                            while ($studentData = $statSelectStudentData->fetch()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $studentData['roll_number']; ?></td>
                                                    <td><?php echo $studentData['student_name']; ?></td>
                                                    <td><?php echo $studentData['email']; ?></td>
                                                    <td><?php echo $studentData['contact_number']; ?></td>
                                                    <td><?php echo $studentData['date_of_birth']; ?></td>
                                                    <td><?php echo $studentData['pincode']; ?></td>
                                                    <td><?php echo $studentData['username']; ?></td>
                                                </tr>
                                            <?php
                                            }    
                                        } else {
                                        ?>
                                            <script>
                                                document.getElementById("studentAvailableError").innerHTML = "Please add the student";
                                            </script>
                                        <?php
                                        }
                                        
                                    }                                    
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- This is a end coding of student report -->

            <!-- This is a start coding of Attendance -->
            <div id="attendance" style="display: none;" class="section">
                <h3 class="title">Attendence</h3>
                
                <?php
                    // This is a data for attendance
                    $selectDivisionForAttendance = "SELECT * FROM division WHERE standard = ?";
                    $statSelectDivisionForAttendance = $conn->prepare($selectDivisionForAttendance);
                    $statSelectDivisionForAttendance->execute([$dataOfUser['standard']]);

                ?>
                <div class="container-attendance">
                    <form method="post">
                        <p class="para">Standard : <?php echo $dataOfUser['standard']; ?></p>
                        <select name="division" class="se-opt dataStu" style="margin-top: -10px;" required>
                            <option value="" selected disabled>Division</option>
                            <?php
                                
                                if ($statSelectDivisionForAttendance->rowCount() > 0) {
                                    while ($dataOfAtt = $statSelectDivisionForAttendance->fetch()) {
                                    ?>
                                        <option value="<?php echo $dataOfAtt['division_name']; ?>"><?php echo $dataOfAtt['division_name'];?></option>
                                    <?php
                                    }
                                } else {
                                    echo "Division cannot set";
                                }
                            ?>
                        </select>
                        <br>
                        <input type="date" name="dateOfAtt" class="dateOfAtt" required>
                        <br>
                        <button type="submit" name="submit-attendanceDetail" class="btn" style="margin-top: 15px;">Select</button>
                    </form>
                    <form method="post">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>ROLL NUMBER</td>
                                    <td>STUDENT NAME</td>
                                    <td>ATTENDANCE</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_POST['submit-attendanceDetail'])) {
                                        // $standard = $dataOfUser['standard'];
                                        $divisionStudentAtt = $_POST['division'];
                                        $date = $_POST['dateOfAtt'];

                                        $tmpnm = "attendancebookstandard".$dataOfUser['standard'].$divisionStudentAtt;

                                        $_SESSION['attendanceTableName'] = $tmpnm;
                                        $_SESSION['date'] = $date;
                                        $_SESSION['division_name'] = $divisionStudentAtt;

                                        $checkDate = "SELECT attendance_date FROM $tmpnm WHERE attendance_date = $date";
                                        $statCheckDate = $conn->prepare($checkDate);
                                        $statCheckDate->execute();

                                        if ($statCheckDate->rowCount() == 0) {
                                            $st = "standard".$dataOfUser['standard'].$divisionStudentAtt; //Standard10a
                                            $tblNameAtt = $st;
                
                                            $selectAtt = "SELECT * FROM $tblNameAtt"; //Select data for standard10a
                                            $statSelectAtt = $conn->prepare($selectAtt);
                
                                            $attnm = "attendancebook".$st;
                
                                            if ($statSelectAtt->execute()) {
                                                if ($statSelectAtt->rowCount() > 0) {
                                                    while ($dataAtt = $statSelectAtt->fetch()) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $dataAtt['id']; ?></td>
                                                                <td><?php echo $dataAtt['roll_number']; ?></td>
                                                                <td><?php echo $dataAtt['username']; ?></td>
                                                                <td>
                                                                    <select name="attendance[]" class="se-opt" style="margin-left: 1px;" required>
                                                                        <option value="" selected disabled>Attendance</option>
                                                                        <option value="present">Present</option>
                                                                        <option value="absant">Absant</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="hidden" name="idAtt[]" value="<?php echo $dataAtt['id']; ?>"></td>
                                                                <td><input type="hidden" name="rollNumber[]" value="<?php echo $dataAtt['roll_number']; ?>"></td>
                                                                <td><input type="hidden" name="username[]" value="<?php echo $dataAtt['username']; ?>"></td>
                                                            </tr>
                                                        <?php
                                                    }                                        
                                                }
                                            }
                                        } else {
                                        ?>
                                            <p style="color: brown; font-family: verdana; margin-left: 10%;"><?php echo "Please choose another date"; ?></p>
                                        <?php
                                        }  
                                    }
                                ?>   
                            </tbody>
                        </table>
                        <button type="submit" name="submit-attendanceDetailData" class="btn" id="bt" style="margin-left: 10px;">Attendance</button>
                    </form>
                </div>
                <?php
                    if (isset($_POST['submit-attendanceDetailData'])) {
                        $id = $_POST['idAtt'];
                        $rollNumber = $_POST['rollNumber'];
                        $studentNm = $_POST['username'];
                        $attendance = $_POST['attendance'];

                        if (isset($_SESSION['date'])) {
                            $dateTb = $_SESSION['date'];
                        }

                        if (isset($_SESSION['division_name'])) {
                            $divi = $_SESSION['division_name'];
                        }

                        $stdtb = $dataOfUser['standard']; // 10

                        if (isset($_SESSION['division_name'])) {
                            $divtbl = $_SESSION['division_name'];    
                        }

                        $stdtbl = $dataOfUser['standard'];

                        // echo "This is a division : ".$divtbl."<br>";
                        $tmptb = "standard".$stdtbl.$divi;
    
                        $secondSelectAtt = "SELECT * FROM $tmptb";
                        $secondTime = $conn->prepare($secondSelectAtt);
    
                        if ($secondTime->execute()) {
                            $num = $secondTime->rowCount();
                        }     

                        //  echo "The standard is : ".$stdtbl;
                        //  echo "<br><br>The division is : ".$divtbl;
                        $tbl = $_SESSION['attendanceTableName'];

                        $checkDateAvai = "SELECT attendance_date FROM $tbl WHERE attendance_date = ?";
                        $statCheckDateAvai = $conn->prepare($checkDateAvai);
                        $statCheckDateAvai->execute([$dateTb]);

                        if ($statCheckDateAvai->rowCount() == 0) {
        
                            $insertAttendance = "INSERT INTO $tbl (roll_number, student_name, attendance, attendance_date) VALUES ";

                            // $insertAttendance .="('".$rollNumber[$i]."','".$studentNm[$i]."','".$attendance[$i]."','".$dateTb."'),";
    
                            for ($i=0; $i < $num; $i++) {
        
                                $insertAttendance .="('".$rollNumber[$i]."','".$studentNm[$i]."','".$attendance[$i]."','".$dateTb."'),";
                            }
                            $insertAttendance = rtrim($insertAttendance, ",");
                            $statInsertAttendance = $conn->prepare($insertAttendance);
                                
                            if ($statInsertAttendance->execute() == true) {
                            ?>
                                <script>alert("Attendance inserted successfully");</script>
                            <?php
                            } else {
                                echo "<br><br>Cannot insert please try again";
                            }  
                        } else {
                        ?>
                            <p class="error" style="margin-left: 20%; margin-top: 30px;"><?php echo "Please choose another date"; ?></p>
                        <?php
                        }
                    }
                ?>
            </div>
            <!-- This is a end coding of Attendance -->

            <!-- This is a start Attendace Report coding -->
            <div id="attendenceReport" style="display: none;" class="section">
                <h3 class="title">Attendance Report</h3>
                <div class="containerAdvanceReport">
                    <form method="post">
                        <p class="st">Standard : <?php echo $dataOfUser['standard']; ?></p>
                        <?php
                            // The standard data fetch coding
                            $fetchStandard = "SELECT * FROM division WHERE standard = ?";
                            $statFetchStandard = $conn->prepare($fetchStandard);
                            $statFetchStandard->execute([$dataOfUser['standard']]);
                            
                            if ($statFetchStandard->rowCount() > 0) {
                            ?>
                                <select name="divisionAdvRe" required class="se-opt dro">
                                <option value="" selected disabled>Division</option>
                                <?php
                                    while ($dataDivisionAdRe = $statFetchStandard->fetch()) {
                                    ?>
                                        <option value="<?php echo $dataDivisionAdRe['division_name']; ?>"><?php echo $dataDivisionAdRe['division_name']; ?></option>
                                    <?php
                                    }
                                ?>
                                </select>      
                            <?php
                            } else {
                                echo "The record cannot found";
                            }
                        ?>
                        <br>
                        <input type="date" name="dateAdvRe" class="dateStyAdvRe" required/><br>
                        <button type="submit" name="submitAdvRe" class="btn">Show Report</button>
                        <?php
                            if (isset($_POST['submitAdvRe'])) {
                                $stdAttRe = $dataOfUser['standard'];
                                $divAttRe = $_POST['divisionAdvRe'];
                                $dateAttRe = $_POST['dateAdvRe'];

                                $tblnmAttRe = "attendancebookstandard".$stdAttRe.$divAttRe;

                                $tblCheckAttRe = "SELECT * FROM $tblnmAttRe";
                                $statTblCheckAttRe = $conn->prepare($tblCheckAttRe);
                                $statTblCheckAttRe->execute();

                                if ($statTblCheckAttRe->rowCount() > 0) {
                                    $tblCheckDateAttRe = "SELECT * FROM $tblnmAttRe WHERE attendance_date = ?";
                                    $stattblCheckDateAttRe = $conn->prepare($tblCheckDateAttRe);
                                    $stattblCheckDateAttRe->execute([$dateAttRe]);

                                    if ($stattblCheckDateAttRe->rowCount() > 0) {
                                    ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>ROLL NUMBER</td>
                                                    <td>STUDENT NAME</td>
                                                    <td>ATTENDANCE</td>
                                                    <td>DATE</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while ($dataStattblCheckDateAttRe = $stattblCheckDateAttRe->fetch()) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $dataStattblCheckDateAttRe['roll_number']; ?></td>
                                                            <td><?php echo $dataStattblCheckDateAttRe['student_name']; ?></td>
                                                            <td><?php echo $dataStattblCheckDateAttRe['attendance']; ?></td>
                                                            <td><?php echo $dataStattblCheckDateAttRe['attendance_date']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                ?>
                                                </tbody>
                                           </table> 
                                    <?php
                                    } else {
                                    ?>
                                        <p class="error" style="margin-left: 20%; margin-top: 30px;"><?php echo "Please choose another date"; ?></p>
                                    <?php
                                    }
                                } else {
                                ?>
                                    <p style="font-family: verdana; color: brown"><?php echo "Please you can first attendance because the attendace table can empty"; ?></p>
                                <?php
                                } 
                            } 
                        ?>
                    </form>
                </div>
            </div>
            <!-- This is a end Attendace Report system -->

            <!-- This is a start coding of Advance Report -->
            <div id="studentDetail" style="display: none;" class="section">
                <h3 class="title">Student Detail</h3>
                <div class="container-advanceReport">
                    <p class="st">Standard : <?php echo $dataOfUser['standard']; ?></p>
                    <!-- This is a coding of fetch division data for selected standard -->
                    <?php
                        $selectDivStuRe = "SELECT division_name FROM division WHERE standard = ?";
                        $statSelectDivStuRe = $conn->prepare($selectDivStuRe);
                        $statSelectDivStuRe->execute([$dataOfUser['standard']]);
                    ?>
                    <form method="post">
                        <select onchange="divisionFun()" id="division" class="se-opt" style="margin-bottom: 10px;">
                            <option value="" selected disabled>Division</option>
                            <?php
                                while ($dataDivisionStuRe = $statSelectDivStuRe->fetch()) {
                                ?>
                                    <option value="<?php echo $dataDivisionStuRe['division_name']; ?>"><?php echo $dataDivisionStuRe['division_name']; ?></option>
                                <?php
                                }
                            ?>
                        </select><br>
                        <script>
                            function divisionFun(){ 
                                let division = document.getElementById("division").value;
                                location.href="?divisionClass="+division;
                            }
                        </script>
                        <?php
                            if (isset($_GET['divisionClass'])) {
                                $div = $_GET['divisionClass'];
                                $tblNm = "standard".$dataOfUser['standard'].$div;
                                $_SESSION['UsernamedataTable'] = $tblNm;
                                
                                $dataOfStudent = "SELECT username FROM $tblNm";
                                $statDataOfStudent = $conn->prepare($dataOfStudent);
                                $statDataOfStudent->execute();

                            ?>
                                <select name="usernm" class="se-opt" required>
                                    <option value="" selected disabled>Username</option>
                                    <?php
                                        while ($dataOfStudentRe = $statDataOfStudent->fetch()) {
                                        ?>
                                            <option value="<?php echo $dataOfStudentRe['username']; ?>"><?php echo $dataOfStudentRe['username']; ?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            <?php
                            } else {
                            ?>
                                <script>
                                    let stuDetBtn = document.getElementById("btn-StuDet");
                                    stuDetBtn.disabled = true;
                                </script>
                            <?php
                            }
                        ?>
                        <br>
                        <input type="submit" name="submitUsernameData" class="btn-selectTableData" id="btn-StuDet">
                    </form>
                    <?php
                        if (isset($_POST['submitUsernameData'])) {
                            if (isset($_POST['usernm'])) {
                                $usernm = $_POST['usernm'];
                                if (isset($_SESSION['UsernamedataTable'])) {
                                    $tableNameShowData = $_SESSION['UsernamedataTable'];

                                    $selectData = "SELECT * FROM $tableNameShowData WHERE username like ?";
                                    $statSelectData = $conn->prepare($selectData);
                                    $statSelectData->execute([$usernm]);
                                    $dataOfStudentSelectedClass = $statSelectData->fetch();
                                }
                            }
                        }
                    ?>
                    <p class="studentDataTitle">The all data of Username is be like.............</p>
                    <table class="table table-striped">
                        <tr>
                            <p class="UsernmDetail">Roll Number : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['roll_number']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Student Name : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['student_name']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Contact Number : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['contact_number']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Email Id : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['email']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Date Of Birth : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['date_of_birth']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">City : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['city']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Address : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['address']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Pincode : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['pincode']; } ?></p>
                        </tr>
                        <tr>
                            <p class="UsernmDetail">Username : <?php if (!empty($dataOfStudentSelectedClass)) { echo $dataOfStudentSelectedClass['username']; } ?></p>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- This is a end coding of Advance Report -->

           <!-- This is a start coding of to complain -->
            <div id="toComplain" style="display: none;" class="section">
                <h3 class="title">To Complain</h3>
                <div class="containerAdvanceReport">
                    <p class="titleForComplain">Here you can write a complain.........</p><br>
                    <form method="post">
                        <input type="date" class="dateBox" name="complain_date"><br><br>
                        <textarea name="complain" class="textareaBox" cols="50" rows="7" placeholder="Write your complain here......."></textarea><br><br>
                        <button type="submit" name="submitComplain" class="btn">To Complain</button>
                    </form>
                    <?php
                        if (isset($_POST['submitComplain'])) {
                            $complain_date = $_POST['complain_date'];
                            $complain = $_POST['complain'];
                            if (isset($_SESSION['username'])) {
                                
                                $teacherDetail = "SELECT * FROM staff WHERE username like ?";
                                $statTeacherDetail = $conn->prepare($teacherDetail);
                                $statTeacherDetail->execute([$_SESSION['username']]);

                                if ($dataOfTeacher = $statTeacherDetail->fetch()) {
                                    $contactNumber = $dataOfTeacher['contact_number'];
                                    $gender = $dataOfTeacher['gender'];
                                    $teacherStandard = $dataOfTeacher['standard'];

                                    $complainTblName = "complain".$_SESSION['username'];

                                    $insertComplain = "INSERT INTO $complainTblName (username, standard, gender, contactNumber, complain, complain_date) VALUES (?, ?, ?, ?, ?, ?)";
                                    $statInsertComplain = $conn->prepare($insertComplain);

                                    if ($statInsertComplain->execute([$_SESSION['username'], $teacherStandard, $gender, $contactNumber, $complain, $complain_date])) {
                                    ?>
                                        <script>alert("Your complaint has been successfully processed........");</script>
                                    <?php
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </div>
           <!-- This is a end coding of to complain -->

            <!-- This is a start coding of complain made -->
           <div id="complainMade" class="section" style="display: none;">
                <h3 class="title">Complain Made</h3>
                <div class="showComplain-Container"><br>
                    <?php
                        $complainTblForTeacher = "complain".$dataOfUser['username'];
                        $_SESSION['teacherComplainTbl'] = $complainTblForTeacher;
                        
                        $selectComplain = "SELECT * FROM $complainTblForTeacher";
                        $statSelectComplain = $conn->prepare($selectComplain);
                        $statSelectComplain->execute();

                        if ($statSelectComplain->rowCount() > 0) {
                            while ($dataOfTeacherComplain = $statSelectComplain->fetch()) {
                            ?>
                                <div class="complainCart">
                                    <p>Username : <?php echo $dataOfUser['username']; ?></p>
                                    <p>Complain Date : <?php echo $dataOfTeacherComplain['complain_date']; ?></p>
                                    <p>Complain : <?php echo $dataOfTeacherComplain['complain']; ?></p><br><br><br><br>
                                    <a href="http://localhost/viral/school-system/teacherAdmin/editComplain.php?editOwnCom=<?php echo $dataOfTeacherComplain['id']; ?>"><input type="button" value="EDIT" class="btn"></a>
                                    <a href="http://localhost/viral/school-system/teacherAdmin/deleteComplain.php?deleteOwnCom=<?php echo $dataOfTeacherComplain['id']; ?>"><input type="button" value="DELETE" class="btn"></a><br><br>
                                    
                                </div>
                            <?php
                            }
                        } else {
                        ?>
                            <p class="titleForComplain">What you may have complained about before is resolved, and no complaints now</p>
                        <?php
                        }
                    ?>
                </div>
                <!-- What you may have complained about before is resolved, and no complaints now -->
           </div>
           <!-- This is a end coding of complain made -->

            <!-- This is a start coding of show complain -->
           <div id="showComplain" class="section" style="display: none;">
                <h3 class="title">Show Complain</h3>
                <div class="showComplain-Container">
                    <form method="post">
                        <select name="standard" class="dropDown" style="margin-top: 20px;" required>
                            <option value="" selected disabled>Standard</option>
                            <option value="<?php echo $dataOfUser['standard']; ?>"><?php echo $dataOfUser['standard']; ?></option>
                        </select><br>
                        <?php
                            $selectDvisionData = "SELECT * FROM division WHERE standard = ?";
                            $statSelectDvisionData = $conn->prepare($selectDvisionData);
                            $statSelectDvisionData->execute([$dataOfUser['standard']]);
                        ?>
                        <select name="division" class="dropDown" required>
                            <option value="" selected disabled>Division</option>
                            <?php
                                while ($dataDiv = $statSelectDvisionData->fetch()) {
                                ?>
                                    <option value="<?php echo $dataDiv['division_name'] ?>"><?php echo $dataDiv['division_name'] ?></option>
                                <?php
                                }
                            ?>
                        </select><br>
                        <input type="submit" value="Show Complain" class="btn" name="submitComplainTbl" style="margin-left: 152px;">
                    </form>
                    <?php
                        if (isset($_POST['submitComplainTbl'])) {
                            $division = $_POST['division'];

                            $complainTblNm = "complainstandard".$dataOfUser['standard'].$division;

                            $_SESSION['studentComplain'] = $complainTblNm;

                            $showStudentComplain = "SELECT * FROM $complainTblNm";
                            $statShowStudentComplain = $conn->prepare($showStudentComplain);
                            $statShowStudentComplain->execute();

                            if ($statShowStudentComplain->rowCount() > 0) {
                                while ($dataStudentComplain = $statShowStudentComplain->fetch()) {
                                    ?>
                                        <div class="complainCart">
                                            <p>Roll Number : <?php echo $dataStudentComplain['roll_number']; ?></p>
                                            <p>Standard : <?php echo $dataStudentComplain['student_standard']; ?></p>
                                            <p>Division : <?php echo $dataStudentComplain['student_division']; ?></p>
                                            <p>Student Name : <?php echo $dataStudentComplain['student_name']; ?></p>
                                            <p>Complain Date : <?php echo $dataStudentComplain['complain_date']; ?></p>
                                            <p>Complain : <?php echo $dataStudentComplain['complain']; ?></p>
                                            <a href="http://localhost/viral/school-system/teacherAdmin/deleteComplain.php?idOfDeleteComplain=<?php echo $dataStudentComplain['id']; ?>"><input type="button" value="Complain Solved" class="btn" style="width: 40%;"></a>
                                        </div>
                                    <?php
                                }
                            } else {
                            ?>
                                <p class="complainErr">No Complain Available.......</p>
                            <?php
                            }
                        }
                    ?>
                </div>
           </div>
           <!-- This is a end coding of show complain -->

            <!-- This is a start coding of change password -->
            <div id="changePassword" style="display: none;" class="section">
                <h3 class="title">Change Password</h3>
                <div class="containerAdvanceReport">
                    <p class="titleForComplain">Please change password here.........</p>
                    <p class="errorChangePassword" id="errorChangePassword"></p>
                    <form method="post">
                        <br>
                        <input type="password" name="password" class="passwordBox" placeholder="Password" required><br><br>
                        <input type="password" name="conform_password" class="passwordBox" placeholder="Conform Password" required><br><br>
                        <button type="submit" class="btn" name="changePassword">Submit</button>
                    </form>
                    <?php
                        if (isset($_POST['changePassword'])) {
                            $password = $_POST['password'];
                            $conform_password = $_POST['conform_password'];

                            if (strlen($password) >= 3 && strlen($conform_password) <= 8 && strlen($password) >= 3 && strlen($conform_password) <= 8) {
                                if ($password === $conform_password) {

                                    if (isset($_SESSION['username'])) {

                                        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                                        $conformPasswordHash = password_hash($conform_password, PASSWORD_BCRYPT);

                                        $updatePassword = "UPDATE staff SET password = ?, conform_password = ? WHERE username = ?";
                                        $statupdatePassword = $conn->prepare($updatePassword);
                                        
                                        if ($statupdatePassword->execute([$passwordHash, $conformPasswordHash, $_SESSION['username']])) {
                                        ?> 
                                            <script>
                                                alert("Password can change successfully..........");
                                            </script>
                                        <?php
                                        }
                                    }

                                } else {
                                ?>
                                    <script>
                                        document.getElementById("errorChangePassword").innerHTML = "***Please enter same password and conform password";
                                    </script>
                                <?php  
                                }
                            } else {
                            ?>
                                <script>
                                    document.getElementById("errorChangePassword").innerHTML = "***Please enter the password greter than 3 and less than 8";
                                </script>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <!-- This is a start coding of change password -->

        </div>
    </div>
</body>
</html>