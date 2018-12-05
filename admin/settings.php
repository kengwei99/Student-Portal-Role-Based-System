<?php

	include "../action.php";

	if (isset($_SESSION['adminUsername']))
    {

        $adminUsername = $_SESSION['adminUsername'];
    }


    else
    {
        header("Location: ../index.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE User_Username = '$adminUsername'";

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
			<div class="row">
				
			</div>
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
