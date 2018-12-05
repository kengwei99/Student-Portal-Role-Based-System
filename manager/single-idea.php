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

    $sql = "SELECT * FROM users WHERE User_Username = '$managerUsername'";

    $userInfo = $user->selectRecord($sql);


	// lets assume a user is logged in with id $user_id

	$user_id = $userInfo['User_ID'];

	include "../includes/like.php";

	if(isset($_GET['id']))
	{
		
		$id = $_GET['id'];

		$sql= "UPDATE ideas SET Idea_Views=Idea_Views + 1 WHERE Idea_ID='$id'";
		
		$user->updateRecord($sql);

		$sql = "SELECT i.Idea_ID AS ideaId, i.User_ID, i.Cat_ID, i.Idea_Title, i.Idea_Description, i.Idea_File, i.Idea_postType, i.Idea_Views, i.Idea_isActivate, i.Idea_createdAt AS ideaDate, c.Cat_Name, u.User_Username, u.User_Role, u.User_Email, u.User_createdAt As userCreatedDate FROM ideas i INNER JOIN categories c ON i.Cat_ID = c.Cat_ID INNER JOIN users u ON i.User_ID = u.User_ID  WHERE i.Idea_ID = '$id'";

		$post = $user->selectRecord($sql);

		switch ($post['User_Role']) {
			case '1':
				$userType = 'Admin';
				break;
			case '2':
				$userType = 'Manager';
				break;
			
			case '3':
				$userType = 'Coordinator';
				break;
			case '4':
				$userType = 'Student';
				break;
			
			default:
				$userType = 'Unknown';
				break;
		}
	}
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

			<div class="jumbotron">
		    	<h1>Student Portal Role-Based System</h1> 
			    <p>By Team Kappa</p> 
		  	</div>   

		  	<div class="row">
		  		<div class="col-md-4">
		  			<?php require 'nav.php';?>
		  		</div>
		  		<div class="col-md-8">
		  			<div class="row">
		  				<div class="panel panel-default">
		  					<?php 
                      			if($post['Idea_postType'] == 1)
                      			{
                      		
                      		?>
                      				<div class="panel-heading"><h4>Post as User</h4></div>
		                       		<div class="panel-body">
				                      	<div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
				                      		<img alt="User Pic" src="../assets/img/boy-full.png" id="profile-image1" class="img-circle img-responsive">
				                      	</div>
				                      	<div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
				                          	<div class="row" >
				                            	<h2><?php echo ucfirst($post['User_Username']) ; ?></h2>

				                            	<p>a <b><?php  echo $userType; ?> User</b></p>
				                          	</div>

				                           	<hr>

				                          	<ul class="row details" >
					                            <p>
					                            	<span class="glyphicon glyphicon-envelope one"></span> 

					                            	<?php echo $post['User_Email'];?>

					                            </p>
				                          	</ul>
				                          	<hr>


				                          	<div class="" >
				                          		Date Of Joining: <?php echo date_format(date_create($post['userCreatedDate']), "M d, Y"); ?>
				                          		
				                          	</div>
				                      	</div>
		                			</div>

		                	<?php

                      			}

                      			else

                      			{

                      		?>
                      				<div class="panel-heading"><h4>Post as Anonymous</h4></div>
		                       		<div class="panel-body">
				                      	<div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
				                      		<img alt="User Pic" src="../assets/img/anonymous-logo.png" id="profile-image1" class="img-circle img-responsive">
				                      	</div>
				                      	<div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
				                          	<div class="row" >
				                            	<h2>Anonymous</h2>
				                          	</div>
				                           	<hr>


				                          	<ul class="row details" >
					                            <p><span class="glyphicon glyphicon-envelope one"></span> example@email.com</p>
				                          	</ul>
				                          	<hr>


				                          	<div>

				                          		Date Of Joining: <?php echo date_format(date_create($post['userCreatedDate']), "M d, Y"); ?>
				                          			
				                          	</div>
				                      	</div>
		                			</div>
                      		<?php

                      			}
                      		?>	
	            		</div>
		  			</div>
            	</div>
		  	</div>
		  	

		  	<div class="row">
		  		<div class="panel panel-default">

					<div class="panel-heading">

						<h5>Idea Details (The idea will be automatically closed after 7 days)  <span class="pull-right">Post Date: <?php echo date_format(date_create($post['ideaDate']), "M d, Y @ h:i A");?></span></h5>

					</div>


					<div class="panel-body single-post">
						<p>
							<span style="font-weight: 600">Idea Title: </span> 

							<?php echo $post['Idea_Title'];?>

						</p>

						<p>
							<span style="font-weight: 600">Idea Category: </span> 

							<?php echo $post['Cat_Name'];?>
						</p>

						<p>
							<span style="font-weight: 600">Idea  Description: </span>

							<?php echo $post['Idea_Description'];?>

						</p>

						<p>
							<?php echo ($post['Idea_File'] != '')? "<a href="."../".$post['Idea_File']." download><i class='fa fa-file'></i>".$post['Idea_File']."</a>": "";?>
								
						</p>

					</div>

					<div class="panel-footer card-footer">


						<i<?php if (userLiked($post['ideaId'])): ?> class="fa fa-thumbs-up like-btn"<?php else: ?> class="fa fa-thumbs-o-up like-btn"<?php endif ?> data-id="<?php echo $post['ideaId'] ?>">
							
						</i>

						<span class="likes"><?php echo getLikes($post['ideaId']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

						<i<?php if (userDisliked($post['ideaId'])): ?> class="fa fa-thumbs-down dislike-btn"<?php else: ?> class="fa fa-thumbs-o-down dislike-btn"<?php endif ?> data-id="<?php echo $post['ideaId'] ?>">
							
						</i>

						<span class="dislikes"><?php echo getDislikes($post['ideaId']); ?></span>

                        <div class="pull-right">


                        	<span>Views: <?php echo $post['Idea_Views']; ?></span>

                        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        	<span> Comments: 

                        		<?php

                        	 		$sql ="SELECT Comment_ID FROM comments WHERE Idea_ID = '$id'";
						          	echo $user->countRecord($sql); 
						        ?>
						          		
						    </span>
                        </div>

                        
					</div>
				</div>
		  	</div>



		  	<div class="row">
		  		<div class="comments col-md-offset-2 col-md-8">
		  			<?php
		  				
		  				$sql = "SELECT * FROM users WHERE User_ID='".$post['User_ID']."'";
			    		$ideaRows = $user->selectRecord($sql);
		  			?>
					<div class="comment-wrap">

						<div class="photo">
							<div class="avatar" style="background-image: url('../assets/img/boy.png')"></div>
						</div>

						<div class="comment-block">

							<form action="../action.php" method="POST">

								<input type="hidden" name="userId" value="<?php echo $user_id;?>">

								<input type="hidden" name="postId" value="<?php echo $post['ideaId'];?>">

								<input type="hidden" name="email" value="<?php echo $post['User_Email'];?>">

								<textarea class="form-control" name="commentText" id="" cols="30" rows="3" placeholder="Add comment..."></textarea><br/>

								<div class="checkbox text-right">
								  	<label>
								  		<input type="checkbox" name="anonymous" value="1">
								  		Comment As Anonymous
								  	</label>
								</div>

								<input type="submit" class="btn btn-default pull-right" name="comment" value="comment">
								
							</form>

						</div>
					</div>


					<?php

						$sql ="SELECT c.Comment_ID as comId, c.User_ID, c.Idea_ID, c.Comment_Text, c.Comment_Type, c.Comment_isActive, c.Comment_createdAt, u.User_ID,  u.User_Username FROM comments c JOIN users u ON c.User_ID = u.User_ID JOIN ideas ON ideas.Idea_ID = c.Idea_ID WHERE c.Idea_ID = '$id'";

			    		$tableRows = $user->fetchRecord($sql);

			    		foreach($tableRows as $tableRow)
			    		{
			    	?>
			    			<div class="comment-wrap">

								<div class="photo">
									<div class="avatar" style="background-image: url('../assets/img/boy.png')">
										
									</div>
								</div>
								<div class="comment-block">
									<p><a href=""><?php echo ucfirst($tableRow['User_Username']);?></a></p>

									<p class="comment-text"><?php echo $tableRow['Comment_Text'];?></p>

									<div class="bottom-comment">
										<div class="comment-date"><?php echo date_format(date_create($tableRow['Comment_createdAt']), "M d, Y @ h:i A");?></div>
										
									</div>
									<div class="comment-footer">

										<form action="../action.php" method="POST">

											<input type="hidden" name="comment_id" value="<?php echo $tableRow['comId'];?>">

											<input type="hidden" name="user_id" value="<?php echo $user_id?>">

											<input type="hidden" name="ideaId" value="<?php echo $post['ideaId']?>">

											<?php

												$commentId = $tableRow['comId'];

												$sql = "SELECT * FROM like_unlike WHERE User_ID = '$user_id' AND Comment_ID = '$commentId' AND LU_Type = '1'";

												$rating = $user->selectRecord($sql);

												$sql = "SELECT * FROM like_unlike WHERE  Comment_ID = '$commentId' AND LU_Type = '1'";


												$num = $user->countRecord($sql);

												if(isset($rating))
													
												{
													echo '<button class=""  name="like">
														<i class="fa fa-thumbs-up"></i>
													</button>' . $num . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;
												}

												else
												{
													echo '<button class=""  name="like">
														<i class="fa fa-thumbs-o-up"></i>
													</button>' . $num . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;;
												}


												$sql = "SELECT * FROM like_unlike WHERE User_ID = '$user_id' AND Comment_ID = '$commentId' AND LU_Type = '0'";

												$rating = $user->selectRecord($sql);

												$sql = "SELECT * FROM like_unlike WHERE  Comment_ID = '$commentId' AND LU_Type = '0'";

												$num = $user->countRecord($sql);

												if(isset($rating))
												{
													echo '<button class=""  name="dislike">
														<i class="fa fa-thumbs-down"></i>
													</button>' . $num . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;;
												}
												else
												{
													echo '<button class=""  name="dislike">
														<i class="fa fa-thumbs-o-down"></i>
													</button>'  . $num . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;;
												}
											?>
										</form>  


									</div>
								</div>
							</div>	
					<?php


						}


			    	?>
					
				</div>
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
						url: 'single-idea.php',
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
						url: 'single-idea.php',
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
