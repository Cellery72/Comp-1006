<?php

    $host = 'localhost';
    $dbname = 'comp-1006-lesson-examples';
    $username = 'root';
    $password = '';

  // connect to the DB
  $dbh = new PDO( "mysql:host={$host};dbname={$dbname}", $username, $password );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // build the SQL statment
  $sql = 'SELECT * FROM artists';

  // prepare, execute, and fetchAll
  $artists = $dbh->query( $sql );

  // count the rows
  $row_count = $artists->rowCount();

  // close the DB connection
  $dbh = null;

?>

<!DOCTYPE html>
<html>
  <head>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' rel='stylesheet'>
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css' integrity='sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O' rel='stylesheet'>
    <title>All Artists</title>
  </head>
  <body>
    <div class='container'>
      <header>
        <h3 class='page-header'>All Artists</h3>
      </header>
      <section>
        <?php if ( $row_count > 0 ): ?>
          <table class='table'>
            <thead>
              <tr>
                <th>Artist</th>
                <th>Bio</th>
                <th>Actions</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ( $artists as $artist ): ?>
                <tr>
                  <td><a href="artist_songs.php?id=<?= $artist['id'] ?>"><?= strip_tags($artist['name']) ?></a></td>
                  <td><a href="<?= htmlspecialchars( $artist['bio_link'] ) ?>"><?= strip_tags($artist['bio_link']) ?></a></td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                  <td>
                    <form action="delete_artists.php" method="post">
                      <input type="hidden" name="id" value="<?= $artist['id'] ?>">
                      <button type="submit" style="border:0; background:none; padding:0; margin:0; color:#337ab7;" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-remove"></i></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-warning">
            No song information to display.
          </div>
        <?php endif ?>
      </section>
    </div>
  </body>
</html>
