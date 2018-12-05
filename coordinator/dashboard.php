<?php

	include "../action.php";

	if (isset($_SESSION['coordinatorUsername']))
    {
        $coordinatorUsername = $_SESSION['coordinatorUsername'];
    }
    else
    {
        header("Location: ../index.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE User_Username = '$coordinatorUsername'";

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
			  			<?php include 'profile-panel.php';?>
        			</div>
		  		</div>
		  	</div> 


		  	<div class="row">
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>Statistical Analysis</h5></div>
					<div class="panel-body">
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile ">
						        <a href="users.php"><div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content dark-blue">
						          	<div class="circle-tile-description text-faded"> Total Students</div>
						          	<div class="circle-tile-number text-faded ">
							          	<?php 
							          		$sql ="SELECT * FROM users WHERE User_isActive=1 AND User_Role= 4";
							          		echo $user->countRecord($sql);
							          	?>
						          	</div>
						         	 <a class="circle-tile-footer" href="users.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div>
						     
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile">
						        <a href="categories.php"><div class="circle-tile-heading red"><i class="fa fa-tags fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content red">
						          	<div class="circle-tile-description text-faded">Total Categories</div>
						          	<div class="circle-tile-number text-faded ">
						          		<?php 

						          			$sql ="SELECT * FROM categories WHERE Cat_isActive =1";
						          			echo $user->countRecord($sql);
						          		?>
						          	</div>
						          	<a class="circle-tile-footer" href="categories.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div>
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile">
						        <a href="ideas.php"><div class="circle-tile-heading blue"><i class="fa fa-lightbulb-o fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content blue">
						          	<div class="circle-tile-description text-faded">Total Ideas</div>
						          	<div class="circle-tile-number text-faded ">
						          		<?php 

						          			$sql ="SELECT * FROM ideas WHERE Idea_isActivate =1";
						          			echo $user->countRecord($sql);
						          		?>
						          	</div>
						          	<a class="circle-tile-footer" href="ideas.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div> 
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile">
						        <a href="comments.php"><div class="circle-tile-heading gray"><i class="fa fa-comments fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content gray">
						          	<div class="circle-tile-description text-faded">Total Comments</div>
						          	<div class="circle-tile-number text-faded ">
						          		<?php 

						          			$sql ="SELECT * FROM comments WHERE Comment_isActive =1";
						          			echo $user->countRecord($sql);
						          		?>
						          	</div>
						          	<a class="circle-tile-footer" href="comments.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div> 
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile">
						        <a href="likes.php"><div class="circle-tile-heading orange"><i class="fa fa-thumbs-up fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content orange">
						          	<div class="circle-tile-description text-faded">Total Likes</div>
						          	<div class="circle-tile-number text-faded ">
						          		<?php 

						          			$sql ="SELECT * FROM rating_info WHERE Rating_Action ='like'";
						          			echo $user->countRecord($sql);
						          		?>
						          	</div>
						          	<a class="circle-tile-footer" href="likes.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div> 
						<div class="col-lg-2 col-sm-6">
						    <div class="circle-tile">
						        <a href="ideas.php"><div class="circle-tile-heading dark-blue"><i class="fa fa-eye fa-fw fa-3x"></i></div></a>
						        <div class="circle-tile-content dark-blue">
						          	<div class="circle-tile-description text-faded">Total Views</div>
						          	<div class="circle-tile-number text-faded ">
						          		<?php 

						          			$sql ="SELECT Idea_Views from ideas";
						          			echo $user->countRecord($sql);
						          		?>
						          	</div>
						          	<a class="circle-tile-footer" href="ideas.php">More Info <i class="fa fa-chevron-circle-right"></i></a>
						        </div>
						    </div>
						</div> 
					</div>
				</div>
		  	</div>   
		  	<div class="row">
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>Statistical Analysis</h5></div>
					<div class="panel-body">
						<div class="col-md-6">
							<div id="piechart" style=" font-family: 'Montserrat', sans-serif;"></div>
						</div>
						<div class="col-md-6">
							<div id="chartContainer" style="height: 370px"></div>
						</div>
					</div>
				</div>
			</div> 
		</div>




		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<?php require '../includes/footer.php';?>
	</body>
</html>
