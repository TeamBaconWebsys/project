<?php
    include('../includes/login_check.php');
    include('../includes/functions.php');
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

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
    <nav class="navbar navbar-expand-md navbar-light sticky-top" id="navbar">
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
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="../auth/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <h1 class="display-3 text-center">Settings</h1>
    <br>
    <div class="container">
      <!-- Notifications Settings -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
          <div class="my-4">
            <ul class="nav nav-tabs mb-4" role="tablist">
              <li class="nav-item">
                <!-- Notification Settings with buttons -->
                <!-- HTML Placeholder for future implementation of Notificaiton Features. -->
                <a class="nav-link active" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                  aria-selected="false">Notifications</a>
              </li>
            </ul>
            <div class="list-group mb-5 shadow">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <strong class="mb-0">Follower Notifications</strong>
                    <p class="text-muted mb-0">Receive notification(s) when you receive a follow request?</p>
                  </div>
                  <div class="col-auto">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                      <span class="custom-control-label"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <strong class="mb-0">Followed Artist Notifcations</strong>
                    <p class="text-muted mb-0">Receive notification(s) when an artist you follows posts?</p>
                  </div>
                  <div class="col-auto">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="alert2" />
                      <span class="custom-control-label"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Change Display Name/Password -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
          <div class="my-4">
            <ul class="nav nav-tabs mb-4" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                  aria-selected="false">Display Name and Password</a>
              </li>
            </ul>
            <div class="list-group mb-5 shadow">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <strong class="mb-0">Change Display Name</strong>
                    <form action="" method="POST">
                      <div class="form-group">
                        <input class="form-control" type="text" name="display_name" placeholder="Enter your new Display Name">
                        <br>
                        <button type="submit" name="submit" class="btn btn-secondary btn-sm">Confirm Changes</button>
                        <?php
                          if(isset($_POST['submit'])) 
                          {
                          $display_name = $_POST['display_name'];
                          $current_user_id = $_SESSION['user_id'];
                          $pstmt = $conn->prepare("UPDATE accounts SET display_name = :display_name WHERE user_id = :current_user_id");
                          $pstmt->execute([':current_user_id' => $current_user_id, ':display_name' => $display_name]);
                          }
                        ?>
                      </div>
                    </form>
                    <br>
                    <strong class="mb-0">Change Bio</strong>
                    <form method="POST">
                        <div class="form-group">
                            <div class="form-outline">
                                <textarea class="form-control" name="bio" id="textAreaExample" rows="4"></textarea>
                                <label class="form-label" for="textAreaExample">(512 max characters)</label>
                            </div>
                          <button type="submit" name="submit1" class="btn btn-secondary btn-sm">Confirm Changes</button>
                          <?php
                            if(isset($_POST['submit1'])) 
                            {
                            $bio = $_POST['bio'];
                            $current_user_id = $_SESSION['user_id'];
                            $pstmt = $conn->prepare("UPDATE accounts SET bio = :bio WHERE user_id = :current_user_id");
                            $pstmt->execute([':current_user_id' => $current_user_id, ':bio' => $bio]);
                            }
                          ?>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>



            <!-- Reset Password -->
            <div class="list-group mb-5 shadow">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <strong class="mb-0">Reset Password</strong>
                    <form action="" method="POST">
                      <div class="form-group">
                        <label for="old-password">Current Password</label>
                            <input type="text" class="form-control" name="oldpassword" placeholder="Enter your current password">
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="new-password">New Password</label>
                          <input type="text" class="form-control" name="password" placeholder="Enter your new password">
                      </div>
                      <br>
                      <button type="submit2" class="btn btn-secondary btn-sm">Confirm Changes</button>
                      <?php
                          if(isset($_POST['submit2'])) 
                          {
                          $password = $_POST['password'];
                          $current_user_id = $_SESSION['user_id'];
                          $pstmt = $conn->prepare("UPDATE accounts SET password = :password WHERE user_id = :current_user_id");
                          $pstmt->execute([':current_user_id' => $current_user_id, ':password' => $password]);
                          }
                        ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <!-- Edit Profile/Upload Profile Photo -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
          <div class="my-4">
            <ul class="nav nav-tabs mb-4" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                  Edit Profile
                </a>
              </li>
            </ul>
            <div class="list-group mb-5 shadow">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <strong class="mb-0">Profile Photo</strong>
                    <br>
                    <br>
                    <form method="POST">
                      <div class="form-group">
                        <label for="profile_pic">Choose from device.</label>
                        <br>
                        <input type="file" name="profile_pic" class="form-control-file" id="profile_pic">
                      </div>
                      <br>
                      <button type="submit3" class="btn btn-secondary btn-sm">Confirm Changes</button>
                      <?php
                          if(isset($_POST['submit3'])) 
                          {
                          $profile_pic = $_POST['profile_pic'];
                          $current_user_id = $_SESSION['user_id'];
                          $pstmt = $conn->prepare("UPDATE accounts SET profile_pic = :profile_pic WHERE user_id = :current_user_id");
                          $pstmt->execute([':current_user_id' => $current_user_id, ':profile_pic' => $profile_pic]);
                          }
                        ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <!-- Connect Twitter -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
          <div class="my-4">
            <ul class="nav nav-tabs mb-4" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                  aria-selected="false">Twitter</a>
              </li>
            </ul>
            <div class="list-group mb-5 shadow">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <!-- HTML Placeholder for future implementation of twitter connection-->
                    <strong class="mb-0">Want to connect to Twitter? Enter a link to your account here!</strong>
                    <div class="form-group">
                      <input type="email" class="form-control" id="twitter-link" aria-describedby="emailHelp" placeholder="Enter link">
                      <br>
                      <button type="button" class="btn btn-secondary btn-sm">Connect</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
