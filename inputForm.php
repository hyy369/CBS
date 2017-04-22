<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<form action="toInput.php" method="post">
			CRN:<input type="text" name="crn" required><br>
			DESIRED ROOM:
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
		 	</select><br>
		 	Start Time:
		 	<select name="start" id='start'>
		 	<?php
		  			$dbcon = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay");
		  			$query = pg_query($dbcon, "select distinct time from times order by time;");

		  			while($row=pg_fetch_assoc($query)){
		  				echo '<option value="'.htmlspecialchars($row['time']).'">'.htmlspecialchars($row['time']).'</option>';
		  			}
		  			pg_close($dbcon);
		  		?>
            </select>
		 	Duration:
		 	<select name="duration">
		 		<option value='1'>1hr</option>
		 		<option value='1.5'>1.5hrs</option>
		 	</select><br>
		 	Days:
		 	<select name="days">
		 		<option value='MWF'>MWF</option>
		 		<option value='TR'>TR</option>
		 	</select><br>
		 	Capacity:
		 	<input type='number' name='capacity' min='0' value='0'><br>

		 	PROJECTOR:
		 	<select name="projector">
		 		<option value='null'>No Preference</option>
		 		<option value='0'>No</option>
		 		<option value='1'>Yes</option>
		 	</select><br>
		 	VISUALIZER:
		 	<select name="visualizer">
		 		<option value='null'>No Preference</option>
		 		<option value='0'>No</option>
		 		<option value='1'>Yes</option>
		 	</select><br>
		 	BOARD TYPE:
		 	<select name="board">
		 		<option value='null'>No Preference</option>
		 		<option value='Chalk'>No</option>
		 		<option value='White'>Yes</option>
		 	</select><br>
		 	DESIRED OUTLETS:
		 	<input type='number' name='outlets' min='0' value='0'><br>

		 	<input type='submit'>
		 	<input type='reset'>
		</form> 
		
	</body>
</html>



