<?php
include "connection.php";
$login = false;
$showError = false;
if (isset($_POST["submit"])) {
  if (empty($_POST['uname']) || empty($_POST['password'])) {
    $showError = true;
  } else {
    $uname = $_POST["uname"];
    $uPassword = $_POST["password"];
    $userExist = "SELECT * FROM `admins` WHERE `username`='$uname' AND `password`='$uPassword'";
    $exe = mysqli_query($conn, $userExist);
    $num = mysqli_fetch_assoc($exe);
    if ($uname != null && $uPassword != null && $num != null){
      if ($num['username'] === $uname && $num['password'] === $uPassword) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        header("Location: Dashboard.php");
      } else {
        $showError = true;
      }
    } else {
      $showError = true;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/styles.css" />
  <title>Login - ACM Attendance Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>

<body>
  <?php
  if ($login) {
    echo '
    <div class="alert alert-success" role="alert">
      Sucessfully Loged In!
    </div>
    ';
  }
  if ($showError) {
    echo '
    <div class="alert alert-danger" role="alert">
      Invalid credentials!
    </div>
    ';
  }
  ?>
  <div class="container login">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <img width="50%" src="Images/website_logo.webp" />
            <h1>Login</h1>
            <form method="post">
              <div class="mb-3">
                <input type="text" required name="uname" class="form-control" id="InputUname" placeholder="Username" />
              </div>
              <div class="mb-3">
                <input type="password" required name="password" class="form-control" id="InputPassword" placeholder="Password" />
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-white text-center mt-5">
      <div class="col-lg-12">
        <p>© 2023 ACM Amritapuri All Rights Reserved. Made in ❤️ with India.</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>