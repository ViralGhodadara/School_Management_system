<?php
    $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

    $id = $_GET['idDelete'];

    $selectData = "SELECT * FROM division WHERE id = ?";
    $statSelectData = $conn->prepare($selectData);
    $statSelectData->execute([$id]);

    $data = $statSelectData->fetch();
    $division = $data['division_name'];
    $standard = "Standard".$data['standard'].$division;
    $tblName = $standard; //This is a standard table name
    $tblNameStudentResult = "result".$standard; //This is a result table name
    $tblNameComplain = "complain".$standard;
    $tblNameAtt = "attendancebook".$tblName; //This is a attendancebook table name

    // Delete students table data

    $delStudents = "DELETE FROM students WHERE student_standard = ? AND student_division = ?";
    $statdelStudents = $conn->prepare($delStudents);
    $statdelStudents->execute([$data['standard'], $division]);

    $deleteClassTbl = "drop table $tblName";
    $statDeleteClassTbl = $conn->prepare($deleteClassTbl);
    $statDeleteClassTbl->execute();

    // Delete table student complain

    $delStuComplain = "DROP TABLE $tblNameComplain";
    $statDelStuComplain = $conn->prepare($delStuComplain);
    $statDelStuComplain->execute();

    $deleteAtt = "drop table $tblNameAtt";
    $statDeleteAttt = $conn->prepare($deleteAtt);
    $statDeleteAttt->execute();

    $deleteResultTbl = "drop table $tblNameStudentResult";
    $statDeleteResultTbl = $conn->prepare($deleteResultTbl);
    $statDeleteResultTbl->execute();

    $delete = 'DELETE FROM division WHERE id = ?';
    $statDelete = $conn->prepare($delete);
    
    if ($statDelete->execute([$id])) {
    ?>
        <script>
            alert('Record deleted successfully');
            window.location.replace("http://localhost/viral/school-system/adminPanel/admin.php");
        </script>
    <?php
    }
?>