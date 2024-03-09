<?php
// Include database connection
include('../connection/conn.php');
$Book_ID = $_GET['id'];
$sql = "DELETE FROM book WHERE Book_ID=$Book_ID";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['message'] = 'Record Deleted';
    echo '<script type="text/javascript">';
    echo 'alert("Record Deleted");';
    echo 'window.location="../bookshopView/bookView.php?msg=Record Deleted";';
    echo '</script>';
    exit;
} else {
    $message = "Error: " . mysqli_error($conn);
    // Handle error appropriately
}
