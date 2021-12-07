<?php
include('../includes/login_check.php');
include('../includes/functions.php');
$conn = db_connect();

function delete_following($following_id) {
  $pstmt = $conn->prepare("DELETE FROM followers WHERE user_id = :current_user_id AND follower_id = :follower_id");
  $pstmt->execute([':current_user_id' => $current_user_id, ':follower_id' => $following_id]);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- getting fonts and fontawesome icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4bfa365d66.js" crossorigin="anonymous" defer></script>

    <!-- jQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>

    <!-- Bootstrap 5 stylesheet and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>

    <!--custom CSS and JS-->
    <link rel="stylesheet" href="/assets/style.css">
    <script src="/assets/script.js" async></script>

    <title>Soup Kitchen</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../images/soup_icon.svg" alt="soup.kitchen logo" width="75" height="75" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav link-dark">
            <a class="nav-link" aria-current="page" href="foryou.php">soup.kitchen</a>
            <a class="nav-link" href="saved.php">Saved</a>
            <a class="nav-link" href="follow.php">Follows</a>
            <a class="nav-link" href="notif.html">Notifications</a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo get_username($_SESSION['user_id']); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="../user/profile.html">Profile</a></li>
            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
            <li><a class="dropdown-item" href="../auth/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Following List-->
    <h1 class="display-3 text-center mb-4">Following</h1>
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="row justify-content-md-center">
              <?php
              $current_user_id = $_SESSION['user_id'];
              $pstmt = $conn->prepare("SELECT accounts.user_id, accounts.display_name FROM accounts INNER JOIN followers ON followers.user_id = accounts.user_id WHERE followers.follower_id = :current_user_id");
              $pstmt->execute(array(':current_user_id' => $current_user_id));

              $rows = $pstmt->fetchAll();
              $num_rows = count($rows);
              if ($num_rows > 0) {
                foreach($rows as $row){
                  echo "<div class='col-10'>";
                  echo "<a href='../user/profile.html?user=";
                  echo $row['user_id'];
                  echo "' class='list-group-item list-group-item-action' aria-current='true'>";
                  echo $row['display_name'];
                  echo "</a>";
              ?>
            </div>
            <div class="col-2">
              <button type='button' onclick="" class='btn btn-danger'>Remove</button>
            </div>
            <?php
              }
            }
            else {
              echo "<div>You aren't following anyone :(</div>";
            }
            ?>
          </div>
        </div>
      </div>
    <!-- Followers List-->
      <div class="row">
        <div class="col">
          <h1 class="display-3 text-center mb-4">Followers</h1>
        </div>   
      </div>
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="row justify-content-md-center">
              <?php
              $current_user_id = $_SESSION['user_id'];
              $pstmt = $conn->prepare("SELECT accounts.user_id, accounts.display_name FROM accounts INNER JOIN followers ON followers.user_id = accounts.user_id WHERE followers.user_id = :current_user_id");
              $pstmt->execute(array(':current_user_id' => $current_user_id));

              $rows = $pstmt->fetchAll();
              $num_rows = count($rows);
              if ($num_rows > 0) {
                foreach($rows as $row){
                  echo "<div class='col-10'>";
                  echo "<a href='../user/profile.html?user=";
                  echo $row['user_id'];
                  echo "' class='list-group-item list-group-item-action' aria-current='true'>";
                  echo $row['display_name'];
                  echo "</a>";
              ?>
            </div>
            <div class="col-2">
              <button type='button' onclick="" class='btn btn-danger'>Remove</button>
            </div>
            <?php
              }
            }
            else {
              echo "<div>You aren't following anyone :(</div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <br>
  </body>
</html>

