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
		  			<div class="panel panel-default">
			  			<?php include 'profile-panel.php';?>
        			</div>
		  		</div>



		  		
		  	</div> 

		  	
		  	<div class="row">
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>All Likes</h5></div>
					<div class="panel-body">
						<table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						    <thead>
						    	<tr>
							        <th>#</th>
							        <th>Date</th>
							        <th>Username</th>
							        <th>Title</th>
							        <th>Description</th>
							        <th>Category Name</th>
							        <th>Comment</th>
							        <th>Action</th>
						      	</tr>
						    </thead>
						    <tbody>

						    	<?php

						    		$sql = "SELECT r.Rating_ID AS likeId, r.User_ID, r.Idea_ID, r.Rating_Action, r.Rating_CreatedAt, i.Idea_ID AS ideaId, i.Cat_ID, i.Idea_Title, i.Idea_Description, c.Cat_ID, c.Cat_Name, c.Cat_Note, u.User_Username, u.User_ID AS uid FROM rating_info r INNER JOIN ideas i ON i.Idea_ID = r.Idea_ID INNER JOIN categories c ON c.Cat_ID = i.Cat_ID INNER JOIN users u ON u.User_ID = r.User_ID";

						    		$tableRows = $user->fetchRecord($sql);
						    		$count = 1;
						    		foreach($tableRows as $tableRow)
						    		{
						    			?>
						    			<tr>
									        <td><?php echo $count;?></td>
									        <td><?php echo date_format(date_create($tableRow['Rating_CreatedAt']), "d-m-Y");?></td>
									        <td><?php echo $tableRow['User_Username'];?></td>
									        <td><?php echo $tableRow['Idea_Title'];?></td>
									        <td><?php echo substr($tableRow['Idea_Description'],0,20);?></td>
									        <td><?php echo $tableRow['Cat_Name'];?></td>
									        <td><?php echo $tableRow['Cat_Note'];?></td>
									        <td>
									        	<a class="btn btn-info btn-xs" href="single-idea.php?id=<?php echo $tableRow['ideaId'];?>">View Idea</a>
									        	<a class="btn btn-danger btn-xs" href="../action.php?likeDelete=1&id=<?php echo $tableRow["likeId"];?>">Delete</a>
									        </td>
								      	</tr>



						    			<?php
						    				$count ++;

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
