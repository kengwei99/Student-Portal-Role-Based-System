<?php

  session_start();

  require "includes/db.inc.php";

  require "includes/file.inc.php";

  require "includes/function.php";


  // Check login user role 

  if (isset($_SESSION['adminUsername']))
    {

        $adminUsername = $_SESSION['adminUsername'];

        $folder = "admin/";
    }

    else if (isset($_SESSION['managerUsername'])) 
    {

        $managerUsername = $_SESSION['managerUsername'];

        $folder = "manager/";
    }

    else if (isset($_SESSION['coordinatorUsername'])) 
    {
        $coordinatorUsername = $_SESSION['coordinatorUsername'];

        $folder = "coordinator/";
    }

    else if (isset($_SESSION['studentUsername'])) 
    {

        $studentUsername = $_SESSION['studentUsername'];

        $folder = "student/";
    }


    // Data Operation Class
  class DataOperation extends Database
  {
    
    
    // Data insert method

    public function insertRecord($table, $fileds)
    {
      $sql = "";

      $sql .= "INSERT INTO " .$table;

      $sql .= " (". implode(",", array_keys($fileds)) . ") VALUES ";

      $sql .= " ('". implode("','", array_values($fileds)) . "')";

      $query = mysqli_query($this->conn, $sql);

      if($query)
      {

        return true;

      }

    }


    // Data fetch method

    public function fetchRecord($sql)
    {

      $array = array();

      $query = mysqli_query($this->conn, $sql);

      while($row = mysqli_fetch_assoc($query))
      {

        $array[] = $row;

      }

      return $array;
    }

    // Data select method

    public function selectRecord($sql)
    {

      $query = mysqli_query($this->conn, $sql);

      $row = mysqli_fetch_array($query);
      return $row;
    }

    // Data update method

    public function updateRecord($sql)
    {
      
      $upadte = mysqli_query($this->conn, $sql);

      if(isset($upadte))
      {

        return true;

      }
      else
      {

        return mysqli_error($this->conn);
      }
      
    }


    // Data delete method 

    public function deleteRecord($sql)
    {

      $delete = mysqli_query($this->conn, $sql);

      if(isset($delete))
      {

        return true;

      }
      else
      {
        return mysqli_error($this->conn);
      }

    }

    // Data count method
    public function countRecord($sql)
    {
      
      $count = mysqli_query($this->conn, $sql);

      $rows = mysqli_num_rows($count);

      return $rows;

    }
  }


  // New object from Data Operation class

  $user = new DataOperation;

  


  // User login 

  if(isset($_POST['login']))
  {
    $username = trim($_POST['username']);

    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE User_Username = '$username'";

    $row = $user->selectRecord($sql);

    if(isset($row))
    {
      if($username == $row['User_Username'] && $row['User_isActive'] == 1 && password_verify($password,$row['User_Password']))
      {
        
        if(!empty($_POST["rememberMe"])) 
                {

                    setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));

                    setcookie ("userPassword",$password,time()+ (10 * 365 * 24 * 60 * 60));

                }

                else 
                {
                    if(isset($_COOKIE["username"])) 
                    {

                      setcookie ("username","");
                    }

                    if(isset($_COOKIE["userPassword"])) 
                    {

                        setcookie ("userPassword","");
                    }
                }

                switch ($row['User_Role']) 
                {
                  case '1':

                    $_SESSION['adminUsername'] = $username;

                    header("Location: admin/dashboard.php");

                    break;

                  case '2':
                    $_SESSION['managerUsername'] = $username;

                    header("Location: manager/dashboard.php");

                    break;

                  case '3':
                    $_SESSION['coordinatorUsername'] = $username;

                    header("Location: coordinator/dashboard.php");

                    break;

                  case '4':
                    $_SESSION['studentUsername'] = $username;

                    header("Location: student/dashboard.php");

                    break;
                  
                  default:
                    # code...
                    break;
                }
      }

      else
      {

        header("location:index.php?msg=username or password doesn't match");
      }
    }


    else
    {
      header("location:index.php?msg=username or password invalid");
    }


  }





  // User create

  if(isset($_POST['addUser']))
  {
    $username = trim($_POST['username']);

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    $role = $_POST['role'];

    $where = array(

      "User_Username" => $username
    );

    $row = $user->selectRecord("users", $where);

    if(isset($row))
    {

      header("location:users.php?msg=username already exists");
    }

    else
    {
      
      $userPassword = password_hash($password, PASSWORD_DEFAULT);

      $usersArray = array(

            "User_Username" => $username,

            "User_Email" => $email,

            "User_Password" => $userPassword,

            "User_Role" => $role,

            "User_isActive" => 1
          );

      if($user->insertRecord('users', $usersArray))
      {
        
        header("location: $folder"."users.php?msg=User added Successfully");
      }
      else
      {
        header("location: $folder"."users.php?msg=Username or Email already Exists");
      }
    }
  }





  // User update

  if(isset($_POST['updateUser']))
  {
    $username = trim($_POST['username']);

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    $role = $_POST['role'];

    if($password == '')
    {
      
      $password = $_POST['oldPass'];
    }

    else
    {

      $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $id = $_POST['id'];

    $sql = "UPDATE users SET User_Username = '$username', User_Email = '$email', User_Password = '$password', User_Role = '$role' WHERE User_ID = '$id'";

    if($user->updateRecord($sql))
    {
      
      header("location: $folder"."users.php?msg=User Updated Successfully");
    }

  }




  // User delete
  if(isset($_GET['userDelete']))
  {
    
    $id = $_GET['uid'];


    $sql = "DELETE FROM users WHERE User_ID = '$id'";

    if($user->deleteRecord($sql))
    {

      header("location: $folder"."users.php?msg=Record deleted Successfully");
    }
  }






  // Category create

  if(isset($_POST['addCategory']))
  {
    $categoryArray = array(

      "Cat_Name" => $_POST['name'],

      "Cat_Note" => $_POST['comment'],

      "Cat_isActive" => 1,

    );

    if($user->insertRecord('categories', $categoryArray))
    {

      header("location: $folder"."categories.php?msg=Category Created Successfully");
    }
    else{ header("location: $folder"."categories.php?msg=Category already exists");
    }
  }






  //Category update

  if(isset($_POST['updateCategory']))
  {
    
    $id = $_POST['id'];

    $name = $_POST['name'];

    $note = $_POST['comment'];

    $sql = "UPDATE categories SET Cat_Name = '$name', Cat_Note = '$note' WHERE Cat_ID = '$id'";

    if($user->updateRecord($sql))
    {

      header("location: $folder"."categories.php?msg=Category Updated Successfully");
    }
  }






  // Category delete

  if(isset($_GET['categoryDelete']))
  {
    
    $id = $_GET['cid'];

    $sql = "DELETE FROM categories WHERE Cat_ID = '$id'";

    if($user->deleteRecord($sql))
    {

      header("location: $folder"."categories.php?msg=Record deleted Successfully");
    }
  }







  // Idea create

  if(isset($_POST['addIdea']))
  {
    

    $userId = $_POST['userId'];

    $title = $_POST['title'];

    $description = $_POST['description'];

    $category = $_POST['category'];

    $postAs = $_POST['postAs'];

    $fileName = "";

    $availableDate = strtotime('+7 day', time());

    $views = 0;

    $isActive = 1;

    if($_FILES['file']['size'] == 0) 
    {
    
      $fileName = "";
    }

    else
    {
        $fileUploader=new FileUploader();

          if($fileUploader->upload()){

             $fileName = $fileUploader->getUploadFile();

          }
    }

    $userArray = array(

      "User_ID" => $userId,

      "Cat_ID" => $category,

      "Idea_Title" => $title,

      "Idea_Description" => $description,

      "Idea_File" => $fileName,

      "Idea_postType" => $postAs,

      "Idea_availableDate" => $availableDate,

      "Idea_Views" => $views,

      "Idea_isActivate" => $isActive

    );

    if($user->insertRecord('ideas', $userArray))
    {
      $subject = "New idea posted";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      
      
      $message = "Hello, a new idea posted on the system. Here is the title of the idea" . $title . '. Check full details from system';
      

      $sql = "SELECT User_Email FROM users WHERE User_Role = 3";

      $result = mysqli_query($conn, $sql);

      $maillArrs = array();

      while($row = mysqli_fetch_assoc($result))
      {
        $maillArrs[] = $row['User_Email'];
      }

      foreach($maillArrs as $maillArr)
      {
        
        mail($maillArr, $subject, $message,$headers);

      }
      
      
      
      

      

      header("location: $folder"."ideas.php?msg=Idea Inserted Successfully");
    }
  }





  // Idea Update

  if(isset($_POST['updateIdea']))
  {

    $title = $_POST['title'];

    $description = $_POST['description'];

    $postAs = $_POST['postAs'];

    $id = $_POST['ideaId'];

    $sql = "UPDATE ideas SET Idea_Title ='$title', Idea_Description='$description', Idea_postType = '$postAs' WHERE Idea_ID = '$id'";

    if($user->updateRecord($sql))
    {

      header("location: $folder"."ideas.php?msg=Idea Updated Successfully");
    }
  }

  // User delete

  if(isset($_GET['ideaDelete']))
  {
    
    $id = $_GET['id'];

    $sql = "DELETE FROM ideas WHERE Idea_ID = '$id'";

    if($user->deleteRecord($sql))
    {

      header("location: $folder"."ideas.php?msg=Record deleted Successfully");
    }
  }






  // Comment create
  if(isset($_POST['comment']))
  {

    $ideaId = $_POST['postId'];

    $userId = $_POST['userId'];

    $notifyEmail = $_POST['email'];


    if(isset($_POST['anonymous']))
    {

      $commentType = 0;
    }

    else
    {

      $commentType = 1;
    }
    
    $commentArray = array(

      "User_ID" => $userId,

      "Idea_ID" => $ideaId,

      "Comment_Text" => $_POST['commentText'],

      "Comment_Type" => $commentType,

      "Comment_isActive" => 1

    );

    if($user->insertRecord('comments', $commentArray))
    {

      $sql = "SELECT * FROM users WHERE User_ID = '$userId'";

      $userInfo = $user->selectRecord($sql);

      if($userInfo['User_Role'] == 4)
      {
      
        $subject = "New comment on your idea";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        
        $message = $_POST['commentText'];
        
        
        mail($notifyEmail, $subject, $message,$headers);
      }

      header("location: $folder"."single-idea.php?id=$ideaId");
    }
  }






  // Comment delete

  if(isset($_GET['commentDelete']))
  {
    
    $id = $_GET['id'];

    $where = array('id' => $id);

    $sql = "DELETE FROM comments WHERE Comment_ID = '$id'";

    if($user->deleteRecord($sql))
    {

      header("location: $folder"."comments.php?msg=Record deleted Successfully");
    }
  }






  // Like delete

  if(isset($_GET['likeDelete']))
  {
    

    $id = $_GET['id'];


    $sql = "DELETE FROM rating_info WHERE Rating_ID = '$id'";

    if($user->deleteRecord($sql))
    {

      header("location: $folder"."likes.php?msg=Record deleted Successfully");
    }
  }






  // User access update
  if(isset($_POST['updateAccess']))
  {

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    if($password == '')
    {

      $password = $_POST['oldPass'];
    }

    else
    {

      $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $id = $_POST['userId'];

    $sql = "UPDATE users SET  User_Email = '$email', User_Password = '$password' WHERE User_ID = '$id'";
    
    if($user->updateRecord($sql))
    {
      header("location: $folder"."settings.php?msg= Profile Updated Successfully");
    }
  }







  if(isset($_POST['like']))
  {
    $userId = $_POST['user_id'];
    $commentId = $_POST['comment_id'];
    $ideaId = $_POST['ideaId'];


    $sql = "SELECT * FROM like_unlike WHERE User_ID = '$userId' AND Comment_ID = '$commentId' AND LU_Type = 1 ";

    $rating = $user->selectRecord($sql);

    if(isset($rating))
    {
      $sql = "DELETE FROM like_unlike WHERE User_ID = '$userId' AND Comment_ID ='$commentId' AND LU_Type = 1";

      $rating = $user->deleteRecord($sql);

      header("location: $folder"."single-idea.php?id=$ideaId");
    }

    else
    {
      $commentRattingArray = array(

      "User_ID" => $userId,

      "Comment_ID" => $commentId,

      "Idea_ID" => $ideaId,

      "LU_Type" => 1,

      );

      if($user->insertRecord('like_unlike', $commentRattingArray))
      {

        header("location: $folder"."single-idea.php?id=$ideaId");
      }
    }
  }




  //
  if(isset($_POST['dislike']))
  {
    $userId = $_POST['user_id'];
    $commentId = $_POST['comment_id'];
    $ideaId = $_POST['ideaId'];


    $sql = "SELECT * FROM like_unlike WHERE User_ID = '$userId' AND Comment_ID = '$commentId' AND LU_Type = 0";

    $rating = $user->selectRecord($sql);

    if(isset($rating))
    {
      $sql = "DELETE FROM like_unlike WHERE User_ID = '$userId' AND Comment_ID ='$commentId' AND LU_Type = 0";

      $rating = $user->deleteRecord($sql);

      header("location: $folder"."single-idea.php?id=$ideaId");
    }

    else
    {
      $commentRattingArray = array(

      "User_ID" => $userId,

      "Comment_ID" => $commentId,

      "Idea_ID" => $ideaId,

      "LU_Type" => 0,

      );

      if($user->insertRecord('like_unlike', $commentRattingArray))
      {

        header("location: $folder"."single-idea.php?id=$ideaId");
      }
    }
  }

?>
