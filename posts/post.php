<?php
  include('../includes/functions.php');
  include('../includes/login_check.php');
  
  $conn = db_connect();

  // kick them out if they got here and there's no post to access
  if(!isset($_GET['post'])){
    header('Location: ../index.php', true, 302);
    die();
  }
  $post_id = $_GET['post'];

  #initialize the arrays 
  $post_array = array();
  $tag_array = array();
  $user_array = array();
  $poster_id = '0';

  //Get the information of the post
  $pstmt = $conn->prepare("SELECT * FROM posts WHERE post_id = :post_id");
  $result = $pstmt->execute([':post_id' => $post_id]);

  if(!$result) {
    header('Location: ../index.php', true, 302);
    die();
  }

  $post_info = $pstmt->fetch();
  $title = $post_info['title'];
  $submitted_date = $post_info['upload_date'];
  $image = $post_info['image'];
  $img_type = $post_info['image_type'];
  
  //get the post tags from the database
  $pstmt = $conn->prepare("SELECT tag FROM tags WHERE post_id = :post_id");
  $result = $pstmt->execute([':post_id' => $post_id]);

  $rows = $pstmt->fetchAll();
  $row_num = count($rows);
  if ($row_num > 0) {
    foreach($rows as $row) {
      array_push($tag_array, $row['tag']);
    }
  }

  // get the user who uploaded the post from the database
  $pstmt = $conn->prepare("SELECT username, display_name FROM accounts WHERE user_id = :artist_id");
  $result = $pstmt->execute([':artist_id' => $post_info['user_id']]);
  $artist_data = $pstmt->fetch();
  
  $artist_name = $artist_data['display_name'];
  $artist_username = $artist_data['username'];

  // get username of current user for navbar
  $username = get_username($_SESSION['user_id']);

  //TODO: Change mysqli to PDO
  //see if the user has favorited the post before
  $pstmt = $conn->prepare("SELECT * FROM favorites WHERE user_id = :user_id AND post_id = :post_id");
  $result = $pstmt->execute([':user_id' => $_SESSION['user_id'], ':post_id' => $post_id]);
  $check_fav = $pstmt->fetch();
  
  //get the different items that were gotten and puts them in an array, with the keys being the different content.
  // $array = array('post' => $post_array, 'tag'=>$tag_array, 'user'=>$user_array, 'favorite'=>$favorite_array);
  
  // //TODO: Change mysqli to PDO
  // //when favorite is submitted, try to see if you can remove/add them to the database.
  // if (isset($_POST['Favorite']) == "Favorite"){
    
  //   //TODO: Add the post the favorite page for the user.
  //   if($array['favorite'][0] == 'true'){  
  //     $delete_sql = "DELETE FROM favorites WHERE user_id=$user_id AND post_id=$id";
  //     $result = $conn->query($delete_sql);
  //     header("Refresh:0");
  //   } else {
  //     $add_sql = "INSERT INTO favorites (user_id, post_id) VALUES($user_id, $id);";
  //     header("Refresh:0");
  //   } 
  // }

  // $conn->close();
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

    <title><?php echo $title;?></title>
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
            <a class="nav-link" href="../homepage/saved.php">Saved</a>
            <a class="nav-link" href="../homepage/follow.php">Follows</a>
            <a class="nav-link" href="../homepage/notif.html">Notifications</a>
          </div>
        </div>
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $username; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="../user/profile.html">Profile</a></li>
            <li><a class="dropdown-item" href="../homepage/settings.php">Settings</a></li>
            <li><a class="dropdown-item" href="../auth/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div id="postBody" class="container-fluid">
      <div id="postContainer" class="card">
        <div id="postImg">
          <?php echo "<img src='data:$img_type;base64,".base64_encode($image)."' class='img-fluid card-img rounded mx-auto d-block' alt='$title'>"; ?>
        </div>
        <div id="postContent" class="card-body">
          <div class="row">
            <div id="postTitle" class="col-md-8">
              <h3><?php echo $title;?> by <?php echo "<a href='../user/profile.html?user=".$post_info['user_id']."'>$artist_username</a>";?></h3>
            </div>
            <div id="postDate" class="col-md-2">
              <?php echo date('m/d/Y', strtotime(str_replace('-','/', $submitted_date)));?>
            </div>
            <div id="favoritePost" class="col-md-2">
              <form id="favForm">
                <input id="isFav" type="submit" name="Favorite" value="Favorite"
                  class="<?php if(1 == 'true'){
                      echo 'btn active';
                    } else{
                      echo 'btn notActive';
                    }?>"
                />
              </form>
            </div>
          </div>

          <div id="postTag">
            <b>Tags:</b>
            <div class="btn-group">
              <?php foreach($tag_array as $tag) :?>
                <button class='btn tagBtn'><?php echo $tag;?></button>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>