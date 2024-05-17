<!DOCTYPE html>
<?php session_start();
if(!isset($_SESSION['access_token'])){
    header('Location: index.php');
} 
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
    <title>Artify | Recommendations</title>
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
              <li class="dropdown"><a href="stats.php">See Statistics</a>
              <li class="dropdown"><a href="backend/logout.php">Logout</a>
            </ul>
          </div>
        </div>
      </nav>
      <div class="main">
        <section class="module bg-dark-60 shop-page-header" data-background="assets/images/background.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">hi <?php echo($_SESSION['user_name'])?> !</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module-small">
          <div class="container">
            <div class="row">
            <form method="POST">
              <div class="col-sm-6">
                <button class="btn btn-block btn-round btn-g" name="newSubmit" type="submit">Get new</button>
              </div>
            </form>
            <form method="POST">
              <div class="col-sm-6">
                <button class="btn btn-block btn-round btn-g" name="listSubmit" type="submit">Create Playlist</button>
              </div>
            </form>
            </div>
          </div>
        </section>
        <hr class="divider-w">
        <section class="module-small">
          <div class="container">
            <div class="row multi-columns-row">
              <?php

              //creating new playlist on spotify 
                if(isset($_POST['listSubmit'])){
                  //generate playlist info
                  $post = [
                    'name' => 'Artify Recommended',
                    'description' => 'artify playlisterino',
                    'public'   => 'false'
                  ];
                  $access_token = $_SESSION['access_token'];
                  $me_headers = array(
                    "Authorization: Bearer ".$access_token,
                    "Accept: application/json",
                    "Content-Type: application/json"
                  );
                  //get recommended track ids
                  $track_uris = $_SESSION['track_uris'];
                  $idtrack_uris_comma = implode(',', $track_uris);
                  
                  //create request
                  $payload = json_encode($post);
                  $curl = curl_init();
                  curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/users/".$_SESSION['id']."/playlists");
                  curl_setopt($curl, CURLOPT_POST, true);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                  curl_setopt($curl, CURLOPT_POSTFIELDS,$payload);
                  
                  $res = curl_exec($curl);
                  $obj = json_decode($res, true);
                  $playlist_id = $obj['id'];
                  $playlist_url = $obj['external_urls']['spotify'];
                  
                  $payload = json_encode($post);
                  
                  curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/playlists/".$playlist_id."/tracks?uris=".$idtrack_uris_comma);
                  curl_setopt($curl, CURLOPT_POST, true);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                  
                  $res = curl_exec($curl);
                  $obj = json_decode($res, true);
                  curl_close($curl);
                }
                // end creating new playlist on spotify 

                //generate new recommendations
                $res_count = 0;

                $access_token = $_SESSION['access_token'];
                $curl = curl_init();
                $me_headers = array(
                    "Authorization: Bearer ".$access_token,
                    "Accept: application/json",
                    "Content-Type: application/json"
                );
                $current = array();
                $artists = array();
                $track_uris = array();
                $danceability = 0;
                $energy = 0;
                $loudness = 0;
                $acousticness = 0;
                $instrumentalness = 0;
                $liveness = 0;
                $popularity = 0;


                curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me/top/tracks?time_range=medium_term&limit=50");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $res = curl_exec($curl);

                $obj = json_decode($res, true);
                foreach($obj['items'] as $tracks => $track){
                    $current[] = $track['id'];
                    $artists[] = $track['artists'][0]['id'];
                    $popularity += $track['popularity'];
                    $res_count++;
                }
                
                $ids = implode(',', $current);
                $start = rand(0, count($artists)-4);
                $artistsids = implode(',', array_slice($artists, $start, 2));

                
                curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/audio-features?ids=".$ids);
                $res = curl_exec($curl);
                $obj = json_decode($res, true);
                #print_r($obj);

                foreach($obj['audio_features'] as $tracks => $track){
                    $danceability += $track['danceability'];
                    $energy += $track['energy'];
                    $loudness += $track['loudness'];
                    $acousticness += $track['acousticness'];
                    $instrumentalness += $track['instrumentalness'];
                    $liveness += $track['liveness'];
                }
                $start = rand(0, count($current)-3);
                $ids = implode(',', array_slice($current, $start, 2));

                $danceability /= $res_count;
                $energy /= $res_count;
                $loudness /= $res_count;
                $popularity /= $res_count;
                $acousticness /= $res_count;
                $instrumentalness /= $res_count;
                $liveness /= $res_count;
                #print_r($popularity);
                if($popularity > 20){
                  $popularity -= 10;
                }

                if(rand(0,1) == 1){
                  $danceability -= rand(0,0.2);
                  $energy -= rand(0,0.2);
                  $loudness -= rand(0,3);
                  $acousticness += rand(0,0.1);
                  $instrumentalness += rand(0,0.1);
                  $liveness -= rand(0,0.2);
                }else{
                  $danceability += rand(0,0.2);
                  $energy += rand(0,0.2);
                  $loudness += rand(0,3);
                  $acousticness -= rand(0,0.1);
                  $instrumentalness -= rand(0,0.1);
                  $liveness += rand(0,0.2);
                }

                curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/recommendations?seed_artists=".$artistsids."&seed_tracks=".$ids."&target_danceability=".$danceability."&target_energy=".$energy."&target_loudness=".$loudness."&target_acousticness=".$acousticness."&target_instrumentalness=".$instrumentalness."&target_liveness=".$liveness."&target_popularity=".intval($popularity)."&max_popularity=".intval($popularity+10));
                $res = curl_exec($curl);
                $obj = json_decode($res, true);

                #print_r($obj);
                #print_r($obj['tracks'][0]);
                foreach($obj['tracks'] as $tracks => $track){
                  $track_uris[] = $track['uri'];
                  echo('<div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="shop-item">
                    <div class="shop-item-image"><img src="'.$track['album']['images'][1]['url'].'" alt="Accessories Pack"/>
                      <div class="shop-item-detail"><a href="'.$track['external_urls']['spotify'].'" target="_blank" class="btn btn-round btn-b"><span>Check Song</span></a></div>
                    </div>
                    <h4 class="shop-item-title font-alt">');
                    if(strlen($track['artists'][0]['name']) > 20){
                      echo(substr($track['artists'][0]['name'], 0, 20).'...');
                    }else{
                      echo($track['artists'][0]['name']);
                    }
                    echo('</a></h4>');
                    echo('<h4 class="shop-item-title font-alt">');
                    if(strlen($track['name']) > 20){
                      echo(substr($track['name'], 0, 20).'...');
                    }else{
                      echo($track['name']);
                    }
                    echo('</a></h4>');
                    echo('
                    </div>
                  </div>' );
                }
                $_SESSION['track_uris'] = $track_uris;
              
                
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