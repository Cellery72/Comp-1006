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
    <!-- Nav Bar -->
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
                    <!-- NBA -->
                    <li>
                        <a class="hvr-bounce-in" href="#">
                            <img src="images/nba.png" style="height:45px;width:auto;" />
                        </a>
                    </li>
                    <!-- NFL -->
                    <li>
                        <a class="hvr-bounce-in" href="#">
                            <img src="images/nfl.png" style="height:45px;width:auto;" />
                        </a>
                    </li>
                    <!-- TEAMS dropdown -->
                    <li class="dropdown dd">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button">TEAMS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="./teams.php#modal">Add Team</a></li>
                            <li><a href="./teams.php">View Team</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- PLAYERS dropdown -->
                    <li class="dropdown dd">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button">PLAYERS <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/players.php#">Add Player</a></li>
                            <li><a href="/players.php">View Players</a></li>
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

    <!-- Main Splash Section -->
    <section id="splash">
        <div class="container">
            <div class="jumbotron">
                <h1 id="opener">
                    Welcome to the Professional Sports Database of Professionals..
                </h1>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <footer>
        <p>Copyright Justin Ellery 2016©</p>
    </footer>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
</body>
</html>
