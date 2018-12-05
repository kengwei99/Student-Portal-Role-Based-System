<?php

	include "../action.php";

	if (isset($_SESSION['managerUsername']))
    {
        $managerUsername = $_SESSION['managerUsername'];
    }
    else
    {
        header("Location: ../index.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE User_Username = '$managerUsername'";


    $userInfo = $user->selectRecord($sql);

	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Student Portal Role-Based System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
		    	<h1>Student Portal Role-Based System</h1> 
			    <p>By Team Kappa</p> 
		  	</div>   

		  	<div class="row">
		  		<div class="col-md-4">
		  			<?php require 'nav.php';?>
		  		</div>
		  		<div class="col-md-8">
		  			<div class="panel panel-default">
			  			<?php require 'profile-panel.php';?>
        			</div>
		  		</div>
		  	</div> 


		  	<div class="row">
		  		<div>
		  			<?php

		  				if(isset($_GET['msg']))
		  				{
		  					messageToUser($_GET['msg']);
		  				}	

		  			?>
		  		</div>
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>Download Contributions</h5></div>
					<div class="panel-body">
						<div class="">
							<?php
								if(isset($_POST["Export"]))
								{
									
									$table = $_POST['filter'];

									switch ($table) 
									{
										case '1':
											$query = "SELECT id, username, email, isActive, createdAt FROM users";
											$table = "users";
											break;
										case '2':
											$query = "SELECT id, name, note, isActive, createdAt FROM categories";
											$table = "categories";
											break;

										case '3':
											$query = "SELECT i.id, i.title, i.description, i.views, i.createdAt, u.username, c.name FROM ideas i INNER JOIN categories c ON c.id = i.cat_id INNER JOIN users u ON i.user_id = u.id";
											$table = "ideas";
											break;
										case '4':
											$query = "SELECT i.id, i.title, i.description, i.createdAt, c.text, u.username FROM ideas i INNER JOIN comments c ON i.id = c.post_id INNER JOIN users u ON i.user_id = u.id ORDER BY c.id ASC";
											$table = "comments";
										case '5':
											$query = "SELECT i.id, i.title, i.description, i.createdAt, r.id AS likeId , u.username FROM ideas i INNER JOIN rating_info r ON i.id = r.post_id INNER JOIN users u ON i.user_id = u.id GROUP BY i.id ORDER BY MIN(r.post_id) DESC";;
											$table = "likes";
											break;
										
											break;

									}
									$link = expertToCsv($query,$table, $conn);
								}
							?>
							<form class="form-inline" action="" method="POST">
							  	<div class="form-group">
								    <label for="sel">Download Data From:</label>
							      	<select class="form-control" id="sel" name="filter" required>
								        <option value="">Select list (select one):</option>
								        <option value="1">Users</option>
								        <option value="2">Categories</option>
								        <option value="3">Ideas</option>
								        <option value="4">Comments</option>
								        <option value="5">Likes</option>
							      	</select>
							  	</div>
							  	<button type="submit" class="btn btn-default" name="Export">Submit</button>
							  	<?php 
							  		if(isset($link))
									{
										echo "<a class='btn btn-default' href=\"$link\">Download</a>";
									}

							  	?>
							</form>
						</div>
						
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading"><h5>Update Profile</h5></div>
					<div class="panel-body">
						<?php 
							$sql = $sql = "SELECT * FROM users WHERE User_ID = '".$userInfo['User_ID']."'";
							$row = $user->selectRecord($sql);
						?>
						<form class="form-horizontal" action="../action.php" method="POST">
						  	
						  	<div class="form-group">
							    <label class="control-label col-sm-4" for="email">Email</label>
							    <div class="col-sm-8">
							      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row['User_Email']?>" required>
							    </div>
						  	</div>
						  	<div class="form-group">
							    <label class="control-label col-sm-4" for="password">Password</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="password" name="password" placeholder="New password">
							      <input type="hidden" name="oldPass" value="<?php echo $row['User_Password']?>">
							      <input type="hidden" name="userId" value="<?php echo $userInfo['User_ID']?>">
							    </div>
						  	</div>
							<div class="form-group"> 
							    <div class="col-sm-offset-4 col-sm-8">
							      <button type="submit" class="btn btn-default" name="updateAccess">Update</button>
							    </div>
							</div>
						</form>
					</div>
				</div>
		  	</div>   
		</div>




		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
