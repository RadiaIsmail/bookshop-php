<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
  
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include('./allLinks/bostlink.php');
?>

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
                    <a href="bookshopView\bookView.php" class="nav-link px-2 link-dark">Book_Registration
                    </a>
                </li>
                <li>
                    <a href="bookshopView\autherViw.php" class="nav-link px-2 link-dark">
                        Auther
                    </a>
                </li>
                <li>
                    <a href="bookshopView\bookAutherView.php"
                        class="nav-link px-2 link-dark">AuthorBook_Registration</a>
                </li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Login</button>
                
            </div>
        </header>
    </div>
    <div>
        <div class="bg-light p-5 rounded">
            <div class="col-sm-8 mx-auto">
                <h1>Bookshop</h1>
                <p>
                    Book shops, also known as bookstores, serve multiple purposes. They are retail outlets where various
                    types of books are sold, ranging from novels, memoirs, and cookbooks to textbooks and more1. Here
                    are some common uses for book shops:
                </p>
                <p>
                <p>
                <ul>
                    <li>.Purchasing Books: Customers can buy new, used, or rare books on a wide array of subjects.
                        Sustainability: Buying used books from book shops is a form of recycling, giving books a new
                        life
                        with different owners1.</li>
                    <li>
                        Supporting Authors and Publishers: Book shops help authors and publishers by providing a
                        platform
                        t
                        o
                    </li>
                    <li>
                        Community Hub: Many book shops host events like book signings, readings, and discussions, acting
                        as
                    </li>
                    <li>
                        Educational Resource: They provide access to educational materials, including textbooks and
                        reference books.
                    </li>
                    <li>
                        .Entertainment: Book shops offer a variety of fiction and non-fiction for entertainment and
                        leisure
                        reading.

                    </li>
                    <li>.Collectibles: Some people visit book shops to find collectible or out-of-print books that are
                        no
                        longer in circulation1.</li>
                </ul>
                cultural centers in their communities.

                </p>
                <a class="btn btn-primary" href="./bookshopView/bookView.php" role="button">Register book »</a>
                </p>
            </div>
        </div>
    </div>
    <?php
    include('../allLinks/jslink.php');
    ?>
</body>

</html>