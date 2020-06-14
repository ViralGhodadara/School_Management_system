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
        .back{
            margin-left: 65px;
            font-family: verdana;
            padding-bottom: 20px;
        }
        .back a{
            text-decoration: none;
            color: black;
        }
        .back a:hover{
            color: blue;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET['idEditStuCom'])) {
            $id = $_GET['idEditStuCom'];
            $TblNm = $_SESSION['studentComplainTblName'];

            $myComplain = "SELECT complain_date, complain FROM $TblNm WHERE id = ?";
            $statMyComplain = $conn->prepare($myComplain);
            $statMyComplain->execute([$id]);

            $complainDate = $statMyComplain->fetch();
        }
    ?>
    <h3 class="title">Update Here.....</h3>
    <div class="container">
        <p class="heading">Edit your Complain Here...</p>
        <form method="post">
            <input type="date" name="date" class="dateBox" value="<?php echo $complainDate['complain_date']; ?>" required><br><br>
            <textarea name="complain" cols="50" rows="8" placeholder="Edit your complain here....." class="txtare" required><?php echo $complainDate['complain']; ?></textarea><br><br>
            <button type="submit" name="updateComplain" class="btn">Update</button><br><br>
        </form>
        <p class="back">Back To <a href="http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php">Home ?</a></p>
    </div>
</body>
</html>
<?php
    if (isset($_POST['updateComplain'])) {
        $complainDate = $_POST['date'];
        $complain = $_POST['complain'];

        $updateMyComplain = "UPDATE $TblNm SET complain_date = ?, complain = ? WHERE id = ?";
        $statUpdateMyComplain = $conn->prepare($updateMyComplain);

        if ($statUpdateMyComplain->execute([$complainDate, $complain, $id])) {
        ?>
            <script>
                alert("Your complain can update successfully..........");
                window.location.replace("http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php");
            </script>
        <?php
        }
    }
?>