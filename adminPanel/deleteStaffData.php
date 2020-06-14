<?php

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    // if ($conn) {
    //     echo "Connection successfull";
    // } else {
    //     echo "Connection cannot successfull please try again";
    // }

    $id = $_GET['idOfDeleteStadd'];

    $selectStaff = "SELECT * FROM staff WHERE id = ?";
    $statSelectStaff = $conn->prepare($selectStaff);
    $statSelectStaff->execute([$id]);

    if ($dataOfStaff = $statSelectStaff->fetch()) {
        $usernameStaff = $dataOfStaff['username'];

        $tableNameComplain = "complain".$usernameStaff;

        $deleteCompalainTbl = "DROP TABLE $tableNameComplain";
        $statDeleteComplainTbl = $conn->prepare($deleteCompalainTbl);
        $statDeleteComplainTbl->execute();
    }

    $delete = 'DELETE FROM staff WHERE id = ?';
    $statDelete = $conn->prepare($delete);

    if ($statDelete->execute([$id])) {
    ?>
        <script>
            alert("Delete record successfully");
            window.location.replace("http://localhost/viral/school-system/adminPanel/admin.php");
        </script>
    <?php
    }
?>