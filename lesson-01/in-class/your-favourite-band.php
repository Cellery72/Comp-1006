<?php
    $band_name ="The Red Hot Chili Peppers";
    $band_founded = new DateTime('01/01/1983');
    $band_members = ['Anthony Kiedis','Flea','Chad Smith','Josh Klinghoffer'];
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Lesson 01 - Lab</title>
  </head>
  <body>
    <div class="container">
      <header>
        <h1 class="page-header">Lesson 01 Lab<small>&nbsp;&mdash;&nbsp;Dynamic Pages</small></h1>
      </header>
      <section>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
                <?php if($band_name!=null)echo $band_name;?>
            </h3>
          </div>
          <div class="panel-body">
            <div>
              <h3>Band Members</h3>
              <p>
                  <?php
                    foreach ($band_members as $member)
                    {
                        echo $member;
                        echo "<br>";
                    }
                  ?>
              </p>
              <h3>Band Founded Date</h3>
              <p>
                  <?php
                    if($band_founded!=null)echo date_format($band_founded,'Y');
                  ?>
              </p>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
  
</html>