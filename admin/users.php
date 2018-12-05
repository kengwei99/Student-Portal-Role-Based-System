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
    };
?>

<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Student Portal Role-Based System</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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

		  			<?php
		  				
		  				if(isset($_GET['msg']))
		  				{
		  					messageToUser($_GET['msg']);
		  				}
		  				
		  			?>
		  			<div class="panel panel-default">
						<?php

							if(isset($_GET['update']))
							{


								$id = $_GET['id'];

								$sql = "SELECT * FROM users WHERE User_ID = '$id'";

								$row = $user->selectRecord($sql);

						?>
								<div class="panel-heading"><h5>Update User</h5></div>
								<div class="panel-body">


									<form class="form-horizontal" action="../action.php" method="POST">
										
									  	<div class="form-group">
									  		<input type="hidden"  value="<?php echo $row['User_ID']?>" id="id" name="id">
										    <label class="control-label col-sm-4" for="username">Username</label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $row['User_Username']?>" required>
										    </div>
									  	</div>

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
										    </div>
									  	</div>

										<div class="form-group">
										    <label class="control-label col-sm-4" for="role">User Role</label>
										    <div class="col-sm-8"> 
										    	<select class="form-control" name="role" required id="role">
										    		<option value="">Select a User Role</option>
										    		<option value="2" <?php echo ($row['User_Role'] == 2)? "selected":""; ?> >Manager</option>
										    		<option value="3" <?php echo ($row['User_Role'] == 3)? "selected":""; ?> >Coordinator</option>
										    	</select>
										    </div>
										</div>
										
										<div class="form-group"> 
										    <div class="col-sm-offset-4 col-sm-8">
										      <button type="submit" class="btn btn-default" name="updateUser">Update User</button>
										    </div>
										</div>
									</form>
								</div>

						<?php

							}

							else

							{
						?>
								<div class="panel-heading"><h5>Add User</h5></div>

								<div class="panel-body">
									<form class="form-horizontal" action="../action.php" method="POST">
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="username">Username</label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
										    </div>
									  	</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="email">Email</label>
										    <div class="col-sm-8">
										      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
										    </div>
									  	</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="password">Password</label>
										    <div class="col-sm-8">
										      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
										    </div>
									  	</div>
										<div class="form-group">
										    <label class="control-label col-sm-4" for="role">User Role</label>
										    <div class="col-sm-8"> 
										    	<select class="form-control" name="role" required id="role">
										    		<option value="">Select a User Role</option>
										    		<option value="2">Manager</option>
										    		<option value="3">Coordinator</option>
										    	</select>
										    </div>
										</div>
										
										<div class="form-group"> 
										    <div class="col-sm-offset-4 col-sm-8">
										      <button type="submit" class="btn btn-default" name="addUser">Add User</button>
										    </div>
										</div>
									</form>
								</div>
						<?php

							}

						?>

					</div>
		  		</div>
		  	</div> 
		  	<div class="row">
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>All Users</h5></div>
					<div class="panel-body">
						<table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						    <thead>
						    	<tr>
							        <th>#</th>
							        <th>Date</th>
							        <th>Username</th>
							        <th>Email</th>
							        <th>Role</th>
							        <th>Action</th>
						      	</tr>
						    </thead>

						    <tbody>

						    	<?php

						    		$sql = "SELECT * FROM users WHERE User_Role in('2','3')";

									$tableRows = $user->fetchRecord($sql);

						    		foreach($tableRows as $tableRow)

						    		{
						    	?>
						    			<tr>
									        <td><?php echo $tableRow['User_ID'];?></td>

									        <td>
									        	<?php echo date_format(date_create($tableRow['User_createdAt']), "d-m-Y");?>
									        		
									        </td>

									        <td><?php echo $tableRow['User_Username'];?></td>

									        <td><?php echo $tableRow['User_Email'];?></td>
									        
									        <td>
									        	<?php 

									        		switch ($tableRow['User_Role']) 
									        		{
									        			case '1':
									        				echo "Admin";
									        				break;
									        			case '2':
									        				echo "Manager";
									        				break;
									        			case '3':
									        				echo "Coordinator";
									        				break;
									        			case '4':
									        				echo "Student";
									        				break;

									        			default:
									        				echo "Undefine";
									        		}
									        	?>
									        		
									        	</td>
									        <td>
									        	<a class="btn btn-warning btn-xs" href="users.php?update=1&id=<?php echo $tableRow["User_ID"];?>">Edit</a>
									        	<a class="btn btn-danger btn-xs" href="../action.php?userDelete=1&uid=<?php echo $tableRow["User_ID"];?>">Delete</a>
									        </td>
								      	</tr>


						    	<?php

						    		}

						    	?>
						      	
						    </tbody>
						</table>
					</div>
				</div>
		  	</div>   
		</div>




		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			    $('#myTable').DataTable();
			});
		</script>
	</body>
</html>
