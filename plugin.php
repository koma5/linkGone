<?php
  /*
Plugin Name: 410 linkGone
Plugin URI: https://github.com/koma5/linkGone
Description: Send a 410 if the link was deleted
Version: 0.1
Author: koma5
Author URI: https://github.com/koma5
  */
yourls_add_action('pre_redirect','is_link_gone');
function is_link_gone($args) {
  $url  = $args[0];
  $code = $args[1];
  if (strpos($url, '#linkGone') !== false) {
    printPage();
    die();
  }
}

function printPage() {
header("HTTP/1.0 410 Gone");

$urlBase  = YOURLS_SITE;
$siteName = $urlBase;
$siteName = str_replace('http://', '', $siteName);
$siteName = str_replace('https://', '', $siteName);

echo <<<HTML
<!DOCTYPE html>
<html>
  <head>

  <meta charset="utf-8">
  <meta http-equiv="refresh" content="6; url=$urlBase/">
  <title>410 link gone!! - $siteName/</title>

  </head>

  <body style="background: #222;">
  <span style="color:white; font-size:50px; font-family:sans-serif;">410 link gone!!</span>
  </body>
</html>
HTML;
}

yourls_add_filter('admin_list_where', 'no_display_of_gone_links');
function no_display_of_gone_links($where) {
  $urlBase  = YOURLS_SITE;
  return $where .= " AND `url` != '$urlBase/#linkGone'";
}
