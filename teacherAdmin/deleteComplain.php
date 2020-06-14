<?php

    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    if (isset($_GET['idOfDeleteComplain'])) {
        $id = $_GET['idOfDeleteComplain'];
        $tblNm = $_SESSION['studentComplain'];

        $deleteComplain = "DELETE FROM $tblNm WHERE id = ?";
        $statDeleteComplain = $conn->prepare($deleteComplain);

        if ($statDeleteComplain->execute([$id])) {
        ?>
            <script>
                alert("Complain can resolved successfully............");
                window.location.replace("http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php");
            </script>
        <?php
        }
    }

    if (isset($_GET['deleteOwnCom'])) {
        $delId = $_GET['deleteOwnCom'];

        $deleteRecord = $_SESSION['teacherComplainTbl'];

        $deleteOwnComplain = "DELETE FROM $deleteRecord WHERE id = ?";
        $statDeleteOwnComplain = $conn->prepare($deleteOwnComplain);

        if ($statDeleteOwnComplain->execute([$delId])) {
        ?>
            <script>
                alert("Complain can delete successfully............");
                window.location.replace("http://localhost/viral/school-system/teacherAdmin/teacherAdmin.php");
            </script>
        <?php
        }

    }
?>