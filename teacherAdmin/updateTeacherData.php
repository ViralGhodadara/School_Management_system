<?php

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    session_start();

    $id = $_GET['id'];
    $usernm = $_GET['odlUsernm'];

    $oldComplainTblName = "complain".$usernm;

    $updateData = 'SELECT * FROM staff WHERE id = ?';
    $statUpdateData = $conn->prepare($updateData);
    $statUpdateData->execute([$id]);
    $data = $statUpdateData->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: beige;
        }
        .container{
            height: 600px;
            width: 435px;
            background-color: white;
            margin-left: 33%;
        }
        .title{
            color: brown;
            font-family: verdana;
            text-align: center;
            font-size: 30px;
            font-style: italic;1
        }
        .box{
            height: 25px;
            margin-left: 20%;
            width: 220px;
            margin-top: 18px;
            font-family: verdana;
        }
        .optionbox{
            height: 25px;
            width: 150px;
            margin-top: 18px;
            font-family: verdana;
            margin-left: 20%;
        }
        .textarea{
            margin-top: 18px;
            font-family: verdana;
            margin-left: 20%;
        }
        .btn{
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
        #error{
            color: brown;
            font-family: verdana;
        }
    </style>
</head>
<!-- The standard data fetch -->
<?php
    $selectStandard = 'SELECT standard FROM std';
    $statSelectStandard = $conn->prepare($selectStandard);
    $statSelectStandard->execute();
?>
<body>
    <h3 class="title">Update Here</h3>
    <div class="container">
        <p id="error"></p>
        <form method="post">
            <table>
                <tr>
                    <input type="text" name="username" placeholder="Username" value="<?php echo $data['username'] ?>" class="box" required>
                </tr>
                <tr>
                    <br>
                    <select name="standard" class="optionbox" required>
                        <option disabed>Standard</option>
                        <option value="<?php echo $data['standard'] ?>" selected><?php echo $data['standard'] ?></option>
                        <?php
                            while ($dataStd = $statSelectStandard->fetch()) {
                            ?>
                                <option value="<?php echo $dataStd['standard'] ?>"><?php echo $dataStd['standard'] ?></option>
                            <?php
                            }
                        ?>
                    </select>
                </tr>
                <tr>
                    <br>
                    <input type="text" name="teacherName" placeholder="Teacher Name" value="<?php echo $data['teacher_name'] ?>" class="box" required>
                </tr>
                <tr>
                    <br>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $data['email'] ?>" class="box" required>
                </tr>
                <tr>
                    <br>
                    <input type="number" name="contact_number" placeholder="Contact Number" value="<?php echo $data['contact_number'] ?>" class="box" required>
                </tr>
                <tr>
                    <br>
                    <textarea name="address" cols="30" rows="7" placeholder="Address" class="textarea" required><?php echo $data['address'] ?></textarea>
                </tr>
                <tr>
                    <br>
                    <select name="qualification" class="optionbox" required>
                        <option>Qualification</option>
                        <option value="<?php echo $data['qualification']; ?>" selected><?php echo $data['qualification']; ?></option>
                        <option value="bca">BCA</option>
                        <option value="bsc">BSC</option>
                        <option value="arts">ARTS</option>
                    </select>
                </tr>
                <tr>
                    <br>
                    <input type="text" name="city" placeholder="city" value="<?php echo $data['city'] ?>" class="box" required>
                </tr>
                <tr>
                    <br>
                    <select name="gender" class="optionbox" required>
                        <option>Gender</option>
                        <option value="<?php echo $data['gender'] ?>" selected><?php echo $data['gender'] ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </tr>
                <tr>
                    <br>
                    <button type="submit" class="btn" name="updateTeacherData">Update</button>
                </tr>
                <tr>
                    <p style="font-family: verdana; margin-left: 20%; margin-bottom: 10px;">Back to <a href="http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php" style="font-family: verdana; text-decoration: none; color: blue"> Panel ?</a></p>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
    if (isset($_POST['updateTeacherData'])) {
        $username = $_POST['username'];
        $std = $_POST['standard'];
        $teacherName = $_POST['teacherName'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contact_number'];
        $address = $_POST['address'];
        $qualification = $_POST['qualification'];
        $city = $_POST['city'];
        $gender = $_POST['gender'];

        $newComplainTblaName = "complain".$username;

        $renameComplainTbl = "ALTER TABLE $oldComplainTblName RENAME TO $newComplainTblaName";
        $statRenameComplainTbl = $conn->prepare($renameComplainTbl);
        $statRenameComplainTbl->execute();

        if (strlen($contactNumber) == 10) {

            $_SESSION['username'] = $username;
            $update = 'UPDATE staff SET username = ?, standard = ?, teacher_name = ?, email = ?, contact_number = ?, address = ?, qualification = ?, city = ?, gender = ? WHERE id = ?';
            $statUpdate = $conn->prepare($update);
            
            if ($statUpdate->execute([$username, $std, $teacherName, $email, $contactNumber, $address, $qualification, $city, $gender, $id])) {
            ?>
                <script>
                    alert("Record can update successfully");
                    window.location.replace("http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php");
                </script>
            <?php
            } else {
            ?>
                <script>
                    document.getElementById("error").innerHTML = "Please enter the valid number";
                </script>
            <?php
            }
        }
    }
?>