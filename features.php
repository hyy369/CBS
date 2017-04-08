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
            <li><a href="roomFeatures.php">Search by Features</a></li>
            <li><a href="old_search.php">Old Search</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div> <!--end Header-->
  <div id="body">
    <div class="container">
      <div class="row">
        <p><strong>Please check the features you would like to have:</strong></p>
        <form action ="action.php" method="post">
          <input type="checkbox" name="projector" value="proj_true">
          <span>Projector</span>
          <input type="checkbox" name="board" value="chalkboard">
          <span>Chalkboard</span>
          <input type="checkbox" name="board" value="whiteboard">
          <span>Whiteoard</span>
          <input type="checkbox" name="visualizer" value="vis_true">
          <span>Visualizer</span>
          <br>
          <span>Minimum capacity: </span>
          <input type="text" name="min_outlets">
          <br>
          <span>Minimum number of outlets: </span>
          <input type="text" name="min_cap">
          <br>
          <input type="submit" value="Search Rooms">
          <input type ="reset">
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
        </table>
      </div>
    </div>
  </div>
</body>
</html>
