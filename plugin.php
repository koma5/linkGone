<?php
  /*
Plugin Name: 410 linkGone
Plugin URI: https://github.com/koma5/linkGone
Description: Send a 410 if the link was deleted
Version: 0.1
Author: koma5
Author URI: https://github.com/koma5
  */
yourls_add_action('pre_redirect','temp_instead_function');
function temp_instead_function($args) {
  $url  = $args[0];
  $code = $args[1];
  if (strpos($url, 'link_removed') !== false) {
    printPage();
    die();
  }
}

function printPage() {
header("HTTP/1.0 410 Gone");

echo <<<HTML
<!DOCTYPE html>
<html>
  <head>

  <meta charset="utf-8">
  <title>link gone!!</title>

  <style type="text/css">
  </style>


  </head>

  <body>
  link gone!!
  </body>
</html>
HTML;
}
