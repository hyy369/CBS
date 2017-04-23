<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<title>CS421 Database G11 Project "Class Booking Service"</title>
	  <meta name="Author" content="Yangyang He">
	  <meta content="width=device-width,initial-scale=1" name=viewport>
	  <!-- Latest compiled and minified CSS -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	  <link rel="stylesheet" href="assets/css/main.css">
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	</head>
	<body>
		<div id="header">
	    <!--Puts logo into Bootstrap grid so that it properly resizes across devices-->
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-4" id="logo"><a href="home.html"><div id="logo-img"></div></a></div>
	        <div class="col-sm-4"></div>
	        <div class="col-sm-4"></div>
	      </div>
	    </div>

	    <!-- Static navbar -->
	    <!-- HTML for the navigation bar - will collapse into a dropdown button on small screens-->
	    <div class="navbar navbar-inverse navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-left">
	            <li><a href="home.html">Home</a></li>
	            <li><a href="classrooms.php">Search by Classrooms</a></li>
	            <li><a href="features.php">Search by Features</a></li>
	            <li><a href="events.php">Confirmed Reservations</a></li>
	            <li><a href="schedule.php">Schedule a class</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
	  </div> <!--end Header-->

		<div class="container">
			<div class="row">
				<div class="col-md-12" id="middle">
					<h3>Schedule a Class</h3>
				</div>
				<form action="write-input.php" method="post">
					<div class="row">
						<div class="col-md-6" id="right-label">
							<h5>CRN: </h5>
						</div>
						<div class="col-md-6">
							<input type="text" name="crn" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
							<h5>Desired room: </h5>
						</div>
						<div class="col-md-6">
					  	<select name="building" id='building'>
					  		<option value="null">No Preference</option>
					  		<?php
					  			$dbcon = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay");
					  			$query = pg_query($dbcon, "select * from rooms;");

					  			while($row=pg_fetch_assoc($query)){
					  				echo '<option value="'.htmlspecialchars($row['room_id']).'">'.htmlspecialchars($row['room_id']).'</option>';
					  			}
					  			pg_close($dbcon);
					  		?>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Start Time: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="start" id='start'>
							 	<?php
					  			$c = 8;
									while ($c < 21) {
										echo '<option value=' .$c. '>' .$c. '</option>';
										$c = $c + .5;
									}
					  		?>
	            </select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Duration: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="duration">
						 		<option value='1'>1hr</option>
						 		<option value='1.5'>1.5hrs</option>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Days: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="days">
						 		<option value='MWF'>MWF</option>
						 		<option value='TR'>TR</option>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Capacity: </h5>
						</div>
						<div class="col-md-6">
						 	<input type='number' name='capacity' min='0' value='0'>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Projector: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="projector">
						 		<option value='null'>No Preference</option>
						 		<option value='0'>No</option>
						 		<option value='1'>Yes</option>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Visualizer: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="visualizer">
						 		<option value='null'>No Preference</option>
						 		<option value='0'>No</option>
						 		<option value='1'>Yes</option>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5> Board type: </h5>
						</div>
						<div class="col-md-6">
						 	<select name="board">
						 		<option value='null'>No Preference</option>
						 		<option value='0'>Chalkboard</option>
						 		<option value='1'>Whiteboard</option>
						 	</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" id="right-label">
						 	<h5>Desired outlets: </h5>
						</div>
						<div class="col-md-6">
						 	<input type='number' name='outlets' min='0' value='0'>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="middle">
						 	<input type="submit" name="submit" value="Submit this class schedule">
						 	<input type='reset' name='reset' value='Reset all field'>
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-12" id="middle">
					<h6><a href="admin-login.html">Administrator login</a></h6>
				</div>
			</div>
		</div>
	</body>
</html>
