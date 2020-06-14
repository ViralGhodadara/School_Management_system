<?php
    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    // if ($conn) {
    //     echo "Connection can successfull";
    // } else {
    //     echo "connection cannot successfull please try again";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['studentUsername'])) { echo $_SESSION['studentUsername']; } ?></title>
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
        .container-home {
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .para {
            margin-left: 12%;
            font-family: verdana;
            padding: 10px;
            font-size: 15px;
        }
        .btn {
            height: 32px;
            background-color: rgb(70, 125, 236);
            color: white;
            margin-left: 13.5%;
            margin-top: 7px;
            width: 129px;
            font-family: verdana;
            border: 2px solid;
            border-radius: 8px;
            border: 2px solid rgb(70, 125, 236);
            margin-bottom: 10px;
        }
        .btn a {
            font-family: verdana;
            text-decoration: none;
            color: white;
        }
        .container-attendaceReport{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .attBox{
            margin-top: 14px;
            margin-left: 103px;
        }
        #error{
            color: brown;
            font-family: verdana;
            margin-left: 10%;
        }
        .container-toComplain{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .titleForComplain{
            margin-left: 105px;
            margin-top: 0px;
            padding-top: 10px;
            font-family: verdana;
            font-size: 15px;
        }
        .dateBox {
            height: 31px;
            width: 165px;
            font-family: verdana;
            margin-left: 105px;
        }
        .textareaBox {
            font-family: verdana;
            margin-left: 105px;
        }
        .containerChangePass{
            height: 40%;
            width: 75%;
            background-color: #d0c9c9;
            margin-left: 110px;
        }
        .passwordBox {
            margin-left: 13.5%;
            font-family: verdana;
        }
        .titleForComplain {
        margin-left: 105px;
        margin-top: 0px;
        padding-top: 10px;
        font-family: verdana;
        font-size: 15px;
        }
        .errorChangePassword {
            color: brown;
            font-family: verdana;
            margin-left: 13.5%;
            margin-bottom: -18px;
            margin-top: 30px;
        }
        .myComplain-Container {
            background-color: #d0c9c9;
            height: 1000px;
            width: 75%;
            margin-left: 10%;
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
    </style>
</head>
<body>

    <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
        <h3 class="w3-bar-item" style="font-family: verdana;">Student Admin Panel</h3>
        <a onclick="displaySection('home')" class="w3-bar-item w3-button sty">Home</a>
        <a onclick="displaySection('attendanceReport')" class="w3-bar-item w3-button sty">Attendance Report</a>
        <a onclick="displaySection('toComplain')" class="w3-bar-item w3-button sty">To Complain</a>
        <a onclick="displaySection('myComplain')" class="w3-bar-item w3-button sty">My Complain</a>
        <a onclick="displaySection('passwordChange')" class="w3-bar-item w3-button sty">Password Change</a>
        <a href="http://localhost/viral/school-system/" class="w3-bar-item w3-button sty">Logout</a>
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

    <?php
        // This is a code for student data.....

        $selectStudentData = "SELECT * FROM students WHERE username = ?";
        $statselectStudentData = $conn->prepare($selectStudentData);
        $statselectStudentData->execute([$_SESSION['studentUsername']]);
        $stuData = $statselectStudentData->fetch();

        $stdStudent = $stuData['student_standard'];
        $divStudent =  $stuData['student_division'];

        // $_SESSION['studentStandard'] = $stdStudent;
        // $_SESSION['studentDivision'] = $divStudent;

        $tblNm = "standard".$stdStudent.$divStudent;

        $_SESSION['StudentTblName'] = $tblNm;

        $selectStudentDataForProper = "SELECT * FROM $tblNm WHERE username = ?";
        $statSelectStudentDataForProper = $conn->prepare($selectStudentDataForProper);
        $statSelectStudentDataForProper->execute([$_SESSION['studentUsername']]);

        $dataStudent = $statSelectStudentDataForProper->fetch();
    ?>
    
    <div style="margin-left: 25%;">
        
        <!-- This is a start coding of home -->
        <div class="section" id="home">
            <h3 class="title">Home</h3>
            <div class="container-home">
                <p class="para">Standard : <?php echo $stdStudent; ?></p>
                <p class="para">Division : <?php echo $divStudent; ?></p>
                <p class="para">Roll Number : <?php echo $dataStudent['roll_number']; ?></p>
                <p class="para">Student Name : <?php echo $dataStudent['student_name']; ?></p>
                <p class="para">Contact Number : <?php echo $dataStudent['contact_number']; ?></p>
                <p class="para">Email Id : <?php echo $dataStudent['email']; ?></p>
                <p class="para">Date of Birth : <?php echo $dataStudent['date_of_birth']; ?></p>
                <p class="para">Address : <?php echo $dataStudent['address']; ?></p>
                <p class="para">City : <?php echo $dataStudent['city']; ?></p>
                <p class="para">Pincode : <?php echo $dataStudent['pincode']; ?></p>
                <p class="para">Username : <?php echo $dataStudent['username']; ?></p>
                <a href="http://localhost/viral/school-system/studentAdminPanel/updateStuInfo.php"><button type="button" class="btn">Edit</button></a>
            </div>
        </div>
        <!-- This is a end coding of home -->

        <!-- This is a start coding of attendace report... -->
        <div class="section" id="attendanceReport" style="display: none;">
            <h3 class="title">Attendance Report</h3>
            <p id="error"></p>
            <div class="container-attendaceReport">
                <form method="post">
                    <input type="date" class="attBox" name="firstDate" required><br>
                    <input type="date" class="attBox" name="secondDate" required><br>
                    <button type="submit" class="btn" name="submitDates" style="margin-top: 15px;">Take Report</button>
                </form>
                <?php
                    if (isset($_POST['submitDates'])) {
                        $firstDate = $_POST['firstDate'];
                        $secondDate = $_POST['secondDate'];

                        $attTblName = "attendancebook".$tblNm;

                        $checkDateInTbl = "SELECT attendance_date FROM $attTblName WHERE attendance_date = ? AND student_name = ?";
                        $statCheckDateInTbl = $conn->prepare($checkDateInTbl);
                        $statCheckDateInTbl->execute([$firstDate, $_SESSION['studentUsername']]);

                        // echo "The rows is : ".$statCheckDateInTbl->rowCount();

                        if ($statCheckDateInTbl->rowCount() == 1) {

                            $checkSecondDate = "SELECT attendance_date FROM $attTblName WHERE attendance_date = ? AND student_name = ?";
                            $statCheckSecondDate = $conn->prepare($checkSecondDate);
                            $statCheckSecondDate->execute([$secondDate, $_SESSION['studentUsername']]);

                            if ($statCheckSecondDate->rowCount() == 1) {
                                $selectAtt = "SELECT * FROM $attTblName WHERE student_name = ? AND attendance_date BETWEEN ? AND ?";
                                $statSelectAtt = $conn->prepare($selectAtt);
                                
                                if ($statSelectAtt->execute([$_SESSION['studentUsername'], $firstDate, $secondDate])) {
                                ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>ROLL NUMBER</td>
                                                <td>STUDENT NAME</td>
                                                <td>ATTENDANCE</td>
                                                <td>ATTENDANCE DATE</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($showAtt = $statSelectAtt->fetch()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $showAtt['roll_number']; ?></td>
                                                        <td><?php echo $showAtt['student_name']; ?></td>
                                                        <td><?php echo $showAtt['attendance']; ?></td>
                                                        <td><?php echo $showAtt['attendance_date']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    } 
                                } 
                            } else {
                            ?>
                                <script type="text/javascript">
                                    document.getElementById("error").innerHTML = "***Please enter the date between take attendance";
                                </script>
                            <?php    
                            }
                        } else {
                        ?>
                            <script type="text/javascript">
                                document.getElementById("error").innerHTML = "***Please enter the date between take attendance";
                            </script>
                        <?php
                    }
                    
                ?>
            </div>
        </div>
        <!-- This is a end coding of attendace report -->

        <!-- This is a start coding of to complain -->
        <div class="section" id="toComplain" style="display: none;">
            <h3 class="title">To Complain</h3>
            <div class="container-toComplain">
                <p class="titleForComplain">Here you can write a complain.........</p>
                <br>
                <form method="post">
                    <input type="date" name="complainDate" class="dateBox" required><br><br>
                    <textarea name="stuComplain" class="textareaBox" cols="50" rows="7" placeholder="Write your complain here......." required></textarea><br><br>
                    <input type="submit" name="submitStuComplain" value="To Complain" class="btn">
                </form>
            </div>
            <?php
                if (isset($_POST['submitStuComplain'])) {
                    $complainDate = $_POST['complainDate'];
                    $stuComplain = $_POST['stuComplain'];

                    $stuComplainTblName = "complainstandard".$stdStudent.$divStudent;

                    $insertStuComplain = "INSERT INTO $stuComplainTblName (roll_number, student_name, student_standard, student_division, complain_date, complain) VALUES (?, ?, ?, ?, ?, ?)";
                    $statInsertStuComplain = $conn->prepare($insertStuComplain);

                    if ($statInsertStuComplain->execute([$dataStudent['roll_number'], $dataStudent['username'], $stdStudent, $divStudent, $complainDate, $stuComplain])) {
                    ?>
                        <script>
                            alert("Your complaint has been successfully processed........");
                        </script>
                    <?php
                    }
                }
            ?>
        </div>
        <!-- This is a end coding of to complain-->

        <!-- This is a start coding of password change -->
        <div class="section" id="passwordChange" style="display: none;">
            <h3 class="title">Change Password</h3>
            <p class="errorChangePassword" id="showerr"></p><br>
            <div class="containerChangePass">
                <p class="titleForComplain">Please change password here.........</p>
                <form method="post">
                    <br>
                    <input type="password" name="password" class="passwordBox" placeholder="Password" required><br><br>
                    <input type="password" name="conform_password" class="passwordBox" placeholder="Conform Password" required><br><br>
                    <button type="submit" class="btn" name="changePassword" style="width: 20%;">Change Password</button>
                </form>
                <?php
                    if (isset($_POST['changePassword'])) {
                        $password = $_POST['password'];
                        $conformPassword = $_POST['conform_password'];

                        $changePasstblName = "standard".$stdStudent.$divStudent;

                        if (strlen($password) >= 3 && strlen($password) <= 8 && strlen($conformPassword) >= 3 && strlen($conformPassword) <= 8) {
                            if ($password === $conformPassword) {
                                $passhash = password_hash($password, PASSWORD_BCRYPT);
                                $conPassHash = password_hash($conformPassword, PASSWORD_BCRYPT);

                                $updatePass = "UPDATE $changePasstblName SET student_password = ?, student_conform_password = ? WHERE username = ?";
                                $statUpdatePass = $conn->prepare($updatePass);

                                $studentUpdatePass = "UPDATE students SET student_password = ?, student_conform_password = ? WHERE username = ?";
                                $statStudentUpdatePass = $conn->prepare($studentUpdatePass);
                                $statStudentUpdatePass->execute([$passhash, $conPassHash, $_SESSION['studentUsername']]);

                                if ($statUpdatePass->execute([$passhash, $conPassHash, $_SESSION['studentUsername']])) { 
                                ?>
                                    <script>
                                        alert("Password can change successfully.......");
                                    </script>
                                <?php
                                }

                            } else {
                            ?>
                                <script>
                                    document.getElementById('showerr').innerHTML = "***Please enter the same password and conform password";
                                </script>
                            <?php
                            }
                        } else {
                        ?>
                            <script>
                                document.getElementById('showerr').innerHTML = "***Please enter the password greter than 2 and less than 9";
                            </script>
                        <?php
                        }
                    }
                ?>
            </div>
        </div>
        <!-- This is a end coding of password change -->

        <div id="myComplain" class="section" style="display: none;">
            <h3 class="title">My Complain</h3>
            <?php
                $myComplainTblNm = "complainstandard".$stdStudent.$divStudent;

                $_SESSION['studentComplainTblName'] = $myComplainTblNm;
                
                $selectMyComplain = "SELECT * FROM $myComplainTblNm WHERE student_name = ?";
                $statSelectMyComplain = $conn->prepare($selectMyComplain);
                $statSelectMyComplain->execute([$_SESSION['studentUsername']]);

                // $myComplainData = $statSelectMyComplain->fetch();
            ?>
            <div class="myComplain-Container">
            <br>
               <?php
                    while ($myComplainData = $statSelectMyComplain->fetch()) {
                    ?>
                        <div class="complainCart">
                            <p>Username : <?php echo $myComplainData['student_name']; ?></p>
                            <p>Complain Date : <?php echo $myComplainData['complain_date']; ?></p>
                            <p>Complain : <?php echo $myComplainData['complain']; ?></p><br><br><br>
                            <a href="http://localhost/viral/school-system/studentAdminPanel/editStuComplain.php?idEditStuCom=<?php echo $myComplainData['id']; ?>"><input type="button" class="btn" value="EDIT"></a>
                            <a href="http://localhost/viral/school-system/studentAdminPanel/deleteMyComplain.php?idDeleteMyComplain=<?php echo $myComplainData['id']; ?>"><input type="button" class="btn" value="DELETE"></a><br><br>
                        </div>
                    <?php
                    }
               ?> 
            </div>
        </div>
    </div>
    
</body>
</html>