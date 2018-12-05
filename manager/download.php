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

								$sql = "SELECT * FROM ideas WHERE Idea_ID = '$id'";

								$row = $user->selectRecord($sql);

						?>
								<div class="panel-heading"><h5>Update Idea</h5></div>
								<div class="panel-body">
									<form class="form-horizontal" action="../action.php" method="POST">
										<input type="hidden" name="ideaId" value="<?php echo $row['Idea_ID'];?>">
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="title">Idea Title</label>
										    <div class="col-sm-8">
										      <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['Idea_Title'];?>" required>
										    </div>
									  	</div>
									  	<div class="form-group">
										    <label class="control-label col-sm-4" for="description">Description</label>
										    <div class="col-sm-8">
										    	<textarea class="form-control" id="description" name="description" required><?php echo $row['Idea_Description'];?></textarea>
										    </div>
									  	</div>
									  	
										<div class="form-group">
										    <label class="control-label col-sm-4" for="postAs">Post As</label>
										   	<div class="col-sm-8"> 
										    	<select class="form-control" name="postAs"  id="postAs" required>
										    		<option value="">Select a User Role</option>
										    		<option value="1" <?php echo ($row['Idea_postType'] == 1)? "selected":""; ?> >User</option>
										    		<option value="0" <?php echo ($row['Idea_postType'] == 0)? "selected":""; ?> >Anonymous</option>
										    	</select>
										    </div>
										</div>

										
										<div class="form-group"> 
										    <div class="col-sm-offset-4 col-sm-8">
										      <button type="submit" class="btn btn-default" name="updateIdea">Update Idea</button>
										    </div>
										</div>
									</form>
								</div>

						<?php

							}

							else

							{

						?>

					  			<?php include 'profile-panel.php';?>

						<?php


							}

							
						?>

					</div>
		  		</div>
		  	</div> 
		  	<div class="row">
		  		<div class="panel panel-default">
					<div class="panel-heading"><h5>All Latest Ideas</h5></div>
					<div class="panel-body table-responsive">
						<table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						    <thead>
						    	<tr>
							        <th>#</th>
							        <th>Username</th>
							        <th>Date</th>
							        <th>Category</th>
							        <th>Title</th>
							        <th>Descrition</th>
							        <th>File</th>
							        <th>Download</th>
						      	</tr>
						    </thead>
						    <tbody>


						    	<?php

						    		
									$sql ="SELECT i.Idea_ID AS ideaId, i.Idea_Title, i.Idea_Description, i.Idea_File, i.Idea_createdAt, c.Cat_Name, o.User_Username FROM ideas i INNER JOIN categories c ON i.Cat_ID = c.Cat_ID INNER JOIN users o ON i.User_ID = o.User_ID WHERE DATE_ADD(i.Idea_createdAt, INTERVAL 14 DAY) <= CURDATE() AND i.Idea_File <> '' ORDER BY i.Idea_ID DESC";
						    		$tableRows = $user->FetchRecord($sql);
						    		$count = 1;
						    		foreach($tableRows as $tableRow)
						    		{
						    			
						    	?>


						    			<tr>
									        <td><?php echo $count;?></td>
									        <td><a href=""><?php echo $tableRow['User_Username'];?></a></td>
									        <td><?php echo date_format(date_create($tableRow['Idea_createdAt']), "d-m-Y");?></td>
									        <td><?php echo $tableRow['Cat_Name'];?></td>
									        <td><?php echo $tableRow['Idea_Title'];?></td>
									        <td><?php echo substr( $tableRow['Idea_Description'], 0, 50);?></td>
									        <td>
									        	<?php echo ($tableRow['Idea_File'] != '')? "<a href="."../".$tableRow['Idea_File']." download>".$tableRow['Idea_File']."</a>": "No File attached";?>
									        </td>
									        <td>

									        	<?php

									        		$file = $tableRow['Idea_File'];

									        		if(isset($_POST["download"]))
													{
														


														$file_path=$_SERVER["DOCUMENT_ROOT"]."/EWSP/";

        
												        
														//Call the ZIP constructor
												        $zip = new ZipArchive(); 

												        $zip_file_name=substr( $tableRow['Idea_Title'], 0, 20).".zip"; 


												        //create zip filename with current datetime

												        if($zip->open($zip_file_name, ZipArchive::CREATE)===true)

												        {      

												            if(file_exists($file_path.$file))
												            {
												                $zip->addFile($file_path.stripslashes($file),stripslashes($file));                     
												           }                  
												        }

												        $zip->close();


														header('Content-type: application/zip');

											            header('Content-Disposition: attachment; filename="'.$zip_file_name.'"');
											            
											            readfile($zip_file_name);

											            //After download the zip file which is created deleted it
											            unlink($zip_file_name);
													}
									        	?>

									        	<?php

									        		if($file  != '')
									        		{

									        	?>
										        	<form method="POST">
										        		<button class="btn btn-info btn-xs" name="download">Download</button>
										        	</form>

									        	<?php

									        		}
									        	?>

									        	
									        	
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
				<div class="text-center">
					<a class="btn btn-info" href="all-ideas.php">View all Ideas</a>
				</div><br/><br/>
				
		  	</div>   <br/><br/>
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
