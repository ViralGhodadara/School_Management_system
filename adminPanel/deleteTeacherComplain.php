<?php
    $conn = new PDO('mysql:host=localhost; dbname=school_management_system;', 'root', '');

    $id = $_GET['idDeleteComplain'];
    $tableName = $_GET['tableName'];
    
    $deleteComplain = "DELETE FROM $tableName WHERE id = ?";
    $statDeleteComplain = $conn->prepare($deleteComplain);

    if ($statDeleteComplain->execute([$id])) {
    ?>
        <script>
            alert("Complain Resolved successfully");
            window.location.replace("http://localhost/viral/school-system/adminPanel/admin.php");
        </script>
    <?php
    }
?>