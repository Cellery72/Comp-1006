<?php
// Validate league ID and build SQL string
if (empty($_GET['league_id'])) {    // return all teams
    $sql = 'SELECT t.team_id, t.team_name, sp.sport_name, l.league_name
FROM teams t
INNER JOIN sports sp
    on t.sport_id = sp.sport_id
INNER JOIN leagues l
    on t.league_id = l.league_id;';
} else {    // return teams for that league
    $selected_league = $_GET['league_id'];
    $sql = 'SELECT t.team_id, t.team_name, sp.sport_name, l.league_name
FROM teams t
INNER JOIN sports sp
    on t.sport_id = sp.sport_id
INNER JOIN leagues l
    on t.league_id = l.league_id
WHERE t.league_id = :id;';
}

// Set up DB
$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// prepare, execute, and fetchAll
$teams_sth = $dbh->prepare($sql);
$teams_sth->bindParam(':id', $selected_league, PDO::PARAM_INT);
$teams_sth->execute();
$teams = $teams_sth->fetchAll();
$row_count = $teams_sth->rowCount();


// count the rows
$row_count = $teams_sth->rowCount();

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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/styles.css">

    <!-- Remodal.JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal-default-theme.min.css">
    <title>Sports Database</title>
    <meta charset="UTF-8">
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
                    <li><a href="./teams.php#addTeam">Add Team</a></li>
                    <li><a href="./teams.php">View Team</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <!-- PLAYERS dropdown -->
            <li class="dropdown dd">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button">PLAYERS <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="./players.php#addPlayer">Add Player</a></li>
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

<!-- Section for Rows of Teams-->
<section class="remodal-bg">
    <div class="container">
        <div class="row">
            <h2 class="mainHeader">Sports Teams</h2>
            <br/>
            </row>
            <?php if ($row_count > 0): ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>League</th>
                        <th>Sport</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teams as $team): ?>
                        <tr>
                            <td><a href="players.php?team_id=<?= $team['team_id'] ?>"><?= $team['team_name'] ?></a></td>
                            <td><?= $team['league_name'] ?></td>
                            <td><?= $team['sport_name'] ?></td>
                            <td><a href="#editTeam" onclick="setProperties(<?= $team['team_id'] ?>)"
                                   class="id-<?= $team['team_id'] ?>"><i class="fa fa-pencil"></i></a></td>
                            <td>
                                <form action="delete_team.php" method="post">
                                    <input type="hidden" name="id" value="<?= $team['team_id'] ?>">
                                    <button type="submit"
                                            style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;"
                                            onclick="return confirm('Are you sure want to permanently delete the <?= strip_tags($team['team_name']) ?>')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
            <br/>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <a href="#addTeam" class="btn btn-success">Add New Team!</a>
                </div>
            </div>
        </div>
</section>

<!-- Modal for Add Team Form -->
<div class="remodal" data-remodal-id="addTeam">
    <button data-remodal-action="close" class="remodal-close"></button>
    <form action="add_team.php" method="post">
        <fieldset>
            <legend>New Team</legend>
            <br/>
            <div class="row">

                <!-- Team Name Field -->
                <div class="form-group col-md-12">
                    <label for="name">Team Name</label>
                    <input class="form-control" type="text" name="name" required>
                </div>

                <!-- League Dropdown-->
                <div class="text-center col-md-6 form-group">
                    <label for="league">League</label>
                    <select id="leagueSelect" class="form-control selectpicker show-tick" title="Select a league"
                            name="league">
                        <option value="NHL">NHL</option>
                        <option value="NBA">NBA</option>
                        <option value="CFL">CFL</option>
                        <option value="NFL">NFL</option>
                        <option value="NLL">NLL</option>
                        <option value="MLB">MLB</option>
                    </select>

                </div>

                <!-- Read only Sport Value-->
                <div class="text-center col-md-6 form-group">
                    <label for="sport">Sport</label>
                    <input class="form-control disabled" type="text" id="sport" name="sport" readonly>
                </div>
                <br/>
            </div>
            <br/>
            <div class="col-md-2 col-md-offset-5">
                <button class="btn btn-success">Add Team!</button>
            </div>
            <br/>
        </fieldset>
    </form>
</div>

<!-- Modal for Edit Team Form -->
<div class="remodal" data-remodal-id="editTeam">
    <button data-remodal-action="close" class="remodal-close"></button>
    <form action="update_team.php" method="post">
        <fieldset>
            <legend>Edit Team Information</legend>
            <br/>
            <div class="row">

                <!-- Team Name Field -->
                <div class="form-group col-md-12">
                    <label for="name">Team Name</label>
                    <input class="form-control" type="text" name="name" id="team_name" required>
                </div>

                <!-- League Dropdown-->
                <div class="text-center col-md-6 form-group">
                    <label for="league">League</label>
                    <select id="dropdown" class="form-control selectpicker show-tick" title="Select a league"
                            name="league">
                        <option value="NHL">NHL</option>
                        <option value="NBA">NBA</option>
                        <option value="CFL">CFL</option>
                        <option value="NFL">NFL</option>
                        <option value="NLL">NLL</option>
                        <option value="MLB">MLB</option>
                    </select>

                </div>

                <!-- Read only Sport Value-->
                <div class="text-center col-md-6 form-group">
                    <label for="sport">Sport</label>
                    <input class="form-control disabled" type="text" id="sports" name="sport" readonly>
                </div>

                <br/>
            </div>
            <br/>
            <div class="col-md-2 col-md-offset-5">
                <input type="hidden" name="id" id="hiddenID">
                <button class="btn btn-success">Update Team!</button>
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
<script>
    var sport = "";
    $('#leagueSelect').change(function () {
        var leagueSelected = $('#leagueSelect').val();
        switch (leagueSelected) {
            case "NHL":
                sport = "Hockey";
                break;
            case "NBA":
                sport = "Basketball";
                break;
            case "CFL":
                sport = "Football";
                break;
            case "NFL":
                sport = "Football";
                break;
            case "NLL":
                sport = "Lacrosse";
                break;
            case "MLB":
                sport = "Baseball";
                break;
        }
        $('#sport').val(sport);
    });

    // GROSS PT2
    $('#dropdown').change(function () {
        var leagueSelected = $('#dropdown').val();
        switch (leagueSelected) {
            case "NHL":
                sport = "Hockey";
                break;
            case "NBA":
                sport = "Basketball";
                break;
            case "CFL":
                sport = "Football";
                break;
            case "NFL":
                sport = "Football";
                break;
            case "NLL":
                sport = "Lacrosse";
                break;
            case "MLB":
                sport = "Baseball";
                break;
        }
        $('#sports').val(sport);
    });
    function setProperties(id) {
        // get PHP Array of rows
        teams = <?php echo json_encode($teams); ?>;
        // Iterate through the teams until we find match with id
        for (var i = 0, len = teams.length; i < len; i++) {
            var currentTeam = teams[i];
            if (currentTeam.team_id == id) {
                // Set appopriate values
                $('#team_name').val(currentTeam.team_name);
                $('#sports').val(currentTeam.sport_name);
                $('#dropdown').val(currentTeam.league_name);
                $('#dropdown').selectpicker('render');
                $('#hiddenID').val(currentTeam.team_id);
            }
        }
    }
</script>
</body>

</html>
