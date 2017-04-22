<!DOCTYPE html>

<html lang="en">
<head>
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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div> <!--end Header-->
  <div id="body">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php
            // Connecting, selecting database
            $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
             or die('Could not connect:' . pg_last_error());
            $timeList = $_POST["time_list"];
            $info = $_POST["info"];
            $room = $_POST["room"];
            $reserver = $_POST["reserver_id"];

            // Set event_id to max of existing event ids +1
            $getEventIdSql = "SELECT MAX(event_id)+1 FROM event;";
            $getEventIdresult = pg_query($getEventIdSql) or die('Query failed: ' . pg_last_error());
            $event_id = pg_fetch_array($getEventIdresult, null, PGSQL_NUM)[0];

            // SQL insert new reserver and new event
            $sql = "BEGIN;";
            // Only insert reserver if not exist
            $checkUserSql = "SELECT count(*) FROM reserver WHERE reserver_id=" .$reserver. ";";
            $checkUserResult = pg_query($checkUserSql) or die('Query failed: ' . pg_last_error());
            if (pg_fetch_array($checkUserResult, null, PGSQL_NUM)[0] == 0) {
              $sql .= "INSERT INTO reserver VALUES(" . $reserver . ",3);";
            }

            $sql .= "INSERT INTO event VALUES(" . $event_id . "," . $reserver . ",'student','" . $info ."');" ;
            $sql .= "COMMIT;";
            $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
            foreach ($timeList as $selectedTime) {
              switch (((int)$selectedTime) % 26) {
                case 0:
                  $time = '08:00';
                  break;
                case 1:
                  $time = '08:30';
                  break;
                case 2:
                  $time = '09:00';
                  break;
                case 3:
                  $time = '09:30';
                  break;
                case 4:
                  $time = '10:00';
                  break;
                case 5:
                  $time = '10:30';
                  break;
                case 6:
                  $time = '11:00';
                  break;
                case 7:
                  $time = '11:30';
                  break;
                case 8:
                  $time = '12:00';
                  break;
                case 9:
                  $time = '12:30';
                  break;
                case 10:
                  $time = '13:00';
                  break;
                case 11:
                  $time = '13:30';
                  break;
                case 12:
                  $time = '14:00';
                  break;
                case 13:
                  $time = '14:30';
                  break;
                case 14:
                  $time = '15:00';
                  break;
                case 15:
                  $time = '15:30';
                  break;
                case 16:
                  $time = '16:00';
                  break;
                case 17:
                  $time = '16:30';
                  break;
                case 18:
                  $time = '17:00';
                  break;
                case 19:
                  $time = '17:30';
                  break;
                case 20:
                  $time = '18:00';
                  break;
                case 21:
                  $time = '18:30';
                  break;
                case 22:
                  $time = '19:00';
                  break;
                case 23:
                  $time = '19:30';
                  break;
                case 24:
                  $time = '20:00';
                  break;
                case 25:
                  $time = '20:30';
                  break;
              }
              $d = 1;
              switch ((int)((int)$selectedTime / 26)) {
                case 0:
                  $date = '2017-04-17';
                  break;
                case 1:
                  $date = '2017-04-18';
                  break;
                case 2:
                  $date = '2017-04-19';
                  break;
                case 3:
                  $date = '2017-04-20';
                  break;
                case 4:
                  $date = '2017-04-21';
                  break;
              }
              $sql = "BEGIN;";
              $sql .= "UPDATE times SET event_id=" . $event_id . " ";
              $sql .= "WHERE room_id='" .$room. "' AND time='" .$time. "' AND date ='" .$date."';";
              $sql .= "COMMIT;";
              $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
              echo "<h4 style='color: green;'>";
              echo "Student " . $reserver;
              echo " has successfully booked " . $room;
              echo " for " . $info . " (event no.: " .$event_id.")";
              echo " on " . $date . " " . $time;
              echo "<h4>";
            }
          ?>
          <h5><a href="home.html">Go back to home page</a></h5>
        </div>
      </div>

    </div>
  </div>
</body>
<?php
// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
</html>
