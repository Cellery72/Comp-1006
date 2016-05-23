<?php
  $recipe_name = 'Grilled Cheese';
  $ingredients = ['2 tbl spns of butter', '2 slices of home baked bread', '2 slices of monteray jack cheese', '1 slice of old cheddar', '1 slice of mozzarella'];
  $preparation_steps = ['Butter one side of each slice of bread', 'Place buttered side of each slice on griddle', 'Place on piece of monteray jack on each piece of bread', 'Place cheddar cheese on one slice of bread', 'Place mozzarella on the opposite piece', 'Once golden brown, combine both pieces', 'Cut into triangles and serve with favourite your ketchup'];
  $date = date("l jS \of F Y", strtotime('2016-05-13'));
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <title>Grilled Cheese</title>
  </head>
  <body>
    <div class="container">
        <h1 class="page-header">Lesson 01 Example<small> - Grilled Cheese</small></h1>

        <div class="panel panel-default">
          <div class="pull-left">
            <img src="http://www.weewatch.com/wp-content/uploads/2016/04/grilled-cheese-_-sex.jpg" class="img-responsive thumbnail"/>
          </div>
          <div class="pull-right">
            <h3>Recipe Ingredients</h3>
            <ul>
              <?php foreach($ingredients as $i)
              {
                echo '<li>' . $i . '</li>';
              } ?>
            </ul>

            <h3>Recipe Preparation Method</h3>
            <ol>
              <?php foreach($preparation_steps as $p): ?>
                <li>
                  <?= $p ?>
                </li>
              <?php endforeach;?>
            </ol>
          </div>

        </div>
    </div>

    <div class="panel-footer">
    <small><strong>Preperation Date: <?= $date ?></strong></small>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>
