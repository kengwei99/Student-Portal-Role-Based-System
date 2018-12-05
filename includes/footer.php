<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {

	    var data = google.visualization.arrayToDataTable([
	      ['Language', 'Rating'],
	      <?php
	      	$result = $conn->query("SELECT * FROM categories");
	      	if($result->num_rows > 0){
	          while($row = $result->fetch_assoc()){
	            $ideaId = $row['Cat_ID'];
	          	$sql ="SELECT Idea_ID from ideas WHERE Cat_ID ='$ideaId'";
	          	$cnum = $user->countRecord($sql);
	            echo "['".$row['Cat_Name']."', ".$cnum."],";
	          }
	      	}
	      ?>
	    ]);
	    
	    var options = {
	        title: 'Percentage of ideas by each Department',
	        height: 300,
	        is3D: true,
	        

	    };
	    
	    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	    
	    chart.draw(data, options);
	}
</script>

<script>
	window.onload = function () {
	 
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2", // "light1", "light2", "dark1", "dark2"
		title: {
			text: "Number of ideas made by each Department"
		},
		axisY: {
			title: "Number of Ideas",
			includeZero: false
		},
		data: [{
			type: "column",
			dataPoints: <?php
						  		echo "[";
						  		$result = $conn->query("SELECT * FROM categories");
						        while($row = $result->fetch_assoc()){
						            $ideaId = $row['Cat_ID'];
						            $cname = $row['Cat_Name'];
						          	$sql ="SELECT Idea_ID from ideas WHERE Cat_ID ='$ideaId'";
						          	$cnum = $user->countRecord($sql);
						            echo "{'label': '".$cname."', 'y':". $cnum."},";
						      	}
						      	echo "]";
						?>
		}]
	});
	chart.render();
	 
	}
</script>