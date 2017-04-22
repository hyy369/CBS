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
        <div class="col-md-9">
          <?php
            // Connecting, selecting database
            $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
             or die('Could not connect:' . pg_last_error());
            $event_id = $_POST["event_id"];
            $verification = $_POST["verification"];

            // Set event_id to max of existing event ids +1
            $getReserverIdSql = "SELECT reserver_id FROM event WHERE event_id=" .$event_id. ";";
            $getReserverIdresult = pg_query($getReserverIdSql) or die('Query failed: ' . pg_last_error());
            $reserver_id = pg_fetch_array($getReserverIdresult, null, PGSQL_NUM)[0];

            if (((int)$verification) == $reserver_id) {
              $sql = "BEGIN;";
              $sql .= "UPDATE times SET event_id=null WHERE event_id=$event_id;";
              $sql .= "DELETE FROM event WHERE event_id=$event_id;";
              $sql .= "COMMIT;";
              $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
              echo "<h3 style='color: green;' >Booking No. " .$event_id. " has been successfully canceled.</h3>";
            } else {
              echo "<h3 style='color: red;'>Verification failed. You do not have the right to cancel this booking.</h3>";
            }
          ?>
          <h4><a href="events.php">Go back to Comfirmed Reservations</a></h4>
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
