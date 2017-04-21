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
        <?php
          $timeList = $_POST["time_list"];
          echo $_POST["time_list"];
          echo "You booked ";
          echo $_POST["room"];
          echo "on";
          echo count($timeList);
          echo "<br>";
          echo $timeList[0];
          echo $timeList[1];
          echo $timeList[2];
          foreach ($timeList as $selectedTime) {
            echo $selectedTime;
            switch (((int)$selectedTime) % 26) {
              case 1:
                $time = '08:00';
                break;
              case 2:
                $time = '08:30';
                break;
              case 3:
                $time = '09:00';
                break;
              case 4:
                $time = '09:30';
                break;
              case 5:
                $time = '10:00';
                break;
              case 6:
                $time = '10:30';
                break;
              case 7:
                $time = '11:00';
                break;
              case 8:
                $time = '11:30';
                break;
              case 9:
                $time = '12:00';
                break;
              case 10:
                $time = '12:30';
                break;
              case 11:
                $time = '13:00';
                break;
              case 12:
                $time = '13:30';
                break;
              case 13:
                $time = '14:00';
                break;
              case 14:
                $time = '14:30';
                break;
              case 15:
                $time = '15:00';
                break;
              case 16:
                $time = '15:30';
                break;
              case 17:
                $time = '16:00';
                break;
              case 18:
                $time = '16:30';
                break;
              case 19:
                $time = '17:00';
                break;
              case 20:
                $time = '17:30';
                break;
              case 21:
                $time = '18:00';
                break;
              case 22:
                $time = '18:30';
                break;
              case 23:
                $time = '19:00';
                break;
              case 24:
                $time = '19:30';
                break;
              case 25:
                $time = '20:00';
                break;
              case 0:
                $time = '20:30';
                break;
            }
            switch (intdiv(((int)$selectedTime), 26)) {
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
            // $date = "2017-04-21";
            // $time = "08:00";
            // echo "You booked ";
            // echo $_POST["room"];
            // echo "on";
            // echo $date;
            // echo $time;
          }
        ?>
      </div>

    </div>
  </div>
</body>
</html>
