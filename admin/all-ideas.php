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

	// lets assume a user is logged in with id $user_id
	$user_id = $userInfo['User_ID'];

	include "../includes/like.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Student Portal Role-Based System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
		  		<div class="col-md-5">
		  			<br/><br/><br/><br/>
		  			<div class="filter">
		  				<form class="form-inline" action="" method="POST">
						  	<div class="form-group">
							    <label for="sel">View Ideas By:</label>
						      	<select class="form-control" id="sel" name="filter">
							        <option value="">Select list (select one):</option>
							        <option value="1">Most Viewed Ideas</option>
							        <option value="2">Most Like Ideas</option>
							        <option value="3">Most Comment Ideas</option>
							        <option value="4">Latest Ideas</option>
							        <option value="5">Latest Comment</option>
						      	</select>
						  	</div>
						  	<button type="submit" class="btn btn-default" name="serach">Submit</button>
						</form>
		  			</div>
		  		</div>
		  		<div class="col-md-3">
		  			<br/><br/><br/><br/>
		  			<div class="dropdown">
					    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ideas by categories
					    <span class="caret"></span></button>
					    <ul class="dropdown-menu">
					    	<?php

					    		$sql = "SELECT * FROM categories";
					    		$tableRows = $user->fetchRecord($sql);
					    		foreach($tableRows as $tableRow)
					    		{
					    	?>
					      			<li>

					      				<a href="idea-category.php?categoryId=<?php echo $tableRow["Cat_ID"];?>">
					      					<?php echo $tableRow["Cat_Name"]?>
					      						
					      				</a>
					      			</li>
					      	<?php

						    	}
						    ?>
					      	
					    </ul>
					</div>
		  		</div>
		  	</div> 
		  	<div class="row">

		  		<?php
		  			
					try
					{

					    $DB_con = $DB_con;

					    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					}

					catch(PDOException $exception)
					{

					    echo $exception->getMessage();

					}
		        	include_once '../includes/classpagination.php';

					$paginate = new paginate($DB_con);

					$time = time();

			        $query = "SELECT * FROM ideas WHERE Idea_availableDate > '$time' and Idea_isActivate = 1 ORDER BY Idea_ID DESC "; 

			        if(isset($_POST['serach']))
			        {
			        	$serach = $_POST['filter'];
			        	switch ($serach) 
			        	{
			        		case '1':
			        			$query = "SELECT * FROM ideas WHERE Idea_Views > 0  GROUP BY Idea_ID ORDER BY MIN(Idea_Views) DESC";
			        			break;


			        		case '2':
			        			$query = "SELECT i.Idea_ID, i.Idea_Title, i.Idea_Description, i.Idea_createdAt, r.Rating_ID AS likeId , u.User_Username FROM ideas i INNER JOIN rating_info r ON i.Idea_ID = r.Idea_ID INNER JOIN users u ON i.User_ID = u.User_ID";
			        			break;



			        		case '3':
			        			$query = "SELECT i.Idea_ID, i.Idea_Title, i.Idea_Description, i.Idea_createdAt, c.Comment_ID AS commentId , u.User_Username FROM ideas i INNER JOIN comments c ON i.Idea_ID = c.Idea_ID INNER JOIN users u ON i.User_ID = u.User_ID ";
			        			break;


			        		case '4':
			        			$query = "SELECT * FROM ideas WHERE Idea_availableDate > '$time' and Idea_isActivate = 1 ORDER BY Idea_ID DESC ";
			        			break;


			        		case '5':
			        			$query = "SELECT i.Idea_ID, i.Idea_Title, i.Idea_Description, i.Idea_createdAt, c.Comment_ID AS commentId , u.User_Username FROM ideas i INNER JOIN comments c ON i.Idea_ID = c.Idea_ID INNER JOIN users u ON i.User_ID = u.User_ID ORDER BY c.Comment_ID DESC";
			        			break;
			        			
			        		
			        		default:
			        			$query = "SELECT * FROM ideas WHERE Idea_availableDate > '$time' and Idea_isActivate = 1 ORDER BY Idea_ID DESC ";
			        			break;
			        	}
			        }

			        $records_per_page = 8;
			        $newquery = $paginate->paging($query,$records_per_page);
			        $paginate->dataview($newquery);
			        
		        ?>
		  		   
		</div><br/><br/>
		<div class="row">
			<div class="text-center">
				<?php $paginate->paginglink($query,$records_per_page);  ?>
			</div>
		</div>
		

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				// if the user clicks on the like button ...
				$('.like-btn').on('click', function(){
					var post_id = $(this).data('id');
					$clicked_btn = $(this);

					if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
						action = 'like';
					} else if($clicked_btn.hasClass('fa-thumbs-up')){
						action = 'unlike';
					}


					$.ajax({
						url: 'all-ideas.php',
						type: 'post',
						data: {
							'action': action,
							'post_id': post_id
						},
						success: function(data){
							res = JSON.parse(data);

							if (action == "like") {
								$clicked_btn.removeClass('fa-thumbs-o-up');
								$clicked_btn.addClass('fa-thumbs-up');
							} else if(action == "unlike") {
								$clicked_btn.removeClass('fa-thumbs-up');
								$clicked_btn.addClass('fa-thumbs-o-up');
							}

							$clicked_btn.siblings('span.likes').text(res.likes);
							$clicked_btn.siblings('span.dislikes').text(res.dislikes);

							$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
						}
					});		

				});

				// if the user clicks on the dislike button ...
				$('.dislike-btn').on('click', function(){
					var post_id = $(this).data('id');
					$clicked_btn = $(this);

					if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
						action = 'dislike';
					} else if($clicked_btn.hasClass('fa-thumbs-down')){
						action = 'undislike';
					}
					
					$.ajax({
						url: 'all-ideas.php',
						type: 'post',
						data: {
							'action': action,
							'post_id': post_id
						},
						success: function(data){
							res = JSON.parse(data);

							if (action == "dislike") {
								$clicked_btn.removeClass('fa-thumbs-o-down');
								$clicked_btn.addClass('fa-thumbs-down');
							} else if(action == "undislike") {
								$clicked_btn.removeClass('fa-thumbs-down');
								$clicked_btn.addClass('fa-thumbs-o-down');
							}

							$clicked_btn.siblings('span.likes').text(res.likes);
							$clicked_btn.siblings('span.dislikes').text(res.dislikes);

							$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
						}
					});	

				});
			});
		</script>
	</body>
</html>
