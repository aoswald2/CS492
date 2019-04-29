<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Postcode Finder</title>
  </head>
  <body>
      <div class="container">
          <h1>Postcode Finder</h1>
          <p>Enter a partial address to get a postcode.</p>
          <div id="message"></div>
          <form>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" aria-describedby="address" placeholder="Enter Partial Address">
          </div>
          <button id="findPostcode" class="btn btn-primary">Submit</button>
        </form>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      
    <script>
        $('#findPostcode').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent($('#address').val()) + "&key=AIzaSyBSgIC_txc1OeJ4wbdHUWoj5o4zeEM0HQM",
                type: "GET",
                success: function(data) {
                    if(data["status"] != "OK") {
                        $('#message').html('<div class="alert alert-warning" role="alert">Postcode could not be found. Please try again.</div>');
                    }
                    $.each(data["results"][0]["address_components"], function(key, value) {
                        if (value["types"][0] == "postal_code") {
                            $('#message').html('<div class="alert alert-primary" role="alert"><strong>Postcode found!</strong> The postcode is ' + value["long_name"] + '</div>');
                        }
                    });
                }
            });
        });
    </script>
  </body>
</html>