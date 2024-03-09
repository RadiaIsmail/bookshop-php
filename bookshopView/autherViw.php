
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
    <title>Author Table View</title>
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
        <h2 class="text-center">Author Table View</h2>
        <div class="d-flex justify-content-between mb-3">
            <!-- Button on the left -->
            <div>
                <a href="../pages/author.php" class="btn btn-primary">Add New</a>
            </div>
            <!-- Search input on the right -->
            <div class="lg-4">
                <input type="text" class="form-control" id="Search" name="Search" placeholder="Search"
                    style="width: 100%;">
            </div>
        </div>
        <table class="table table-bordered  styled-table">
            <thead class="table-dark">
                <tr>
                    <th>Author ID</th>
                    <th>Full Name</th>
                    <th>Birthdate</th>
                    <th>Nationality</th>
                    <th>Bibliography</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop to fetch and display author records -->
                <?php
                // Database connection code
                include('../connection/conn.php');

                // Fetch author records
                $sql = "SELECT * FROM author";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Author_ID"] . "</td>";
                        echo "<td>" . $row["FullName"] . "</td>";
                        echo "<td>" . $row["Birthdate"] . "</td>";
                        echo "<td>" . $row["Nationality"] . "</td>";
                        echo "<td>" . $row["Bibliography"] . "</td>";
                        echo "
                        <td>
                            <a 
                                href='../tblEdit/edit_author.php ?id=" . $row["Author_ID"] . "'      class='btn btn-primary '>
                                Edit <i class=' fas fa-pencil-alt ms-2'></i>
                            </a> 
                            | 
                            <a 
                                href='../tblEdit/delete_author.php?id=" . $row["Author_ID"] . "' 
                                class='btn btn-danger '>
                                Delete <i class=' fas fa-trash ms-2'></i>
                            </a>
                        </td>
                        ";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
                <!-- End of PHP loop -->
            </tbody>

        </table>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <?php include '../allLinks/jslink.php'; ?>
</body>

</html>