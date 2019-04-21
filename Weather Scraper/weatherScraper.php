<?php

    $weather = "";
    $error = "";
    if($_GET["city"]) {
        $forecastPage = file_get_contents("http://completewebdevelopercourse.com/locations/".$_GET["city"]);
        $file_headers = @get_headers($forecastPage);
        if($file_headers[0] == 'HTTP/1.0 400 Bad Request') {
            $error = "That city could not be found.";
        } else {
            $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);
            $secondPageArray = explode('</span></span></span>', $pageArray[1]);
            $weather = $secondPageArray[0];
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Weather Scraper</title>
      
      <style type="text/css">
          body {
              background-image: url("https://images.unsplash.com/photo-1530908295418-a12e326966ba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60");
              background-size: cover;
          }
          .container {
              text-align: center;
              margin-top: 200px;
              width: 450px;
          }
          input {
              margin: 20px 0;
          }
      </style>
  </head>
  <body>
      
      <div class="container">
          <h1>What's The Weather?</h1>
          <form>
              <div class="form-group">
                <label for="city">Enter the name of a city.</label>
                <input type="text" class="form-control" name="city" id="city" aria-describedby="cityField" placeholder="Eg. London" value="<?php echo $_GET["city"]; ?>">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          <div id="weather"><?php
              if($weather) {
                  echo '<div class="alert alert-success" role="alert">'.
                      $weather
                    .'</div>';
              } else if($error) {
                  echo '<div class="alert alert-danger" role="alert">'.
                      $error
                    .'</div>';
              }
          ?></div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>