<!DOCTYPE HTML>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <title>title</title>
  </head>

  <body>

    <div class="container">
      <h1 class="page-header">Add New Artist</h1>
      <section>
        <form action="add_artist.php" method="post">
          <fieldset>
            <legend>Artist Info</legend>
            <div class="form-group">
              <label for="name">Artist Name</label>
              <input class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
              <label for="bio_link">Bio Link</label>
              <input class="form-control" type="text" name="bio_link">
            </div>
            <div>
                <button class="btn btn-danger">Add Artist</button>
            </div>
          </fieldset>
        </form>
      </section>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>
