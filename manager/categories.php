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
    };
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Student Portal Role-Based System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
								$sql = "SELECT * FROM categories WHERE Cat_ID = '$id'";
								$row = $user->selectRecord($sql);
								?>
								<div class="panel-heading"><h5>Update Category</h5></div>
								<div class="panel-body">
									<form class="form-horizontal" action="../action.php" method="POST">
									  	<div class="form-group">

									  		<input type="hidden"  value="<?php echo $row['Cat_ID']?>" id="id" name="id">
										    <label class="control-label col-sm-4" for="name">Category Name</label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" value="<?php echo $row['Cat_Name']?>" id="name" name="name" placeholder="Enter name" required>
										    </div>
									  	</div>
										<div class="form-group">
										    <label class="control-label col-sm-4" for="comment">Comment</label>
										    <div class="col-sm-8"> 
										      <input type="text" class="form-control" value="<?php echo $row['Cat_Note']?>" name ="comment" id="comment" placeholder="Enter comment" required>
										    </div>
										</div>
										
										<div class="form-group"> 
										    <div class="col-sm-offset-4 col-sm-8">
										      <button type="submit" class="btn btn-default" name="updateCategory">Update</button>
										    </div>
										</div>
									</form>
								</div>

							<?php
							}
							else
							{
								?>
								<div class="panel-heading"><h5>Add Category</h5></div>
								<div class="panel-body">
									<form class="form-horizontal" action="../action.php" method="POST">
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="name">Category Name</label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
										    </div>
									  	</div>
										<div class="form-group">
										    <label class="control-label col-sm-4" for="comment">Comment</label>
										    <div class="col-sm-8"> 
										      <input type="text" class="form-control" name ="comment" id="comment" placeholder="Enter Comment" required>
										    </div>
										</div>
										
										<div class="form-group"> 
										    <div class="col-sm-offset-4 col-sm-8">
										      <button type="submit" class="btn btn-default" name="addCategory">Add Category</button>
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
					<div class="panel-heading"><h5>All Categories</h5></div>
					<div class="panel-body table-responsive">
						<table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						    <thead>
						    	<tr>
							        <th>#</th>
							        <th>Date</th>
							        <th>Category Name </th>
							        <th>Comment</th>
							        <th>Total Idea</th>
							        <th>Action</th>
						      	</tr>
						    </thead>
						    <tbody>

						    	<?php

						    		$sql = "SELECT * FROM categories";
						    		$tableRows = $user->fetchRecord($sql);
						    		foreach($tableRows as $tableRow)
						    		{
						    			?>
						    			<tr>
									        <td><?php echo $tableRow['Cat_ID'];?></td>
									        <td><?php echo date_format(date_create($tableRow['Cat_CreatedAt']), "d-m-Y");?></td>
									        <td><?php echo $tableRow['Cat_Name'];?></td>
									        <td><?php echo $tableRow['Cat_Note'];?></td>
									        <td>
									        	<?php
									        		$sql ="SELECT Idea_ID from ideas WHERE Cat_ID ='". $tableRow['Cat_ID']."'";
						          					echo $user->countRecord($sql);
									        	?>
									        		
									        </td>
									        <td>
									        	<a class="btn btn-info btn-xs" href="idea-category.php?categoryId=<?php echo $tableRow["Cat_ID"];?>">View Ideas</a>
									        	<a class="btn btn-warning btn-xs" href="categories.php?update=1&id=<?php echo $tableRow["Cat_ID"];?>">Edit</a>
									        	<a class="btn btn-danger btn-xs" href="../action.php?categoryDelete=1&cid=<?php echo $tableRow["Cat_ID"];?>">Delete</a>
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
