
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
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js" async></script>

    <title><? echo $pageTitle;?></title>
  </head>
  <body>
    <?php
      $conn = mysql_connect('localhost', 'root', 'password123') ;
      mysql_select_db('websys_project');

      $dbOk = false;
      
      if ($conn->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $conn->connect_errno . ' - ' . $conn->connect_error . '</div>';
      } else {
        $dbOk = true; 
      }

      $id=$_GET['id'];
      #not sure where to get the id from? probably from clicking the image --> sends over the id, then the php page will retrieve it
      $sql = "SELECT * FROM posts WHERE id=$id";
      $result = mysql_query($sql);
      mysql_close($conn);
      $row = mysql_fetch_assoc($result);

      $pageTitle = $row['name'];
      $image = $row['img'];
      echo($row['img']);
    ?>

    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" id="navbar">
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
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div id="postBody" class="Container">
      <div id="postContainer" class="card">
        <?echo '<img src="'.$image.'" alt="image" style="width:75%;height:40%">';?>
        <div id="postTitle" class="card-body">
          <h3 class="card-title"><? echo $pageTitle;?></h3>
          <!--maybe tags?-->
          <?
            $tag='1';
          ?>
        </div>
      </div>
    </div>
  </body>

</html>