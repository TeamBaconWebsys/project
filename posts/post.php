<?php
  $dbhost= "localhost";
  $dbname = "soup.kitchen";
  $dbusername= "root";
  $dbpassword = "";
  
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
  $user_id = '0';

  #get the post item from the database
  $sql = "SELECT * FROM posts WHERE post_id='1'";
  $result = $conn->query($sql);
  if(!$result) { echo "Error" . $conn->error; }

  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($post_array, $row);
      $user_id = $row['user_id'];
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
  $user_sql = "SELECT username from accounts WHERE user_id=$user_id";
  $result = $conn->query($user_sql);
  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($user_array, $row);
    }
  }
  $conn->close();

  //get the different items that were gotten and puts them in an array, with the keys being the different content.
  $array = array('post' => $post_array, 'tag'=>$tag_array, 'user'=>$user_array);
  /*foreach($array as $index => $value){
    foreach($value as $type => $content){
      foreach($content as $key => $x){
        echo "$x\n";
      }
    }
    -send id as query string --> get post_id from it
  }*/

  //get $array, and then send it as a JSON file.
  $send = json_encode($array);
  header('Content-type: application/json');
  echo $send;
?>