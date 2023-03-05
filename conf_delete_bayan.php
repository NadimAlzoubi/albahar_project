<?php
error_reporting(0);
    function deleteRow($table, $row_id, $file_name) {
        include('./conn.php');
        $query = "DELETE FROM " . $table . " WHERE ID = " . $row_id;
        if (mysqli_query($connect, $query)) {
            unlink("./declarations/" . $file_name);
            echo '1';
        } else {
            echo '0';
        }
    }

    $dele_btn = $_POST['dele_btn'];
    if(isset($dele_btn)){
        $file_name = $_POST['file_name'];
        $id = $_POST['id'];
        deleteRow("bayan", $id, $file_name);
    }
?>
