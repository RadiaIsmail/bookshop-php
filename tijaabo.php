<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table View</title>
    <!-- Include Bootstrap CSS -->
    <?php include './allLinks/bostlink.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <h2>Book Table View</h2>
        <div class="d-flex justify-content-between mb-3">
            <!-- Button on the left -->
            <div>
                <a href="../pages/book.php" class="btn btn-primary">Add New</a>
            </div>
            <!-- Search input on the right -->
            <div class="lg-4">
                <input type="text" class="form-control" id="Search" name="Search" placeholder="Search" style="width: 100%;">
            </div>
        </div>
        <table class="table table-bordered  styled-table">
            <thead class="table-dark">
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>ISBN</th>
                    <th>Publication Date</th>
                    <th>Price</th>
                    <th>Availability Status</th>
                    <th>Author ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop to fetch and display book records -->
                <?php
                //  database connection code
                include('./connection/conn.php');
                // include('../tblEdit/bookEdit.php');
                // Fetch book records
                $sql = "SELECT * FROM book";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Book_ID"] . "</td>";
                        echo "<td>" . $row["Title"] . "</td>";
                        echo "<td>" . $row["Genre"] . "</td>";
                        echo "<td>" . $row["Language"] . "</td>";
                        echo "<td>" . $row["ISBN"] . "</td>";
                        echo "<td>" . $row["PublicationDate"] . "</td>";
                        echo "<td>" . $row["Price"] . "</td>";
                        echo "<td>" . $row["AvailabilityStatus"] . "</td>";
                        echo "<td>" . $row["Author_ID"] . "</td>";
                        echo "
                        <td>
                            <a 
                                href='../tblEdit/bookEdit.php?id=" . $row["Book_ID"] . "'      class='btn btn-primary '>
                                Edit <i class=' fas fa-pencil-alt '></i>
                            </a> 
                            | 
                            <a 
                                href='../tblEdit/book_delete.php?id=" . $row["Book_ID"] . "' 
                                class='btn btn-danger '>
                                Delete <i class=' fas fa-trash '></i>
                            </a>
                        </td>
                        ";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
                <!-- End of PHP loop -->
            </tbody>
        </table>

        <h2>Book Information</h2>
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
                $successMessage = "Book information added successfully.";
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="Book_ID">Book ID:</label>
                <input type="text" class="form-control" id="Book_ID" name="Book_ID" required>
            </div>
            <div class="form-group">
                <label for="Title">Title:</label>
                <input type="text" class="form-control" id="Title" name="Title" required>
            </div>
            <div class="form-group">
                <label for="Genre">Genre:</label>
                <input type="text" class="form-control" id="Genre" name="Genre" required>
            </div>
            <div class="form-group">
                <label for="Language">Language:</label>
                <input type="text" class="form-control" id="Language" name="Language" required>
            </div>
            <div class="form-group">
                <label for="ISBN">ISBN:</label>
                <input type="text" class="form-control" id="ISBN" name="ISBN" required>
            </div>
            <div class="form-group">
                <label for="PublicationDate">Publication Date:</label>
                <input type="date" class="form-control" id="PublicationDate" name="PublicationDate" required>
            </div>
            <div class="form-group">
                <label for="Price">Price:</label>
                <input type="number" class="form-control" id="Price" name="Price" required>
            </div>
            <div class="form-group">
                <label for="AvailabilityStatus">Availability Status:</label>
                <input type="text" class="form-control" id="AvailabilityStatus" name="AvailabilityStatus" required>
            </div>
            <div class="form-group">
                <label for="Author_ID">Author ID:</label>
                <input type="text" class="form-control" id="Author_ID" name="Author_ID" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success mt-3'>" . $successMessage . "</div>";
        }

        if (!empty($errorMessage)) {
            echo "<div class='alert alert-danger mt-3'>" . $errorMessage . "</div>";
        }
        ?>
    </div>
    <!-- Include Bootstrap JS -->
    <?php include '/allLinks/bootstrapjs.php'; ?>
</body>

</html>