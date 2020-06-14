<?php

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');
    
    session_start();

    if (isset($_POST['teacherLoginSubmit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $_SESSION['username'] = $username;

        $select_username_password = "SELECT username, password FROM staff WHERE username like ?";
        $stat_select_username_password = $conn->prepare($select_username_password);
        $stat_select_username_password->execute([$username]);

        $data = $stat_select_username_password->fetch();

        if ($stat_select_username_password->rowCount() == 1) {
            if (password_verify($password, $data['password']) == true) {
                header('location: http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php');
            } else {
                $_SESSION['error-username-techer'] = "***Please enter valid username or password";
                header('location: http://localhost/viral/school-system/');
            }
        } else {
            $_SESSION['error-username-techer'] = "***Please enter valid username or password";
            header('location: http://localhost/viral/school-system/');
        }
    }
?>