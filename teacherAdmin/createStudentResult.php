<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    session_start();
    if (isset($_POST['submit-stdDiv'])) {
        $std = $_SESSION['standardStuRe'];
        $username = $_POST['usernameAdvRe'];
        $tblName = $_SESSION['classNameForStudentData'];

        echo $std."<br><br>";
        echo $username."<br><br>";
        echo $tblName;
    }
?>
</body>
</html>