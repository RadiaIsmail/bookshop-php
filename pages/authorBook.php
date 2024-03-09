
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    
}
?>
<?php
// Check if the form is submitted
$successMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('../connection/conn.php');

    // Get the form data
    $id = $_POST['id'];
    $book_id = $_POST['Book_ID'];
    $author_id = $_POST['Author_ID'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO book_author (id,book_id, author_id) VALUES (?,?, ?)");
    $stmt->bind_param("iii", $id, $book_id, $author_id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        $successMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Author!</strong> is successfully saved.
        <a href="../bookshopView/bookAutherView.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </a>
      
      </div>';
    } else {
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " .  $stmt->error . "
        <a href='../bookshopView/bookAutherView.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
        </div>";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book-Author Relationship Form</title>
    <!-- Include Bootstrap CSS -->
    <?php include '../allLinks/bostlink.php'; ?>
</head>

<body>
<?php
    
    ?>
    <div class="container mt-5">
        <h2>Book-Author Relationship</h2>
        <?php
        echo $successMessage;
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="id"> ID</label>
                <input type="number" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="Book_ID">Book ID</label>
                <input type="number" class="form-control" id="Book_ID" name="Book_ID" required>
            </div>
            <div class="form-group">
                <label for="Author_ID">Author ID</label>
                <input type="number" class="form-control" id="Author_ID" name="Author_ID" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>

</html>