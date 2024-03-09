
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
    $author_id = $_POST['Author_ID'];
    $full_name = $_POST['FullName'];
    $birthdate = $_POST['Birthdate'];
    $nationality = $_POST['Nationality'];
    $bibliography = $_POST['Bibliography'];

    // Insert data into the database
    $sql = "INSERT INTO author (Author_ID, FullName, Birthdate, Nationality, Bibliography) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $author_id, $full_name, $birthdate, $nationality, $bibliography);

    if ($stmt->execute()) {
        $successMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Author!</strong> is successfully saved.
        <a href="../bookshopView/autherViw.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </a>
      
      </div>';
    } else {
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . $conn->error . "
            <a href='../bookshopView/autherViw.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
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
    <title>Author Form</title>
    <!-- Include Bootstrap CSS -->
    <?php include '../allLinks/bostlink.php'; ?>
</head>

<body>
<?php
    
    ?>
    <div class="container mt-5">
        <?php
        echo $successMessage;
        ?>
        <h2>Author Information</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="Author_ID">Author ID</label>
                <input type="number" class="form-control" id="Author_ID" name="Author_ID" required>
            </div>
            <div class="form-group">
                <label for="FullName">Full Name</label>
                <input type="text" class="form-control" id="FullName" name="FullName" required>
            </div>
            <div class="form-group">
                <label for="Birthdate">Birthdate</label>
                <input type="date" class="form-control" id="Birthdate" name="Birthdate">
            </div>
            <div class="form-group">
                <label for="Nationality">Nationality</label>
                <input type="text" class="form-control" id="Nationality" name="Nationality">
            </div>
            <div class="form-group">
                <label for="Bibliography">Bibliography</label>
                <textarea class="form-control" id="Bibliography" name="Bibliography" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>

</html>