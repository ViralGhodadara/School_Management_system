<?php
    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: beige;
        }
        .container{
            height: 260px;
            width: 400px;
            background-color: white;
            margin-top: 50px;
        }
        .heading-title{
            font-family: verdana;
            margin-top: -0.09px;
            text-align: center;
            background-color: brown;
            color: white;
            font-style: italic;
            padding: 10px;
        }
        .box{
            height: 32px;
            margin-top: 20px;
            width: 230px;
            font-family: verdana;
            margin-left: 32px;
        }
        .btn{
            background-color: rgb(70, 125, 236);
            color: white;
            font-family: verdana;
            margin-left: 32px;
        }
        .back-home-link{
            color: black;
            text-decoration: none;
        }
        .lastLine{
            font-family: verdana;
            margin-left: 32px;
        }
        #error{
            font-size: 15px;
            margin-left: 33px;
            margin-bottom: -26px;
            margin-top: 20px;
            color: brown;
            font-family: verdana;
        }
    </style>
</head>
<body>
<h3 class="heading-title">Admin Login Here.......</h3>
    <div class="container">
        <form method="post">
            <table>
                <tr>
                    <p id="error"></p>
                </tr>
                <tr>
                    <br>
                    <input type="text" placeholder="Username" class="box" required name="username">
                </tr>
                <tr>
                    <br>
                    <input type="password" placeholder="Password" class="box" required name="password">
                </tr>
                <tr>
                    <br><br>
                    <button type="submit" class="btn" required name="submit">Login</button>
                </tr>
                    <br><br>
                    <p class="lastLine">Please Back to <a href="http://localhost/viral/school-system/" class="back-home-link">Home ?</a></p>
                <tr>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $checkUsername = "SELECT * FROM admin WHERE username LIKE ?";
        $statCheckUsername = $conn->prepare($checkUsername);
        $statCheckUsername->execute([$username]);

        if ($statCheckUsername->rowCount() > 0) {
            $data = $statCheckUsername->fetch();

            $passwordDataBase = $data['password'];

            if (password_verify($password, $passwordDataBase) == true) {
                header('location: http://localhost/viral/school-system/adminPanel/admin.php');
            } else {
            ?>
                <script>
                    document.getElementById('error').innerHTML = "***Please enter the valid username or password";
                </script>
            <?php
            }
        } else {
        ?>
            <script>
                document.getElementById('error').innerHTML = "***Please enter the valid username or password";
            </script>
        <?php
        }
    }
?>