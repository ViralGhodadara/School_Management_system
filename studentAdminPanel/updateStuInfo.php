<?php
    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system;', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
    body{
        margin: 0;
        padding: 0;
        background-color: beige;
    }
    .title {
        color: brown;
        font-family: verdana;
        text-align: center;
        font-size: 30px;
        font-style: italic;
    }
    .container {
        height: 550px;
        width: 435px;
        background-color: white;
        margin-left: 33%;
    }
    .box {
        height: 25px;
        margin-left: 20%;
        width: 220px;
        margin-top: 18px;
        font-family: verdana;
    }
    .textarea {
        margin-top: 18px;
        font-family: verdana;
        margin-left: 20%;
    }
    .btn {
        height: 32px;
        background-color: rgb(70, 125, 236);
        color: white;
        margin-left: 20.0%;
        margin-top: 17px;
        width: 87px;
        font-family: verdana;
        border: 2px solid;
        border-radius: 8px;
    }
    #err{
        color: brown;
        font-family: verdana;
        margin-left: 20px;
    }
    </style>
</head>
<body>
    <?php
        $tblName = $_SESSION['StudentTblName'];
        $selectData = "SELECT * FROM $tblName WHERE username = ?";
        $statSelectData = $conn->prepare($selectData);
        $statSelectData->execute([$_SESSION['studentUsername']]);

        $stuData = $statSelectData->fetch();
    ?>
    <h3 class="title">Update Here......</h3>
    <div class="container">
        <form method="post">
            <p id="err"></p>
            <input type="text" class="box" name="stuName" placeholder="Student Name" value="<?php echo $stuData['student_name']; ?>" required>
            <input type="number" class="box" name="contactNumber" placeholder="Contact Number" value="<?php echo $stuData['contact_number']; ?>" required>
            <input type="email" class="box" name="email" placeholder="Email id" value="<?php echo $stuData['email']; ?>" required>
            <input type="date" class="box" name="date_of_birth" placeholder="Date of Birth" value="<?php echo $stuData['date_of_birth']; ?>" required>
            <textarea class="textarea" name="address" cols="30" rows="7" placeholder="Address" required><?php echo $stuData['address']; ?></textarea>
            <input type="text" class="box" name="city" placeholder="City" value="<?php echo $stuData['city']; ?>" required>
            <input type="number" name="pincode" class="box" placeholder="Pincode" value="<?php echo $stuData['pincode']; ?>" required>
            <button type="submit" class="btn" name="updateStuInfo">Update</button>
        </form>
        <p style="font-family: verdana; margin-left: 20%; margin-bottom: 10px;">Back to <a href="http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php" style="font-family: verdana; text-decoration: none; color: blue">Home ?</a></p>
    </div>
</body>
</html>
<?php
    if (isset($_POST['updateStuInfo'])) {

        $studentName = $_POST['stuName'];
        $contactNumber = $_POST['contactNumber'];
        $email = $_POST['email'];
        $dateOfBirth = $_POST['date_of_birth'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];

        if (strlen($studentName) >= 3 && strlen($studentName) <= 8) {
            if (strlen($contactNumber) == 10) {
                if (strlen($pincode) == 6) {
                    $updateStu = "UPDATE $tblName SET student_name = ?, contact_number = ?, email = ?, date_of_birth = ?, address = ?, city = ?, pincode = ? WHERE username = ?";
                    $statUpdateStu = $conn->prepare($updateStu);

                    if ($statUpdateStu->execute([$studentName, $contactNumber, $email, $dateOfBirth, $address, $city, $pincode, $_SESSION['studentUsername']])) {
                    ?>
                        <script>
                            alert("Student data can update successfully......");
                            window.location.replace("http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php");
                        </script>
                    <?php
                    } else {
                        echo "Query cannot work";
                    }
                } else {
                ?>
                    <script>
                        document.getElementById("err").innerHTML = "***Please enter the valid pincode";
                    </script>
                <?php   
                }
            } else {
            ?>
                <script>
                    document.getElementById("err").innerHTML = "***Please enter the valid contact number";
                </script>
            <?php        
            }
        } else {
        ?>
            <script>
                document.getElementById("err").innerHTML = "***Please enter the student name greter than 2 and less than 9 character";
            </script>
        <?php
        }
    }
?>