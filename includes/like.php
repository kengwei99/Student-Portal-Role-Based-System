<?php 

// if user clicks like or dislike button
if (isset($_POST['action'])) 
{
  $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    switch ($action) 
    {
      

      case 'like':
          $sql="INSERT INTO rating_info (User_ID, Idea_ID, Rating_Action) VALUES ($user_id, $post_id, 'like') ON DUPLICATE KEY UPDATE Rating_Action='like'";
          break;
      
      case 'dislike':
          $sql="INSERT INTO rating_info (User_ID, Idea_ID, Rating_Action) VALUES ($user_id, $post_id, 'dislike') ON DUPLICATE KEY UPDATE Rating_Action='dislike'";
          break;
      
      case 'unlike':
      
      $sql="DELETE FROM rating_info WHERE User_ID=$user_id AND Idea_ID=$post_id";
          break;
      
      case 'undislike':
          $sql="DELETE FROM rating_info WHERE User_ID=$user_id AND Idea_ID=$post_id";
          break;
      
      default:
          break;
    }
    // execute query to effect changes in the database ...
    mysqli_query($conn, $sql);
    echo getRating($post_id);
    exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info WHERE Idea_ID = $id AND Rating_Action='like'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info  WHERE Idea_ID = $id AND Rating_Action='dislike'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE Idea_ID = $id AND Rating_Action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info WHERE Idea_ID = $id AND Rating_Action='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  'likes' => $likes[0],
  'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $conn;

  global $user_id;

  $sql = "SELECT * FROM rating_info WHERE User_ID='$user_id' AND Idea_ID='$post_id' AND Rating_Action='like'";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) 
  {
    return true;
  }
  else
  {
  return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $conn;

  global $user_id;

  $sql = "SELECT * FROM rating_info WHERE User_ID='$user_id' AND Idea_ID='$post_id' AND Rating_Action='dislike'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) 
  {
    return true;
  }

  else
  {
    return false;
  }
}

$sql = "SELECT * FROM ideas";

$result = mysqli_query($conn, $sql);

// fetch all ideas from database

$posts = mysqli_fetch_array($result, MYSQLI_ASSOC);


?>

