<?php
  // connect and get the person
  require_once './classes/class.person.php';
  $a_person = new Person('Justin','Ellery','03/19/1994','50000');
?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>A Person</title>
  </head>

  <body>


    <div class="container">
      <div class="col-lg-12 text-center">
        <h1>This is a person<h1>
      </div>
      <br/>
      <div class="col-md-10 col-md-offset-1">
        <table class="table">
         <thead>
           <tr>
             <th>Firstname</th>
             <th>Lastname</th>
             <th>Age</th>
             <th>Gross Income<th>
             <th>Net Income<th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td><?= $a_person->get_first_name() ?></td>
             <td><?= $a_person->get_last_name() ?></td>
             <td><?= $a_person->get_age() ?> </td>
             <td><?= $a_person->get_gross_income() ?> </td>
             <td><?= $a_person->get_net_income() ?> </td>
           </tr>
         </tbody>
       </table>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>

</html>
