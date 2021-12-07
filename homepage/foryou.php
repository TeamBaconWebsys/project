<?php
include('../includes/login_check.php');
include('../includes/functions.php');
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

    <!-- Bootstrap 5 stylesheet and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>

    <!--custom CSS and JS-->
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="/assets/script.js" async></script>

    <title>Soup Kitchen</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html"><img src="/images/soup_icon.svg" alt="soup.kitchen logo" width="75" height="75" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav link-dark">
            <a class="nav-link" aria-current="page" href="foryou.html">soup.kitchen</a>
            <a class="nav-link" href="saved.html">Saved</a>
            <a class="nav-link" href="follow.html">Follows</a>
            <a class="nav-link" href="notif.html">Notifications</a>
          </div>
        </div>
        <div class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            username
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="my-4 mb-lg-2">
          <h2>For You</h2>
        </div>

        <?php
        $conn = db_connect();

        // Get posts from every user your account follows
        $pstmt = $conn->prepare("SELECT `post_id`, `title`, `image`, `image_type` FROM posts INNER JOIN followers ON followers.user_id = posts.user_id WHERE followers.follower_id = :current_user_id");
        $pstmt->execute(array(':current_user_id' => $_SESSION['user_id']));

        $rows = $pstmt->fetchAll();
        $num_rows = count($rows);

        if ($num_rows > 0) {
          echo "<div class='row'>";
          for ($i = 0; $i < $num_rows; $i++) {
            $post = $rows[$i];
            $post_id = htmlspecialchars($post['post_id']);
            $title = $post['title'];
            $image = $post['image'];
            $img_type = $post['image_type'];

            echo "<div class='col-3 thumbnail'>";
            echo "<a href='./recipe.php?post=$post_id'>";

            echo "<div class='card'>";
            echo "<div class='image'>";
            echo "<img src='data:$img_type;base64,".base64_encode($image)."' class='img-fluid' alt='$title'>";

            echo "<i class='far fa-star fa-lg'></i>";
            echo "</div>";
            echo "<h5 class='card-title'>$title</h5>";
            echo "</div>";

            echo "</a></div>\n";

            if ($i % 3 == 2) {
              echo "</div><div class='row'>\n";
            }
          }
          echo "</div>";
        }
        else {
          echo "<div> No posts to load :(</div>";
        }
        ?>
      </div>
    </div>

  </body>

</html>