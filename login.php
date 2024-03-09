<?php
session_start();
include('./connection/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Login</title>
    <style>
    .container {
      margin-top: 20vh;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      padding: 40px;
      max-width: 400px; /* Adjust the maximum width of the form */
      border: 2px solid #ccc; /* Adjust the border size and color */
    }
  </style>

</head>
<body>
   
    <div class="container">
    
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>Login</h2>
        <form method="POST" action="">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          </div>
          <button type="submit" name="login" class="btn btn-primary">Login</button>
          <?php if (isset($error)) { echo '<p style="color:red;">' . $error . '</p>'; } ?>
        </form>
      </div>
    </div>
  </div>
</body>
</html>