<?php
 include("../includes/functions.php");
 include("../includes/login_check.php");

 $conn = db_connect();

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
    <script src="https://code.jquery.com/jquery-1.12.4.js" ></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

    <!-- Bootstrap 5 stylesheet and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>

    <!--custom CSS and JS-->
    <link type="text/css" rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js" async></script>

    <title>Upload</title>
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
            <a class="nav-link" aria-current="page" href="../homepage/foryou.php">soup.kitchen</a>
            <a class="nav-link" href="../homepage/saved.html">Saved</a>
            <a class="nav-link" href="../homepage/follow.html">Follows</a>
            <a class="nav-link" href="../homepage/notif.html">Notifications</a>
          </div>
        </div>
        <div class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <?php echo $username ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="../profile/profile.html">Profile</a>
            <a class="dropdown-item" href="../homepage/settings.html">Settings</a>
            <a class="dropdown-item" href="../index.html">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    
    <div id="uploadBody">
      <div class="row">
        <div class="col"></div>
        <div id="formBody" class="col">
          <h2>Upload Your Post!</h2>
          <form>
            <div class="form-group">
              <label for="postName">Name of Post:</label>
              <input id="postName" class="form-control" type="text" placeholder="Post Name" name="title" id="title" value="" />
            </div>
            <div class="form-group">
              <label for="uploadTags">Tags:</label>
              <input id="uploadTags" class="form-control" type="text" placeholder="Insert tags (separate by commas)" name="tags" id="name" value="" />
            </div>
            <div class="form-group">
              <label for="uploadTags">Upload Image:</label><br>
              <input id="insertImg" type="file" name="Image"/>
            </div>
            </br>
            <input class="btn tagBtn" type="submit" name="Post!" value="Post!"/>
          </form>
        </div>
        <div class="col"></div>
      </div>
      
      
    </div>
  </body>
</html> 