<?php
require("connection/connectdb.php");


if (isset($_POST['program'])) {
    $program = $_POST['program'];
    $program = stripslashes($program);
    // delete 
    if ($program == "delete_data") {
        $id = $_POST['id'];
        $sql_delete = "DELETE FROM `student` WHERE `student_id` = '$id'";
        $query = $condb->query($sql_delete);
        if ($query) {
            echo "ok";
        } else {
            echo "not ok";
        }
        // insert 
    } else if ($program == "insert_data") {

        $student_name = $_POST['student_name'];
        $student_tel = $_POST['student_tel'];
        $student_email = $_POST['student_email'];

        $sql_insert = "INSERT INTO `student`(
            `student_name`,
            `student_tel`,
            `student_email`
        )
        VALUES('$student_name','$student_tel','$student_email')";

        $query = $condb->query($sql_insert);
        if ($query) {
            echo "ok";
        } else {
            echo "not ok";
        }
        // edit data 
    } else if ($program == "edit_data") {

        $student_id = $_POST['student_id'];
        $sql_edit = "SELECT
            `student_name`,
            `student_tel`,
            `student_email`
        FROM
            `student`
        WHERE
            `student_id` = '$student_id '";

        $query = $condb->query($sql_edit);
        $row = mysqli_fetch_assoc($query);
        if ($query) {
            $return_arr[] = array(
                "student_name" => $row['student_name'],
                "student_tel" => $row['student_tel'],
                "student_email" => $row['student_email']
                // "student_id" => $row['student_id']
            );
            echo json_encode($return_arr);
        } else {
            echo "not ok";
        }
    }
    // Update 
    else if ($program == "save_edit_data") {

        $id_data = $_POST['id_data'];
        $student_name = $_POST['student_name'];
        $student_tel = $_POST['student_tel'];
        $student_email = $_POST['student_email'];

        $sql_update = "UPDATE `student`
            SET
            
                `student_name` = '$student_name',
                `student_tel` = '$student_tel',
                `student_email` = '$student_email'
            WHERE
                `student_id` = '$id_data'";

        $query = $condb->query($sql_update);
        if ($query) {
            echo "ok";
        } else {
            echo "not ok";
        }
    } else {
    }
}
