<title>Student Login</title>
<?php

    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    if (isset($_POST['submitStudentUandP'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $_SESSION['studentUsername'] = $username;

        $checkUsernmOrPass = "SELECT * FROM students WHERE username LIKE ?";
        $statCheckUsernmOrPass = $conn->prepare($checkUsernmOrPass);
        $statCheckUsernmOrPass->execute([$username]);

        $dataOfStu = $statCheckUsernmOrPass->fetch();

        if ($statCheckUsernmOrPass->rowCount() == 1) {

            if (password_verify($password, $dataOfStu['student_password'])) {
                $_SESSION['studentUsername'] = $username;
                header('location: http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php');
            } else {
                $_SESSION['studentLoginErr'] = "***Please enter the valid username or password";
                header('location: http://localhost/viral/school-system/');
            }

        } else {
            $_SESSION['studentLoginErr'] = "***Please enter the valid username or password";
            header('location: http://localhost/viral/school-system/');
        }
    }

?>