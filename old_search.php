<!DOCTYPE html>

<html lang="en">
<head>
  <title>CS421 Database G11 Project "Class Booking Service"</title>
  <meta name="Author" content="Yangyang He">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <div id="header">

    <!--Puts logo into Bootstrap grid so that it properly resizes across devices-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4" id="logo"><a href="home.html"><img src="assets/img/logo.png" alt="Logo"></a></div>
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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div> <!--end Header-->

  <div class="container">

    <div class="row"> <!--old search dropdown-->
      <form action="old_search.php" method="post">
        <select  name="room">
          <?php
          // Performing SQL query
          $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
          or die('Could not connect:' . pg_last_error());
          $query = "SELECT room_id FROM rooms";
          $result = pg_query($query) or die('Query failed: ' . pg_last_error());

          while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo '<option value="';
            echo $line[0];
            echo '">';
            echo $line[0];
            echo '</option>\n';
          }
          ?>
        </select>
        <INPUT TYPE="submit" name="submit" />
      </form>
    </div>

    <div class="row">
      <table id="roomTable">
      <tr>
        <th>Room ID</th>
        <th>Projector</th>
        <th>Board</th>
        <th>Visualizer</th>
        <th>Outlets No.</th>
        <th>Capacity</th>
      </tr>
      <?php
      // Performing SQL query
      $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
      or die('Could not connect:' . pg_last_error());
      $query = "SELECT * FROM rooms where room_id='" . $_POST("room") . "'";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());

      while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
        echo "\t<tr>\n";
        echo "\t\t<td>$line[0]</td>\n";
        echo "\t\t<td>$line[3]</td>\n";
        echo "\t\t<td>$line[4]</td>\n";
        echo "\t\t<td>$line[5]</td>\n";
        echo "\t\t<td>$line[6]</td>\n";
        echo "\t\t<td>$line[7]</td>\n";
        echo "\t</tr>\n";
      }
      ?>
      </table>
    </div>
  </div>
</body>
</html>
<? php
// Free resultset
pg_free_result($result);

// Closing connection
pg_close<$dbconn);
?>
