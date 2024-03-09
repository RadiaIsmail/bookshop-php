<?php
// Include database connection
include('../connection/conn.php');
$author_id = $_GET['id'];
$sql = "DELETE FROM author WHERE Author_ID=$author_id";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['message'] = 'Record Deleted';
    echo '<script type="text/javascript">';
    echo 'alert("Record Deleted");';
    echo 'window.location="../bookshopView/bookAutherView.php?msg=Record Deleted";';
    echo '</script>';
    exit;
} else {
    $message = "Error: " . mysqli_error($conn);
    // Handle error appropriately
}
