<?php
// Include database connection
include('../connection/conn.php');

// Initialize the variable
$author = null;
$successMessage = '';
// Check for the 'id' GET parameter
if (isset($_GET['id'])) {
    $author_id = $_GET['id'];

    // Fetch the author's data
    $sql = "SELECT * FROM author WHERE Author_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $author_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $author = $result->fetch_assoc();
    }
    $stmt->close();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $author_id = $_POST['Author_ID'];
    $full_name = $_POST['FullName'];
    $birthdate = $_POST['Birthdate'];
    $nationality = $_POST['Nationality'];
    $bibliography = $_POST['Bibliography'];

    // Update data in the database
    $sql = "UPDATE author SET FullName=?, Birthdate=?, Nationality=?, Bibliography=? WHERE Author_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $full_name, $birthdate, $nationality, $bibliography, $author_id);

    if ($stmt->execute()) {
        $successMessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Author!</strong> is successfully saved.
        <a href="../bookshopView/autherViw.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </a>
      
      </div>';
    } else {
        //  echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        $successMessage = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . $stmt->error . "
            <a href='../bookshopView/autherViw.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
            </div>";
    }
    $stmt->close();
}

// Before using $author, check if it's an array and the offset exists
if (is_array($author) && isset($author['FullName'])) {
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
            <input type="hidden" name="Author_ID" value="<?php echo isset($author['Author_ID']) ? $author['Author_ID'] : ''; ?>">
            <div class="form-group">
                <label for="FullName">Full Name</label>
                <input type="text" class="form-control" id="FullName" name="FullName" value="<?php echo isset($author['FullName']) ? $author['FullName'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Birthdate">Birthdate</label>
                <input type="date" class="form-control" id="Birthdate" name="Birthdate" value="<?php echo isset($author['Birthdate']) ? $author['Birthdate'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Nationality">Nationality</label>
                <input type="text" class="form-control" id="Nationality" name="Nationality" value="<?php echo isset($author['Nationality']) ? $author['Nationality'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Bibliography">Bibliography</label>
                <textarea class="form-control" id="Bibliography" name="Bibliography" rows="4"><?php echo isset($author['Bibliography']) ? $author['Bibliography'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>


</html>