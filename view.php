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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div> <!--end Header-->
  <div id="body">
    <div class="container">
      <div class="row">
        <table>
          <tr>
            <th>04-17</th>
            <th>04-18</th>
            <th>04-19</th>
            <th>04-20</th>
            <th>04-21</th>
          </tr>
          <?php
            // Connecting, selecting database
            $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
             or die('Could not connect:' . pg_last_error());
            $sql = "SELECT * FROM times WHERE room_id='";
            $sql .= $_GET["room"];
            $sql .= "' ORDER BY date, time;";
            $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

            while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
              echo "\t<tr>\n";
              echo "\t\t<td>$line[0]</td>\n";
              echo "\t\t<td>$line[1]</td>\n";
              echo "\t\t<td>$line[2]</td>\n";
              echo "\t\t<td>$line[3]</td>\n";
              echo "\t</tr>\n";
            }
          ?>
        </table>
      </div>

    </div>
  </div>
</body><? php
// Free resultset
pg_free_result($result);

// Closing connection
pg_close<$dbconn);
?>
</html>
