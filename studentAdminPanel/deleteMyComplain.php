<?php
    session_start();

    $conn = new PDO('mysql:host=localhost; dbname=school_management_system;', 'root', '');

    if (isset($_GET['idDeleteMyComplain'])) {
        $id = $_GET['idDeleteMyComplain'];

        $tblNm = $_SESSION['studentComplainTblName'];

        $deleteMyCom = "DELETE FROM $tblNm WHERE id = ?";
        $statDeleteMyCom = $conn->prepare($deleteMyCom);

        if ($statDeleteMyCom->execute([$id])) {
        ?>
            <script>
                alert("Complain can delete successfully......");
                window.location.replace("http://localhost/viral/school-system/studentAdminPanel/studentAdmin.php");
            </script>
        <?php
        }

    }
?>