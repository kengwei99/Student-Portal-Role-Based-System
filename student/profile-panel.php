<div class="panel-heading"><h4>Profile Info</h4></div>
<div class="panel-body">

  	<div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
  		<img alt="User Pic" src="../assets/img/boy-full.png" id="profile-image1" class="img-circle img-responsive">
  	</div>
  	<div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
      	<div class="row" >
        	<h2><?php echo ucfirst($userInfo['User_Username']);?></h2>
        	<p>a<b> Student</b></p>
      	</div>
       	<hr>
      	<ul class="row details" >
        	<p>
        		<span class="glyphicon glyphicon-envelope one"></span> <?php echo $userInfo['User_Email'];?>
        	</p>
      	</ul>
      	<hr>
      	<div class="" >Date Of Joining: <?php echo date_format(date_create($userInfo['User_createdAt']), "M d, Y");?></div>
  	</div>
</div>