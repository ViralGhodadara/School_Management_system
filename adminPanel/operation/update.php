<?php
    $conn = new PDO("mysql:host=localhost; dbname=school_management_system", 'root', '');

    $id = $_GET['idupdate'];

    $select = "SELECT * FROM division WHERE id = ?";
    $stat = $conn->prepare($select);
    $stat->execute([$id]);
    $data = $stat->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body{
            background-color: beige;
            margin: 0;
            padding: 0;
        }
        .title{
            text-align: center;
            color: brown;
            font-family: verdana;
            font-style: italic;
            font-size: 30px; 
        }
        .container{
            height: 270px;
            width: 350px;
            background-color: white;
            margin-left: 38%;
        }
        .box{
            margin-left: 15%;
            margin-top: 5%;
            height: 20px;
            width: 200px;
        }
        .select-tag{
            margin-left: 15%;
            margin-top: 4.5%;
            height: 30px;
            font-family: verdana;
            width: 20%;
        }
        .btn{
            background-color: rgb(70, 125, 236);
            color: white;
            font-family: verdana;
            margin-left: 15%;
            margin-top: 4.5%;
            border: 3px solid rgb(70, 125, 236);
            height: 35px;
        }
        .back{
            font-family: verdana;
            margin-left: 15%;
        }
        .back a{
            color: blue;
        }
    </style>
</head>
<body>
    <h2 class="title">Update Here</h2>
    <div class="container">
        <form method="post">
            <table>
                <tr>
                    <input type="text" name="divname" placeholder="Division Name" class="box" style="margin-top: 10%;" value="<?php echo $data['division_name']; ?>" required>
                </tr>
                <tr>
                    <input type="number" name="update_seat" placeholder="Seat" class="box" value="<?php echo $data['seat']; ?>" required>
                </tr>
                <?php
                    $selected = "SELECT standard FROM std";
                    $statSelected = $conn->prepare($selected);
                    $statSelected->execute();
                ?>
                <tr>
                    <br>
                    <select name="standard" required class="select-tag">
                        <option>Standard</option>
                        <option value="<?php echo $data['standard']; ?>" selected><?php echo $data['standard']; ?></option>
                        <?php
                            while ($allData = $statSelected->fetch()) {
                            ?>
                                <option value="<?php echo $allData['standard']; ?>"><?php echo $allData['standard']; ?></option>
                            <?php
                            }
                        ?>
                    </select>
                </tr>
                <tr>
                    <br>
                    <button type="submit" name="submit-update" class="btn">Update</button>
                </tr>
                <tr>
                    <p class="back">Back to <a href="http://localhost/viral/school-system/adminPanel/admin.php">Admin ?</a></p>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
    if (isset($_POST['submit-update'])) {
        $divisionName = $_POST['divname'];
        $seat = $_POST['update_seat'];
        $std = $_POST['standard'];

        $mainSeat = $seat + $data['seat']; 
        $pending_seat = $seat + $data['pending_seat'];

        $update = "UPDATE division SET division_name = ?, seat = ?, standard = ?, pending_seat = ? WHERE id = ?";
        $statUpdate = $conn->prepare($update);

        $oldTbl = "standard".$data['standard'].$data['division_name'];
        $oldTable = $oldTbl;
        $oldStudentComplain = "complain".$oldTbl;

        $newStandard = "standard".$std;
        $newDiv = $divisionName;
        $newTb = $newStandard.$newDiv;
        $newTableName = $newTb;

        $complainStu = "complain".$newTb;

        $updateStuComplain = "ALTER TABLE $oldStudentComplain RENAME TO $complainStu";
        $statUpdateStuComplain = $conn->prepare($updateStuComplain);
        $statUpdateStuComplain->execute();

        $updateTableName = "alter table $oldTable rename to $newTableName";
        $statUpdateTableName = $conn->prepare($updateTableName);
        $statUpdateTableName->execute();

        if ($statUpdate->execute([$divisionName, $mainSeat, $std, $pending_seat, $id])) {
            session_start();
            $_SESSION['seat'] = $seat;
        ?>
            <script>
                alert("Record can update successfully");
                window.location.replace("http://localhost/viral/school-system/adminPanel/admin.php");
            </script>
        <?php
        }

    }
?>