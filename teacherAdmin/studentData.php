<?php
    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: beige;
        }
        .heading{
            font-family: verdana;
            color: brown;
            text-align: center;
            font-size: 32px;
        }
        .student-data{            
            height: 380px;
            width: 513px;
            background-color: white;
            margin-left: 31.5%;
        }
        .content{
            font-family: verdana;
            margin-left: 65px;
            margin-top: 15px;
        }
        .lbl{
            color: red;
        }
        .panelLink{
            text-decoration: none;
        }
    </style>
</head>
<?php
    if (isset($_POST['submit-stdDiv'])) {
        $username = $_POST['usernameAdvRe'];

        session_start();

        $className = $_SESSION['classNameForStudentData'];

        $selectStudentData = "SELECT * FROM $className WHERE username like ?";
        $statSelectStudentData = $conn->prepare($selectStudentData);
        $statSelectStudentData->execute([$username]);
        $dataForUsername = $statSelectStudentData->fetch();
    }
?>
<body>
    <h3 class="heading">Student Data</h3>
    <div class="student-data">
        <p class="content" style="padding-top: 25px;"><span class="lbl">Roll Number : </span><?php echo $dataForUsername['roll_number']; ?></p>
        <p class="content"><span class="lbl">Student Name : </span><?php echo $dataForUsername['student_name']; ?></p>
        <p class="content"><span class="lbl">Contact Number : </span><?php echo $dataForUsername['contact_number']; ?></p>
        <p class="content"><span class="lbl">Email : </span><?php echo $dataForUsername['email']; ?></p>
        <p class="content"><span class="lbl">Date Of Birth : </span><?php echo $dataForUsername['date_of_birth']; ?></p>
        <p class="content"><span class="lbl">Address : </span><?php echo $dataForUsername['address']; ?></p>
        <p class="content"><span class="lbl">City : </span><?php echo $dataForUsername['city']; ?></p>
        <p class="content"><span class="lbl">Pincode : </span><?php echo $dataForUsername['pincode']; ?></p>
        <p class="content"><span class="lbl">Username : </span><?php echo $dataForUsername['username']; ?></p>
        <!-- <p class="content" style="margin-left: 30%;">Back to <a href="http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php" class="panelLink">Panel ?</a></p> -->
    </div>
</body>
</html>

<title><?php echo $dataForUsername['username']; ?></title>
<?php
    session_destroy();
?>