<!DOCTYPE html>

<html lang="en">
<head>
  <title>CS421 Database G11 Project "Class Booking Service"</title>
  <meta name="Author" content="Yangyang He">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <table>
      <tr>
        <td>Building</td>
        <td>Room No.</td>
        <td>Projector</td>
        <td>Board</td>
        <td>Visualizer</td>
        <td>Outlets No.</td>
        <td>Capacity</td>
      </tr>
      <?php
      // Performing SQL query
      $dbconn = pg_connect("host=db.cs.wm.edu dbname=swyao_CBS user=nswhay password=nswhay")
      or die('Could not connect:' . pg_last_error());
      $query = "SELECT * FROM rooms WHERE room_id='" . $_POST["room"]. "'";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());

      while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
        echo "\t<tr>\n";
        echo "\t\t<td>$line[1]</td>\n";
        echo "\t\t<td>$line[2]</td>\n";
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
