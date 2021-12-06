<?php
  $dbhost= "localhost";
  $dbname = "soup.kitchen";
  $dbusername= "root";
  $dbpassword = "gwinifred20";
  session_start();
  
  $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $id='1';
  #not sure where to get the id from? probably from clicking the image --> sends over the id, then the php page will retrieve it
  
  #initialize the arrays 
  $post_array = array();
  $tag_array = array();
  $user_array = array();
  $poster_id = '0';

  #get the post item from the database
  $sql = "SELECT * FROM posts WHERE post_id='1'";
  $result = $conn->query($sql);
  if(!$result) { echo "Error" . $conn->error; }

  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($post_array, $row);
      $poster_id = $row['user_id'];
    }
  }
  
  #get the post tags from the database
  $tag_sql = "SELECT * FROM tags WHERE post_id=$id";
  $result = $conn->query($tag_sql);

  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($tag_array, $row);
    }
  }
  
  #get the user who uploaded the post from the database
  $user_sql = "SELECT username from accounts WHERE user_id=$poster_id";
  $result = $conn->query($user_sql);
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($user_array, $row);
    }
  }

  $user_id = '0';
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  }
  #see if the user has favorited the post before
  $favorite_sql = "SELECT userid from favorites WHERE user_id=$user_id";
  $result = $conn->query($favorite_sql);
  $favorite_array = array();
  if(!$result){
    array_push($favorite_array, 'false');
  } else{
    array_push($favorite_array, 'true');
  }

  array_push($favorite_array, $user_id);
  $conn->close();

  //get the different items that were gotten and puts them in an array, with the keys being the different content.
  $array = array('post' => $post_array, 'tag'=>$tag_array, 'user'=>$user_array, 'favorite'=>$favorite_array);
  /*foreach($array as $index => $value){
    foreach($value as $type => $content){
      foreach($content as $key => $x){
        echo "$x\n";
      }
    }
    -send id as query string --> get post_id from it
  }*/

  /*foreach ($array['post'] as $index => $value){
    echo "$index";
    foreach($value as $x => $y){
      echo "$x: $y";
    }
  }*/
  
  //get $array, and then send it as a JSON file.
  #$send = json_encode($array);
  #header('Content-type: application/json');
  #echo $send;
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

    <!--
      Date format JQuery
      Link/Source: https://github.com/phstc/jquery-dateFormat
    -->
    <script src="../assets/jquery-dateformat.min.js"></script>

    <!-- Bootstrap 5 stylesheet and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>

    <!--custom CSS and JS-->
    <link type="text/css" rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js" async></script>

    <title><?php echo $array['post'][0]['title'];?></title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="/index.html"><img src="../images/soup_icon.svg" alt="soup.kitchen logo" width="75" height="75" /></a>
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
            <a class="dropdown-item" href="../profile/profile.html">Profile</a>
            <a class="dropdown-item" href="../homepage/settings.html">Settings</a>
            <a class="dropdown-item" href="../index.html">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div id="postBody" class="container-fluid">
      <div id="postContainer" class="card">
        <div id="postImg">
          <img class="card-img rounded mx-auto d-block" src="<?php echo $array['post'][0]['image_link']; ?>" />
        </div>
        <div id="postContent" class="card-body">
          <div class="row">
            <div id="postTitle" class="col-md-8">
              <h3><?php echo $array['post'][0]['title'];?></h3>
            </div>
            <div id="postDate" class="col-md-2">
              <?php echo date('m-d-Y', strtotime(str_replace('-','/', $array['post'][0]['upload_date'])));;?>
            </div>
            <div id="favoritePost" class="col-md-2">
              <form id="favForm">
                <button id="isFav" type="submit" name="Favorite" value="<?php echo $array['favorite'][1];?>"
                  class="<?php if($array['favorite'][0] == 'true'){
                      echo 'btn active';
                    } else{
                      echo 'btn notActive';
                    }?>"
                >Favorite</button>
              </form>
            </div>
          </div>

          <div id="postTag">
            <b>Tags:</b>
            <div class="btn-group">
              <?php foreach($array['tag'] as $tag) :?>
                <button class='btn tagBtn'><?php echo $tag['tag'];?></button>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>