<?php
  if (isset($_GET["search_term"])) {
    $search_term = urlencode($_GET["search_term"]);
    $uri = "https://www.brooklynmuseum.org/opencollection/api/?method=collection.search" .
      "&version=1&api_key=" . $_SERVER['OPENCOLLECTION_API_KEY'] . "&format=json&results_limit=10&keyword=" . $search_term . "&name=" . $search_term;
    $bm_json_results = json_decode(file_get_contents($uri));

    $bm_results_count = $bm_json_results->{"response"}->{"resultset"}->total;
  }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Brooklyn Museum OpenCollection API Search Example</title>
</head>
<body>
  <form method="get" enctype="application/x-www-form-urlencoded" action="">
    <div id="search_controls">
      <img id="search_icon" src="images/search_icon_32px.png" />
      <label for="search_term">Search museum collections:</label>
      <input id="search_term" name="search_term" type="search" />
      <input id="search_submit" type="submit" value="Search" />
    </div>
  </form>
  <div id="loading_display"><img src="images/ajax_loader.gif" /> Loading...</div>
  <div id="results_container">
  <?php 
    if (count($bm_json_results->{'response'}->{'resultset'}->{'items'}) > 0) {
      include("_search_results.php");
    }
    else {
      include("_no_results.php");
    }
  ?>
  </div>
</body>
</html>