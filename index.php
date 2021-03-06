<?php
// bootstrap_markdown 20130811 (C) Mark Constable (AGPL-3.0)
// A simple script to render Markdown files within a Bootstrap3 contianer.

define('TITLE', 'alsa.opensrc.org');
define('FOOTER', '&copy; 2013 OpenSrc Team (AGPL-3.0)');
define('BLOB', 'https://github.com/opensrc/alsa/blob/master/');
define('EDIT', 'https://github.com/opensrc/alsa/edit/master/');

require 'lib/php/Markdown.php';
use \Michelf\Markdown;

$page = isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'], '/')) : '';

if ($page) {
    if (file_exists('lib/md/' . $page . '.md')) {
        $html = Markdown::defaultTransform(file_get_contents('lib/md/' . $page . '.md')).'
        <div class="edit">
          <a href="'.BLOB.'lib/md/'.$page.'.md">GITHUB</a> |
          <a href="'.EDIT.'lib/md/'.$page.'.md">EDIT</a>
        </div>';
    } else {
        header('HTTP/1.0 404 Not Found');
        $html = '<h1 class="text-center">404 Page Not Found</h1>';
    }
} else {
    $html = include 'lib/php/navigation.php';
}

$menu = '';
$menu_ary = [
    ['README', '<i class="fa fa-file-text"></i>'],
    ['Github', '<i class="fa fa-github-alt"></i>'],
    ['User:Markc', '<i class="fa fa-user"></i>'],
];

foreach($menu_ary as $m) {
    $c = $m[0] == $page ? ' class="active"' : '';
    $menu .= '
            <li'.$c.'><a href="/'.$m[0].'">'.$m[1].' '.$m[0].'</a></li>';
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="alsa linux audio">
    <meta name="description" content="ALSA support site">
    <meta name="author" content="(C) 2013-2014 Mark Constable (AGPL-3.0)">
    <meta name="google-site-verification" content="L4CmEiRi_2aoQ3T2CYsZSQpBa05c3wZuIBONMmrgugU">
    <title><?= TITLE ?></title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
body { padding-top: 50px; overflow-y: scroll; }
h1, h2, h3, h4 { border-bottom: 1px solid #eee; padding-bottom: 2px; margin-top: 20px; }
footer { text-align: center; color: #7F7F7F; font-style: italic; font-family: serif; }
.edit { font-size: 50%; float: right; }
@media (min-width: 768px) { .container { max-width: 760px; } }
    </style>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><i class="fa fa-home"></i> <?= TITLE ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav"><?= $menu ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
      <?= $html ?>

    </div>
    <footer><?= FOOTER ?>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
