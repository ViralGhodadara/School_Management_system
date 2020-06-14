<?php
    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

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
        .container{
            background-color: white;
            font-family: verdana;
            height: 40%;
            width: 40%;
            margin-left: 32%;
        }
        .dateBox {
            height: 31px;
            width: 165px;
            font-family: verdana;
            margin-left: 65px;
        }
        .txtare{
            font-family: verdana;
            margin-left: 65px;
        }
        .heading{
            font-family: verdana;
            margin-left: 65px;
            padding-top: 3.5%;
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
            border-radius: 5px;
        }
        .btn:hover {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET['editOwnCom'])) {
            $idOfEdit = $_GET['editOwnCom'];

            $complainTblNm = $_SESSION['teacherComplainTbl'];

            $selectComplainDate = "SELECT * FROM $complainTblNm WHERE id = ?";
            $statSelectComplainDate = $conn->prepare($selectComplainDate);
            $statSelectComplainDate->execute([$idOfEdit]);

            $dataOfComplain = $statSelectComplainDate->fetch();
        }
    ?>
    <h3 class="title">Update Here.....</h3>
    <div class="container">
        <p class="heading">Edit your Complain Here...</p>
        <form method="post">
            <input type="date" name="date" class="dateBox" value="<?php echo $dataOfComplain['complain_date']; ?>" required><br><br>
            <textarea name="complain" cols="50" rows="8" placeholder="Edit your complain here....." class="txtare" required><?php echo $dataOfComplain['complain']; ?></textarea><br><br>
            <button type="submit" name="updateComplain" class="btn">Update</button><br><br>
        </form>
    </div>
</body>
</html>
<?php
    if (isset($_POST['updateComplain'])) {
        $complainDate = $_POST['date'];
        $complain = $_POST['complain'];

        $updateComplain = "UPDATE $complainTblNm SET complain_date = ?, complain = ? WHERE id = ?";
        $statUpdateComplain = $conn->prepare($updateComplain);

        if ($statUpdateComplain->execute([$complainDate, $complain, $idOfEdit])) {
        ?>
            <script>
                alert("Update your complain......");
                window.location.replace("http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php");
            </script>
        <?php
        }
    }
?>