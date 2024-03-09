
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    
}
?>
<?php
$successMessage = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include('../connection/conn.php');

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

    // Insert data into the database
    $sql = "INSERT INTO book(Book_ID, Title, Genre, Language, ISBN, PublicationDate, Price, AvailabilityStatus, Author_ID)VALUES (?,?,?,?,?,?,?,?,?)";
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
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . $conn->error . "
            <a href='../bookshopView/bookView.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>";
    }
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
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
<?php
   
    ?>
    <div class="container mt-5">
        <h2>Book Information</h2>
        <?php
        echo $successMessage;
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="Book_ID">Book ID</label>
                <input type="number" class="form-control" id="Book_ID" name="Book_ID" required>
            </div>
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="Title" name="Title" required>
            </div>
            <div class="form-group">
                <label for="Genre">Genre</label>
                <input type="text" class="form-control" id="Genre" name="Genre">
            </div>
            <div class="form-group">
                <label for="Language">Language</label>
                <input type="text" class="form-control" id="Language" name="Language">
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN">
            </div>
            <div class="form-group">
                <label for="PublicationDate">Publication Date</label>
                <input type="date" class="form-control" id="PublicationDate" name="PublicationDate">
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" step="0.01" class="form-control" id="Price" name="Price">
            </div>
            <div class="form-group">
                <label for="AvailabilityStatus">Availability Status</label>
                <select class="form-control" id="AvailabilityStatus" name="AvailabilityStatus">
                    <option value="Available">Available</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Author_ID">Author ID</label>
                <input type="number" class="form-control" id="Author_ID" name="Author_ID">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>

</html>