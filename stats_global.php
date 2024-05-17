<!DOCTYPE html>
<?php 
error_reporting(0);
session_start();
?>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  
    Document Title
    =============================================
    -->
    <title>Artify | Statistics</title>
    <!--  
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->
    <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.php">Artify</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a href="backend/index.php">Login</a>
            </ul>
          </div>
        </div>
      </nav>
      <div class="main">
        <section class="module bg-dark-60 shop-page-header" data-background="assets/images/background.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">hi guest !</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module-small">
          <div class="container">
            <form class="row" method="POST">
              <div class="col-sm-4 mb-sm-20">
                <select class="form-control" name="type" id="type">
                  <option selected="selected" value="artists">Artists</option>
                  <option value="tracks">Tracks</option>
                </select>
              </div>
              <div class="col-sm-3 mb-sm-20">
                <select class="form-control" name="time" id="time">
                  <option value="short_term">Current</option>
                  <option selected="selected" value="medium_term">Last 6 months</option>
                  <option value="long_term">Ever</option>
                </select>
              </div>
              <div class="col-sm-2 mb-sm-20" >
                <select class="form-control" name="amount" id="amount">
                  <option selected="selected" value="50">50</option>
                  <option value="25">25</option>
                  <option value="10">10</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="col-sm-3">
                <button class="btn btn-block btn-round btn-g" type="submit">Apply</button>
              </div>
            </form>
          </div>
        </section>
        <hr class="divider-w">
        <section class="module-small">
          <div class="container">
            <div class="row multi-columns-row">
              <?php
                if(isset($_POST['type'])){
                    $type = $_POST['type'];
                    $time = $_POST['time'];
                    $amount = $_POST['amount'];

                    $_SESSION['type'] = $type;
                    $_SESSION['time'] = $time;
                    $_SESSION['amount'] = $amount;
                    if($type == 'artists'){
                      $access_token = $_SESSION['access_token'];
                      $curl = curl_init();
                      $me_headers = array(
                          "Authorization: Bearer ".$access_token,
                          "Accept: application/json",
                          "Content-Type: application/json"
                      );
                      
                      curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me/top/artists?time_range=".$time."&limit=".$amount);
                      curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                      $res = curl_exec($curl);
                      curl_close($curl);
                      
                      $jobj = json_decode($res, true);
                      $count = 1;
                      foreach($jobj['items'] as $artists => $artist){
                          echo('<div class="col-sm-6 col-md-3 col-lg-3">
                          <div class="shop-item">
                            <div class="shop-item-image"><img src="'.$artist['images'][1]['url'].'" alt="'.$artists['name'].'"/>
                              <div class="shop-item-detail"><a href="'.$artist['external_urls']['spotify'].'" target="_blank" class="btn btn-round btn-b"><span>Check Profile</span></a></div>
                            </div>
                            <h4 class="shop-item-title font-alt">'.$count.' . ');
                          if(strlen($artist['name']) > 20){
                            echo(substr($artist['name'], 0, 20).'...');
                          }else{
                            echo($artist['name']);
                          }
                          echo('</h4> 
                          </div>
                        </div>');
                        $count++;
                      }
                    }else{
                      $access_token = $_SESSION['access_token'];
                      $curl = curl_init();
                      $me_headers = array(
                          "Authorization: Bearer ".$access_token,
                          "Accept: application/json",
                          "Content-Type: application/json"
                      );
                      
                      curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me/top/tracks?time_range=".$time."&limit=".$amount);
                      curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                      $res = curl_exec($curl);
                      curl_close($curl);
                      
                      $jobj = json_decode($res, true);
                      $count = 1;
                      foreach($jobj['items'] as $tracks => $track){
                          echo('
                          <div class="col-sm-6 col-md-3 col-lg-3">
                          <div class="shop-item">
                            <div class="shop-item-image"><img src="'.$track['album']['images'][1]['url'].'" alt="'.$track['name'].'"/>
                              <div class="shop-item-detail"><a href="'.$track['external_urls']['spotify'].'" target="_blank" class="btn btn-round btn-b"><span>Check Song</span></a></div>
                            </div>
                            <h4 class="shop-item-title font-alt">'.$count.' . ');
                          if(strlen($track['name']) > 20){
                            echo(substr($track['name'], 0, 20).'...');
                          }else{
                            echo($track['name']);
                          }
                          echo('</h4> 
                          </div>
                        </div>');
                        $count++;
                      }
                    }
                  

                }else{
                  $access_token = $_SESSION['access_token'];
                  $type = $_SESSION['type'];
                  $time = $_SESSION['time'];
                  $amount = $_SESSION['amount'];
                  if($type == 'artists'){
                    $curl = curl_init();
                    $me_headers = array(
                        "Authorization: Bearer ".$access_token,
                        "Accept: application/json",
                        "Content-Type: application/json"
                    );
                    
                    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me/top/".$type."?time_range=".$time."&limit=".$amount);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $res = curl_exec($curl);
                    curl_close($curl);
                    
                    $jobj = json_decode($res, true);
                    $count = 1;
                    foreach($jobj['items'] as $artists => $artist){
                        echo('<div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="shop-item">
                          <div class="shop-item-image"><img src="'.$artist['images'][1]['url'].'" alt="'.$artists['name'].'"/>
                            <div class="shop-item-detail"><a href="'.$artist['external_urls']['spotify'].'" target="_blank" class="btn btn-round btn-b"><span>Check Profile</span></a></div>
                          </div>
                          <h4 class="shop-item-title font-alt">'.$count.' . ');
                            if(strlen($artist['name']) > 20){
                              echo(substr($artist['name'], 0, 20).'...');
                            }else{
                              echo($artist['name']);
                            }
                            echo('</h4> 
                            </div>
                          </div>');
                      $count++;
                    }
                  }else{
                    $curl = curl_init();
                      $me_headers = array(
                          "Authorization: Bearer ".$access_token,
                          "Accept: application/json",
                          "Content-Type: application/json"
                      );
                      
                      curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me/top/tracks?time_range=".$time."&limit=".$amount);
                      curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                      $res = curl_exec($curl);
                      curl_close($curl);
                      
                      $jobj = json_decode($res, true);
                      $count = 1;
                      foreach($jobj['items'] as $tracks => $track){
                          echo('
                          <div class="col-sm-6 col-md-3 col-lg-3">
                          <div class="shop-item">
                            <div class="shop-item-image"><img src="'.$track['album']['images'][1]['url'].'" alt="Accessories Pack"/>
                              <div class="shop-item-detail"><a href="'.$track['external_urls']['spotify'].'" target="_blank" class="btn btn-round btn-b"><span>Check Profile</span></a></div>
                            </div>
                            <h4 class="shop-item-title font-alt"><a href="#">'.$count.' . ');
                          if(strlen($track['name']) > 20){
                            echo(substr($track['name'], 0, 20).'...');
                          }else{
                            echo($track['name']);
                          }
                          echo('</a></h4> 
                          </div>
                        </div>');
                        $count++;
                      }
                  }
                }
              ?>
            </div>

          </div>
        </section>

        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
            <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2024&nbsp;<a href="index.html">Artify</a></p>
              </div>
              <!--
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
  	  	      -->
            </div>
          </div>
        </footer>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->
    <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('amount');
        var input2 = document.getElementById('type');
        var input3 = document.getElementById('time');
        if (sessionStorage['amount']) { // if job is set
            input.value = sessionStorage['amount']; // set the value
        }
        if (sessionStorage['type']) { // if job is set
            input2.value = sessionStorage['type']; // set the value
        }
        if (sessionStorage['time']) { // if job is set
            input3.value = sessionStorage['time']; // set the value
        }
        input.onchange = function () {
          sessionStorage['amount'] = this.value; // change localStorage on change
        }
        input2.onchange = function () {
          sessionStorage['type'] = this.value; // change localStorage on change
        }
        input3.onchange = function () {
          sessionStorage['time'] = this.value; // change localStorage on change
        }
      });
    </script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>