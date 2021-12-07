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
    <?php
        include('../inlcudes/functions.inc.php');
        session_start();
        $conn = db_connect();
    ?>
    <nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.html"><img src="/images/soup_icon.svg" alt="soup.kitchen logo" width="75" height="75" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav link-dark">
            <a class="nav-link" aria-current="page" href="/homepage/foryou.html">soup.kitchen</a>
            <a class="nav-link" href="/homepage/saved.html">Saved</a>
            <a class="nav-link" href="/homepage/following.html">Following</a>
            <a class="nav-link" href="/homepage/followers.html">Followers</a>
            <a class="nav-link" href="/homepage/notif.html">Notifications</a>
          </div>
        </div>
        <div class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            username
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile/profile.html">Profile</a>
            <a class="dropdown-item" href="homepage/settings.html">Settings</a>
            <a class="dropdown-item" href="index.html">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Following List-->
    <h1 class="display-3 text-center">Following</h1>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="row justify-content-md-center">
            <div class="col">
              <?php 
                $stmt = $conn->query("SELECT DISTINCT accounts.user_id, accounts.username, accounts.display_name FROM accounts WHERE accounts.user_id == follows.user_id");
                while($row = $stmt->fetch()){
                    echo "<a href=/profile.html?user=";
                    echo $row['user_id'];
                    echo "class='list-group-item list-group-item-action' aria-current='true'>";
                    echo $row['display_name'];
                    echo "</a>";
                }
              ?>
            </div>
            <div class="col col-lg-2">
              <?php 
                $stmt = $conn->query("SELECT DISTINCT accounts.user_id, accounts.username, accounts.display_name FROM accounts WHERE accounts.user_id == follows.user_id");
                $sql = "DELETE FROM follows WHERE follows.user_id = accounts.user_id";
                $delete = $dbh->prepare($sql);
                echo "<button type='button' class='btn btn-danger'>Remove</button>";
                $delete -> excute();
              ?>
            </div>
          </div>
        </div>
      </div>

    <br>
    <!-- Followers List-->
    <h1 class="display-3 text-center">Followers</h1>
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="row justify-content-md-center">
            <div class="col">
                <?php 
                    $stmt = $conn->query("SELECT DISTINCT accounts.user_id, accounts.username, accounts.display_name FROM accounts WHERE accounts.user_id == follows.follower_id");
                    while($row = $stmt->fetch()){
                        echo "<a href=/profile.html?user=";
                        echo $row['user_id'];
                        echo "class='list-group-item list-group-item-action' aria-current='true'>";
                        echo $row['display_name'];
                        echo "</a>";
                    }
                ?>
            </div>
            <div class="col col-lg-2">
                <?php 
                    $stmt = $conn->query("SELECT DISTINCT accounts.user_id, accounts.username, accounts.display_name FROM accounts WHERE accounts.user_id == follows.user_id");
                    $sql = "DELETE FROM follows WHERE follows.user_id = accounts.user_id";
                    $delete = $dbh->prepare($sql);
                    echo "<button type='button' class='btn btn-danger'>Remove</button>";
                    $delete -> excute();
                ?>
            </div>
          </div>
        </div>
    </div>
    <br>
  </body>


</html>