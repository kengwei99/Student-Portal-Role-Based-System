<?php

	include "action.php";


	if(isset($_SESSION['adminUsername']))

    {
        header("Location: admin/dashboard.php");
    }

    elseif (isset($_SESSION['managerUsername']))

    {
    	header("Location: manager/dashboard.php");
    }

    elseif (isset($_SESSION['coordinatorUsername']))

    {
    	header("Location: coordinator/dashboard.php");
    }

    else if (isset($_SESSION['studentUsername']))
    	
    {
    	header("Location: student/dashboard.php");
    }

?>

<!DOCTYPE html>
<html lang="en">


	<head>

		<title>Student Portal Role-Based System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">

	</head>


	<body>

		<div class="container">

			<div class="row">
				<div class="jumbotron">
			    	<h1>Student Portal Role-Based System</h1> 
			    	<p>By Team Kappa</p> 
			  	</div> 
			</div>
		  	
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
		  			<?php


		  				

		  				if (isset($_GET['msg']))

		  				{
		  					$msg = $_GET['msg'];

		  			?>
			  				<div class="alert alert-warning">
			  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $msg;?>
							</div>

					<?php

						}	

		  			?>
		  		</div> 
			</div>


		  	<div class="row">
		  		<div class="col-md-offset-3 col-md-6">
		  			<div class="panel panel-default">
						<div class="panel-heading"><h5>Login</h5></div>
						<div class="panel-body">
							<form class="form-horizontal" action="action.php" method="POST">

							  	<div class="form-group">
								    <label class="control-label col-sm-4" for="name">Username</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="name" name="username" placeholder="Your username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required>
								    </div>
							  	</div>

							  	

								<div class="form-group">
								    <label class="control-label col-sm-4" for="password">Password</label>
								    <div class="col-sm-8"> 
								      <input type="password" class="form-control" name ="password" id="password" placeholder="Your Password" value="<?php if(isset($_COOKIE["userPassword"])) { echo $_COOKIE["userPassword"]; } ?>" required>
								    </div>
								</div>



								<div class="form-group">
									<div class="col-md-offset-4 col-sm-6"> 
								      	<div class="checkbox">
										  	<label><input type="checkbox" name="rememberMe" <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?> />Remember Me ?</label>
										</div>
								    </div>
								</div>


								<div class="form-group"> 
								    <div class="col-sm-offset-4 col-sm-8">
								      <button type="submit" class="btn btn-default" name="login">Login</button>
								    </div>
								</div>
							</form>

						</div>
					</div>
		  		</div>
		  	</div> 
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
