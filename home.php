<!doctype html>
<html lang="en">
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <title>CS421 Database G11 Project "Class Booking Service"</title>
  <meta name="Author" content="Yangyang He">
</head>
<body>
  <h1>CS421 Database G11 "Class Booking Service" Project</h1>
  <ul>
    <li>Shennie Yao</li>
    <li>Nicholas Whays (Contact Person)</li>
    <li>Yangyang He</li>
  </ul>
  <h1>We will post our project here!</h1>
  <ul>
    <li><a href="assets/CBS_STAGE_1.pdf">Stage 1 (PDF)</a></li>
    <li><a href="assets/CBS_STAGE_2.pdf">Stage 2 (PDF)</a></li>
  </ul>
  <h1>CBS: Search classroom facilities</h1>
  <form action="search_room.php" method="post">
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
</body>
</html>
