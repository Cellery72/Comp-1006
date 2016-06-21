<?php
// Local DB Connection
$dbh = new PDO("mysql:host=localhost;dbname=acsm_866e6052803773b", "root", "");
// Azure DB Connection
//$dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// build statement
$sql = 'SELECT t.team_id, t.team_name, sp.sport_name, l.league_name
FROM teams t
INNER JOIN sports sp
    on t.sport_id = sp.sport_id
INNER JOIN leagues l
    on t.league_id = l.league_id;';

// prepare our SQL
// $artists = $dbh->query( $sql );
$sth = $dbh->prepare($sql);
$sth->execute();
$teams = $sth->fetchAll();
$row_count = $sth->rowCount();

// close the DB connection
$dbh = null;
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal-default-theme.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Professional Sports Teams</title>
</head>
<body>
<div class="container">
    <!-- Create FORM -->
    <section>
        <h1 class="page-header text-center">Add New Professional Sports Team!</h1>
        <form action="add_team.php" method="post">
            <fieldset>
                <div class="row">
                    <!-- Team Name -->
                    <div class="text-center col-xs-4 form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>

                    <!-- League Drop Down -->
                    <div class="text-center col-xs-4 form-group">
                        <label for="league">Professional League</label>
                        <select  class="form-control selectpicker show-tick leagueSelect" id="mainDD" title="Choose a league"
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
                    <div class="text-center col-xs-4 form-group">
                        <label for="sport">Sport</label>
                        <input class="form-control disabled" type="text" id="sport" name="sport" readonly>
                    </div>
                </div>
                <div class="row text-right">
                    <button class="btn btn-success">Add Team</button>
                </div>
            </fieldset>
        </form>
    </section>
    <!--  Table to read data IF there's data in the table -->
    <?php if ($row_count > 0): ?>
        <section class="remodal-bg">
            <div class="container">
                <div class="row">
                    <h2>Team Info</h2>
                    <hr>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Team</th>
                            <th>League</th>
                            <th>Sport</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td><?= $team['team_name'] ?></td>
                                <td><?= $team['league_name'] ?></td>
                                <td><?= $team['sport_name'] ?></td>
                                <td><a href="#edit" onclick="setProperties(<?= $team['team_id'] ?>)" class="id-<?= $team['team_id'] ?>"><i class="fa fa-pencil"></i></a></td>
                                <td>
                                    <form action="delete_team.php" method="post">
                                        <input type="hidden" name="id" value="<?= $team['team_id'] ?>">
                                        <button type="submit"
                                                style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;"
                                                onclick="return confirm('Are you sure want to permanently delete <?= strip_tags($team['team_name']) ?>')">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- Edit Modal FORM -->
    <div class="remodal" data-remodal-id="edit">
        <form action="edit_team.php" method="post">
            <fieldset>
                <div class="row">

                    <!-- Team Name -->
                    <div class="text-center col-xs-4 form-group">
                        <label for="name">Name</label>
                        <input id="team_name" class="form-control" type="text" name="name">
                    </div>

                    <!-- League Drop Down -->
                    <div class="text-center col-xs-4 form-group">
                        <label for="league">Professional League</label>
                        <select class="form-control selectpicker show-tick modalSelect" id="dropdown" title="Choose a league"
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
                    <div class="text-center col-xs-4 form-group">
                        <label for="sport">Sport</label>
                        <input id="sports" class="form-control disabled" type="text" name="sport" readonly>
                    </div>

                </div>
                <div class="row text-right">
                    <button class="btn btn-success">Update Team </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.7/remodal.min.js"></script>

<script>
    var sport = "";
    var teams = {};
    $('.leagueSelect').change(function () {
        var leagueSelected = $('#mainDD').val();
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

    $('.modalSelect').change(function () {
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

    function setProperties(id){
        // get PHP Array of rows
        teams = <?php echo json_encode($teams ); ?>;
        // Iterate through the teams until we find match with id
        for (var i = 0, len = teams.length; i < len; i++) {
            var currentTeam = teams[i];
            if (currentTeam.team_id==id)
            {
                // Set appopriate values
                $('#team_name').val(currentTeam.team_name);
                $('#sports').val(currentTeam.sport_name);
                $('#dropdown').val(currentTeam.league_name);
                $('#dropdown').selectpicker('render');
            }
        }
    }
</script>
</body>
</html>