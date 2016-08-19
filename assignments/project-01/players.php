<?php

// Validate Team ID and build SQL string
if (empty($_GET['team_id'])) {  // return all players
    $sql = 'SELECT p.first_name, p.last_name, p.DOB, p.position, t.team_name, t.team_id
FROM players p
INNER JOIN teams t ON p.team_id = t.team_id;';
} else {    // return players for that team
    $selected_team = $_GET['team_id'];
    $sql = 'SELECT p.first_name, p.last_name, p.DOB, p.position, t.team_name, t.team_id
FROM players p
INNER JOIN teams t ON p.team_id = t.team_id
WHERE p.team_id=:id;';
}

// Set up DB
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// prepare, execute, and fetchAll
$players_sth = $dbh->prepare($sql);
$players_sth->bindParam(':id', $selected_team, PDO::PARAM_INT);
$players_sth->execute();

// prepare 2nd sql
$teamsSQL = 'SELECT * FROM TEAMS;';
$teams_sth = $dbh->prepare($teamsSQL);
$teams_sth->execute();


$players = $players_sth->fetchAll();
$teams = $teams_sth->fetchAll();

// Set Current Team
foreach ($teams as $tm) {
    if ($tm['team_id'] == $selected_team)
        $ourTeam = $tm;
}

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
        <div class="row">
            <?php if (empty($_GET['team_id'])): ?>
                <h2 class="mainHeader">All Players</h2>
            <?php else: ?>
                <h2 class="mainHeader">Players of the <?= $ourTeam['team_name'] ?></h2>
            <?php endif ?>
            <br>
        </div>
        <?php if ($row_count > 0): ?>
            <div class="row">
                <table class="table table-hover table-bordered">
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
                            <td><?= $player['position'] ?></td><td><a href="#editPlayer" onclick="setProperties(<?= $player['team_id'] ?>)"
                                                                      class="id-<?= $player['team_id'] ?>"><i class="fa fa-pencil"></i></a></td>
                            <td>
                                <form action="delete_team.php" method="post">
                                    <input type="hidden" name="id" value="<?= $player['team_id'] ?>">
                                    <button type="submit"
                                            style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;"
                                            onclick="return confirm('Are you sure want to permanently delete the <?= strip_tags($player['team_name']) ?>?')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </form>
                            </td>
                            <input type="hidden" id="playerID" value="<?= $player['team_id'] ?>">
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="alert alert-danger col-md-4 col-md-offset-4" style="text-align:center;">
                    <strong>Oppss.. No players on this team!!</strong>
                    <p>Add one below or select another team.</p>
                </div>
            </div>
        <?php endif ?>
        <br/>
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

            <!-- First Name Field -->
            <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input class="form-control" id="first_name_field" type="text" name="first_name" required>
            </div>

            <!-- Last Name Field -->
            <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input class="form-control" id="last_name_field" type="text" name="last_name" required>
            </div>

            <!-- DOB Selection -->
            <div class="form-group col-md-6">
                <label for="dob">DOB</label>
                <input type="text" class="form-control" name="dob" id="datepicker">
            </div>

            <!-- Position Field -->
            <div class="form-group col-md-6">
                <label for="position">Position</label>
                <input class="form-control" id="position" type="text" name="position" required>
            </div>

            <!-- Team Dropdown-->
            <div class="text-center col-md-12 form-group">
                <label for="team">Team</label>
                <select id="teamSelect" class="form-control show-tick" title="Select a team.."
                        name="team_id" required>
                    <?php foreach ($teams as $team): ?>
                        <option value="<?= $team['team_id'] ?>"><?= $team['team_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br/>
            <div class="col-md-2 col-md-offset-5">
                <input type="hidden" name="id" id="hiddenID">
                <button class="btn btn-success">Add New Player!</button>
            </div>
            <br/>
        </fieldset>
    </form>
</div>

<!-- Footer Div -->
<footer>
    <p>Copyright Justin Ellery 2016&copy;</p>
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

    $(function () {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

</script>
</body>
</html>
