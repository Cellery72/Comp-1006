<?php
    // Local DB Connection
    //$dbh = new PDO("mysql:host=localhost;dbname=comp-1006-lesson-examples", "root", "");
    // Azure DB Connection
    $dbh = new PDO("mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net;dbname=acsm_866e6052803773b", "bef99d16faecee", "6fed48b7");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // build statement
    $sql = 'SELECT * FROM heroes';

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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
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
                        <select id="leagueSelect" class="form-control selectpicker show-tick" title="Choose a league"
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
        <section>
            <div class="container">
                <div class="row">
                    <h2>Hero Info</h2>
                    <hr>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Team</th>
                            <th>League</th>
                            <th>Sport</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td><?= $team['name'] ?></td>
                                <td><?= $team['league'] ?></td>
                                <td><?= $team['sport'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endif ?>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
</script>
</body>
</html>