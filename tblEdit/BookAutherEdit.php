<?php
// Include database connection
include('../connection/conn.php');

// Initialize the variable
$book_Author = null;
$successMessage = '';
// Check for the 'id' GET parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the author's data
    $sql = "SELECT Book_ID,Author_ID FROM book_author WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $book_Author = $result->fetch_assoc();
    }
    $stmt->close();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $book_id = $_POST['Book_ID'];
    $author_id = $_POST['Author_ID'];

    // Update data in the database
    $sql = "UPDATE book_author SET author_id = ?,book_id=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $author_id, $book_id);

    if ($stmt->execute()) {
        $successMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Author!</strong> is successfully saved.
        <a href="../bookshopView/bookAutherView.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </a>
      
      </div>';
    } else {
        //  echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . $stmt->error . "
            <a href='../bookshopView/bookAutherView.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>";
    }
    $stmt->close();
}

// Before using $author, check if it's an array and the offset exists
if (is_array($book_Author) && isset($book_Author['FullName'])) {
    // Now you can safely use $author['FullName']
    // For example:
    echo "Author's full name: " . $author['FullName'];
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <!-- Include Bootstrap CSS -->
    <?php include '../allLinks/bostlink.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Author</h2>
        <?php
        echo $successMessage;
        ?>
        <form method="post" action="edit_author.php">
            <input type="hidden" name="id" value="<?php echo isset($book_Author['id']) ? $book_Author['id'] : ''; ?>">
            <div class="form-group">
                <label for="Book_ID">Book_ID</label>
                <input type="number" class="form-control" id="Book_ID" name="Book_ID" value="<?php echo isset($book_Author['Book_ID']) ? $book_Author['Book_ID'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Author_ID">Author_ID</label>
                <input type="number" class="form-control" id="Author_ID" name="Author_ID" value="<?php echo isset($book_Author['Author_ID']) ? $book_Author['Author_ID'] : ''; ?>">
            </div>

            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>


</html>