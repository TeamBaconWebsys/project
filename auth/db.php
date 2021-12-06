<?php
include('../includes/functions.php');
session_start(); 

$conn = db_connect();
// where to send the user after logging in
$send_to = "../index.php";

// user input validation
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// give an array of inputs to check if they're set
function check_inputs_set($arr) {
  foreach ($arr as $val) {
    if (!isset($_POST[$val])) return false;
  }
  return true;
}

// If a user is trying to login (they can use either their username or their email to login)
if (isset($_POST['login']) && check_inputs_set(['username_email', 'password'])) {
  $username_email = validate($_POST['username_email']);
  $pass = validate($_POST['password']);

  // Error if either username or password is required
  if (empty($username_email)) {
    header("Location: login.php?error=Username or Email is required");
  }
  else if(empty($pass)) {
    header("Location: login.php?error=Password is required");
  }
  // If username or email, and password are entered
  else {
    // Query for the user account
    $pstmt = $conn->prepare("SELECT * FROM accounts WHERE username=:username_email OR email=:username_email");
    $pstmt->execute(array(':username_email' => $username_email));
    $result = $pstmt->fetchAll();

    // If user exists
    if (count($result) === 1) {
      $row = $result[0];
      // If account credentials verify
      if (($row['username'] === $username_email || $row['email'] === $username_email) && password_verify($pass, $row['password'])) {
        echo "Logged in!";
        $_SESSION['display_name'] = $row['display_name'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: ".$send_to);
      } else {
        header("Location: login.php?error=Incorrect credentials");
      }
    }
    // If user not found (say that user doesn't exist instead of incorrect credentials for debugging)
    else {
      header("Location: login.php?error=Account doesn't exist");
    }
  }
}
// If a user is registering
else if (isset($_POST['register']) && check_inputs_set(['email', 'username', 'password'])) {
  $email = validate($_POST['email']);
  $username = validate($_POST['username']);
  $pass = validate($_POST['password']);

  // extra stuff because display name is optional
  $display_name = '';
  if (isset($_POST['display_name'])) {
    $display_name = validate($_POST['display_name']);
  }

  // Error if there are missing fields
  if (empty($username) || empty($email)) {
    header("Location: register.php?error=Username/Email are required");
  }
  else if(empty($pass)) {
    header("Location: register.php?error=Password is required");
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: register.php?error=Invalid Email");
  }
  // If username/email/password are entered
  else {
    // Check to make sure the username isn't taken
    $pstmt = $conn->prepare("SELECT * FROM accounts WHERE username=:username OR email=:email");
    $pstmt->execute([':username' => $username, ':email' => $email]);
    $result = $pstmt->fetchAll();

    // Error if the username/email is taken
    if (count($result) > 0) {
      header("Location: register.php?error=Username/Email already taken");
    }
    // Otherwise salt + hash password and insert into array
    else {
      $pstmt = $conn->prepare("INSERT INTO accounts (username, email, display_name, password)
                              VALUES(:username, :email, :display_name, :password)");
      // If there's no display name set, just user the username, otherwise use the entered display name
      if (empty($display_name)) {
        $result = $pstmt->execute([':username' => $username, ':email' => $email, ':display_name' => $username, ':password' => password_hash($pass, PASSWORD_DEFAULT)]);
      }
      else {
        $result = $pstmt->execute([':username' => $username, ':email' => $email, ':display_name' => $display_name, ':password' => password_hash($pass, PASSWORD_DEFAULT)]);
      }
      
      // If there was somehow a DB error
      if (!$result) {
        header("Location: register.php?error=Couldn't create new user");
      }
      // If everything went well send them to login
      else {
        header("Location: login.php");
      }
    }
  }
} 
else {
  header("Location: ".$send_to);
}
exit();
?>
