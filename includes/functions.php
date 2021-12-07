<?php

// database connection function
function db_connect() {
  $db = parse_ini_file("config.ini");
  $dbhost = $db['dbhost'];
  $dbname = $db['dbname'];
  $dbuser = $db['dbuser'];
  $dbpass = $db['dbpass'];
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
  return $dbconn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, $options);
}

// get the username given an id
function get_username($user_id) {
  $dbconn = db_connect();

  $pstmt = $dbconn->prepare("SELECT username FROM accounts WHERE user_id = :user_id");
  $result = $pstmt->execute([':user_id' => $user_id]);
  $user_data = $pstmt->fetch();

  return $user_data['username'];
}

function add_tags(string $raw_tags, int $post_id) {
  $tags = get_tags($raw_tags);
  $conn = db_connect();
  $pstmt = $conn->prepare("INSERT INTO tags (post_id, tag)
                          VALUES(:post_id, :tag)");
  foreach($tags as $tag) {
    $result = $pstmt->execute([':post_id' => $post_id, ':tag' => $tag]);
    if (!$result) {
      echo '<div class="db-status error">Error inserting into database.</div>';
    }
  }
}

function get_tags(string $tags) {
  $ret = array();

  $parsed = explode(",", preg_replace("/\s+/", "", $tags));

  foreach($parsed as $tag) {
    // Sanitize p
    $tag_lower = strtolower($tag);
    // Make sure it's unique, and add it
    if (!in_array($tag_lower, $ret)) array_push($ret, $tag_lower);
  }

  return $ret;
}

?>