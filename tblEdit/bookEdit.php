<?php
// Include database connection
include('../connection/conn.php');

// Initialize the variable
$Book = null;
$successMessage = '';
// Check for the 'id' GET parameter
if (isset($_GET['id'])) {
    $Book_ID = $_GET['id'];

    // Fetch the author's data
    $sql = "SELECT * FROM book WHERE Book_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Book_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $Book = $result->fetch_assoc();
    }
    $stmt->close();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $Book_ID = $_POST['Book_ID'];
    $Title = $_POST['Title'];
    $Genre = $_POST['Genre'];
    $Language = $_POST['Language'];
    $ISBN = $_POST['ISBN'];
    $PublicationDate = $_POST['PublicationDate'];
    $Price = $_POST['Price'];
    $AvailabilityStatus = $_POST['AvailabilityStatus'];
    $Author_ID = $_POST['Author_ID'];

    // Update data in the database
    $sql = "UPDATE book SET Title=?, Genre=?, Language=?,ISBN=?, PublicationDate=?,Price=?,AvailabilityStatus=?,Author_ID=? WHERE Book_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssdsi", $Book_ID, $Title, $Genre, $Language, $ISBN, $PublicationDate, $Price, $AvailabilityStatus, $Author_ID);

    if ($stmt->execute()) {
        $successMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Author!</strong> is successfully saved.
        <a href="../bookshopView/bookView.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </a>
      
      </div>';
    } else {
        //  echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . $stmt->error . "
            <a href='../bookshopView/bookView.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>";
    }
    $stmt->close();
}

// Before using $author, check if it's an array and the offset exists
if (is_array($Book) && isset($Book['Title'])) {
    // Now you can safely use $author['FullName']
    // For example:
    // echo "Book's full Title: " . $Book[' Title'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information</title>
    <!-- Include Bootstrap CSS -->
    <?php include '../allLinks/bostlink.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <h2>Book Information</h2>
        <?php
        echo $successMessage;
        ?>
        <form method="post" action="./bookEdit.php">
            <div class="form-group">
                <label for="Book_ID">Book ID</label>
                <input type="number" class="form-control" id="Book_ID" name="Book_ID"
                    value="<?php echo isset($Book['Book_ID']) ? $Book['Book_ID'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="Title" name="Title"
                    value="<?php echo isset($Book['Title']) ? $Book['Title'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Genre">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre"
                    value="<?php echo isset($Book['Genre']) ? $Book['Genre'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Language">Language</label>
                <input type="text" class="form-control" id="Language" name="Language"
                    value="<?php echo isset($Book['Language']) ? $Book['Language'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN"
                    value="<?php echo isset($Book['Genre']) ? $Book['Genre'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="PublicationDate">Publication Date</label>
                <input type="date" class="form-control" id="PublicationDate" name="PublicationDate"
                    value="<?php echo isset($Book['PublicationDate']) ? $Book['PublicationDate'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" step="0.01" class="form-control" id="Price" name="Price"
                    value="<?php echo isset($Book['Price']) ? $Book['Price'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="AvailabilityStatus">Availability Status</label>
                <select class="form-control" id="AvailabilityStatus" name="AvailabilityStatus">
                    <option value="Available"
                        <?php echo (isset($Book['AvailabilityStatus']) && $Book['AvailabilityStatus'] == 'Available') ? 'selected' : ''; ?>>
                        Available</option>
                    <option value="Out of Stock"
                        <?php echo (isset($Book['AvailabilityStatus']) && $Book['AvailabilityStatus'] == 'Out of Stock') ? 'selected' : ''; ?>>
                        Out of Stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Author_ID">Author ID</label>
                <input type="number" class="form-control" id="Author_ID" name="Author_ID"
                    value="<?php echo isset($Book['Author_ID']) ? $Book['Author_ID'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>

</html>