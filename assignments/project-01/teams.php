<?php
  $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // build the SQL statment
  $sql = 'SELECT * FROM teams';
  // prepare, execute, and fetchAll
  $teams = $dbh->query( $sql );
  // count the rows
  $row_count = $teams->rowCount();
  // close the DB connection
  $dbh = null;
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>
        <!-- Bootstrap, Font-Awesome, Hover.css, Google Fonts, Custom Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css">
        <link href="https://fonts.googleapis.com/css?family=Black+Ops+One|Oswald|Pridi" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <title>Sports Database</title>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <!-- NHL -->
                        <li>
                            <a class="hvr-bounce-in" href="#"><img src="images/nhl.png" style="height:45px;width:auto;" /></a>
                        </li>
                        <! -- NBA -->
                        <li>
                            <a class="hvr-bounce-in" href="#">
                                <img src="images/nba.png" style="height:45px;width:auto;" />
                            </a>
                        </li>
                        <! -- NFL -->
                        <li>
                            <a class="hvr-bounce-in" href="#">
                                <img src="images/nfl.png" style="height:45px;width:auto;" />
                            </a>
                        </li>
                        <!-- TEAMS dropdown -->
                        <li class="dropdown dd">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button">TEAMS <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Add Team</a></li>
                                <li><a href="./teams.php">View Team</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- PLAYERS dropdown -->
                        <li class="dropdown dd">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button">PLAYERS <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Add Player</a></li>
                                <li><a href="./players.php">View Players</a></li>
                            </ul>
                        </li>
                        <!-- CFL -->
                        <li class="logo">
                            <a class="hvr-bounce-in" href="#">
                                <img src="images/cfl.png" style="height:45px;width:auto;" />
                            </a>
                        </li>
                        <!-- NLL -->
                        <li class="logo">
                            <a class="hvr-bounce-in" href="#">
                                <img src="images/nll.png" style="height:45px;width:auto;" />
                            </a>
                        </li>
                        <!-- MLB -->
                        <li class="logo">
                            <a class="hvr-bounce-in" href="#">
                                <img src="images/mlb.png" style="height:auto;width:70px;" />
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <section>
            <div class="container">
                <h2 style="text-align:center;">Sports Teams</h2>
                <?php if ( $row_count > 0 ): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Team Name</th>
                                <th>League</th>
                                <th>Sport</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td><?= $team['team_name'] ?></td>
                                <td><?= $team['league_id'] ?></td>
                                <td><?= $team['sport_id'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php endif ?>
            </div>
        </section>

        <footer>
            <p>Copyright Justin Ellery 2016©</p>
        </footer>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
    </body>

    </html>