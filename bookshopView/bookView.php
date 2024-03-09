
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table View</title>
    <!-- Include Bootstrap CSS -->
    <?php include '../allLinks/bostlink.php'; ?>
</head>

<body>
<div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../Index.php" class="nav-link px-2 link-secondary">Home</a></li>
                <li>
                    <a href="../bookshopView/bookView.php" class="nav-link px-2 link-dark">Book_Registration
                    </a>
                </li>
                <li>
                    <a href="../bookshopView/autherView.php" class="nav-link px-2 link-dark">
                        Auther
                    </a>
                </li>
                <li>
                    <a href="../bookshopView/bookAutherView.php"
                        class="nav-link px-2 link-dark">AuthorBook_Registration</a>
                </li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Login</button>
                
            </div>
        </header>
    </div>
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
                include('../connection/conn.php');
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
                                href='../tblEdit/bookEdit.php ?id=" . $row["Book_ID"] . "'      class='btn btn-primary '>
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
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>