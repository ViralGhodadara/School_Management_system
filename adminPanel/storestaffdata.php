<?php
    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    session_start();

    if (isset($_POST['addStaff'])) {
        $name = $_POST['Name'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contact_number'];
        $address = $_POST['address'];
        $qualification = $_POST['qualification'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $gender = $_POST['gender'];
        $std = $_POST['standard'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conform_password = $_POST['conformPassword'];

        $_SESSION['error'] = '';

        // Check username

        $checkUsername = 'SELECT username FROM staff WHERE username = ?';
        $statCheckUsername = $conn->prepare($checkUsername);
        $statCheckUsername->execute([$username]);

        if ($password === $conform_password) {

            $len_pass = strlen($password);
            $len_con_pass = strlen($conform_password);

            if ($len_pass >= 3 && $len_con_pass >= 3 && $len_pass <= 8 && $len_con_pass <= 8) {
                $password_hass = password_hash($password, PASSWORD_BCRYPT);
                $conform_password_hash = password_hash($conform_password, PASSWORD_BCRYPT);

                if ($statCheckUsername->rowCount() == 0) {
                    if (strlen($pincode) == 6) {
                        
                        // This is a create complain table start
                        $tblName = "complain".$username;
                        $createComplain = "CREATE TABLE $tblName (id integer primary key AUTO_INCREMENT, username varchar(50), standard varchar(10), gender varchar(10), contactNumber varchar(15), complain_date date, complain varchar(255))";
                        $statCreateCompain = $conn->prepare($createComplain);
                        $statCreateCompain->execute();
                        // The create complain table end...... 

                        $insert = 'INSERT INTO staff (teacher_name, email, contact_number, address, qualification, city, pincode, gender, standard, username, password, conform_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                        $statInsert = $conn->prepare($insert);
                        $runInsert = $statInsert->execute([$name, $email, $contactNumber, $address, $qualification, $city, $pincode, $gender, $std, $username, $password_hass, $conform_password_hash]);
    
                        if ($runInsert) {
                        ?>
                            <script>
                                alert("Record can insert successfully");
                                window.location.replace("http://localhost/viral/school-system/adminPanel/admin.php");
                            </script>
                        <?php
                        }
    
                    } else {
                        $_SESSION['error'] = 'Please enter the 6 digit pincode';
                        header('location: http://localhost/viral/school-system/adminPanel/admin.php');
                    }
                }else{
                    $_SESSION['error'] = 'Username already exist please try another username';
                    header('location: http://localhost/viral/school-system/adminPanel/admin.php');
                }                              
            } else {
                $_SESSION['error'] = 'Please enter the password is lessthan 8 and greter than 3';
                header('location: http://localhost/viral/school-system/adminPanel/admin.php');
            }
        } else {
            $_SESSION['error'] = "Please enter the same password";
            header('location: http://localhost/viral/school-system/adminPanel/admin.php');
        }
    }
    
?>