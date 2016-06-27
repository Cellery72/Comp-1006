<?php
// Validate Team ID and build SQL string
if (empty($_GET['team_id'])) {  // return all players
    $sql = 'SELECT first_name, last_name, DOB, position, t.team_name
FROM players p
INNER JOIN teams t ON p.team_id = t.team_id;';
} else {    // return players for that team
    $selected_team = $_GET['team_id'];
    $sql = 'SELECT first_name, last_name, DOB, position, t.team_name
FROM players p
INNER JOIN teams t ON p.team_id = t.team_id
WHERE p.team_id=:id;';
}

// Set up DB
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$teamsSQL = 'SELECT * FROM TEAMS;';

// prepare, execute, and fetchAll
$players_sth = $dbh->prepare($sql);
$players_sth->bindParam(':id', $selected_team, PDO::PARAM_INT);
$players_sth->execute();

$teams_sth = $dbh->prepare($teamsSQL);
$teams_sth->execute();

$players = $players_sth->fetchAll();
$teams = $teams_sth->fetchAll();

// count the rows
$row_count = $players_sth->rowCount();

// close the DB connection
$dbh = null;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

    <title>Sports Database</title>

    <!-- Bootstrap, Font-Awesome, Hover.css, Google Fonts, Custom Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css">
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One|Oswald|Pridi" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/styles.css">

    <!-- Remodal.JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal-default-theme.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>

<body>

<!-- Nav Bar -->
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">mySportsDB</a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
            <!-- NHL -->
            <li>
                <a class="hvr-bounce-in" href="teams.php?league_id=1"><img src="assets/images/nhl.png"
                                                                           style="height:45px;width:auto;"/></a>
            </li>

            <!-- NBA -->
            <li>
                <a class="hvr-bounce-in" href="teams.php?league_id=5">
                    <img src="assets/images/nba.png" style="height:45px;width:auto;"/>
                </a>
            </li>

            <!-- NFL -->
            <li>
                <a class="hvr-bounce-in" href="teams.php?league_id=3">
                    <img src="assets/images/nfl.png" style="height:45px;width:auto;"/>
                </a>
            </li>

            <!-- TEAMS dropdown -->
            <li class="dropdown dd">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button">TEAMS <span
                        class="caret"></span></a>
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
                    <li><a href="players.php#addPlayer">Add Player</a></li>
                    <li><a href="./players.php">View Players</a></li>
                </ul>
            </li>

            <!-- CFL -->
            <li class="logo">
                <a class="hvr-bounce-in" href="teams.php?league_id=4">
                    <img src="assets/images/cfl.png" style="height:45px;width:auto;"/>
                </a>
            </li>

            <!-- NLL -->
            <li class="logo">
                <a class="hvr-bounce-in" href="teams.php?league_id=2">
                    <img src="assets/images/nll.png" style="height:45px;width:auto;"/>
                </a>
            </li>

            <!-- MLB -->
            <li class="logo">
                <a class="hvr-bounce-in" href="teams.php?league_id=6">
                    <img src="assets/images/mlb.png" style="height:auto;width:70px;"/>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Section for Rows of Players -->
<section class="remodal-bg">
    <div class="container">
        <?php if ($row_count > 0): ?>
            <div class="row">
                <h2 class="mainHeader">Players of the Team</h2>
                <br>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Position</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?= $player['first_name'] ?></td>
                        <td><?= $player['last_name'] ?></td>
                        <td><?= $player['DOB'] ?></td>
                        <td><?= $player['position'] ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="row">
                <div class="alert alert-danger col-md-4 col-md-offset-4" style="text-align:center;">
                    <strong>Oppss.. No players on this team!!</strong>
                    <p>Add one below or select another team.</p>
                </div>
            </div>
        <?php endif ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
                <a href="#addPlayer" class="btn btn-success">Add a Player!</a>
            </div>
        </div>
</section>

<!-- Modal for Add Player Form -->
<div class="remodal" data-remodal-id="addPlayer">
    <button data-remodal-action="close" class="remodal-close"></button>
    <form action="add_player.php" method="post">
        <fieldset>
            <legend style="text-align: center;">New Player Information..</legend>
            <br/>
            <div class="row">
                <!-- First Name Field -->
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input class="form-control" type="text" name="first_name" required>
                </div>

                <!-- Last Name Field -->
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input class="form-control" type="text" name="last_name" required>
                </div>

                <!-- Team Dropdown-->
                <div class="text-center col-md-8 form-group">
                    <label for="team">Team</label>
                    <select id="teamSelect" class="form-control show-tick" title="Select a team.."
                            name="team" required>
                        <?php foreach ($teams as $team): ?>
                           <option value="<?= $team['team_id'] ?>"><?= $team['team_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- DOB Selection -->
                <div class="form-group col-md-4">
                    <label for="dob">DOB</label>
                    <input type="text" name="dob" id="datepicker">
                </div>
                <br/>
            </div>
            <div class="col-md-2 col-md-offset-5">
                <button class="btn btn-success">Add New Player!</button>
            </div>
            <br/>
        </fieldset>
    </form>
</div>

<!-- Footer Div -->
<footer>
    <p>Copyright Justin Ellery 2016©</p>
</footer>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });

    var players = <?php echo json_encode($players_sth); ?>;

</script>
</body>
</html>
