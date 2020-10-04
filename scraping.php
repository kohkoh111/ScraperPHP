<?php
     
     $weather = "";


       if($_GET['city']){

        $city = str_replace(' ', '', $_GET['city']);

        $file_headers = @get_headers("https://ja.weather-forecast.com/locations/".$city."/forecasts/latest");


        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
          $error = "The city you entered was not found";

        } else {

        $forecastPage = file_get_contents("https://ja.weather-forecast.com/locations/".$city."/forecasts/latest");
        $pageArray = explode('</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

        if(sizeof($pageArray) > 1){
          $secondPageArray = explode('</span></p></td>', $pageArray[1]);
          if(sizeof($secondPageArray) > 1){
            $weather = $secondPageArray[0];
          } else {
            $error = "The city you entered was not found";           
          }
          
        } else{
          $error = "The city you entered was not found";
        }

      }
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
 
    <style type = "text/css">
    html {
        background: url(background.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    body{
        background: none;
    }

    .container{
        text-align: center;
        margin-top: 200px;
        width: 450px;
    }

    input{
        margin: 20px 0;
    }

    #weather{
        margin-top: 15px;
    }

    </style>
    </head>
     <body>

     <div class = "container">
         <h1>What's the weather today?</h1>

         <form>
  <fieldset class="form-group">
    <label for="city">Enter the city you want to know</label>
    <input type="text" class="form-control" name = "city" id="city" placeholder="Eg.New York, Tokyo" value = "<?php echo $city;?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Go!</button>
</form>

<div id = "weather"><?php
if($weather){
  echo '<div class = "alert alert-success" role = "alert">
  '.$weather.'
  </div>';

} else if ($error){
  echo '<div class = "alert alert-danger" role = "alert">
  '.$error.'
  </div>';
}


?></div>
     </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>