<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css">
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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- CFL -->
                    <li>
                        <a class="hvr-bounce-in" href="#">
                            <img src="images/cfl.png" style="height:45px;width:auto;" />
                        </a>
                    </li>
                    <!-- NLL -->
                    <li>
                        <a class="hvr-bounce-in" href="#">
                            <img src="images/nll.png" style="height:45px;width:auto;" />
                        </a>
                    </li>
                    <!-- MLB -->
                    <li>
                        <a class="hvr-bounce-in" href="#">
                            <img src="images/mlb.png" style="height:auto;width:70px;" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="splash">
    </section>

    <div id="footer">
        <p style="text-align:right; margin-right:20px;">Copyright Justin Ellery 2016©</p>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch(["images/bg5.jpg",
                       "images/bg2.jpg",
                        "images/bg3.jpg",
                        "images/bg4.jpg"], {
            duration: 3000,
            fade: 750
        });
    </script>
</body>

</html>