<?
if(isset($_GET["ID"]))  
{  
    $conn = mysql_connect('localhost', 'root', 'password123') ;
    mysql_select_db('websys_project');
    
    $id=$_GET['ID'];
    #not sure where to get the id from? probably from clicking the image --> sends over the id, then the php page will retrieve it
    $sql = "SELECT * FROM tags WHERE post_id=$id";
    $result = mysql_query($sql);
    mysql_close($conn);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo("<a href='' > ".$row['tag_name']. "</a>");
        }
      } else {
        echo "No Tags";
      }
 }
?>